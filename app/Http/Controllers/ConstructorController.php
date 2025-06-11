<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Fabric;
use App\Models\SewingType;
use App\Models\Configuration;
use Illuminate\Support\Facades\Auth;

class ConstructorController extends Controller
{
    // public function showForm()
    // {
    //     // Здесь можно передавать список тканей и пошивов в представление
    //     return view('constructor.form', [
    //         'curtainFabrics' => Fabric::where('type', 'curtain')->get(),
    //     'tulleFabrics' => Fabric::where('type', 'tulle')->get(),
    //     'sewingTypes' => SewingType::all(),
    //     'quiltingMethods' => [
    //         'Стежка квадратами',
    //         'Узорная стежка',
    //         'Прямая строчка',
    //     ], // методы простежки для покрывал
    //     ]);
    // }
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'product_type' => 'required|in:curtains,tulle,roman_curtains,bedspread',
    //         'width' => 'required|numeric|min:10',
    //         'height' => 'required|numeric|min:10',
    //         'fabric' => 'required',
    //         // Условная валидация по типу продукта
    //         'sewing_type' => 'required_if:product_type,curtains',
    //         'quilting_method' => 'required_if:product_type,bedspread',
    //         'config_name' => 'required|string|max:255',
    //     ]);

    //     // Здесь логика сохранения или обработки данных
    //     $data = [
    //         'user_id' => auth()->id(),
    //         'name' => $request->config_name,
    //         'product_type' => $request->product_type,
    //         'width' => $request->width,
    //         'height' => $request->height,
    //         'fabric_id' => $request->fabric,
    //     ];
    //     // Шторы: швейный тип
    //     if ($request->product_type === 'curtains') {
    //         $data['sewing_type_id'] = $request->sewing_type;
    //     }
    
    //     // Покрывало: метод простежки
    //     if ($request->product_type === 'blanket') {
    //         $data['quilting_method'] = $request->quilting_method;
    //     }
    //     Configuration::create($data);
    //     return redirect('/constructor')->with('success', 'Конфигурация успешно сохранена!');
    // }

    public function create()
    {
        $curtainFabrics = Fabric::where('type', 'curtain')->get();
        $tulleFabrics = Fabric::where('type', 'tulle')->get();

        $sewingTypes = SewingType::all();
        $quiltingMethods = ['ромбы', 'линии', 'зигзаг'];

        return view('constructor.form', [
            'curtainFabrics' => $curtainFabrics,
            'tulleFabrics' => $tulleFabrics,
            'sewingTypes' => $sewingTypes,
            'quiltingMethods' => $quiltingMethods
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'product_type' => 'required|in:curtains,tulle,roman_curtains',
            'width' => 'required|integer|min:10',
            'height' => 'required|integer|min:10',
            'fabric_id' => 'required|exists:fabrics,id',
            'sewing_type_id' => 'required|exists:sewing_types,id',
            'quilting_method' => 'nullable|string'
        ]);
        $validated['user_id'] = Auth::id();

        Configuration::create($validated);

        return redirect()->route('constructor.create')->with('success', 'Конфигурация сохранена!');
    }
    public function destroy($id)
{
    $deleted = Configuration::where('id', $id)
              ->where('user_id', auth()->id())
              ->delete();
    
    return response()->json([
        'success' => $deleted > 0,
        'message' => $deleted > 0 ? 'Удалено успешно' : 'Не удалось удалить'
    ]);
}
}
