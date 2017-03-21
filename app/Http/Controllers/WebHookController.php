<?php

namespace App\Http\Controllers;

use App\Email;
use App\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebhookController extends Controller
{
    protected $payload = [];
    protected $email;
    protected $request;

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * receive mail from Sendgrid
     * @return response status 200
     */
    public function handle()
    {
        $this->getPayload();
        $this->createEmail();
        $this->checkAttachments();
   
        return response('Email Received');
    }

    protected function getPayload()
    {
        $this->payload = request()->only([
            'to', 
            'from',
            'subject',
            'text',
            'sender_ip',
            'spam_score',
            'attachments'
        ]);
    }

    protected function createEmail()
    {
        $this->email = Email::create($this->payload);
    }

    protected function checkAttachments()
    {
        if(intval(request('attachments')) > 0) {
            for($i = 1; $i <= intval(request('attachments')); $i++) {
                $path = $this->request->file('attachment' . $i)->store('attachments', 's3');
                Attachment::create([
                    'email_id' => $this->email->id,
                    'filepath' => $path
                ]);
            }
        }
    }   
}
