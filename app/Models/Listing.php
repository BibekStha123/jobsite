<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'logo',
        'company',
        'location',
        'email',
        'website',
        'tags',
        'description'
    ];

    public function scopeFilter($query, $tag, $search)
    {
        if ($tag) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if ($search) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%'. request('search') . '%')
                ->orWhere('location', 'like', '%'. request('search') . '%');
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
