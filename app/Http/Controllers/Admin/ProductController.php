<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\FilterRequest;
use App\Http\Requests\StoreRequest;
use App\Models\Categories;
use App\Models\Products;
use App\Models\Review;
use App\Models\Supplier;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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
        $query = Products::query();

        // Поиск по названию товара
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        // Сортировка по алфавиту (A-Z или Z-A)
        if ($request->has('sort_name')) {
            $sortOrder = $request->input('sort_name') === 'desc' ? 'desc' : 'asc';
            $query->orderBy('name', $sortOrder);
        }

        // Фильтр по категории
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category_id', $request->input('category'));
        }

        // Фильтр по стране поставщика
        if ($request->has('supplier_country') && $request->supplier_country != 'all') {
            $query->whereHas('supplier', function ($q) use ($request) {
                $q->where('country', $request->input('supplier_country'));
            });
        }

        // Получаем товары после фильтрации
        $products = $query->paginate(6)->withQueryString();

        // Получаем уникальные страны поставщиков и категории
        $countries = Supplier::select('country')->distinct()->pluck('country');
        $categories = Categories::all();

        return view('admin.products.index', compact('products', 'countries', 'categories'));

//        $query = Products::all();
//        $products = $query;
//        $countries = Supplier::select('country')->distinct()->pluck('country');
//        return view('admin.products.index', compact('products', 'countries'));
    }

    public function create()
    {
        $products = Products::all();
        $suppliers = Supplier::all();
        $categories = Categories::all();
        return view('admin.products.create', compact('products', 'suppliers', 'categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:1000',
            'material' => 'required|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'supplier_id' => 'required|numeric',
        ]);
        $imagePath = $request->file('image')->store('uploads', 'public');
        $data = [
            'name' => $request->input('name'),
            'material' => $request->input('material'),
            'image' => $imagePath,
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
            'supplier_id' => $request->input('supplier_id'),
        ];

        Products::create($data);
        return redirect()->route('admin.products.index');
    }

    public function edit(Products $product)
    {
        $suppliers = Supplier::all();
        $categories = Categories::all();
        return view('admin.products.edit1', compact('product', 'suppliers', 'categories'));
    }

    public function update(Request $request, Products $product)
    {
        $request->validate([
            'name' => 'required|string|max:1000',
            'material' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
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
            'category_id' => $request->input('category_id'),
            'supplier_id' => $request->input('supplier_id'),
        ];
        $product->update($data);
        return redirect()->route('admin.products.index');
    }

    public function show(Products $product)
    {
        $supplier_id = $product->supplier->id;
        $supplier = Supplier::where('id',$supplier_id)->first();
        return view('admin.products.show', compact('product', 'supplier'));
    }

    public function destroy(Products $product){
        if ($product->image) {
            Storage::delete('public/' . $product->image); // Удаляет фото
        }
        $product->delete();
        return redirect()->route('admin.products.index');
    }

    public function exportPDF(Request $request)
    {
        $query = Products::query();

        // Поиск по названию товара
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        // Сортировка по алфавиту (A-Z или Z-A)
        if ($request->has('sort_name')) {
            $sortOrder = $request->input('sort_name') === 'desc' ? 'desc' : 'asc';
            $query->orderBy('name', $sortOrder);
        }

        // Фильтр по категории
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category_id', $request->input('category'));
        }

        // Фильтр по стране поставщика
        if ($request->has('supplier_country') && $request->supplier_country != 'all') {
            $query->whereHas('supplier', function ($q) use ($request) {
                $q->where('country', $request->input('supplier_country'));
            });
        }

        // Получаем товары после фильтрации
        $products = $query->get();
        $pdf = FacadePdf::loadView('admin.products.pdf', compact('products'))// Загружаем представление
            ->setOptions(['deafultFont'=> 'DejaVu Sans']);
//        return $pdf->stream('products.pdf');
        return $pdf->download('products.pdf'); // Отдаем файл на скачивание
//        return view('admin.products.pdf', compact('products'));
    }
}
