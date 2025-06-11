<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\FilterRequest;
use App\Http\Requests\StoreRequest;
use App\Models\Review;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
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
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('suppliers.create');
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
        return redirect()->route('supplier.index');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->route('review.index');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
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
        return redirect()->route('supplier.index');
    }
//    public function update(Supplier $supplier)
//    {
//        $data = request()->validate([
//            'name' => 'required|string|max:1000',
//            'country' => 'required|string|max:1000',
//        ]);
//        $supplier->update($data);
//        return redirect()->route('supplier.index', $supplier->id);
//    }
}
