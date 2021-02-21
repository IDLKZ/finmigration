<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $created_at
 * @property string $updated_at
 * @property TagsNews[] $tagsNews
 */
class Tag extends Model
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
    protected $fillable = ['title', 'alias', 'created_at', 'updated_at'];

    public function sluggable(): array
    {
        return [
            'alias' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tagsNews()
    {
        return $this->hasMany('App\TagsNews', 'tags_id');
    }

    public function news(){
        return $this->belongsToMany(News::class,"tags_news","tags_id","news_id");
    }

    public static function createData($request){
        $model = new self();
        $model->fill($request->all());
        return $model->save();
    }
    public static function updateData($model,$request){
        $model->update($request->all());
        return $model->save();
    }
}
