<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\FilterRequest;
use App\Http\Requests\StoreRequest;
use App\Models\Products;
use App\Models\Review;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PocrivalaController extends Controller
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
        $query = Products::where('category_id', '4');
        // Проверяем, есть ли запрос на поиск
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "{$search}%");
        }
        if ($request->has('country') && $request->country != '') {
            $country = $request->input('country');
            $query->whereHas('supplier', function ($q) use ($country) {
                $q->where('country', $country);
            });
        }
        // Получаем результаты запроса
        $products = $query->paginate(6)->withQueryString();
        $countries = Supplier::select('country')->distinct()->pluck('country');
        return view('catalogs.pocrivala.index', compact('products', 'countries'));
    }

    public function create()
    {
        $products = Products::where('category_id', '4')->get();
        $suppliers = Supplier::all();
        return view('catalogs.pocrivala.create', compact('products', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:1000',
            'material' => 'required|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'category_id' => 'nullable|numeric',
            'supplier_id' => 'required|numeric',
        ]);
        $imagePath = $request->file('image')->store('uploads', 'public');
        $data = [
            'name' => $request->input('name'),
            'material' => $request->input('material'),
            'image' => $imagePath,
            'price' => $request->input('price'),
            'category_id' => 4,
            'supplier_id' => $request->input('supplier_id'),
        ];

        Products::create($data);
        return redirect()->route('pocrivala.index');
    }

    public function edit(Products $product)
    {
        $suppliers = Supplier::all();
        return view('catalogs.pocrivala.edit', compact('product', 'suppliers'));
    }

    public function update(Request $request, Products $product)
    {
        $request->validate([
            'name' => 'required|string|max:1000',
            'material' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'category_id' => 'nullable|numeric',
            'supplier_id' => 'required|numeric',
        ]);
        if (!empty($request->image)) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        } else {
            $imagePath = $product->image;
        }
//        $imagePath = $request->file('image')->store('uploads', 'public');
        $data = [
            'name' => $request->input('name'),
            'material' => $request->input('material'),
            'image' => $imagePath,
            'price' => $request->input('price'),
            'category_id' => 4,
            'supplier_id' => $request->input('supplier_id'),
        ];
        $product->update($data);
        return redirect()->route('pocrivala.index');
    }

    public function show(Products $product)
    {
        $supplier_id = $product->supplier->id;
        $supplier = Supplier::where('id',$supplier_id)->first();
        return view('catalogs.pocrivala.show', compact('product', 'supplier'));
    }

    public function destroy(Products $product){
        if ($product->image) {
            Storage::delete('public/' . $product->image); // Удаляет фото
        }
        $product->delete();
        return redirect()->route('pocrivala.index');
    }
}
