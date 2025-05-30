<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\Candidate;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;

class BoxController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'vote_id' => 'required|exists:votes,id',
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        // Ambil data vote berdasarkan ID
        $vote = Vote::find($request->vote_id);

        // Cek apakah waktu voting sudah sesuai
        $currentDateTime = now();

        if ($currentDateTime < $vote->start) {
            return redirect()->back()->with('no', 'Voting belum dimulai.');
        }

        if ($currentDateTime > $vote->end) {
            return redirect()->back()->with('yes', 'Voting sudah selesai.');
        }

        // Cek apakah user sudah memilih di vote ini
        $existingVote = Box::where('user_id', $request->user_id)
            ->where('vote_id', $request->vote_id)
            ->exists();

        if ($existingVote) {
            return redirect()->back()->with('error', 'Kamu sudah melakukan voting pada sesi pemilihan ini!');
        }

        // Simpan suara
        Box::create([
            'user_id' => $request->user_id,
            'vote_id' => $request->vote_id,
            'candidate_id' => $request->candidate_id,
        ]);


        return redirect()->route('student.dashboard')->with('success', 'Suara kamu berhasil disimpan.');
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
       //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
