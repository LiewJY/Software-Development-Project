<h1 class="font-serif sm:text-3xl text-2xl font-bold title-font mb-4 text-gray-900 underline mx-3">Business Report</h1>

<!-- Status Bar -->
<div class="py-1 sm:px-1 lg:px-2">
    <div class="cointainer px-4 py-2 ">
        <div class="sm:grid sm:h-32 sm:grid-flow-row sm:gap-4 sm:grid-cols-4">
            <div class="mb-4">
                <div class="shadow py-2 bg-gray-100">
                    <div class="font-serif font-bold text-sm mb-1 mx-3">Total Approved Staff:</div>
                    <div class="font-serif mb-0 text-gray-800 text-center">{{ $employeeCount }}</div>
                </div>
            </div>

            <div class="mb-4">
                <div class="shadow py-2 bg-gray-100">
                    <div class="font-serif font-bold text-sm mb-1 mx-3">Total maintenance done:</div>
                    <div class="font-serif mb-0 text-gray-800 text-center">{{ $maintenanceCount }}</div>
                </div>
            </div>

            <div class="mb-4">
                <div class="shadow py-2 bg-gray-100">
                    <div class="font-serif font-bold text-sm mb-1 mx-3">Total Rooms Available:</div>
                    <div class="font-serif mb-0 text-gray-800 text-center">{{ $roomCount }}</div>
                </div>
            </div>

            <div class="mb-4">
                <div class="shadow py-2 bg-gray-100">
                    <div class="font-serif font-bold text-sm mb-1 mx-3">Total Rooms under maintenance:</div>
                    <div class="font-serif mb-0 text-gray-800 text-center">{{ $doneMaintenance }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto space-y-4 p-4 sm:p-0">

    <ul class="flex flex-col sm:flex-row sm:space-x-8 sm:items-center">
        <li>
            <input type="checkbox" value="travel" wire:model="locations" />
            <span>Lake Siennastad</span>
        </li>
        <li>
            <input type="checkbox" value="shopping" wire:model="locations" />
            <span>Leechester</span>
        </li>
        <li>
            <input type="checkbox" value="food" wire:model="locations" />
            <span>New Holly</span>
        </li>
    </ul>
    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
        <div class="shadow rounded p-4 border bg-gray-100 flex-1" style="height: 32rem;">
            <livewire:livewire-column-chart key="{{ $columnChartModel->reactiveKey() }}" :column-chart-model="$columnChartModel" />
        </div>

        <div class="shadow rounded p-4 border bg-gray-100 flex-1" style="height: 32rem;">
            <livewire:livewire-pie-chart key="{{ $pieChartModel->reactiveKey() }}" :pie-chart-model="$pieChartModel" />
        </div>
    </div>

    <div class="shadow rounded p-4 border bg-gray-100" style="height: 32rem;">
        <livewire:livewire-line-chart key="{{ $lineChartModel->reactiveKey() }}" :line-chart-model="$lineChartModel" />
    </div>

    <div class="shadow rounded p-4 border bg-gray-100" style="height: 32rem;">
        <livewire:livewire-area-chart key="{{ $areaChartModel->reactiveKey() }}" :area-chart-model="$areaChartModel" />
    </div>
    @livewireChartsScripts

</div>