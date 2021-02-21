<?php

namespace App;

use App\Models\File;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title
 * @property string $img
 * @property string $alias
 * @property string $content
 * @property string $start
 * @property string $end
 * @property string $advantages
 * @property string $price
 * @property string $created_at
 * @property string $updated_at
 */
class Conference extends Model
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
    protected $fillable = ['title', 'img', 'alias', 'content', 'start', 'end', 'advantages', 'price',"zoomId","password",'created_at', 'updated_at'];

    public function sluggable(): array
    {
        return [
            'alias' => [
                'source' => 'title'
            ]
        ];
    }
    public function getStartAttribute($value)
    {
        return \DateTime::createFromFormat('d/m/Y H:i', $value)->getTimestamp() * 1000;
    }
    public function getEndAttribute($value)
    {
        return \DateTime::createFromFormat('d/m/Y H:i', $value)->getTimestamp() * 1000;
    }

    public static function createData($request){
        $model = new self();
        $input = $request->all();
        $input["img"] =File::createFile($request,"img","/uploads/conference/",$request->title);
        $model->fill($input);
        return $model->save();
    }
    public static function updateData($model,$request){
        $input = $request->all();
        if($request->hasFile("img"))
        {
            $input["img"] = File::updateFile($request['img'], $request,"img","/uploads/conference/",$request->title);
        }
        $model->update($input);
        return $model->save();
    }



}
