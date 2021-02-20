<?php

namespace App;

use App\Models\File;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
    protected $fillable = ['author_id', 'category_id', 'alias', 'title', 'subtitle', 'content', 'thumbnail', 'img', 'img_description','actual','trend', 'created_at', 'updated_at'];

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
        return $this->belongsTo(User::class, 'author_id');
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

    public function tags(){
        return $this->belongsToMany(Tag::class,"tags_news","news_id","tags_id");
    }


    public static function createData($request){
        $model = new self();
        $input = $request->all();
        $input["thumbnail"] = File::createFile($request,"thumbnail","/uploads/news/",$request->title);
        $input["img"] = File::createFile($request,"img","/uploads/news/",$request->title);
        $input["trend"] = $request->has("trend") == true ? 1 : 0;
        $input["actual"] = $request->has("actual") == true ? 1 : 0;
        $input["author_id"] = Auth::id();
        $model->fill($input);
        $model->save();
        return $model->id;
    }

    public static function updateData($model,$request){
        $input = $request->all();
        $input["thumbnail"] = File::updateFile($model->thumbnail,$request,"thumbnail","/uploads/news/",$request->title);
        $input["img"] = File::updateFile($model->img,$request,"img","/uploads/news/",$request->title);
        $input["trend"] = $request->has("trend") == true ? 1 : 0;
        $input["actual"] = $request->has("actual") == true ? 1 : 0;
        $input["author_id"] = Auth::id();
        $model->update($input);
        return $model->save();
    }

    public static function giveData($category){
        $news["category"] = $category->title;
        $news["count"] = count(News::where("category_id",$category->id)->get());
        $news["trend"] = News::where("category_id",$category->id)->where("trend",1)->orderBy("created_at","DESC")->with("user")->first();
        if(News::where("actual",1)->where("category_id",$category->id)->count() > 3){$news["actual"] = News::where("category_id",$category->id)->where("trend",0)->where("actual",1)->with("user")->get()->take(3);}
        else{$news["actual"][0] = News::where("category_id",$category->id)->orderBy("created_at","DESC")->with("user")->first();}
        $news["news"] = News::where("category_id",$category->id)->orderBy("created_at","DESC")->with("user")->paginate(5);
        if(News::where("trend",1)->get()->count()>2){$news["all_trend"] = News::where("trend",1)->orderBy("created_at","DESC")->get()->take(3);} else{$news["all_trend"] = [];}
        if(News::where("actual",1)->get()->count()>2){$news["all_actual"] = News::where("actual",1)->orderBy("created_at","DESC")->get()->take(3);} else{$news["all_actual"] = [];}
        return $news;
    }

}
