<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobVacancy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function index(): View
    {
        $applications = Application::with(['user', 'job'])->latest()->get();

        return view('applications.index', compact('applications'));
    }

    public function store(Request $request, JobVacancy $job): RedirectResponse
    {
        if (! Auth::user()->isJobseeker()) {
            abort(403);
        }

        $data = $request->validate([
            'cv' => ['required', 'file', 'mimes:pdf', 'max:2048'],
        ]);

        $cvPath = $request->file('cv')->store('cvs', 'public');

        Application::create([
            'user_id' => Auth::id(),
            'job_id' => $job->id,
            'cv' => $cvPath,
            'status' => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Lamaran berhasil dikirim.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:Pending,Accepted,Rejected'],
        ]);

        $application = Application::findOrFail($id);
        $application->update($data);

        return redirect()->back()->with('success', 'Status pelamar berhasil diperbarui.');
    }
}
