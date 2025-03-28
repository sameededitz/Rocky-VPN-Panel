<?php

namespace App\Livewire\Admin;

use App\Models\Server;
use Livewire\Component;
use Livewire\WithPagination;

class AllServers extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;

    public $statusFilter = '';
    public $typeFilter = '';
    public $platformFilter = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingTypeFilter()
    {
        $this->resetPage();
    }

    public function updatingPlatformFilter()
    {
        $this->resetPage();
    }

    public function deleteServer($serverId)
    {
        $server = Server::findOrFail($serverId);
        $server->delete();

        $this->dispatch('sweetAlert', title: 'Deleted!', message: 'Server has been deleted successfully.', type: 'success');
    }

    public function render()
    {
        $servers = Server::query()
            ->when($this->search, fn($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->statusFilter, fn($query) => $query->where('status', $this->statusFilter))
            ->when($this->typeFilter, fn($query) => $query->where('type', $this->typeFilter))
            ->when($this->platformFilter, function ($query) {
                return $query->where($this->platformFilter, true);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.all-servers', compact('servers'))
            ->extends('layouts.app')
            ->section('content');
    }
}
