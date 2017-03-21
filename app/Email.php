<?php

namespace App;

use App\Attachment;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $guarded = [];

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
