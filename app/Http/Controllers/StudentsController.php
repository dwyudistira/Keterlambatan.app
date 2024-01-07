<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\Rayons;
use App\Models\Lates;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = students::all();
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|numeric',
            'name' => 'required',
            'rombel_id' => 'required',
            'rayon_id' => 'required',
        ]);

        Students::create([
            'nis' => $request->nis,
            'name' => $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id,
        ]);
        return redirect()->route('student.home')->with('success', 'Berhasil menambahkan data rayon');
    }

    /**
     * Display the specified resource.
     */
    public function show(Students $students)
    {
        $students = students::find($id);

        return view('student.edit', compact('students'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $students = students::find($id);

        return view('student.edit', compact('students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Students $students ,$id)
    {
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'rombel_id' => 'required',
            'rayon_id' => 'required',
        ]);
    
        Students::where('id', $id)->update([
            'nis' => $request->nis,
            'name' => $request->name,
            'rombel_id'=> $request->rombel_id,
            'rayon_id' => $request->rayon_id,
        ]);

        return redirect()->route('student.home')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        students::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        if($user == 'admin'){
            $keyword = $request->input('search');

            $students = Students::where('nis', 'like', "%$keyword%")
                ->orWhere('name', 'like', "%$keyword%")
                ->orWhereHas('rombel', function ($query) use ($keyword) {
                    $query->where('rombel', 'like', "%$keyword%");
                })
                ->orWhereHas('rayon', function ($query) use ($keyword) {
                    $query->where('rayon', 'like', "%$keyword%");
                })
                ->get();
    
            return view('student.index', compact('students'));
        }elseif($user == 'ps'){
            
            $keyword = $request->input('search');

            $students = Students::where('nis', 'like', "%$keyword%")
                ->orWhere('name', 'like', "%$keyword%")
                ->orWhereHas('rombel', function ($query) use ($keyword) {
                    $query->where('rombel', 'like', "%$keyword%");
                })
                ->orWhereHas('rayon', function ($query) use ($keyword) {
                    $query->where('rayon', 'like', "%$keyword%");
                })
                ->get();
    
            return view('Ps.role.dataSiswa', compact('students'));
        }
    }

    // Bagian Ps

    public function dataSiswa()
    {
        // return view('role.Ps.dataSiswa');
           // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Jika user ditemukan
        if ($user) {
            // Mendapatkan nama user dan rayon_id yang dimilikinya
            $userName = $user->id;
            $rayon = Rayons::where('user_id', $userName)->first();

            // Mengambil data siswa berdasarkan rayon_id
            $students = Students::where('rayon_id', $rayon->id)->with('rayon')->get();

            return view('role.Ps.dataSiswa', compact('students', 'userName' , 'rayon'));
        } else {
            // Handle jika user tidak ditemukan
            return redirect()->route('login')->with('error', 'User tidak ditemukan.');
        }
    }

    //menampilkan tampilan home dalam role PS
    public function dashboard()
    {
        $user = Auth::user();

        // Jika user ditemukan
        if ($user) {
            // Mendapatkan nama user
            $userName = $user->id;
    
            $rayon = Rayons::where('user_id', $userName)->first();
    
            // Mengambil data siswa dengan relasi ke tabel rayon
            $students = Students::where('rayon_id', $rayon->id)->with('rayon')->get();
    
            $countLateToday = Lates::whereIn('student_id', $students->pluck('id'))
                ->whereDate('date_time_late', Carbon::today())
                ->count();
    
            // Mendapatkan hari dan tanggal sekarang
            $dayAndDateToday = Carbon::today()->isoFormat('dddd, D MMMM YYYY');
    
            // Menyusun data siswa berdasarkan rayon dan menghitung jumlah siswa
            $studentWithRayon = [
                'rayon' => $rayon->rayon,
                'total_students' => $students->count(),
                'day_and_date_today' => $dayAndDateToday,
            ];
    
            return view('role.ps.index', compact('studentWithRayon', 'userName', 'countLateToday'));
        } else {
            // Handle jika user tidak ditemukan
            return redirect()->route('login')->with('error', 'User tidak ditemukan.');
        }
    }
    }