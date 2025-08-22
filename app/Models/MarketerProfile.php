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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'marketer_products')
            ->withPivot('price')
            ->withTimestamps();
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class, 'marketer_id');
    }
}
