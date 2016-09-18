@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="panel panel-default ">
            <style>
                .image-upload > input
                {
                    display: none;
                }

            </style>
           {!!   Form::open(['url' => 'home','files' => true]) !!}
            <!-- Form input -->
           <div class="form-group" >
             {!! Form::textarea('content',null,['class'=>'form-control' ,'style'=>" height: 120px;"]) !!}
           </div>

               <!-- submit input -->
               <div class="form-group">
                   <label class="fa fa-picture-o  fa-film" for="file-input" style="font-size:2.5em;"></label>
                   <label class="fa fa-film" for="file-input" style="font-size: 2.5em;"></label>
                   {!! Form::file('media',['class'=>'image-upload ','id'=>'file-input','style'=>"display:none"]) !!}

               </div>

               <!-- submit input -->
               <div class="form-group">
                   {!! Form::submit('publish',['class' => ' btn btn-primary']) !!}
               </div>
           {!! Form::close() !!}

        </div>
      

                <div class="panel panel-default ">

                    <div class="panel-heading">Posts</div>
                    <div class="form-group">

                    <div class="panel-body">
                        @foreach($posts as $post)
                            <post>

                <div style="display: block">

                               <h1>{{ $post->content }}</h1>
                                <div><a class="row " href="profile={{$post->user_id}}/posts/{{$post->post_id}}">
                                        {{ jdmonthname ( $post->created_at->month , 0 ).' '.$post->created_at->day.' at '.$post->created_at->hour.' o\'clock ' }}</a></div>
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

                                    <a class="btn btn-danger form-control" href="/deletepost={{$post->post_id}}" >delete</a>
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