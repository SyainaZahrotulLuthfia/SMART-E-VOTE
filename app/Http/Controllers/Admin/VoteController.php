<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\Candidate;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all vote
        //Mengabil data votes dengan diurutkan data terakhir dahulu dan dibatasi 10 data per halaman
        $votes = Vote::with('candidates')->latest()->paginate(); // Ambil vote + kandidat

        return view('admin.votes.index', compact('votes'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vote = Vote::get();
        return view('admin.votes.create', compact('vote'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vote_name'   => 'required|min:3',
             'image'     => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
             'start'   => 'required|date',
             'end'   => 'required|date|after:start',
         ]);

         try {
             // Simpan gambar ke storage public
             $image = $request->file('image');
             $imagePath = $image->store('votes', 'public');

             // Simpan data ke database
             $insert = Vote::create([
                 'vote_name'         => $request->vote_name,
                 'image'         => $imagePath,
                 'start'         => $request->start,
                 'end'         => $request->end,
             ]);

             return redirect()->route('votes.index')->with(['success' => 'Data Berhasil Disimpan!']);

         } catch (\Exception $e) {
             return response()->json([
                 'message' => "Failed: " . $e->getMessage()
             ]);
         }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil satu vote beserta kandidat-kandidatnya
        $vote = Vote::with('candidates')->findOrFail($id);

        // Tampilkan view khusus untuk detail vote
        return view('admin.votes.show', compact('vote'));
    }

    public function report(string $id)
    {
        // Ambil satu vote beserta kandidat-kandidatnya
        $vote = Vote::findOrFail($id);

        // Ambil kandidat yang hanya terkait dengan ID vote tertentu
        $candidates = Candidate::where('vote_id', $id)
        ->withCount('boxes') // Menghitung jumlah suara dari tabel boxes
        ->orderByDesc('boxes_count') // Urutkan berdasarkan suara terbanyak
        ->get();


        // Tampilkan view khusus untuk detail vote
        return view('admin.votes.report', compact('candidates', 'vote'));
    }


    public function success($vote_id)
    {
        // Ambil data pemilih berdasarkan vote_id
        $boxes = Box::with('user.classroom')
            ->where('vote_id', $vote_id)
            ->get()
            ->sortBy([
                fn ($a, $b) => strcmp($a->user->classroom->classroom ?? '', $b->user->classroom->classroom ?? ''),
                fn ($a, $b) => strcmp($a->user->name ?? '', $b->user->name ?? ''),
            ]);

        // Ambil data vote-nya
        $vote = Vote::findOrFail($vote_id);

        return view('admin.votes.success', compact('boxes', 'vote'));
    }


    public function pending($vote_id)
    {
        $votedUserIds = Box::where('vote_id', $vote_id)->pluck('user_id');

        $pendingUsers = User::with('classroom')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'student');
            })
            ->whereNotIn('users.id', $votedUserIds)
            ->leftJoin('classrooms', 'users.classroom_id', '=', 'classrooms.id')
            ->orderBy('classrooms.classroom')  // urut kelas
            ->orderBy('users.name')             // urut nama siswa
            ->select('users.*')
            ->get();

        $vote = Vote::findOrFail($vote_id);

        return view('admin.votes.pending', compact('pendingUsers', 'vote'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get vote by ID
        $vote = Vote::findOrFail($id);


        //render view with vote
        return view('admin.votes.edit', compact('vote'));

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'vote_name'   => 'required|min:3',
             'image'     => 'image|mimes:jpeg,png,jpg,gif|max:2048',
             'start'   => 'required|date',
             'end'   => 'required|date|after:start',
         ]);

         try {
             // Ambil data kandidat berdasarkan ID
             $vote = Vote::findOrFail($id);

             // Cek apakah ada file gambar baru diunggah
             if ($request->hasFile('image')) {
                 // Upload gambar baru ke storage public
                 $image = $request->file('image');
                 $imagePath = $image->store('votes', 'public');

                 // Hapus gambar lama jika ada
                 if ($vote->image) {
                     Storage::disk('public')->delete($vote->image);
                 }

                 // Perbarui data dengan gambar baru
                 $vote->update([
                     'vote_name'         => $request->vote_name,
                     'image'         => $imagePath,
                     'start'         => $request->start,
                     'end'         => $request->end,
                 ]);
             } else {
                 // Perbarui data tanpa mengubah gambar
                 $vote->update([
                     'vote_name'         => $request->vote_name,
                     'start'         => $request->start,
                     'end'         => $request->end,
                 ]);
             }

             return redirect()->route('votes.index')->with(['success' => 'Data Berhasil Diubah!']);

         } catch (\Exception $e) {
             return response()->json([
                 'message' => "Failed: " . $e->getMessage()
             ]);
         }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Ambil data kandidat berdasarkan ID
            $vote = Vote::findOrFail($id);

            // Hapus gambar dari storage jika ada
            if ($vote->image) {
                Storage::disk('public')->delete($vote->image);
            }

            // Hapus data kandidat dari database
            $vote->delete();

            return redirect()->route('votes.index')->with(['success' => 'Data Berhasil Dihapus!']);

        } catch (\Exception $e) {
            return response()->json([
                'message' => "Failed: " . $e->getMessage()
            ]);
        }
    }
}
