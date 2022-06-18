<?php

namespace App\Models;

use App\Models\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pdf extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function resource()
    {
        return $this->morphOne(Resource::class, 'type');
    }
}
