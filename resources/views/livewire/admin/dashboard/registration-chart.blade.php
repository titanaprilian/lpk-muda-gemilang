<?php

use Livewire\Volt\Component;

new class extends Component {
    public string $filter = 'year';
    public array $chartData = [];

    public function mount()
    {
        $this->loadData();
    }

    public function setFilter($type)
    {
        $this->filter = $type;
        $this->loadData();
    }

    public function loadData()
    {
        // Logika query database berdasarkan $this->filter
        // $this->chartData = ...;
    }
}; ?>

<div class="dropdown">
    <button class="...">{{ $filter == 'year' ? 'Tahun Ini' : 'Bulan Ini' }}</button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" wire:click.prevent="setFilter('month')" href="#">Bulan Ini</a></li>
        <li><a class="dropdown-item" wire:click.prevent="setFilter('year')" href="#">Tahun Ini</a></li>
    </ul>
</div>
