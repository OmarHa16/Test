<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class authors extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    public function authors()
    {
        return $this->belongsToMany(User::class,"Preferred_authors");
    }
}
