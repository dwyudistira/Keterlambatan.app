<?php

namespace App\Exports;

use App\Models\Lates;
use App\Models\Rayons;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LatesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $user = Auth::user();
        $data = collect();

        if ($user) {
            // Mendapatkan nama user dan rayon_id yang dimilikinya
            $userName = $user->id;
            $rayon = Rayons::where('user_id', $userName)->first();

            // Gantilah query ini sesuai dengan kebutuhan Anda
            $lates = Lates::whereHas('student', function ($query) use ($rayon) {
                $query->where('rayon_id', $rayon->id);
            })->get();

            $data = $lates->groupBy('student.rayon_id')->map(function ($groupedLates) {
                return $groupedLates->groupBy('student_id')->map(function ($lates) {
                    return [
                        'nis' => $lates->first()->student->nis,
                        'name' => $lates->first()->student->name,
                        'rombel' => $lates->first()->student->rombel->rombel,
                        'rayon' => $lates->first()->student->rayon->rayon,
                        'total_lates' => $lates->count(),
                    ];
                });
            })->collapse();
        }

        return $data;
    }

    public function headings(): array
    {
        // Sesuaikan judul kolom dengan kebutuhan Anda
        return [
            "NIS",
            "Name",
            "Rombel",
            "Rayon",
            "Total Keterlambatan",
        ];
    }
}
