<?php

namespace App\Http\Controllers;

use App\Exports\EventRegistrantExport;
use App\Models\Event;
use App\Models\EventRegistrant;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EventRegistrantController extends Controller
{

    public function index(Event $event)
    {
        $this->authorize('isAdmin');

        $registrant = $event->registrant()->filter()->paginate(10);

        return view('admin.registrant.event-index', compact('event', 'registrant'));
    }

    public function export(Event $event)
    {
        $title = 'Registrant of ' . $event->name;

        return Excel::download(new EventRegistrantExport($event->id), $title . '.xlsx');
    }

    public function destroy(EventRegistrant $person)
    {
        $this->authorize('isAdmin');

        $person->delete();

        return redirect()->back()->with('success', 'Registrant has been deleted');
    }
}
