<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $author_id
 * @property integer $category_id
 * @property string $alias
 * @property string $title
 * @property string $subtitle
 * @property string $content
 * @property string $thumbnail
 * @property string $img
 * @property string $img_description
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Category $category
 * @property Comment[] $comments
 * @property TagsNews[] $tagsNews
 */
class News extends Model
{
    use Sluggable;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['author_id', 'category_id', 'alias', 'title', 'subtitle', 'content', 'thumbnail', 'img', 'img_description','actual','trand', 'created_at', 'updated_at'];

    public function sluggable(): array
    {
        return [
            'alias' => [
                'source' => 'title'
            ]
        ];
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tagsNews()
    {
        return $this->hasMany('App\TagsNews');
    }
}
