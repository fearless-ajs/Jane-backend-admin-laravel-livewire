<div class="card card-company-table">
    <div class="card-body p-0">
        <livewire:livewire-column-chart
            key="{{ $columnChartModel->reactiveKey() }}"
            :column-chart-model="$columnChartModel"
        />
    </div>
</div>
