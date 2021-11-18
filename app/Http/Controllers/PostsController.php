<?php


namespace app\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use app\Post;
use app\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;      
use Carbon\Carbon;


class PostsController extends BaseController
{
    // BaseControllerlでも使えるようにする
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // 一覧表示index,all()で全て取る！
    public function index(Request $request){
        
        $posts = Post::all();
        //dd($posts);
        
        
        // 検索した条件を受け取る
        $keywords = $request -> input('keywords');
        $from_date = $request -> input('from_date');
        $to_date = $request -> input('to_date');

                if($keywords != null){
                    \Session::flash('msg_success','記事を見つけました');
                        $query -> where('title','LIKE',"%$keywords%")
                    ->orWhere('content','like','%'.$keywords.'%')->paginate(20)->get();
                } else if($keywords != null && $from_date != null && $to_date != null){

                    // 日付検索のみを適応する場合
                    $posts = Post::wherebetween('created_at',[$from_date,$to_date]) 
                    ->orderBy('id','desc')->paginate(20)->get();
                } else{
                    // ない場合はall()で取得する。
                    //\Session::flash('msg_success','ここが実行される');
                    $posts = Post::orderBy('id','desc')->paginate(20);
                }        

        
        

        

        /*else if($from_date != null && $to_date != null){
            $posts = Post::wherebetween('created_at',[$from_date,$to_date]) -> paginate(20);
        
        // 何も入力していない場合はテーブル全体をここで取っている。
        } else {
            $posts = Post::orderBy('id','desc')->paginate(20);
        }*/

        // 更新時にパラメータを消さないようにする
        //$params = array('posts'=> $posts,'keywords' => $keywords,'from_date' => $from_date,'to_date' => $to_date);
            
        /*
        // タイトル検索か、日付検索を行う。最初に入力チェック 
        if($keywords != null){
            $posts = Post::where('title','like','%'.$keywords.'%')
            ->orWhere('content','like','%'.$keywords.'%')
            ->orderBy('id','desc')->paginate(20)->get();
        }  else if($from_date != null && $to_date != null){
            $posts = Post::wherebetween('created_at',[$from_date,$to_date]) -> paginate(20);
        
        // 何も入力していない場合はテーブル全体をここで取っている。
        } else {
            $posts = Post::orderBy('id','desc')->paginate(20);
        }
    */

        return view('posts.index', compact('posts','keywords'));
    }

    // 詳細表示、showとする。compact('posts')でそれぞれのURLを決める？
    public function show(Post $post){
        $comment = new Comment();
        $comments = $comment->where('post_id',$post->id)->get();
        $id = $comment->max('comment_id')+1;
        $user = \Auth::user();

        //return view('posts.show',compact('post'));
        return view('posts.show',['posts'=>$post,'comments'=>$comments,'user'=>$user,'id'=>$id]);
    }

    // 編集画面、editとする
    public function edit(Post $post){

    return view('posts.edit',compact('post'));
    }

    // 更新メソッド、フラッシュメッセージを入れる
    public function update(Request $request,Post $post){

        // バリデーション(タイトルは。3文字〜30文字。記事内容はnullを禁止！)
        $this->validate($request,[
            'title' => 'required | max:30',
            'title' => 'required | min:3',
            'content' => 'required | min:1'
        ],[
            'title.required' => 'タイトルは、「３文字以上30文字以下を入力してください！」',
            'title.required' => '最低でもタイトルは3文字以上入力してください！',
            'content.required'  => '記事は「必須項目」です！必ず１文字以上は入力しましょう！',
    ]);

        $post->update($request->all());
        \Session::flash('msg_success','更新したよ！');
        return redirect()->route('posts.index');
    }


    // 作成メソッド
    public function create(){
        $post = new Post();
        return view('posts.create',compact('post'));
    }

    // 登録メソッド、createクエリを利用する。
    public function store(Request $request,Post $post){

        // バリデーション(タイトルは。3文字〜30文字。記事内容はnullを禁止！)
        $this->validate($request,[
            'title' => 'required | max:30',
            'title' => 'required | min:3',
            'content' => 'required | min:1'
        ],[
            'title.required' => 'タイトルは、「３文字以上30文字以下を入力してください！」',
            'content.required'  => '記事は「必須項目」です！必ず１文字以上は入力しましょう！',
    ]);

        $post = Post::create($request->all());
        \Session::flash('msg_success','登録完了！');
        return redirect()->route('posts.index');
    }

    //削除メソッド,削除を実行する。
    public function destroy(Post $post){
        $post -> delete();
        \Session::flash('msg_success','削除したよ！');
        return redirect()->route('posts.index');
    }
    
    // コメントの一覧を表示させる
    /*public function show(Post $post){
        $comment = new Comment();
        $comments = $comment->where('post_id',$post->id)->get();
        $id = $comment->max('comment_id')+1;
        $user = \Auth::user();

        return view('posts.show',['posts'=>$post,'comments'=>$comments,'user'=>$user,'id'=>$id]);
    }*/


    // コメントの登録を行う。
    public function comment(Request $request){

        // バリデーションを追加する。最低1文字は入力させる。
        $this->validate($request,[
            'comment' => 'required | min:1',
        ],[ 
            'comment.required'=>'必ず１文字以上は入力しましょう！',
        ]);

        $comment = Comment::create($request->all());
        $comment->save();

        \Session::flash('msg_success','コメントの書き込みに成功しました！');
        return redirect()->route('posts.show',[$comment->post_id]);
    }

}

