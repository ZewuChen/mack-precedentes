<?php

namespace App;

use App\Traits\WithSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Collection extends Model
{
    use WithSlug;
    
    public $fillable = [
        'name', 'slug', 'is_public', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function precedents()
    {
        return $this->belongsToMany(Precedent::class)->withTimestamps();
    }

    public function has(Precedent $precedent)
    {
        return DB::table('collection_precedent')
            ->where('collection_id', $this->id)
            ->where('precedent_id', $precedent->id)
            ->exists();
    }
    
    public function scopeOrdered($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function isPublic()
    {
        return $this->is_public;
    }
}
