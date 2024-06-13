<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sources extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    public function sources()
    {
        return $this->belongsToMany(User::class, "Preferred_sources");
    }
}
