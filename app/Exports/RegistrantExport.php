<?php

namespace App\Exports;

use App\Models\Registrant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RegistrantExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
            'C'    => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        return [
            "Registered At",
            "Registration Number",
            "Team Name",
            "Status",
            "Leader's Name",
            "Leader's Email",
            "Leaders's Phone Number",
            "Leader's University",
            "Leader's Major",
            "Number of Members",
            "Members",
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = Registrant::where('competition_id', $this->id)->get();
        return $data->map(function ($item) {
            return [
                'Registered At' => $item->created_at,
                'Registration Number' => $item->registration_number,
                'Team Name' => $item->team_name,
                'Status' => $item->status,
                'Leader\'s Name' => $item->user->name,
                'Leader\'s Email' => $item->user->email,
                'Leader\'s Phone Number' => $item->phone_number,
                'Leader\'s University' => $item->university,
                'Leader\'s Major' => $item->major,
                'Number of Members' => $item->members->count(),
                'Members' => $item->members->map(function ($member) {
                    return $member->name;
                })->implode(', '),
            ];
        });
    }
}
