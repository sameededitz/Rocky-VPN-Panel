<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\SubServer;
use App\Models\SubSubServer;
use Livewire\WithPagination;

class AllSubSubServers extends Component
{
    use WithPagination;

    public SubServer $subServer;
    public $search = '';
    public $perPage = 5;

    public function mount(SubServer $subServer)
    {
        $this->subServer = $subServer;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function deleteSubSubServer($subSubServerId)
    {
        $subSubServer = SubSubServer::findOrFail($subSubServerId);
        $subSubServer->delete();

        $this->dispatch('sweetAlert', title: 'Deleted!', message: 'Sub Sub Server has been deleted successfully.', type: 'success');
    }

    public function render()
    {
        $subSubServers = $this->subServer->subSubServers()
            ->with('vpsServer:id,name,username,ip_address')
            ->when($this->search, fn($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.all-sub-sub-servers', compact('subSubServers'))
            ->extends('layouts.app')
            ->section('content');
    }
}
