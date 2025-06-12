@extends('layouts.Review.main')
@section('content')
    <div class="container">
        <div class="mb-4 mt-4 catalog-header">
            <img src="/images/logoCircle.png" alt="Логотип" class="catalog-logo">
            <p class="catalog-title">Шторы</p>
        </div>
        <div class="mb-4 mt-4 catalog-header">
            <p class="lead text-muted" style="font-size: 1.2rem; font-style: italic; line-height: 1.5;">
                Откройте для себя наш ассортимент стильных и качественных штор, которые подчеркнут вашу
                индивидуальность.
            </p>
        </div>
        <div class="mb-3">
            <a href="{{ route('catalog.index') }}" class="btn btn-outline-danger">
                <i class="bi bi-arrow-left"></i> Назад
            </a>
        </div>
        <form action="{{ route('shtory.index') }}" method="GET" class="mb-3">
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Поиск по названию" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Искать</button>
            </div>
            <div class="col-md-4 input-group">
                <select name="country" class="form-control">
                    <option value="">Выберите страну поставщика</option>
                    @foreach($countries as $country)
                        <option value="{{ $country }}" {{ request('country') == $country ? 'selected' : '' }}>
                            {{ $country }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Искать</button>
            </div>
        </form>
        <div class="d-flex flex-row flex-wrap mb-3">
            @foreach($shtory as $shtor)

                <div class="card m-3 w-20" style="width: 18rem;"> 
                    <img src="{{ asset('storage/' . $shtor->image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$shtor->name}}</h5>
                        <a href="{{route('shtory.show',$shtor->id)}}" class="btn btn-primary mb-1">Подробнее</a>
                        <form action="{{ route('favorites.toggle', $shtor->id) }}" method="POST">
                            @csrf
                            @if(auth()->user() && auth()->user()->favorites()->where('product_id', $shtor->id)->exists())
                                <button type="submit" class="btn btn-success">✅ В избранном</button>
                            @else
                                <button type="submit" class="btn btn-outline-primary">💖 Добавить в избранное</button>
                            @endif
                        </form>
                    </div>

                </div>

            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $shtory->links() }}
        </div>
    </div>
@endsection
