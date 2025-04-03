<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\UserFeedback;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;

class AllFeedback extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;

    public $subject;
    public $message;

    public function mount()
    {
        $this->subject = null;
        $this->message = null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function viewFeedback($feedbackId)
    {
        $this->reset(['subject', 'message']);
        
        $feedback = UserFeedback::find($feedbackId);

        $this->subject = $feedback->subject;
        $this->message = $feedback->message;

        $this->dispatch('viewFeedback');

        Log::info($feedback);
    }

    public function deleteFeedback($feedbackId)
    {
        $feedback = UserFeedback::findOrFail($feedbackId);
        $feedback->delete();

        $this->dispatch('sweetAlert', title: 'Deleted!', message: 'Feedback has been deleted successfully.', type: 'success');
    }

    public function render()
    {
        $feedbacks = UserFeedback::query()
            ->when($this->search, fn($query) => $query->where('subject', 'like', '%' . $this->search . '%'))
            ->when($this->search, fn($query) => $query->where('email', 'like', '%' . $this->search . '%'))
            ->latest()
            ->paginate($this->perPage);

        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.all-feedback', compact('feedbacks'))
            ->extends('layouts.app')
            ->section('content');
    }
}
