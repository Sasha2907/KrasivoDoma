@extends('layouts.Review.main')
@section('content')
    <div class="container mb-3 mt-3">
    <div class="catalog-header">
            <img src="/Images/logoCircle.png" alt="Логотип" class="catalog-logo">
            <h2 class="catalog-title">Отзывы</h2>
        </div>
    <form method="GET" action="{{ route('review.index') }}" class="mb-4">
        <label for="date_filter" class="form-label">Показать отзывы за:</label>
        <select name="date_filter" id="date_filter" class="form-select w-auto d-inline-block">
            <option value="">-- Все отзывы --</option>
            <option value="week" {{ request('date_filter') == 'week' ? 'selected' : '' }}>Последнюю неделю</option>
            <option value="month" {{ request('date_filter') == 'month' ? 'selected' : '' }}>Последний месяц</option>
            <option value="year" {{ request('date_filter') == 'year' ? 'selected' : '' }}>Последний год</option>
        </select>
        <button type="submit" class="btn btn-outline-primary btn-sm ms-2">Применить</button>
    </form>
        @if(auth()->user())
            <a href="{{route('review.create')}}" class="btn btn-outline-primary mb-3">Добавить отзыв</a>
        @endif
        @foreach($reviews as $review)
            @foreach($users as $user)
                <form action="{{route('review.destroy',$review->id)}}" method="post">
                    @if($review->user_id == $user->id)
                        <div class="card mb-3 mt-3">
                            <div class="card-header">
                                Имя пользователя: {{$user->name}}
                                
                            </div>
                            
                            <div class="card-body ps-3">
                            <p class="text-muted">{{ $review->created_at->format('d.m.Y H:i') }}</p>
                                <p class="card-text"> Отзыв: {{$review->content}}</p>
                                @auth
                                    @if(auth()->user()->id == $review->user_id || auth()->user()->role == 'admin')
                                        <form action="{{ route('review.destroy', $review->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm mb-3">Удалить</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @endif
                </form>
            @endforeach
        @endforeach

    </div>

@endsection
