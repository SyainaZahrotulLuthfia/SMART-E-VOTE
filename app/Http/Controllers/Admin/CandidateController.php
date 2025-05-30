<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
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
        $vote = Vote::findOrFail($id); // Ambil data vote berdasarkan ID yang dikirim
        return view('admin.candidates.create', compact('vote'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vote_id'             => 'required|exists:votes,id',
            'number_candidate'    => 'required|integer|min:1',
            'name_candidate'      => 'required|string|min:3|max:255',
            'classroom_candidate' => 'required|string|min:2|max:50',
            'image_candidate'     => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vision'              => 'required|string|min:10',
            'mission'             => 'required|string|min:10',
        ]);

        try {
            // Simpan gambar ke storage public
            $image_candidate = $request->file('image_candidate');
            $imagePath = $image_candidate->store('candidates', 'public');

            // Simpan data ke database
            $insert = Candidate::create([
                'vote_id'            => $request->vote_id,
                'number_candidate'   => $request->number_candidate,
                'name_candidate'     => $request->name_candidate,
                'classroom_candidate' => $request->classroom_candidate,
                'image_candidate'    => $imagePath, // Simpan path yang bisa diakses
                'vision'             => $request->vision,
                'mission'            => $request->mission,
            ]);

            return redirect()->route('votes.show',$request->vote_id)->with(['success' => 'Data Berhasil Disimpan!']);

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
        $candidate = Candidate::with('vote')->findOrFail($id);
        $vote = $candidate->vote;

        return view('admin.candidates.show', compact('candidate', 'vote'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data kandidat berdasarkan ID
        $candidate = Candidate::findOrFail($id);

        // Ambil semua data pemilihan (Vote)
        $votes = Vote::all();

        return view('admin.candidates.edit',compact('candidate','votes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'vote_id'             => 'required|exists:votes,id',
            'number_candidate'    => 'required|integer|min:1',
            'name_candidate'      => 'required|string|min:3|max:255',
            'classroom_candidate' => 'required|string|min:2|max:50',
            'image_candidate'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Tidak wajib di-update
            'vision'              => 'required|string|min:10',
            'mission'             => 'required|string|min:10',
        ]);

        try {
            // Ambil data kandidat berdasarkan ID
            $candidate = Candidate::findOrFail($id);

            // Cek apakah ada file gambar baru diunggah
            if ($request->hasFile('image_candidate')) {
                // Upload gambar baru ke storage public
                $image_candidate = $request->file('image_candidate');
                $imagePath = $image_candidate->store('candidates', 'public');

                // Hapus gambar lama jika ada
                if ($candidate->image_candidate) {
                    Storage::disk('public')->delete($candidate->image_candidate);
                }

                // Perbarui data dengan gambar baru
                $candidate->update([
                    'vote_id'             => $request->vote_id,
                    'number_candidate'    => $request->number_candidate,
                    'name_candidate'      => $request->name_candidate,
                    'classroom_candidate' => $request->classroom_candidate,
                    'image_candidate'     => $imagePath, // Simpan path gambar baru
                    'vision'              => $request->vision,
                    'mission'             => $request->mission,
                ]);
            } else {
                // Perbarui data tanpa mengubah gambar
                $candidate->update([
                    'vote_id'             => $request->vote_id,
                    'number_candidate'    => $request->number_candidate,
                    'name_candidate'      => $request->name_candidate,
                    'classroom_candidate' => $request->classroom_candidate,
                    'vision'              => $request->vision,
                    'mission'             => $request->mission,
                ]);
            }

            return redirect()->route('votes.show',$request->vote_id)->with(['success' => 'Data Berhasil Diubah!']);

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
            $candidate = Candidate::findOrFail($id);

            // Hapus gambar dari storage jika ada
            if ($candidate->image_candidate) {
                Storage::disk('public')->delete($candidate->image_candidate);
            }

            // Hapus data kandidat dari database
            $candidate->delete();

            return redirect()->route('votes.show', $candidate->vote_id)->with(['success' => 'Data Berhasil Dihapus!']);

        } catch (\Exception $e) {
            return response()->json([
                'message' => "Failed: " . $e->getMessage()
            ]);
        }
    }
}
