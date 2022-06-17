<?php

namespace App\Http\Controllers;

use App\Models\Registrant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = auth()->user();
        if ($profile->role == 'registrant' && Registrant::where('user_id', $profile->id)->exists()) {
            $profile->registrant = Registrant::where('user_id', $profile->id)->first();
        }
        return view('admin.profile.index', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = User::where('id', auth()->user()->id)->first();

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($profile->role == 'registrant' && Registrant::where('user_id', $profile->id)->exists()) {
            $registrant = Registrant::where('user_id', $profile->id)->first();
            $request->validate([
                'phone' => 'required',
                'university' => 'required',
                'major' => 'required',
                'id_card' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'student_card' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($request->hasFile('id_card')) {
                File::delete(public_path('storage/competition/registrant/id_card/' . $registrant->id_card));
                $request->id_card->store('public/competition/registrant/id_card');
                $id_card = $request->id_card->hashName();
            }

            if ($request->hasFile('student_card')) {
                File::delete(public_path('storage/competition/registrant/student_card/' . $registrant->student_card));
                $request->student_card->store('public/competition/registrant/student_card');
                $student_card = $request->student_card->hashName();
            }

            $registrant->update([
                'phone_number' => $request->phone,
                'university' => $request->university,
                'major' => $request->major,
                'id_card' => $id_card ?? $registrant->id_card,
                'student_card' => $student_card ?? $registrant->student_card,
            ]);
        }

        if ($request->hasFile('photo')) {
            File::delete(public_path('storage/profile/' . $profile->profile_image));
            $request->photo->store('public/profile');
            $photo = $request->photo->hashName();
        }

        $profile->update([
            'name' => $request->name,
            'password' => $request->password ? bcrypt($request->password) : $profile->password,
            'profile_image' => $photo ?? $profile->profile_image,
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
}
