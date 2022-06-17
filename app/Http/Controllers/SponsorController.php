<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSponsorRequest;
use App\Http\Requests\UpdateSponsorRequest;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('isAdmin');

        $sponsors = Sponsor::latest()->filter()->paginate(10)->withQueryString();
        return view('admin.sponsor.index', compact('sponsors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('isAdmin');

        return view('admin.sponsor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin');

        $this->validate($request, [
            'name' => 'required|unique:sponsors',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'type' => 'required',
            'sponsor_category' => Rule::requiredIf($request->type == 'sponsor'),
        ]);


        $request->logo->store('public/sponsors');

        Sponsor::create([
            'name' => $request->name,
            'logo' => $request->logo->hashName(),
            'status' => $request->status,
            'type' => $request->type,
            'sponsor_category' => $request->type != 'sponsor' ? null : $request->sponsor_category,
        ]);

        return redirect()->route('sponsor.index')->with('success', 'Sponsor created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsor $sponsor)
    {
        $this->authorize('isAdmin');

        return view('admin.sponsor.edit', compact('sponsor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        $this->authorize('isAdmin');

        $this->validate($request, [
            'name' => 'required|unique:sponsors,name,' . $sponsor->id,
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'type' => 'required',
            'sponsor_category' => Rule::requiredIf(request('type') == 'sponsor'),
        ]);

        if ($request->hasFile('logo')) {
            File::delete(public_path('storage/sponsors/' . $sponsor->logo));
            $request->logo->store('public/sponsors');
            $sponsor->logo = $request->logo->hashName();
        }

        $sponsor->name = $request->name;
        $sponsor->status = $request->status;
        $sponsor->type = $request->type;
        $sponsor->sponsor_category = $request->type != 'sponsor' ? null : $request->sponsor_category;
        $sponsor->save();

        return redirect()->route('sponsor.index')->with('success', 'Sponsor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsor $sponsor)
    {
        $this->authorize('isAdmin');

        File::delete(public_path('storage/sponsors/' . $sponsor->logo));
        $sponsor->delete();

        return redirect()->route('sponsor.index')->with('success', 'Sponsor deleted successfully');
    }
}
