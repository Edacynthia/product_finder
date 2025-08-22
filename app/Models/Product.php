<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function marketers()
    {
        return $this->belongsToMany(MarketerProfile::class, 'marketer_products')
            ->withPivot('price')
            ->withTimestamps();
    }
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
