@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Posts</div>
                    <div class="panel-body">
                        @foreach($post as $post)
                            <post>
                                <div style="display: block">
                                    <h1>{{ $post->content }}</h1>
                                    <div><a class="row " href="/posts/{{$post->post_id}}">
                                            {{ jdmonthname ( $post->created_at->month , 0 ).' '.$post->created_at->day.' at '.$post->created_at->hour.' o\'clock ' }}</a></div>
                                    {{--                                <a href="like/{{$post->user_id}}/posts/{{$post->post_id}}"><h1>{{ $post->like_counter }}</h1></a>--}}
                                    @if(in_array(pathinfo($post->media, PATHINFO_EXTENSION),array("jpeg", "png" , "jpg" ,"gif" , "svg")))
                                        <img src="/media/images/{{ $post->media}}" class="img-thumbnail img-responsive">
                                    @elseif(in_array(pathinfo($post->media, PATHINFO_EXTENSION),array('3gp','amv','avi','flv','mkv','mp4','wmv')))
                                        <div align="center" class="embed-responsive embed-responsive-16by9">
                                            <video controls  class="embed-responsive-item">
                                                <source src="/media/videos/{{ $post->media}}" type="video/mp4">
                                            </video>
                                        </div>

                                    @else

                                    @endif
                                </div>
                                @if(Auth::user()->id ==$post->user_id )
                                    <a class="btn btn-danger form-control" href="/deletepost={{$post->post_id}}" >delete</a>
                                    <br />
                                @endif
                            <hr >
                                @foreach($comment as $Comment)
                                    <div>
                                        <h4>

                                            {{ $Comment->content }}
                                         {{--{{  dd( \App\User::post()) }}--}}
                                            <a role="button" href="#" >replay</a>
                                            @foreach($Comment->replais as $reply)
                                                {{dd(11)}}
                                                {{$reply->reply_comment_id}}
                                            <h6>{{ $reply->content }}</h6>
                                            <h6>{{ $reply->reply_comment_id }}</h6>
                                            <h6>{{ $reply->comment_id }}</h6>
                                            @endforeach
                                        </h4>
                                    </div>
                                @endforeach
                            </post>
                        @endforeach
                        <div>

                        </div>
                    </div>

                    {!!   Form::open(['url' => 'post','files' => true]) !!}
                    <!-- Form input -->
                        <div class="form-group" >
                            {!! Form::text('content',null,['class'=>'form-control']) !!}
                        </div>

                        <!-- submit input -->
                        <div class="form-group">
                            <input type="hidden" name="post_id" value="{{$post_id}}">
                            {!! Form::submit('comment',['class'=>'btn btn-primary ']) !!}
                        </div>
                        {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection