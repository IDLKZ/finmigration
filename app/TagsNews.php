<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $tags_id
 * @property integer $news_id
 * @property string $created_at
 * @property string $updated_at
 * @property News $news
 * @property Tag $tag
 */
class TagsNews extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['tags_id', 'news_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function news()
    {
        return $this->belongsTo('App\News');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo('App\Tag', 'tags_id');
    }

    public static function createTagAndNews($data,$newsId){
        if(isset($data)){
            if(count($data)){
                foreach ($data as $id => $tagsId){
                    $model = new self();
                    $model->tags_id = $tagsId;
                    $model->news_id = $newsId;
                    $model->save();
                }
            }
        }
    }
    public static function updateTags($data,$newsId,$news){
        $news->tagNews()->delete();
        if(isset($data)){
            if(count($data)){
                foreach ($data as $id => $tagsId){
                    $model = new self();
                    $model->tags_id = $tagsId;
                    $model->news_id = $newsId;
                    $model->save();
                }
            }
        }
    }
}
