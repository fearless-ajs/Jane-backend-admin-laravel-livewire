<?php

namespace App\Http\Livewire;

use App\Models\CartOrderCatalogue;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Livewire\Component;

class AdminTopSoldProducts extends Component
{
    // 1. Fetch the top 7 products, group_by catalogue_id then pick the ordered between a month selected month range (default last month)

    public $types = ['food', 'shopping', 'entertainment', 'travel', 'other'];

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

    public function render()
    {
        $orders   = CartOrderCatalogue::orderBy('created_at', 'DESC')->orderBy('quantity', 'DESC')->where('type', 'product')->limit(10)->get();

        $columnChartModel = $orders->groupBy('catalogue_id')
            ->reduce(function ($columnChartModel, $data) {
                $type = $data->first()->catalogue->name;
                $value = $data->sum('quantity');

                return $columnChartModel->addColumn($type, $value, '#f6ad55');
            }, LivewireCharts::columnChartModel()
                ->setTitle('Top sold products')
                ->setAnimated($this->firstRun)
                ->withOnColumnClickEventName('onColumnClick')
                ->setLegendVisibility(true)
                ->setDataLabelsEnabled($this->showDataLabels)
                //->setOpacity(0.25)
                ->setColors(['#b01a1b', '#d41b2c', '#ec3c3b', '#f66665'])
                ->setColumnWidth(90)
//                ->withGrid()
            );
        return view('livewire.admin.components.admin-top-sold-products')->with([
            'columnChartModel' => $columnChartModel,
        ]);
    }
}
