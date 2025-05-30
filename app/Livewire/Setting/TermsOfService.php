<?php

namespace App\Livewire\Setting;

use App\Models\Option;
use Livewire\Component;

class TermsOfService extends Component
{
    public $tos;
    public $privacy_policy;

    protected function rules()
    {
        return [
            'tos' => 'required',
            'privacy_policy' => 'required',
        ];
    }

    public function mount()
    {
        $this->tos = Option::where('key', 'tos')->first()->value ?? '';
        $this->privacy_policy = Option::where('key', 'privacy_policy')->first()->value ?? '';
    }

    public function save()
    {
        $this->validate();

        Option::updateOrCreate(
            ['key' => 'tos'],
            ['value' => $this->tos]
        );
        Option::updateOrCreate(
            ['key' => 'privacy_policy'],
            ['value' => $this->privacy_policy]
        );

        $this->reset(['tos', 'privacy_policy']);

        $this->dispatch('sweetAlert', title: 'Success', message: 'Settings updated successfully.', type: 'success');
    }

    public function render()
    {
        return view('livewire.setting.terms-of-service');
    }
}
