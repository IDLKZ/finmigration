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
 * @property News[] $news
 */
class Category extends Model
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
    public function news()
    {
        return $this->hasMany('App\News');
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
