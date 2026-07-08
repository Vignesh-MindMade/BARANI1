<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupplierRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $supplierData;
    public $isUpdate;

    /**
     * Create a new message instance.
     */
    public function __construct($supplierData, $isUpdate = false)
    {
        $this->supplierData = $supplierData;
        $this->isUpdate = $isUpdate;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = $this->isUpdate 
            ? 'Supplier Registration Updated - ' . $this->supplierData['company_name']
            : 'New Supplier Registration - ' . $this->supplierData['company_name'];

        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject($subject)
                    ->view('emails.supplier-registration')
                    ->with([
                        'supplierData' => $this->supplierData,
                        'isUpdate' => $this->isUpdate
                    ]);
    }
}