<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SendEmailController extends Controller
{
    public function index(): View
    {
        return view('send-email.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        SendMailJob::dispatch($data, (string) $request->string('email'));

        return redirect()->back()->with('success', 'Email akan dikirim melalui queue.');
    }
}
