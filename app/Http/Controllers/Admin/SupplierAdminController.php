<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\FilterRequest;
use App\Http\Requests\StoreRequest;
use App\Models\Review;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::query();

        // Поиск по имени
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        // Сортировка (по умолчанию A-Z)
        $sortOrder = $request->input('sort', 'asc'); // Значение по умолчанию: 'asc'
        $query->orderBy('name', $sortOrder);

        // Получаем поставщиков после фильтрации и сортировки
        $suppliers = $query->get();

        return view('Admin.Suppliers.index', compact('suppliers', 'sortOrder'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('Admin.Suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:1000',
            'country' => 'required|string|max:1000',
        ]);
        $data = [
            'name' => $request->input('name'),
            'country' => $request->input('country'),
        ];
        Supplier::create($data);
        return redirect()->route('admin.suppliers.index');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->route('admin.suppliers.index');
    }

    public function edit(Supplier $supplier)
    {
        return view('Admin.Suppliers.edit', compact('supplier'));
    }


    public function update(Request $request, Supplier $supplier){
        $request->validate([
            'name' => 'required|string|max:1000',
            'country' => 'required|string|max:1000',
        ]);

        $data = [
            'name' =>$request->input('name'),
            'country' => $request->input('country'),
        ];
        $supplier->update($data);
        return redirect()->route('admin.suppliers.index');
    }

}
