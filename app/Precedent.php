<?php

namespace App;

use Carbon\Carbon;
use App\Repositories\Precedents;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Precedent extends Model
{
    use FullTextSearch;

    public $fillable = ['number', 'slug', 'body', 'segregated_at', 'approved_at', 'suspended_at', 'canceled_at', 'reviewed_at', 'pending_resources', 
    'additional_info', 'court_id', 'user_id', 'type_id'];

    protected $searchable = [
        'number',
        'body'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(PrecedentType::class);
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class)->withTimestamps();
    }

    public function saves()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function has(Precedent $precedent)
    {        
        $contain = $precedent->saves->contains(Auth::user()->id); 

        return $contain;
    }

    public function scopeLoggedIn($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function scopeFilter($query, $data)
    {
        return $query->where(function ($query) use ($data){

            if(isset($data['courts']))
            {
                if(count($data['courts']) > 1)
                {
                    foreach($data['courts'] as $court)
                    {
                        $query->orWhere('court_id', $court);
                    }
                }
                else
                {
                    $query->where('court_id', $data['courts']);
                }
                
            }

            if(isset($data['types']))
            {
                if(count($data['types']) > 1)
                {
                    foreach($data['types'] as $type)
                    {
                        $query->orWhere('type_id', $type);
                    }
                }
                else
                {
                    $query->where('type_id', $data['types']);
                }                
            }
            
            if(isset($data['date']))
            {
                $dt = Carbon::now('-3');

                switch ($data['date']) {
                    case 'today':
                        $query->where('created_at', '>', $dt->toDateString());
                        break;
                    case 'week':
                        $query->where('created_at', '>', $dt->subWeek());
                        break;
                    case 'month':
                        $query->where('created_at', '>=', $dt->format('Y-m-01'));
                        break;
                    case 'year':
                        $query->whereYear('created_at', $dt->year);
                        break;
                    case 'last':
                        $query->where('created_at', '<', $dt->subYear());
                        break;
                }
            }

        })->orderBy('created_at', 'desc');
    }

}
