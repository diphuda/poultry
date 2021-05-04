<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raw extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
	
	public function distributions()
	{
		return $this->hasMany(Distribution::class);
    }
}
