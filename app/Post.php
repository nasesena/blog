<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use app\Post;

class Post extends Model
{
    //モデルと関連するテーブルを作成する。表示したいテーブルを決める
    protected $table = 'posts';

    
    protected $fillable=[ 
        'id',
        'title',
        'content',
    ];

}
