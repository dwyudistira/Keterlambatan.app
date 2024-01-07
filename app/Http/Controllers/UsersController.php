<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {
        $data = $request->all();
        $data['password'] = Str::substr($request->email, 0, 3) . Str::substr($request->name, 0, 3);

        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'role' => 'required',
        ]);

        $validatedData['password'] = Hash::make($data['password']);

        User::create($validatedData);

        return redirect()->route('user.home')->with('success', 'Berhasil menambahkan data pengguna!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $users, $id)
    {
        //
        $users = user::find($id);

        return view('user.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $users, $id)
    {
        $data = $request->all();

        $rules = [
            'name' => 'required|min:3',
            'email' => 'required',
            'role' => 'required',
        ];

        if ($request->password) {
            $rules['password'] = 'required|min:6';
        }

        $data = $request->validate($rules);

        if($request->password){
            $data['password'] = $request->password;
            $data['password'] = Hash::make($request->password);
        } else{
            $data['password'] = $request->oldPassword;
        }

        User::where('id', $id)->update($data);

        return redirect()->route('user.home')->with('success', 'Berhasil mengubah data pengguna!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        user::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = $request->only(['email', 'password']);
        if (Auth::attempt ($user)) { 
            if(Auth::user()->role == 'admin'){
                return redirect()->route('home.page');
            }
            else {
                return redirect()->route('Ps.role.home');
            }
        } else {
            return redirect()->back()->with('failed', 'proses login gagal, silahkan coba kembali dengan data yang benar!');
        }
    }

    public function  logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Anda telah Logout!');
    }
    public function search(Request $request)
    {
        $search = $request->input('search');

        $users = User::where('name', 'LIKE', "%" .$search ."%")
            ->orWhere('email', 'LIKE', "%". $search ."%")
            ->orWhere('role', 'LIKE', "%" .$search ."%")
            ->paginate(5);

        return view('user.index', compact('users'));
    }
}
