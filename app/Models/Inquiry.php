<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = ['user_id', 'marketer_id', 'message', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function marketer()
    {
        return $this->belongsTo(MarketerProfile::class, 'marketer_id');
    }
}
