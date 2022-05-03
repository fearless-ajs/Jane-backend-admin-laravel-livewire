<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use App\Models\Product;
use App\Models\Worker;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompanyCreateInvoiceForm extends Component
{
    public $to;
    public $invoice_number;
    public $date;
    public $due_date;
    public $bank_name;
    public $account_number;
    public $account_name;
    public $sales_person;
    public $accepts_payment = [];
    public $note;

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





    // contacts and workers
    public $contacts;
    public $workers;
    public $products;

    public function updated($field){
       $this->computeProductData();







        $this->validateOnly($field, [
            'to'            => 'required|numeric',
            'date'          => 'required|string|max:255',
            'due_date'      => 'required|string|max:255',
        ]);
    }

    public function mount(){
        $this->fetchUsersData();
    }

    public function addProductItem(){
        // Validate inputs
        $checkInput = $this->validateItemInputs();
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

    public function validateItemInputs(){
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
            $this->product_total_price = $this->product_selected_item->price * $this->product_quantity;

            $this->product_unit_price = $this->product_selected_item->price;
        }
        // Compute item total price;



    }

    public function fetchUsersData(){
        $this->contacts  = Contact::where('company_id', Auth::user()->company_id)->get();
        $this->workers   = Worker::where('company_id', Auth::user()->company_id)->get();
        $this->products  = Product::where('company_id', Auth::user()->company_id)->get();

        $this->fetchFormData();
    }

    public function fetchFormData(){
        $this->invoice_number = sprintf("%06d", mt_rand(1, 999999999));
    }

    public function render()
    {
        return view('livewire.company.components.company-create-invoice-form');
    }
}
