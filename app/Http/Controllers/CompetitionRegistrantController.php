<?php

namespace App\Http\Controllers;

use App\Exports\RegistrantExport;
use App\Models\Competition;
use App\Models\Registrant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class CompetitionRegistrantController extends Controller
{
    public function index(Competition $competition)
    {
        $this->authorize('isAdmin');

        $registrant = $competition->registrant()->filter()->paginate(10);
        return view('admin.registrant.competition-index', compact('competition', 'registrant'));
    }

    public function member(Registrant $registrant)
    {
        $this->authorize('isAdmin');
        $members = $registrant->members()->filter()->paginate(10);
        return view('admin.registrant.competition-member', compact('registrant', 'members'));
    }

    public function export(competition $competition)
    {
        $title = 'Registrant of ' . $competition->name;
        return Excel::download(new RegistrantExport($competition->id), $title . '.xlsx');
    }

    public function destroy(Registrant $registrant)
    {
        $this->authorize('isAdmin');
        if ($registrant->members->count() > 0) {
            $registrant->members->each(function ($member) {
                File::delete('storage/competition/registrant/id_card/' . $member->id_card);
                File::delete('storage/competition/registrant/student_card/' . $member->student_card);
                File::delete('storage/competition/registrant/photo/' . $member->photo);
                $member->delete();
            });
        }

        $registrant->transactions()->delete();

        File::delete('storage/competition/registrant/id_card/' . $registrant->id_card);
        File::delete('storage/competition/registrant/student_card/' . $registrant->student_card);
        $registrant->delete();
        return redirect()->back()->with('success', 'Registrant has been deleted');
    }
}
