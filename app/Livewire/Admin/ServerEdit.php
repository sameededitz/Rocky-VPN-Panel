<?php

namespace App\Livewire\Admin;

use App\Models\Server;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\LivewireFilepond\WithFilePond;

class ServerEdit extends Component
{
    use WithFileUploads, WithFilePond;

    public Server $server;
    public $image, $name, $android, $ios, $macos, $windows, $type, $status;

    public function mount(Server $server)
    {
        $this->server = $server;
        $this->name = $server->name;
        $this->android = $server->android;
        $this->ios = $server->ios;
        $this->macos = $server->macos;
        $this->windows = $server->windows;
        $this->type = $server->type;
        $this->status = $server->status;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'android' => 'boolean',
            'ios' => 'boolean',
            'macos' => 'boolean',
            'windows' => 'boolean',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:20420',
        ];
    }

    public function updateServer()
    {
        $this->validate();

        $this->server->update([
            'name' => $this->name,
            'android' => $this->android,
            'ios' => $this->ios,
            'macos' => $this->macos,
            'windows' => $this->windows,
            'type' => $this->type,
            'status' => $this->status,
        ]);

        if ($this->image) {
            $this->server->clearMediaCollection('image');
            $this->server->addMedia($this->image->getRealPath())
                ->usingFileName(time() . '_server_' . $this->server->id . '.' . $this->image->getClientOriginalExtension())
                ->toMediaCollection('image');
        }

        $this->reset(['image','name', 'android', 'ios', 'macos', 'windows', 'type', 'status']);

        $this->dispatch('snackbar', message: 'Server updated successfully!', type: 'success');
        $this->dispatch('redirect', url: route('servers'));
    }

    public function render()
    {
        return view('livewire.admin.server-edit');
    }
}
