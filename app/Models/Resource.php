<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $guarded = [];
    use HasFactory;


    public function type()
    {
        return $this->morphTo('type', 'resource_type', 'resource_id');
    }
}
