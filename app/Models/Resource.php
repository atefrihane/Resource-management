<?php

namespace App\Models;

use App\Models\Pdf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resource extends Model
{
    protected $guarded = [];
    use HasFactory;


    public function type()
    {
        return $this->morphTo('type', 'resource_type', 'resource_id');
    }

    public function isPdf()
    {
        return $this->resource_type == Pdf::class;
    }
}
