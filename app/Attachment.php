<?php

namespace App;

use App\Email;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $guarded = [];

    public function email()
    {
        return $this->belongsTo(Email::class);
    }

}
