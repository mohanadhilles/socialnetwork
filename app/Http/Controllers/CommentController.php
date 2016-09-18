<?php

namespace App\Http\Controllers;

use App\Comments;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public  function  store(Request $request){


        $input = $request->all();
        $input['created_at']= Carbon::now();


        $input['user_id']=Auth::user()->id;
        $post_id=$request->get('post_id');
        $input['post_id']=$post_id;


        Comments::create($input);

        return redirect('posts/'.$post_id);

    }
}
