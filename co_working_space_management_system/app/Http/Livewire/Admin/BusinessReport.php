<?php

namespace App\Http\Livewire\Admin;

use App\Models\Customer;
use App\Models\Location;
use App\Models\ReservationPayment;
use App\Models\Room;
use App\Models\Employee;
use App\Models\Maintenance;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;

use Livewire\Component;

class BusinessReport extends Component
{
    public $locations;
    public $employeeCount, $roomCount, $maintenanceCount, $customerCount, $doneMaintenance;

    public $colors = [
        'Lake Siennastad' => '#f6ad55',
        'Leechester' => '#fc8181',
        'New Holly' => '#90cdf4',
    ];

    public $firstRun = true;

    function randomColor($threshold = 127)
    {
        $dt = '';
        for ($i = 1; $i <= 3; $i++) {
            $dt .= str_pad(dechex(mt_rand(0, $threshold)), 2, '0', STR_PAD_LEFT);
        }

        return '#' . $dt;
    }

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

        $this->locations = Location::get("name")->toArray();
        $this->employeeCount = Employee::get()->count();
        $this->roomCount = Room::get()->count();
        $this->maintenanceCount = Maintenance::where('status', 1)->get()->count();
        $this->doneMaintenance = Maintenance::where('status', 0)->get()->count();
        $this->customerCount = Customer::get()->count();



        $payment = ReservationPayment::join('reservations', 'reservation_payments.id', '=', 'reservations.reservation_payment_id')
            ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->join('locations', 'rooms.location_id', '=', 'locations.id')
            ->select('locations.name AS reference', 'reservation_payments.amount AS amount')->get();


        $columnChartModel = $payment->groupBy('reference')
            ->reduce(
                function (ColumnChartModel $columnChartModel, $data) {
                    $payment = $data->first()->reference;
                    $value = $data->sum('amount');
                    $color = $this->randomColor();
                    return $columnChartModel->addColumn($payment, $value, $color);
                },
                (new ColumnChartModel())
                    ->setTitle('Income by Location')
                    ->setAnimated($this->firstRun)
                    ->withOnColumnClickEventName('onColumnClick')
            );

        $pieChartModel = $payment->groupBy('reference')
            ->reduce(
                function (PieChartModel $pieChartModel, $data) {
                    $payment = $data->first()->reference;
                    $value = $data->sum('amount');
                    $color = $this->randomColor();
                    return $pieChartModel->addSlice($payment, $value, $color);
                },
                (new PieChartModel())
                    ->setTitle('Income by Location')
                    ->setAnimated($this->firstRun)
                    ->withOnSliceClickEvent('onSliceClick')
            );

        $lineChartModel = $payment
            ->reduce(
                function (LineChartModel $lineChartModel, $data) use ($payment) {
                    $index = $payment->search($data);

                    $amountSum = $payment->take($index + 1)->sum('amount');

                    if ($index == 6) {
                        $lineChartModel->addMarker(7, $amountSum);
                    }

                    if ($index == 11) {
                        $lineChartModel->addMarker(12, $amountSum);
                    }

                    return $lineChartModel->addPoint($index, $amountSum, ['reference' => $data->reference]);
                },
                (new LineChartModel())
                    ->setTitle('Income Evolution')
                    ->setAnimated($this->firstRun)
                    ->withOnPointClickEvent('onPointClick')
            );

        $areaChartModel = $payment
            ->reduce(
                function (AreaChartModel $areaChartModel, $data) use ($payment) {
                    return $areaChartModel->addPoint($data->description, $data->amount, ['reference' => $data->reference]);
                },
                (new AreaChartModel())
                    ->setTitle('Income Peaks')
                    ->setAnimated($this->firstRun)
                    ->setColor('#f6ad55')
                    ->withOnPointClickEvent('onAreaPointClick')
                    ->setXAxisVisible(false)
                    ->setYAxisVisible(true)
            );

        $this->firstRun = false;

        return view('livewire.admin.business-report', [
            'payments' => ReservationPayment::join('reservations', 'reservation_payments.id', '=', 'reservations.reservation_payment_id')
                ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
                ->join('locations', 'rooms.location_id', '=', 'locations.id')
                ->select('locations.name AS reference', 'reservation_payments.amount AS amount')
        ])
            ->with([
                'columnChartModel' => $columnChartModel,
                'pieChartModel' => $pieChartModel,
                'lineChartModel' => $lineChartModel,
                'areaChartModel' => $areaChartModel,
            ])->layout('layouts.page');
    }
}
