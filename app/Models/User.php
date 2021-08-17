<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document_id',
        'username',
        'first_name',
        'last_name',
        'occupation_id',
        'age',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function occupation()
    {
        return $this->belongsTo(Occupation::class);
    }

    public function scopeSearchByDocID($query, $keywords)
    {
        $query->where('document_id', 'LIKE', '%' . $keywords . '%');
    }

    public function scopeFilterByOccupation($query, $occupation_id)
    {
        $query->when($occupation_id, function($query) use ($occupation_id){
            $query->where('occupation_id', $occupation_id);
        });
    }

    public function scopeOrderByLastName($query, $direction)
    {
        $query->when($direction, function($query) use ($direction){
            $query->orderBy('last_name', $direction);
        });
    }

    public function scopeOrderByAge($query, $direction)
    {
        $query->when($direction, function($query) use ($direction){
            $query->orderBy('age', $direction);
        });
    }


}
