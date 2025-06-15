<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fabric;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class FabricController extends Controller
{
    public function create()
    {
        return view('Admin.fabrics.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:curtain,tulle',
            'image' => 'required|image|max:2048',
            'overlay' => 'required|image|max:2048',
            'price' => 'required|numeric|min:0',
        ]);
    
        // Сохраняем основное изображение в storage/app/public/fabrics
        $path = $request->file('image')->store('fabrics', 'public');
    
        // Сохраняем overlay в public/images/constructor/fabrics
        $overlayFile = $request->file('overlay');
        $overlayFilename = Str::random(20) . '.' . $overlayFile->getClientOriginalExtension();
        $overlayFile->move(public_path('images/constructor/fabrics'), $overlayFilename);
        $overlayPath = 'images/constructor/fabrics/' . $overlayFilename;
    
        // Сохраняем запись в БД
        Fabric::create([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'image' => 'storage/' . $path, // Это ок — хранится через диск storage/public
            'overlay' => $overlayPath,     // Без 'storage/', т.к. это в public напрямую
            'price' => $validated['price'],
        ]);
    
        return redirect()->route('fabrics.create')->with('success', 'Ткань добавлена!');
    }
    public function index()
    {
        $fabrics = Fabric::all();
        return view('Admin.fabrics.index', compact('fabrics'));
    }

    public function edit(Fabric $fabric)
    {
        return view('Admin.fabrics.edit', compact('fabric'));
    }

    public function update(Request $request, Fabric $fabric)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:curtain,tulle',
            'image' => 'nullable|image|max:2048',
            'overlay' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('fabrics', 'public');
            $fabric->image = 'storage/' . $path;
        }
        if ($request->hasFile('overlay')) {
            $overlayFile = $request->file('overlay');
            $overlayFilename = Str::random(20) . '.' . $overlayFile->getClientOriginalExtension();
            $overlayFile->move(public_path('images/constructor/fabrics'), $overlayFilename);
            $overlayPath = 'images/constructor/fabrics/' . $overlayFilename;
            $fabric->overlay = $overlayPath;
        }

        $fabric->name = $validated['name'];
        $fabric->type = $validated['type'];
        $fabric->save();

        return redirect()->route('fabrics.index')->with('success', 'Ткань обновлена!');
    }

    public function destroy(Fabric $fabric)
    {
        $fabric->delete();
        return redirect()->route('fabrics.index')->with('success', 'Ткань удалена!');
    }
}
