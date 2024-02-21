<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $cast = ["region"];
    
    public function zone () {
        return $this->hasOne(Zone::class, 'code', 'zone_id')->with(['region']);
    }
}
