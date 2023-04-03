<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['dob'];

    /* public function setDobAttribute($dob)
    {
        $this->attributes['dob'] = Carbon::parse($dob);
        
        // die(get_class($this->attributes['dob']));
    } */
    public function dob():Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value),
        );
    }
}
