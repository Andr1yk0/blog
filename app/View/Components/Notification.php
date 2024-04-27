<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Notification extends Component
{
    public Collection $notifications;

    public function __construct()
    {
        $this->notifications = collect();
        $errors = Session::get('errors');
        if ($errors) {
            $messages = $errors->getMessages();
            foreach ($messages as $field => $errors) {
                foreach ($errors as $error) {
                    $this->notifications->push([
                        'type' => 'error',
                        'message' => $error,
                    ]);
                }
            }
        }
        $success = Session::get('success');
        if ($success) {
            $this->notifications->push([
                'type' => 'success',
                'message' => $success,
                'timeout' => 5000,
            ]);
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.notification');
    }
}
