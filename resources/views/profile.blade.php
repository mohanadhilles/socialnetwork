@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 ">
                <div class="panel panel-default">
                    <div class="panel-heading">Posts</div>

                    <div class="panel-body">

                        @foreach($posts as $post)
                            <post>
                                <div style="display: block">
                                    <h1>{{ $post->content }}</h1>
                                    <div><a class="row " href="/posts/{{$post->post_id}}">
                                            {{ jdmonthname ( $post->created_at->month , 0 ).' '.$post->created_at->day.' at '.$post->created_at->hour.' o\'clock ' }}</a></div>
                                    {{--   <a href="like/{{$post->user_id}}/posts/{{$post->post_id}}"><h1>{{ $post->like_counter }}</h1></a>--}}
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
                                    <div class="col-md-2 col-lg-2 col-sm-2">

                                    <a class="btn btn-danger form-control " href="/deletepost={{$post->post_id}}" >delete</a>
                                    </div>
                                        <br />
                                @endif
                            </post>

                            @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection