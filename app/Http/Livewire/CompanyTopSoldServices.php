<?php

namespace App\Http\Livewire;

use App\Models\CartOrderCatalogue;
use App\Models\Company;
use App\Models\Expense;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Livewire\Component;

class CompanyTopSoldServices extends Component
{
    public $company;
    // 1. Fetch the top 7 products, group_by catalogue_id then pick the ordered between a month selected month range (default last month)

    public $types = [];

    public $colors = [
        'food'          => '#f6ad55',
        'shopping'      => '#fc8181',
        'entertainment' => '#90cdf4',
        'travel'        => '#66DA26',
        'other'         => '#cbd5e0',
    ];

    public $firstRun = true;

    public $showDataLabels = false;

    protected $listeners = [
        'onPointClick' => 'handleOnPointClick',
        'onSliceClick' => 'handleOnSliceClick',
        'onColumnClick' => 'handleOnColumnClick',
        'onBlockClick' => 'handleOnBlockClick',
    ];


    public function handleOnPointClick($point)
    {
        dd($point);
    }

    public function handleOnSliceClick($slice)
    {
        dd($slice);
    }

    public function handleOnColumnClick($column)
    {
        dd($column);
    }

    public function handleOnBlockClick($block)
    {
        dd($block);
    }


    public function mount($company_id){
        $this->company = Company::find($company_id);
        $orders   = CartOrderCatalogue::orderBy('created_at', 'DESC')->where('company_id', $this->company->id)->where('type', 'service')->limit(4)->get();
        if ($orders){
            foreach ($orders as $order){
                array_push($this->types, $order->catalogue->name);
            }
        }
    }

    public function render()
    {
        $orders   = CartOrderCatalogue::orderBy('created_at', 'DESC')->where('company_id', $this->company->id)->where('type', 'service')->limit(4)->get();


        $pieChartModel = $orders->groupBy('catalogue.name')
            ->reduce(function ($pieChartModel, $data) {
                $type = $data->first()->catalogue->name;
                $value = $data->sum('catalogue_id');

                return $pieChartModel->addSlice($type, $value,  '#f6ad55');
            }, LivewireCharts::pieChartModel()
                ->setTitle('Services usage')
                ->setAnimated($this->firstRun)
                ->setType('donut')
                ->withOnSliceClickEvent('onSliceClick')
                //->withoutLegend()
                ->legendPositionBottom()
                ->legendHorizontallyAlignedCenter()
                ->setDataLabelsEnabled($this->showDataLabels)
                ->setColors(['#b01a1b', '#d41b2c', '#ec3c3b', '#f66665'])
            );

        return view('livewire.company.components.company-top-sold-services')->with([
            'pieChartModel' => $pieChartModel,
        ]);
    }
}
