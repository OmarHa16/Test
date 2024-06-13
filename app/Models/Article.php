<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use Searchable;

    use HasFactory;
    protected $fillable = [
        'title',
        'source_id',
        'author_id',
        'Descreption',
        'url',
        'urlOfImage',
        'content',
        'published_at'
    ];

    public function author()
    {
        return $this->hasOne(authors::class, 'author_id');
    }
    public function source()
    {
        return $this->hasOne(sources::class, 'source_id');
    }
    /**
 * Get the indexable data array for the model.
 *
 * @return array<string, mixed>
 */
public function toSearchableArray()
{
    return array_merge($this->toArray(),[
        'title' => (string) $this->title,
        
    ]);
}
}
