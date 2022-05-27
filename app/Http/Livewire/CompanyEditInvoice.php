<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use App\Models\Invoice;
use App\Models\InvoicePaymentMethod;
use App\Models\InvoiceProduct;
use App\Models\InvoiceService;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Worker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use Livewire\Component;

class CompanyEditInvoice extends Component
{
    public $invoice;

    public $to;
    public $worker;

    public $invoice_number;
    public $date_issued;
    public $due_date;
    public $account_number;
    public $account_name;
    public $payment_methods = [];
    public $note;
    public $invoice_note;
    public $status;

    public $existing_methods=[];

    public $product_quantity_error;

    // Product Item selection params
    public $items;
    public $product_item;
    public $product_unit_price;
    public $product_quantity = 1;
    public $product_item_note;
    public $product_total_price = 0;
    // Selected Item
    public $product_selected_item;
    public $product_selected_items = [];


    // Service Item selection params
    public $service_items;
    public $service_item;
    public $service_unit_price;
    public $service_unit;
    public $service_volume = 1;
    public $service_item_note;
    public $service_total_price = 0;
    // Selected Item
    public $service_selected_item;
    public $service_selected_items = [];


    // contacts and workers
    public $contacts;
    public $workers;
    public $products;
    public $services;

    public $settings;
    // Listener for refreshing the component;
    protected $listeners = ['refreshInvoiceEdit' => '$refresh'];

    public function mount($invoice){
        $this->settings = Setting::first();
        $this->invoice = $invoice;
        $this->fetchUsersData();
        $this->generateInvoiceFormData();
    }

    public function updated($field){
        $this->computeProductData();
        $this->computeServiceData();


        $this->validateOnly($field, [
            'to'                        => 'required|numeric',
            'worker'                    => 'required|numeric',
            'date_issued'               => 'required|string|max:255',
            'due_date'                  => 'required|string|max:255',
            'payment_methods'           => 'required|array',
            'invoice_note'              => 'nullable|string|max:2000',
        ]);
    }

    public function addProductItem(){
        // Validate inputs
        $checkInput = $this->validateProductItemInputs();
        if ($checkInput['errorCode'] != 'SUCCESS'){
            return $this->emit('alert', ['type' => 'error', 'message' => $checkInput['errorCode']]);
        }

        $item = [
            'id'                => $this->product_selected_item->id,
            'name'              => $this->product_selected_item->name,
            'quantity'          => $this->product_quantity,
            'unit_price'        => $this->product_unit_price,
            'total_price'       => $this->product_total_price,
            'note'              => $this->product_item_note
        ];

        $productIsPresent = false;
        if (count($this->product_selected_items) > 0){
            foreach ($this->product_selected_items as $p_item){
                if ($this->product_selected_item->name == $p_item['name']){
                    $productIsPresent = true;
                }
            }
        }
        if ($productIsPresent){
            // Add to the existing product
            return $this->emit('alert', ['type' => 'error', 'message' => 'You have already selected this product']);
        }
        array_push($this->product_selected_items, $item);

        // Clear the input
        $this->product_item        = '';
        $this->product_item_note   = '';
        $this->product_quantity    = 1;
        $this->product_unit_price  = '';
        $this->product_total_price = 0;
    }

    public function validateProductItemInputs(){
        // Check if an item is selected
        if (!$this->product_item){
            return [
                'errorCode' => 'Please select an item'
            ];
        }

        // Check f quantity is less that one
        if (!$this->product_quantity || $this->product_quantity < 1){
            return [
                'errorCode'   => 'Please select a valid qantity'
            ];
        }

        if (!$this->product_item_note){
            return [
                'errorCode'   => 'Please add a description to the item'
            ];
        }

        return [
            'errorCode' => 'SUCCESS'
        ];
    }

    public function computeProductData(){
        // Compute item unit price
        if ($this->product_item && $this->product_quantity > 0){
            $this->product_selected_item = Product::find($this->product_item);
            // Check for quantity && availability
            if ($this->product_quantity > $this->product_selected_item->quantity){
                $this->product_quantity_error = true;
                $this->product_quantity = $this->product_selected_item->quantity;
                $this->product_total_price = $this->product_selected_item->price * $this->product_quantity;
                $this->product_unit_price = $this->product_selected_item->price;
                return $this->emit('alert', ['type' => 'warning', 'message' => 'The quantity selected is more than available product']);
            }

            $this->product_quantity_error = false;
            $this->product_total_price = $this->product_selected_item->price * $this->product_quantity;
            $this->product_unit_price = $this->product_selected_item->price;
        }
    }



    public function addServiceItem(){
        // Validate inputs
        $checkInput = $this->validateServiceItemInputs();
        if ($checkInput['errorCode'] != 'SUCCESS'){
            return $this->emit('alert', ['type' => 'error', 'message' => $checkInput['errorCode']]);
        }

        $item = [
            'id'                => $this->service_selected_item->id,
            'name'              => $this->service_selected_item->name,
            'usage'             => $this->service_selected_item->usage_unit,
            'volume'            => $this->service_volume,
            'unit_price'        => $this->service_unit_price,
            'total_price'       => $this->service_total_price,
            'note'              => $this->service_item_note
        ];

        $serviceIsPresent = false;
        if (count($this->service_selected_items) > 0){
            foreach ($this->service_selected_items as $s_item){
                if ($this->service_selected_item->name == $s_item['name']){
                    $serviceIsPresent = true;
                }
            }
        }
        if ($serviceIsPresent){
            // Add to the existing product
            return $this->emit('alert', ['type' => 'error', 'message' => 'You have already selected this service']);
        }
        array_push($this->service_selected_items, $item);

        // Clear the input
        $this->service_item        = '';
        $this->service_item_note   = '';
        $this->service_volume      = 1;
        $this->service_unit        = '';
        $this->service_unit_price  = '';
        $this->service_total_price = 0;
    }

    public function validateServiceItemInputs(){
        // Check if an item is selected
        if (!$this->service_item){
            return [
                'errorCode' => 'Please select a service'
            ];
        }

        // Check f quantity is less that one
        if (!$this->service_volume || $this->service_volume < 1){
            return [
                'errorCode'   => 'Please select a valid service volume'
            ];
        }

        if (!$this->service_item_note){
            return [
                'errorCode'   => 'Please add a description to the service'
            ];
        }

        return [
            'errorCode' => 'SUCCESS'
        ];
    }

    public function computeServiceData(){
        // Compute item unit price

        if ($this->service_item && $this->service_volume){
            $this->service_selected_item = Service::find($this->service_item);
            $this->service_total_price = $this->service_selected_item->price * $this->service_volume;
            $this->service_unit = $this->service_selected_item->usage_unit;

            $this->service_unit_price = $this->service_selected_item->price;
        }
    }


    public function fetchUsersData(){
        $this->contacts  = Contact::where('company_id', Auth::user()->company_id)->get();
        $this->workers   = Worker::where('company_id', Auth::user()->company_id)->get();
        $this->products  = Product::where('company_id', Auth::user()->company_id)->get();
        $this->services  = Service::where('company_id', Auth::user()->company_id)->get();

        $this->fetchFormData();
    }

    public function fetchFormData(){
        $this->invoice_number = Str::random(4).''.sprintf("%06d", mt_rand(1, 999999999));
    }

    public function removeProduct($product_index, $product_id){
        unset($this->product_selected_items[$product_index]);
        $this->product_selected_items = array_values($this->product_selected_items);

        // Remove from database Too
        InvoiceProduct::where('invoice_id', $this->invoice->id)->where('product_id', $product_id)->delete();

        return $this->emit('alert', ['type' => 'success', 'message' => 'Product removed']);
    }

    public function removeService($service_index, $service_id){
        unset($this->service_selected_items[$service_index]);
        $this->service_selected_items = array_values($this->service_selected_items);

        // Remove from database Too
        InvoiceService::where('invoice_id', $this->invoice->id)->where('service_id', $service_id)->delete();

        return $this->emit('alert', ['type' => 'success', 'message' => 'Service removed']);
    }


    public function generateInvoiceFormData(){
        $this->invoice_number        = $this->invoice->invoice_code;
        $this->date_issued           = Date::parse($this->invoice->date_issued)->format('Y-m-d');
        $this->due_date              = Date::parse($this->invoice->due_date)->format('Y-m-d');
        $this->to                    = $this->invoice->contact_id;

        $this->worker                = $this->invoice->worker_id;
        $this->invoice_note          = $this->invoice->note;

       $payment_methods = InvoicePaymentMethod::where('invoice_id', $this->invoice->id)->get();
       if ($payment_methods){
           foreach ($payment_methods as $method){
               array_push($this->existing_methods, $method->method);
           }
       }

       $this->note                     = $this->invoice->note;
       $this->status                   = $this->invoice->status;

       // Compute products
        $products = InvoiceProduct::where('invoice_id', $this->invoice->id)->get();
        if($products){
            foreach ($products as $product){
                $item = [
                    'id'                => $product->product->id,
                    'name'              => $product->product->name,
                    'quantity'          => $product->quantity,
                    'unit_price'        => $product->unit_price,
                    'total_price'       => $product->total_price,
                    'note'              => $product->description
                ];

                array_push($this->product_selected_items, $item);
            }
        }

        // Compute services
        $services = InvoiceService::where('invoice_id', $this->invoice->id)->get();
        if ($services){
            foreach ($services as $service){
                $item = [
                    'id'                => $service->service->id,
                    'name'              => $service->service->name,
                    'usage'             => $service->usage,
                    'volume'            => $service->volume,
                    'unit_price'        => $service->unit_price,
                    'total_price'       => $service->total_price,
                    'note'              => $service->description
                ];
                array_push($this->service_selected_items, $item);
            }
        }

    }


    public function updateInvoice(){
        // Either of the product or service must be selected
        if (count($this->product_selected_items) < 1 && count($this->service_selected_items) < 1){
            return $this->emit('alert', ['type' => 'error', 'message' => 'You have to select at least one product or service']);
        }

        $this->validate([
            'to'                => 'required|numeric',
            'worker'            => 'required|numeric',
            'date_issued'       => 'required|max:255',
            'due_date'          => 'required|max:255',
            'payment_methods'   => 'required|array',
            'invoice_note'      => 'nullable|max:2000'
        ]);

        // Calculate total price for products and services
        $productTotalPrice = 0;
        if (count($this->product_selected_items) > 0){
            foreach ($this->product_selected_items as $p_item){
                $productTotalPrice = $productTotalPrice + $p_item['total_price'];
            }
        }
        $serviceTotalPrice = 0;
        if (count($this->service_selected_items) > 0){
            foreach ($this->service_selected_items as $s_item){
                $serviceTotalPrice = $serviceTotalPrice + $s_item['total_price'];
            }
        }


        // Create the invoice
        $invoice = Invoice::where('id', $this->invoice->id)->update([
            'contact_id'                => $this->to,
            'worker_id'                 => $this->worker,
            'last_updated_by_id'        => Auth::user()->id, // User_id not worker id

            'date_issued'               => $this->date_issued,
            'due_date'                  => $this->due_date,

            'products_total_price'      => $productTotalPrice,
            'services_total_price'      => $serviceTotalPrice,

            'note'                      => $this->invoice_note,

            'status'                    => $this->status,
        ]);

        // create payment methods table
        if (count($this->payment_methods) > 0){
            foreach ($this->payment_methods as $method){
                // Check if the payment method exist and skip
                if (!InvoicePaymentMethod::where('invoice_id', $this->invoice->id)->where('method', $method)->first()){
                    InvoicePaymentMethod::create([
                        'invoice_id'    => $this->invoice->id,
                        'method'        => $method
                    ]);
                }
            }
        }

        // Create invoice products
        if (count($this->product_selected_items) > 0){
            foreach ($this->product_selected_items as $p_item) {
                // Check if the product exist then skip
                if (!InvoiceProduct::where('invoice_id', $this->invoice->id)->where('product_id', $p_item['id'])->first()){
                    InvoiceProduct::create([
                        'invoice_id'        => $this->invoice->id,
                        'product_id'        => $p_item['id'],
                        'quantity'          => $p_item['quantity'],
                        'unit_price'        => $p_item['unit_price'],
                        'total_price'       => $p_item['total_price'],
                        'description'       => $p_item['note']
                    ]);
                }
            }
        }

        // Create invoice services
        if (count($this->service_selected_items) > 0){
            foreach ($this->service_selected_items as $s_item) {
                // Check if the service exist then skip
                if (!InvoiceService::where('invoice_id', $this->invoice->id)->where('service_id', $s_item['id'])->first()){
                    InvoiceService::create([
                        'invoice_id'        => $this->invoice->id,
                        'service_id'        => $s_item['id'],
                        'usage'             => $s_item['usage'],
                        'volume'            => $s_item['volume'],
                        'unit_price'        => $s_item['unit_price'],
                        'total_price'       => $s_item['total_price'],
                        'description'       => $s_item['note']
                    ]);
                }
            }
        }

        return $this->emit('alert', ['type' => 'success', 'message' => 'Invoice update']);

    }


    public function removePaymentMethod($method){
        InvoicePaymentMethod::where('invoice_id', $this->invoice->id)->where('method', $method)->delete();
        $this->emit('refreshInvoiceEdit');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Payment method removed']);
    }

    public function render()
    {
        return view('livewire.company.components.company-edit-invoice');
    }
}
