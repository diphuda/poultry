<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;
	protected $guarded = ['id'];
	
	public function feed()
	{
		return $this->belongsTo(Feed::class);
	}
	
	public function raw()
	{
		return $this->belongsTo(Raw::class);
	}
}
