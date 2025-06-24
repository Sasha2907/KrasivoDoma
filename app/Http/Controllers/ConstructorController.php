<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Fabric;
use App\Models\SewingType;
use App\Models\Configuration;
use Illuminate\Support\Facades\Auth;

class ConstructorController extends Controller
{
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
            // 'sewing_type_id' => 'required|exists:sewing_types,id',
            'quilting_method' => 'nullable|string'
        ]);
        if ($request->product_type === 'roman_curtains') {
            $validated['sewing_type_id'] = 1;
        } else {
            // Выполняем дополнительную проверку sewing_type_id
            $request->validate([
                'sewing_type_id' => 'required|exists:sewing_types,id'
            ]);
            $validated['sewing_type_id'] = $request->input('sewing_type_id');
        }
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
