<?php

namespace App\Exports;

use App\Models\EventRegistrant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EventRegistrantExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
            'B'    => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        return [
            "Registered At",
            "Name",
            "Email",
            "Current Status",
            "Level of Education",
            "City of Resident",
            "Institution / University",
            "Major",
            "Phone Number",
            "Remark",
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = EventRegistrant::where('event_id', $this->id)->get();
        return $data->map(function ($item) {
            return [
                'Registered At' => $item->created_at,
                'Nama' => $item->name,
                'Email' => $item->email,
                'Current Status' => $item->current_status,
                'Level of Education' => $item->education_level,
                'City of Resident' => $item->resident,
                'Institution / University' => $item->institution,
                'Major' => $item->major,
                'Phone' => $item->phone,
                'Remarks' => $item->remarks,
            ];
        });
    }
}
