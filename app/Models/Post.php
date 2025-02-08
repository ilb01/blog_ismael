<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url_clean',
        'content',
        'posted',
        'user_id',
        'category_id',
    ];
    // Relación Many-to-Many con Tag M:N
    public function tags(): BelongsToMany
{
    return $this->belongsToMany(Tag::class, 'post_tags');
}


}
