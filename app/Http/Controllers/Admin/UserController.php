<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('admin.users.create', compact('id'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        //validate form
        $request->validate([
            'classroom_id'   => 'nullable|exists:classrooms,id',
            'nisn'           => 'nullable|string|max:10',
            'name'           => 'required|string|min:3',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|min:4',
        ]);


        //create user = memasukan data ke database pada tabel cities
        User::create([
            'classroom_id' => $request->classroom_id,
            'nisn'         => $request->nisn,
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password), // Pastikan password di-hash
        ])->assignRole('student');


        //redirect to index
        return redirect()->route('classrooms.show',$request->classroom_id)->with(['success' => 'Data Berhasil Disimpan!']);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get user by ID
        $user = User::findOrFail($id); // Ambil user berdasarkan ID
        $classroom_id = $user->classroom_id; // Ambil classroom_id dari user

        return view('admin.users.edit',compact('user', 'classroom_id'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'classroom_id'   => 'nullable|exists:classrooms,id',
            'nisn'           => 'nullable|string|max:10',
            'name'           => 'required|string|min:3',
            'email'          => ['required', 'email', Rule::unique('users')],
            'password'       => 'nullable|min:4',
        ]);


        //get user by ID
        $user = User::findOrFail($id);



        //update user
        $user->update([
            'classroom_id' => $request->classroom_id,
            'nisn'         => $request->nisn,
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        $user->assignRole('student');


        //redirect to index
        return redirect()->route('classrooms.show',$request->classroom_id)->with(['success' => 'Data Berhasil Diubah!']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get user by ID
        $user = User::findOrFail($id);


        $classroom_id = $user->classroom_id;


        //delete user
        $user->delete();


        //redirect to index
        return redirect()->route('classrooms.show', $classroom_id)->with(['success' => 'Data Berhasil Dihapus!']);
    }


    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx',
            'classroom_id' => 'required',
        ]);

        $file = $request->file('file');
        $classroom_id = $request->classroom_id;

        $nama_file = $file->hashName();

        $path = $file->storeAs('excel', $nama_file);

        // Import data dengan Storage::path untuk path absolut
        Excel::import(new UsersImport($classroom_id), Storage::path($path));

        // Hapus file setelah import selesai
        Storage::delete($path);

        return redirect()->back()->with('success', 'Data berhasil diimpor.');
    }
}
