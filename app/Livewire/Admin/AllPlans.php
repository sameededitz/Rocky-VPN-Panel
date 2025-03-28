<?php

namespace App\Livewire\Admin;

use App\Models\Plan;
use Livewire\Component;
use Livewire\WithPagination;

class AllPlans extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $priceFilter = '';
    public $durationUnitFilter = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingPerPage()
    {
        $this->resetPage();
    }
    public function updatingPriceFilter()
    {
        $this->resetPage();
    }
    public function updatingDurationUnitFilter()
    {
        $this->resetPage();
    }

    public function deletePlan($planId)
    {
        $plan = Plan::findOrFail($planId);
        $plan->delete();

        $this->dispatch('sweetAlert', title: 'Deleted!', message: 'Plan has been deleted successfully.', type: 'success');
    }

    public function render()
    {
        $plans = Plan::query()
            ->when($this->search, fn($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->priceFilter, fn($query) => $query->where('price', '<=', $this->priceFilter))
            ->when($this->durationUnitFilter, fn($query) => $query->where('duration_unit', $this->durationUnitFilter))
            ->latest()
            ->paginate($this->perPage);

        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.all-plans', compact('plans'))
            ->extends('layouts.app')
            ->section('content');
    }
}
