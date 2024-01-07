<?php

namespace App\Http\Controllers;

use App\Models\lates;
use App\Models\rayons;
use App\Models\rombels;
use App\Models\students;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LatesExport;

class LatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $lates = Lates::with('student')->paginate(10);
        return view('late.index', compact('lates'));
    }

    public function data()
    {
        $user = Auth::user();

        // Check the user's role
        if ($user->role == 'ps') {
            // If the user has the role PS, fetch data only for students under their supervision
            $rayon = Rayons::where('user_id', $user->id)->first();

            $students = Students::where('rayon_id', $rayon->id)->with('rayon', 'late')->get();

            // Fetch data for the late based on student_ids under the rayon
            $lates = Lates::whereIn('student_id', $students->pluck('id'))->get();
        } else {
            // If the user has another role or no role, fetch all data for lates
            $lates = Lates::with('student')->get();
        }

        return view('role.Ps.rekapLate', compact('lates'));

    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $student = Students::all();
        return view('late.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'student_id' => 'required',
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('bukti_keterlambatan', $filename, 'public');
            $validatedData['bukti'] = $filename;
        }

        Lates::create($validatedData);

        return redirect()->route('late.home')->with('success', 'Berhasil menambahkan data Keterlambatan!');
        // atau jika seluruh data input akan dimasukkan langsung ke db bisa dengan perintah Medicine::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(lates $lates ,$id)
    {
        //
        $student = Students::find($id);
        $lates = Lates::where('student_id', $id)->with('student')->get();
        return view('late.rekapData',  compact('student' , 'lates'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lates $lates , $id)
    {
        $lates = Lates::find($id);
        return view('late.edit', compact('lates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, lates $lates ,$id)
    {
        $request->validate([
            'student_id' => 'required',
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'required',
        ]);
        Lates::where('id', $id)->update([
            'student_id' => $request->student_id,
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
            'bukti' => $request->bukti,
        ]);
        return redirect()->route('late.home')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        lates::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
    public function search(Request $request)
    {
        $search = $request->input('search');

        // Jika kolom pencarian kosong, tampilkan semua data
        if (empty($search)) {
            $lates = Lates::with('student')->get();
        } else {
            // Jika ada kata kunci pencarian, cari berdasarkan nama siswa atau informasi keterlambatan
            $lates = Lates::whereHas('student', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhere('information', 'like', '%' . $search . '%')
            ->with('student')
            ->get();
        }

        return view('late.data', compact('lates'));
    }
    public function cetakLate($id)
    {
        //
        $lates = Lates::find($id)->toArray();
        view()->share('lates', $lates);

        $student = Students::where('id', $lates['student_id'])->first()->toArray();
        view()->share('student' , $student);

        $rayon = Rayons::where('id', $student['rayon_id'])->first()->toArray();
        view()->share('rayon' , $rayon);

        $rombel = Rombels::where('id', $student['rombel_id'])->first()->toArray();
        view()->share('rombel' , $rombel);

        $ps = User::where('id', $rayon['user_id'])->first()->toArray();
        view()->share('ps' , $ps);

        $pdf = PDF::loadView('late.download-pdf', $lates);
        return $pdf->download('Surat Pernyataan Keterlambatan.pdf');       
    }
    public function exportExcel()
    {
        return Excel::download(new LatesExport, 'keterlambatan.xlsx');
    }

    // Data Ps

    public function dataLate()
    {
        // $late = Lates::all();
        // $student = Students::whereHas('late')->withCount('late')->get();
        // return view('role.Ps.dataLate', compact('late', 'student'));

          $user = Auth::user();
        if ($user) {
            // Mendapatkan nama user dan rayon_id yang dimilikinya
            $userName = $user->id;
            $rayon = Rayons::where('user_id', $userName)->first();
        
            // Mengambil data siswa berdasarkan rayon_id
            $students = Students::where('rayon_id', $rayon->id)->with('rayon', 'late')->get();  
        
            // Mengambil data late berdasarkan student_id yang dimiliki oleh rayon tersebut
            $late = Lates::whereIn('student_id', $students->pluck('id'))->get();
        
            return view('role.Ps.dataLate', compact('students', 'userName', 'rayon', 'late'));
        } else {
            // Handle jika user tidak ditemukan
            return redirect()->route('login')->with('error', 'User tidak ditemukan.');
        }   
    }
    public function dataLihat($id){
        $student = Students::find($id);
        $lates = Lates::where('student_id', $id)->with('student')->get();
        return view('role.Ps.dataLihat', compact('student','lates'));
    }
}
