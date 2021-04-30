<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ingredient extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
	
	protected $guarded = ['id'];
	
	public function user()
	{
		return $this->belongsTo(User::class);
    }
	
	public function raw()
	{
		return $this->belongsTo(Raw::class);
    }
	
	public function supplier()
	{
		return $this->belongsTo(Supplier::class);
    }
	
	public function registerMediaCollections() : void
	{
		$this->addMediaCollection('file')->singleFile();
    }
}
