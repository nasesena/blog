<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

// コメントで利用するカラムを代入する
class Comment extends Model
{
/**
 * モデルと関連するテーブルを定義する(他でも使えるように)
 * 
 */
    protected $table = 'comments';


/**
  * 代入するカラム
  */
    protected $fillable = [
        'name', 
        'comment',
        'post_id',
        'comment_id',
    ];
}
