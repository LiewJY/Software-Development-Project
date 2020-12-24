<?php

namespace App\Http\Livewire\Admin;

use App\Models\Payment;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Livewire\Component;

class BusinessReport extends Component
{
     public $locations = ['New Shirleyfort', 'South Zachery', 'Stammburgh',];

    public $colors = [
        'New Shirleyfort' => '#f6ad55',
        'South Zachery' => '#fc8181',
        'Stammburgh' => '#90cdf4',
    ];

    public $firstRun = true;

    protected $listeners = [
        'onPointClick' => 'handleOnPointClick',
        'onSliceClick' => 'handleOnSliceClick',
        'onColumnClick' => 'handleOnColumnClick',
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

    public function render()
    {
        $payment = Payment::whereIn('reference', $this->locations)->get();

        $columnChartModel = $payment->groupBy('reference')
            ->reduce(function (ColumnChartModel $columnChartModel, $data) {
                $reference = $data->first()->reference;
                $value = $data->sum('amount');

                return $columnChartModel->addColumn($reference, $value, $this->colors[$reference]);
            }, (new ColumnChartModel())
                ->setTitle('Income by Location')
                ->setAnimated($this->firstRun)
                ->withOnColumnClickEventName('onColumnClick')
            );

        $pieChartModel = $payment->groupBy('reference')
            ->reduce(function (PieChartModel $pieChartModel, $data) {
                $reference = $data->first()->reference;
                $value = $data->sum('amount');

                return $pieChartModel->addSlice($reference, $value, $this->colors[$reference]);
            }, (new PieChartModel())
                ->setTitle('Income by Location')
                ->setAnimated($this->firstRun)
                ->withOnSliceClickEvent('onSliceClick')
            );

        $lineChartModel = $payment
            ->reduce(function (LineChartModel $lineChartModel, $data) use ($payment) {
                $index = $payment->search($data);

                $amountSum = $payment->take($index + 1)->sum('amount');

                if ($index == 6) {
                    $lineChartModel->addMarker(7, $amountSum);
                }

                if ($index == 11) {
                    $lineChartModel->addMarker(12, $amountSum);
                }

                return $lineChartModel->addPoint($index, $amountSum, ['reference' => $data->reference]);
            }, (new LineChartModel())
                ->setTitle('Income Evolution')
                ->setAnimated($this->firstRun)
                ->withOnPointClickEvent('onPointClick')
            );

        $areaChartModel = $payment
            ->reduce(function (AreaChartModel $areaChartModel, $data) use ($payment) {
                return $areaChartModel->addPoint($data->description, $data->amount, ['reference' => $data->reference]);
            }, (new AreaChartModel())
                ->setTitle('Income Peaks')
                ->setAnimated($this->firstRun)
                ->setColor('#f6ad55')
                ->withOnPointClickEvent('onAreaPointClick')
                ->setXAxisVisible(false)
                ->setYAxisVisible(true)
            );

        $this->firstRun = false;

        return view('livewire.admin.business-report')
            ->with([
                'columnChartModel' => $columnChartModel,
                'pieChartModel' => $pieChartModel,
                'lineChartModel' => $lineChartModel,
                'areaChartModel' => $areaChartModel,
            ]);
    }
}

?>