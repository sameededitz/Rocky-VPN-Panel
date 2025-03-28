<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\SubServer;
use App\Models\SubSubServer;
use App\Models\VpsServer;

class SubSubServerEdit extends Component
{
    public SubServer $subServer;
    public SubSubServer $subSubServer;
    public $name;
    public $vps_server;

    protected function rules()
    {
        return [
            'name' => 'required',
            'vps_server' => 'required|exists:vps_servers,id',
        ];
    }

    public function mount(SubServer $subServer, SubSubServer $subSubServer)
    {
        $this->subServer = $subServer;
        $this->subSubServer = $subSubServer;

        // Pre-fill fields with existing data
        $this->name = $subSubServer->name;
        $this->vps_server = $subSubServer->vps_server_id;
    }

    public function update()
    {
        $this->validate();

        $this->subSubServer->update([
            'name' => $this->name,
            'vps_server_id' => $this->vps_server,
        ]);

        $this->dispatch('snackbar', message: 'Sub-Sub Server updated successfully!', type: 'success');
        $this->dispatch('redirect', url: route('sub-sub-servers', $this->subServer));
    }

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.sub-sub-server-edit', [
            'vpsServers' => VpsServer::all(),
        ])->extends('layouts.app')->section('content');
    }
}
