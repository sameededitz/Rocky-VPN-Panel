<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\VpsServer;

class VpsServerAdd extends Component
{
    public $name, $ip_address, $username, $port, $status, $private_key, $password;

    protected function rules()
    {
        return [
            'name' => 'required',
            'ip_address' => 'required',
            'username' => 'required',
            'port' => 'required',
            'status' => 'required',
            'private_key' => 'nullable|required_without:password',
            'password' => 'nullable|required_without:private_key',
        ];
    }

    public function store()
    {
        $this->validate();

        VpsServer::create([
            'name' => $this->name,
            'ip_address' => $this->ip_address,
            'username' => $this->username,
            'port' => $this->port,
            'status' => $this->status,
            'private_key' => $this->private_key,
            'password' => $this->password,
        ]);

        $this->reset(['name', 'ip_address', 'username', 'port', 'status', 'private_key', 'password']);

        $this->dispatch('snackbar', type: 'success', message: 'VPS Server created successfully');

        $this->dispatch('redirect', url: route('vps-servers'));
    }

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.vps-server-add')
            ->extends('layouts.app')
            ->section('content');
    }
}
