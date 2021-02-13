<?php

namespace App;

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
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['title', 'img', 'alias', 'content', 'start', 'end', 'advantages', 'price', 'created_at', 'updated_at'];

    public function createData($request){
        $model = new self();


    }



}
