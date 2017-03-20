<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle()
    {
        // $payload = request()->all();
        // $email = Email::create($payload);
        // $method = $this->eventToMethod($payload['type']);
        // if (method_exists($this, $method)) {
        //     $this->$method($payload);
        // }
        return response('Email Received', 200);
    }
}
