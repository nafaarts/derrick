<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('isAdmin');
        $competitions = Competition::with('registrant')->latest()->filter()->paginate(10)->withQueryString();
        return view('admin.competition.index', compact('competitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('isAdmin');
        return view('admin.competition.create');
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
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:competitions',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'status' => 'required|boolean',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'date_reg_start_first_batch' => 'required|date',
            'date_reg_end_first_batch' => 'required|date',
            'price_first_batch' => 'required|integer',
            'date_reg_start_second_batch' => 'required|date',
            'date_reg_end_second_batch' => 'required|date',
            'price_second_batch' => 'required|integer',
            'prize_pool' => 'required|integer',
            'max_member' => 'required|integer',
            'guide_file' => 'required|mimes:pdf|max:5048',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:10048',
            'wa_link' => 'nullable'
        ]);

        if ($request->hasFile('logo')) {
            $request->logo->store('public/competition/logo');
        }
        if ($request->hasFile('guide_file')) {
            $request->guide_file->store('public/competition/guide_book');
        }

        if ($request->hasFile('photo')) {
            $request->photo->store('public/competition/photo');
        }

        Competition::create([
            'name' => $request->name,
            'code' => $request->code,
            'slug' => str()->slug($request->name),
            'logo' => $request->logo->hashName(),
            'description' => $request->description,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'date_reg_start_first_batch' => $request->date_reg_start_first_batch,
            'date_reg_end_first_batch' => $request->date_reg_end_first_batch,
            'price_first_batch' => $request->price_first_batch,
            'date_reg_start_second_batch' => $request->date_reg_start_second_batch,
            'date_reg_end_second_batch' => $request->date_reg_end_second_batch,
            'price_second_batch' => $request->price_second_batch,
            'prize_pool' => $request->prize_pool,
            'max_member' => $request->max_member,
            'guide_file' => $request->guide_file->hashName(),
            'photo' => $request->photo->hashName(),
            'wa_link' => $request->wa_link ?? ''
        ]);

        return redirect()->route('competition.index')->with('success', 'Competition created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function edit(Competition $competition)
    {
        $this->authorize('isAdmin');
        return view('admin.competition.edit', compact('competition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competition $competition)
    {
        $this->authorize('isAdmin');
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:competitions,code,' . $competition->id,
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'status' => 'required|boolean',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'date_reg_start_first_batch' => 'required|date',
            'date_reg_end_first_batch' => 'required|date',
            'price_first_batch' => 'required|integer',
            'date_reg_start_second_batch' => 'required|date',
            'date_reg_end_second_batch' => 'required|date',
            'price_second_batch' => 'required|integer',
            'prize_pool' => 'required|integer',
            'max_member' => 'required|integer',
            'guide_file' => 'mimes:pdf|max:5048',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:10048',
            'wa_link' => 'nullable'
        ]);

        if ($request->hasFile('logo')) {
            File::delete(public_path('storage/competition/logo/' . $competition->logo));
            $request->logo->store('public/competition/logo');
            $logo = $request->logo->hashName();
        }
        if ($request->hasFile('guide_file')) {
            File::delete(public_path('storage/competition/guide_book/' . $competition->guide_file));
            $request->guide_file->store('public/competition/guide_book');
            $guide_book = $request->guide_file->hashName();
        }

        if ($request->hasFile('photo')) {
            File::delete(public_path('storage/competition/photo/' . $competition->photo));
            $request->photo->store('public/competition/photo');
            $photo = $request->photo->hashName();
        }

        $competition->update([
            'name' => $request->name,
            'code' => $request->code,
            'slug' => str()->slug($request->name),
            'logo' => $logo ?? $competition->logo,
            'description' => $request->description,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'date_reg_start_first_batch' => $request->date_reg_start_first_batch,
            'date_reg_end_first_batch' => $request->date_reg_end_first_batch,
            'price_first_batch' => $request->price_first_batch,
            'date_reg_start_second_batch' => $request->date_reg_start_second_batch,
            'date_reg_end_second_batch' => $request->date_reg_end_second_batch,
            'price_second_batch' => $request->price_second_batch,
            'prize_pool' => $request->prize_pool,
            'max_member' => $request->max_member,
            'guide_file' => $guide_book ?? $competition->guide_file,
            'photo' => $photo ?? $competition->photo,
            'wa_link' => $request->wa_link ?? ''
        ]);

        return redirect()->route('competition.index')->with('success', 'Competition updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition)
    {
        $this->authorize('isAdmin');
        File::delete(public_path('storage/competition/logo/' . $competition->logo));
        File::delete(public_path('storage/competition/photo/' . $competition->photo));
        File::delete(public_path('storage/competition/guide_book/' . $competition->guide_file));
        $competition->delete();
        return redirect()->route('competition.index')->with('success', 'Competition deleted successfully');
    }
}
