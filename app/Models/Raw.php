<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raw extends Model
{
	protected $guarded = ['id'];
    use HasFactory;
    
    public function rawEntries(){
    	$this->hasMany(RawEntry::class);
    }
    public function user(){
    	$this->belongsTo(\App\User::class);
    }
}
