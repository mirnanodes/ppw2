<?php

namespace App\Jobs;

use App\Mail\SendEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $data;
    public string $toEmail;

    public function __construct(array $data, string $toEmail)
    {
        $this->data = $data;
        $this->toEmail = $toEmail;
    }

    public function handle(): void
    {
        Mail::to($this->toEmail)->send(new SendEmail($this->data));
    }
}
