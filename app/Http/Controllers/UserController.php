<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\FilterRequest;
use App\Http\Requests\StoreRequest;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
    
        $preorders = $user->preorders()
            ->with(['items' => function($query) {
                
            }])
            ->latest()
            ->paginate(5); // Пагинация по 5 заказов на странице
            
        return view('user.dashboard', compact('user', 'preorders'));
    }

    public function edit()
    {
        return view('user.profile', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:dns|unique:users,email,' . $user->id,
        ]);
    
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();
    
        return redirect()->route('dashboard')->with('status', 'Профиль обновлён!');
    }
}
