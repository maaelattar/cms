<?php

namespace App;

use App\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'description', 'content', 'image', 'published_at', 'category_id', 'user_id'];
    protected $dates = ['published_at'];
    public function deleteImage()
    {
        Storage::disk('s3')->delete($this->image);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }

    public function scopeSearched($query)
    {
        $search = request()->query('search');
        if (!$search) {
            return $query->published();
        }
        return $query->published()->where('title', 'ILIKE', '%' . $search . '%');
    }
}