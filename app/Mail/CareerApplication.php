<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CareerApplication extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $cvPath;

    public function __construct($data, $cvPath)
    {
        $this->data = $data;
        $this->cvPath = $cvPath;
    }

    public function build()
    {
        return $this->subject('New Career Application')
                    ->view('emails.career_application')
                    ->attach($this->cvPath, [
                        'as' => 'cv_' . $this->data->full_name . '.' . pathinfo($this->cvPath, PATHINFO_EXTENSION),
            
                    ]);
    }
}