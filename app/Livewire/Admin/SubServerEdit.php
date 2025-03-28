<?php

namespace App\Livewire\Admin;

use App\Models\Server;
use Livewire\Component;
use App\Models\SubServer;

class SubServerEdit extends Component
{
    public Server $server;
    public SubServer $subServer;
    public $name, $status;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ];
    }

    public function mount(Server $server, SubServer $subServer)
    {
        $this->server = $server;
        $this->subServer = $subServer;
        $this->name = $subServer->name;
        $this->status = $subServer->status;
    }

    public function update()
    {
        $this->validate();

        $this->subServer->update([
            'name' => $this->name,
            'status' => $this->status,
        ]);

        $this->dispatch('snackbar', message: 'Sub Server updated successfully!', type: 'success');
        $this->dispatch('redirect', url: route('sub-servers', $this->server));
    }

    public function render()
    {
        return view('livewire.admin.sub-server-edit');
    }
}
