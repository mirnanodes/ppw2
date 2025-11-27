<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class JobController extends Controller
{
    public function index(Request $request): View
    {
        $jobs = JobVacancy::query()
            ->when($request->filled('search'), fn ($query) => $query->where('title', 'like', '%' . $request->string('search') . '%'))
            ->when($request->filled('filter_location'), fn ($query) => $query->where('location', $request->string('filter_location')))
            ->when($request->filled('filter_type'), fn ($query) => $query->where('job_type', $request->string('filter_type')))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('jobs.index', compact('jobs'));
    }

    public function show(JobVacancy $job): View
    {
        return view('jobs.show', compact('job'));
    }

    public function adminIndex(): View
    {
        $jobs = JobVacancy::latest()->paginate(10);

        return view('jobs.admin-index', compact('jobs'));
    }

    public function create(): View
    {
        return view('jobs.form', ['job' => new JobVacancy()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'salary' => ['nullable', 'numeric'],
            'job_type' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        JobVacancy::create($data);

        return redirect()->route('admin.jobs.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function edit(JobVacancy $job): View
    {
        return view('jobs.form', compact('job'));
    }

    public function update(Request $request, JobVacancy $job): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'salary' => ['nullable', 'numeric'],
            'job_type' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('logo')) {
            if ($job->logo) {
                Storage::disk('public')->delete($job->logo);
            }

            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $job->update($data);

        return redirect()->route('admin.jobs.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(JobVacancy $job): RedirectResponse
    {
        if ($job->logo) {
            Storage::disk('public')->delete($job->logo);
        }

        $job->delete();

        return redirect()->back()->with('success', 'Lowongan berhasil dihapus.');
    }
}
