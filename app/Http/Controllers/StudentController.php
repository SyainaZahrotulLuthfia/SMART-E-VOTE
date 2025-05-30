<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Dashboard student setelah Login
    public function student()
    {
        // Ambil semua vote dan kandidatnya, termasuk jumlah suara (boxes_count)
        $votes = Vote::with(['candidates' => function ($query) {
            $query->withCount('boxes'); // Menambahkan 'boxes_count'
        }])->get();

        // Properti 'winner' pada setiap sesi voting
        foreach ($votes as $vote) {
            // Urutkan kandidat berdasarkan jumlah suara (boxes_count)
            $vote->winner = $vote->candidates->sortByDesc('boxes_count')->first();
        }

        return view('student.dashboard.index', compact('votes'));
    }

    // Menampilkan daftar kandidat untuk pemilihan tertentu
    public function candidates(string $id)
    {
        // Ambil kandidat beserta jumlah suara mereka (boxes_count)
        $candidates = Candidate::where('vote_id', $id)
                        ->withCount('boxes')
                        ->get();

        $currentDateTime = now();

        // Ambil 1 vote yang sesuai ID
        $vote = Vote::findOrFail($id);

        // Ambil semua vote aktif (jika diperlukan di view)
        $votes = Vote::where('is_active', 1)
                    ->where('start', '<=', $currentDateTime)
                    ->where('end', '>=', $currentDateTime)
                    ->get();

        return view('student.candidates.index', compact('candidates', 'vote', 'votes'));
    }

    // Menampilkan detail kandidat
    public function showCandidate($id)
    {
        // Ambil data kandidat beserta jumlah suara
        $candidate = Candidate::withCount('boxes')->findOrFail($id);

        // Dari kandidat, dapatkan vote_id
        $voteId = $candidate->vote_id;

        // Ambil data vote yang sesuai vote_id
        $vote = Vote::findOrFail($voteId);

        return view('student.candidates.show', compact('candidate', 'vote'));
    }
}
