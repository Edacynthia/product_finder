<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'location',
        'description',
        'contact_phone',
        'contact_email',
        'website',
        'image_path', 
        'telegram_handle',
        'instagram_handle',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class, 'marketer_id');
    }
}