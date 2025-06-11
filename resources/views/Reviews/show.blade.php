@extends('layouts.review.main')
@section('content')
    @foreach($reviews as $post)
        <div><a href="{{route('post.show',$post->id)}}">{{$post->id}}. {{$post->title}}</a></div>
    @endforeach
@endsection
