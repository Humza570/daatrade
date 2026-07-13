<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\NewsLetterEmail;
use Mail;
class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $subject;
    protected $message;
    protected $emails;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($emails,$subject,$message)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->emails = $emails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email=new NewsLetterEmail($this->subject, $this->message);
        Mail::to($this->emails)->send($email);
    }
}
