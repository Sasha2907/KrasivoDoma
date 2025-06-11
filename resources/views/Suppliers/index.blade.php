@extends('layouts.Review.main')
@section('content')
    <div class="container">

        @foreach($suppliers as $supplier)
            {{--                <form action="{{route('review.destroy',$review->id)}}" method="post">--}}

            <div><p>Название поставщика: {{$supplier->name}}<br>Страна поставщика: {{$supplier->country}}</p></div>

            {{--                </form>--}}
            <a href="{{route('supplier.edit',$supplier->id)}}" class="btn btn-dark">Изменить поставщика</a>
        @endforeach


        {{--        @if(auth()->user())--}}
        {{--            <a href="{{route('review.create')}}" class="btn btn-dark">Добавить отзыв</a>--}}
        {{--        @endif--}}


    </div>
@endsection
