<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\FilterRequest;
use App\Http\Requests\StoreRequest;
use App\Models\Categories;
use App\Models\Favorites;
use App\Models\Products;
use App\Models\Review;
use App\Models\Configuration;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Получаем все избранные товары пользователя
        $query = Products::whereIn('id', Favorites::where('user_id', $user->id)->pluck('product_id'));

        // Фильтр по названию
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Фильтр по категории
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category_id', $request->category);
        }

        // Фильтр по стране поставщика
        if ($request->has('country') && $request->country != 'all') {
            $query->whereHas('supplier', function ($q) use ($request) {
                $q->where('country', $request->country);
            });
        }

        $configs = Configuration::with(['fabric', 'sewingType'])
        ->where('user_id', auth()->id())
        ->latest()->get();

        $favorites = $query->get();
        $categories = Categories::all();
        $countries = Supplier::select('country')->distinct()->get();


        return view('Favorites.index', compact('favorites', 'categories', 'countries','configs'));


//        $favorites = Favorites::where('user_id', Auth::id())->with('product')->get();
//        return view('favorites.index', compact('favorites'));
    }

    public function store($productId)
    {
        $user = Auth::user();

        // Проверяем, нет ли уже этого продукта в избранном
        if ($user->favorites()->where('product_id', $productId)->exists()) {
            $user->favorites()->where('product_id', $productId)->delete();
            return back()->with('success', 'Товар удален из избранного!');
        } else {
            $user->favorites()->create(['product_id' => $productId]);
            return back()->with('success', 'Товар добавлен в избранное!');
        }
    }

    public function destroy($productId)
    {

        // Favorites::where('user_id', Auth::id())->where('product_id', $productId)->delete();
        // return back()->with('success', 'Товар удален из избранного!');
        try {
            $user = Auth::user();
            $user->favorites()->where('product_id', $productId)->delete();
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
