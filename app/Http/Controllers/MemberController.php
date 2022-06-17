<?php

namespace App\Http\Controllers;

use App\Models\Registrant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MemberController extends Controller
{
    public function index()
    {
        $this->authorize('isRegistrant');
        $register = Registrant::where('user_id', auth()->id())->first();
        if (!$register) return redirect()->route('registrant.competition');
        $members = $register->members()->filter()->paginate(10);
        return view('registrant.members.index', compact('register', 'members'));
    }

    public function create()
    {
        $this->authorize('isRegistrant');
        return view('registrant.members.create');
    }

    public function store(Request $request)
    {
        $this->authorize('isRegistrant');
        $register = Registrant::where('user_id', auth()->id())->first();

        if ($register->members()->count() >= $register->competition->max_member) {
            return redirect()->back()->with('error', 'You have reached the maximum number of members');
        }

        $request->validate([
            "name" => "required",
            "major" => "required",
            "email" => "required|email",
            "phone" => "required|numeric",
            "id_card" => "required|image|mimes:jpeg,png,jpg|max:2048",
            "student_card" => "required|image|mimes:jpeg,png,jpg|max:2048",
            "photo" => "required|image|mimes:jpeg,png,jpg|max:2048",
        ]);

        if ($request->hasFile('id_card')) {
            $request->id_card->store('public/competition/registrant/id_card');
            $id_card = $request->id_card->hashName();
        }

        if ($request->hasFile('student_card')) {
            $request->student_card->store('public/competition/registrant/student_card');
            $student_card = $request->student_card->hashName();
        }

        if ($request->hasFile('photo')) {
            $request->photo->store('public/competition/registrant/photo');
            $photo = $request->photo->hashName();
        }

        $register->members()->create([
            "name" => $request->name,
            "major" => $request->major,
            "email" => $request->email,
            "phone_number" => $request->phone,
            "id_card" => $id_card,
            "student_card" => $student_card,
            "photo" => $photo,
        ]);

        return redirect()->route('registrant.member.index')->with('success', 'Member has been added');
    }

    public function edit($id)
    {
        $this->authorize('isRegistrant');
        $registrant = Registrant::where('user_id', auth()->id())->first();
        if (!$registrant) abort(404);
        $member = $registrant->members()->find($id);
        return view('registrant.members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('isRegistrant');
        $registrant = Registrant::where('user_id', auth()->id())->first();
        if (!$registrant) abort(404);
        $member = $registrant->members()->find($id);
        $request->validate([
            "name" => "required",
            "major" => "required",
            "email" => "required|email",
            "phone" => "required|numeric",
            "id_card" => "image|mimes:jpeg,png,jpg|max:2048",
            "student_card" => "image|mimes:jpeg,png,jpg|max:2048",
            "photo" => "image|mimes:jpeg,png,jpg|max:2048",
        ]);

        if ($request->hasFile('id_card')) {
            File::delete('storage/competition/registrant/id_card/' . $member->id_card);
            $request->id_card->store('public/competition/registrant/id_card');
            $id_card = $request->id_card->hashName();
        }

        if ($request->hasFile('student_card')) {
            File::delete('storage/competition/registrant/student_card/' . $member->student_card);
            $request->student_card->store('public/competition/registrant/student_card');
            $student_card = $request->student_card->hashName();
        }

        if ($request->hasFile('photo')) {
            File::delete('storage/competition/registrant/photo/' . $member->photo);
            $request->photo->store('public/competition/registrant/photo');
            $photo = $request->photo->hashName();
        }

        $member->update([
            "name" => $request->name,
            "major" => $request->major,
            "email" => $request->email,
            "phone_number" => $request->phone,
            "id_card" => $id_card ?? $member->id_card,
            "student_card" => $student_card ?? $member->student_card,
            "photo" => $photo ?? $member->photo,
        ]);

        return redirect()->route('registrant.member.index')->with('success', 'Member has been updated');
    }

    public function destroy($id)
    {
        $this->authorize('isRegistrant');
        $registrant = Registrant::where('user_id', auth()->id())->first();
        if (!$registrant) abort(404);
        $member = $registrant->members()->find($id);
        File::delete('storage/competition/registrant/id_card/' . $member->id_card);
        File::delete('storage/competition/registrant/student_card/' . $member->student_card);
        File::delete('storage/competition/registrant/photo/' . $member->photo);
        $member->delete();
        return redirect()->route('registrant.member.index')->with('success', 'Member has been deleted');
    }
}
