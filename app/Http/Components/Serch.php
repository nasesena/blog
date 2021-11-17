<?php

namespace App\Http\Components;

use App\User;

class Serch{
    public static function serch($keywords,$from_date,$to_date){
        
        $query = Post::query();

        if($keywords != null){
            $judge = $query->where('name','like', '%' .$keywords. '%') ->paginate(20) ->get();
        } else if($from_date != null && $to_date != null){
            $judge = $query->wherebetween('created_at',[$from_date,$to_date]) ->paginate(20) ->get();
        } else{
            $judge = $query->where('title','LIKE',"アニメ")->paginate(20);
        }
    }       
        return $judge;
 }
    