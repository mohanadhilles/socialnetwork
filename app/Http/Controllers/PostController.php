<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Posts;
use App\User;
use App\Comments;
use Illuminate\Support\Facades\View;

class PostController extends Controller
{

    public function getPosts($id)
    {

        $posts = Posts::where('user_id',$id)
            ->orderBy('post_id', 'desc')
            ->get();
        return view('profile',compact('posts'));


    }
    public static function getMyPost($post_id)
    {

        $post = Posts::where('post_id', '=',$post_id)
            ->get();


        $comment = Comments::where('post_id', '=',$post_id)
            ->where('reply_comment_id',null)
            ->get();

//        View::share('try',1);
        return view('post',compact('post','comment'))->with('post_id',$post_id);
        ;
    }
    public static function getPost($user_id,$post_id)
    {

        $post = Posts::where('user_id', '=',$user_id)
            ->where('post_id', '=',$post_id)
            ->get();


//            $reply = Comments::where('post_id', '=',$post_id)
//                     ->where('reply_comment_id', '!=',null)
//                ->first();



        $comment = Comments::where('post_id', '=',$post_id)
            ->where('reply_comment_id',null)
            ->get();

//        View::share('try',1);
        return view('post',compact('post','comment'))->with('post_id',$post_id);
;
    }

    /**
     * Request class used to handle all inputs from form
     * @param Request $request
     * @return array
     */
    public  function  store(Request $request){

        $input = $request->all();
        $input['created_at']= Carbon::now();

//            $this->validate($request, [
//                'media' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//            ]);
        if($request->media != null){
            $mediaName = time().'.'.$request->media->getClientOriginalName();
            $ext=$request->media->getClientOriginalExtension();
            if (in_array($ext,array("jpeg", "png" , "jpg" ,"gif" , "svg"))){
                $media= $request->media->move(public_path('media/images'), $mediaName);

            }elseif (in_array($ext,array('3gp','amv','avi','flv','mkv','mp4','wmv'))){
                $media= $request->media->move(public_path('media/videos'), $mediaName);
            }

            $media=basename($media);
            $input['media']=$media;
        }else{
            $input['media']=null;
        }

        $input['user_id']=$request->user()->id;
        if ($input['content'] !=null OR $input['media']!=null){
            Posts::create($input);
        }


        return redirect('home');

    }
    public  function deletPost($post_id){
        $findPost = Posts::where('post_id', '=',$post_id);
        $findPost->forceDelete();
        return redirect('home');
    }



}
