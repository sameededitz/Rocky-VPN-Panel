<?php

namespace App\Livewire\Admin;

use App\Models\Server;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\LivewireFilepond\WithFilePond;

class ServerAdd extends Component
{
    use WithFileUploads, WithFilePond;

    public $image, $name, $android = false, $ios = false, $macos = false, $windows = false, $longitude, $latitude, $type, $status;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'android' => 'required|boolean',
            'ios' => 'required|boolean',
            'macos' => 'required|boolean',
            'windows' => 'required|boolean',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:active,inactive',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:20420',
        ];
    }

    public function store()
    {
        $this->validate();

        $server = Server::create([
            'name' => $this->name,
            'android' => $this->android,
            'ios' => $this->ios,
            'macos' => $this->macos,
            'windows' => $this->windows,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'type' => $this->type,
            'status' => $this->status,
        ]);

        if ($this->image) {
            $server->clearMediaCollection('image');
            $server->addMedia($this->image->getRealPath())
                ->usingFileName(time() . '_server_' . $server->id . '.' . $this->image->getClientOriginalExtension())
                ->toMediaCollection('image');
        }

        $this->dispatch('snackbar', message: 'Server added successfully!', type: 'success');
        $this->dispatch('redirect', url: route('servers'));
    }

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.server-add')
            ->extends('layouts.app')
            ->section('content');
    }
}
