<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('isAdmin');

        $events = Event::latest()->filter()->paginate(6)->withQueryString();
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('isAdmin');

        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin');

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'required',
            'registration_required' => 'nullable',
        ]);

        if (request()->has('logo')) $request->logo->store('public/events/logo');
        if (request()->has('photo')) $request->photo->store('public/events/photo');

        Event::create([
            'name' => $request->name,
            'slug' => str()->slug($request->name),
            'description' => $request->description,
            'logo' => $request->logo->hashName(),
            'category' => str()->upper($request->category),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'photo' => $request->photo->hashName(),
            'views' => 0,
            'status' => $request->status,
            'registration_required' => $request->registration_required ? 1 : 0,
        ]);

        return redirect()->route('event.index')->with('success', 'Event created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $this->authorize('isAdmin');

        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $this->authorize('isAdmin');

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'required',
            'registration_required' => 'nullable',
        ]);

        if (request()->has('logo')) {
            File::delete('storage/events/logo/' . $event->logo);
            $request->logo->store('public/events/logo');
        };
        if (request()->has('photo')) {
            File::delete('storage/events/photo/' . $event->photo);
            $request->photo->store('public/events/photo');
        };

        $event->update([
            'name' => $request->name,
            'slug' => str()->slug($request->name),
            'description' => $request->description,
            'logo' => request()->has('logo') ? $request->logo->hashName() : $event->logo,
            'category' => str()->upper($request->category),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'photo' => request()->has('photo') ? $request->photo->hashName() : $event->photo,
            'status' => $request->status,
            'registration_required' => $request->registration_required ? 1 : 0,
        ]);

        return redirect()->route('event.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $this->authorize('isAdmin');

        File::delete(public_path('storage/events/logo/' . $event->logo));
        File::delete(public_path('storage/events/photo/' . $event->photo));
        $event->delete();
        return redirect()->route('event.index')->with('success', 'Event deleted successfully.');
    }
}
