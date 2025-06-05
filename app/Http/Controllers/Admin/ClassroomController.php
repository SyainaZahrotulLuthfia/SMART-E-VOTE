<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ClassroomsImport;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all clasroom
        //Mengabil data classrooms dengan diurutkan data terakhir dahulu dan dibatasi 10 data per halaman
        $classrooms = Classroom::latest()->paginate();


        //render view with classrooms
        return view('admin.classrooms.index', compact('classrooms'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.classrooms.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form
        $request->validate([
            'classroom'   => 'required|min:3',
        ]);


        //create product = memasukan data ke database pada tabel classrooms
        Classroom::create([
            'classroom'         => $request->classroom,
        ]);


        //redirect to index
        return redirect()->route('classrooms.index')->with(['success' => 'Data Berhasil Disimpan!']);

    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Get students based on classroom ID
        $students = User::with('classroom')
                        ->where('classroom_id', $id)
                        ->paginate(36);

        // Get the classroom data
        $classroom = Classroom::findOrFail($id);

        // Pass students, classroom, and id to the view
        return view('admin.classrooms.show', compact('students', 'classroom', 'id'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        //get classroom by ID
        $classroom = Classroom::findOrFail($id);


        return view('admin.classrooms.edit', compact('classroom'));

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'classroom'         => 'required|min:3',
        ]);


        //get classroom by ID
        $classroom = Classroom::findOrFail($id);


        //update classroom
        $classroom->update([
            'classroom'         => $request->classroom,
        ]);


        //redirect to index
        return redirect()->route('classrooms.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         //get classroom by ID
         $classroom = Classroom::findOrFail($id);


         //delete classroom
         $classroom->delete();


         //redirect to index
         return redirect()->route('classrooms.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $path = $request->file('file')->store('temp'); // disimpan di storage/app/temp/...

        Excel::import(new ClassroomsImport, $path); // tidak pakai storage_path()

        Storage::delete($path);

        return redirect()->back()->with('success', 'Data kelas berhasil diimpor!');
    }


}
