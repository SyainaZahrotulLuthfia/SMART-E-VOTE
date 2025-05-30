<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Classroom;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->roles->first()->name == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->roles->first()->name == 'student') {
            return redirect()->route('student.dashboard');
        } else {
            return redirect()->route('welcome');
        }
    }

    public function admin()
    {
        $countClassrooms = Classroom::count();
        $countVotes = Vote::count();
        $countCandidates = Candidate::count();
        $countStudents = User::whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })->count();

        $countVotedStudents = \App\Models\Box::distinct('user_id')->count('user_id');
        $countNotVotedStudents = $countStudents - $countVotedStudents;

        $topCandidates = Candidate::withCount('boxes')
            ->orderByDesc('boxes_count')
            ->limit(4)
            ->get();

        $maxVotes = $topCandidates->max('boxes_count');

        // Ambil upcoming votes (pemilihan yang mulai setelah sekarang)
        $upcomingVotes = Vote::where('start', '>', Carbon::now())
            ->orderBy('start')
            ->take(2)
            ->get();

        return view('admin.dashboard.index', compact(
            'countClassrooms',
            'countVotes',
            'countCandidates',
            'countStudents',
            'countVotedStudents',
            'countNotVotedStudents',
            'topCandidates',
            'maxVotes',
            'upcomingVotes'
        ));
    }
}
