<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    //
    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }
}
