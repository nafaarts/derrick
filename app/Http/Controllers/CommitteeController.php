<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('isAdmin');

        $committees = Committee::latest()->filter()->paginate(10)->withQueryString();
        return view('admin.committees.index', compact('committees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('isAdmin');

        return view('admin.committees.create');
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
            'title' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'instagram' => 'required',
            'linkedin' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            request('photo')->store('public/committees');
        }

        Committee::create([
            'name' => request('name'),
            'title' => request('title'),
            'photo' => request('photo')->hashName(),
            'status' => request('status'),
            'email' => request('email'),
            'phone' => request('phone'),
            'instagram' => request('instagram'),
            'linkedin' => request('linkedin'),
        ]);

        return redirect()->route('committee.index')->with('success', 'Committee created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Committee  $committee
     * @return \Illuminate\Http\Response
     */
    public function edit(Committee $committee)
    {
        $this->authorize('isAdmin');

        return view('admin.committees.edit', compact('committee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Committee  $committee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Committee $committee)
    {
        $this->authorize('isAdmin');

        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'instagram' => 'required',
            'linkedin' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            File::delete(public_path('storage/committees/' . $committee->photo));
            request('photo')->store('public/committees');
            $committee->photo = request('photo')->hashName();
        }

        $committee->name = request('name');
        $committee->title = request('title');
        $committee->status = request('status');
        $committee->email = request('email');
        $committee->phone = request('phone');
        $committee->instagram = request('instagram');
        $committee->linkedin = request('linkedin');
        $committee->save();

        return redirect()->route('committee.index')->with('success', 'Committee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Committee  $committee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Committee $committee)
    {
        $this->authorize('isAdmin');

        File::delete(public_path('storage/committees/' . $committee->photo));
        $committee->delete();
        return redirect()->route('committee.index')->with('success', 'Committee deleted successfully.');
    }
}
