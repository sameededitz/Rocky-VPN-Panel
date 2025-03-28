<?php

namespace App\Livewire\Admin;

use App\Models\Server;
use Livewire\Component;
use App\Models\SubServer;

class SubServerAdd extends Component
{
    public Server $server;
    public $name, $status;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ];
    }

    public function mount(Server $server)
    {
        $this->server = $server;
    }

    public function store()
    {
        $this->validate();

        $this->server->subServers()->create([
            'name' => $this->name,
            'status' => $this->status,
        ]);

        $this->dispatch('snackbar', message: 'Sub Server added successfully!', type: 'success');
        $this->dispatch('redirect', url: route('sub-servers', $this->server));
    }

    public function render()
    {
        return view('livewire.admin.sub-server-add');
    }
}
