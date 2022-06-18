<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventRegisterController extends Controller
{
    public function index(Event $event)
    {

        return view('register-event', compact('event'));
    }

    public function register(Event $event)
    {
        $this->validate(request(), [
            "name" => 'required',
            "email" => 'required|email',
            "education_level" => 'required',
            "current_status" => 'required',
            "resident" => 'required',
            "institution" => 'nullable',
            "major" => 'nullable',
            "phone" => 'required',
            "remark" => 'nullable',
        ]);

        $event->registrant()->create([
            'name' => request('name'),
            'email' => request('email'),
            'education_level' => request('education_level'),
            'current_status' => request('current_status'),
            'resident' => request('resident') ?? '',
            'institution' => request('institution') ?? '',
            'major' => request('major'),
            'phone' => request('phone'),
            'remark' => request('remark'),
        ]);

        return redirect()->route('event.registered', $event);
    }
}
