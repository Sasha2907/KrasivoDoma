<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuration;
use App\Models\Preorder;
use App\Models\PreorderItem;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\Favorites;

class PreorderController extends Controller
{
//     public function create()
// {
//     $user = Auth::user();
//     // $favorites = auth()->user()->favorites; // связь должна быть в User
    
//     $query = Products::whereIn('id', Favorites::where('user_id', $user->id)->pluck('product_id'));
//     $configs = Configuration::where('user_id', auth()->id())->get();
//     $favorites = $query->get();

//     return view('preorders.create', compact('favorites', 'configs'));
// }

// public function store(Request $request)
// {
//     // Валидируем данные формы
//     $validated = $request->validate([
//         'favorites' => 'nullable|array',
//         'configs' => 'nullable|array',
//         'description' => 'nullable|string|max:500',
//     ]);

//     // Создаем сам предзаказ
//     $preorder = Preorder::create([
//         'user_id' => auth()->id(),
//         'description' => $request->description,
//         'status' => 'pending',  // Статус заявки (можно изменить по необходимости)
//     ]);
    
//     // Сохранение товаров
//     if ($request->has('favorites')) {
//         foreach ($request->favorites as $productId) {
//             $preorder->items()->create([
//                 'preorder_id' => $preorder->id,
//                 'item_type' => Products::class,
//                 'item_id' => $productId,
//             ]);
//         }
//     }
    
//     // Сохранение конфигураций
//     if ($request->has('configs')) {
//         foreach ($request->configs as $configId) {
//             $preorder->items()->create([
//                 'preorder_id' => $preorder->id,
//                 'item_type' => Configuration::class,
//                 'item_id' => $configId,
//             ]);
//         }
//     }

//     // Перенаправляем с успешным сообщением
//     return redirect()->route('preorders.create')->with('success', 'Заявка успешно отправлена на рассмотрение!');
// }
public function create()
{
    $user = Auth::user();
    $favorites = $user->favorites()->with('product')->get();
    $configs = $user->configurations()->get();
    
    return view('Favorites.index', compact('favorites', 'configs'));
}

public function confirm(Request $request)
{
    
    $request->validate([
        'selected_items' => 'required|array',
        'selected_items.*' => 'string'
    ]);
    $items = collect();
    
    foreach ($request->selected_items as $item) {
        if (str_starts_with($item, 'product_')) {
            $productId = str_replace('product_', '', $item);
            $items->push(Products::findOrFail($productId));
        } else {
            $configId = str_replace('config_', '', $item);
            $items->push(Configuration::findOrFail($configId));
        }
    }
    
    return view('preorders.confirm', compact('items'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'selected_items' => 'required|array',
        'selected_items.*' => 'string',
        'description' => 'nullable|string|max:500'
    ]);
    
    $preorder = Preorder::create([
        'user_id' => auth()->id(),
        'description' => $request->description,
        'status' => 'pending',
    ]);
    
    foreach ($request->selected_items as $item) {
        if (str_starts_with($item, 'product_')) {
            $productId = str_replace('product_', '', $item);
            $preorder->items()->create([
                'item_type' => Products::class,
                'item_id' => $productId,
            ]);
        } else {
            $configId = str_replace('config_', '', $item);
            $preorder->items()->create([
                'item_type' => Configuration::class,
                'item_id' => $configId,
            ]);
        }
    }
    session()->flash('success', 'Заказ отправлен на рассмотрение. Все ваши заказы вы можете посмотреть в личном кабинете.');
    return redirect()->route('favorites.index')->with('success', 'Предзаказ успешно создан!');
}
}
