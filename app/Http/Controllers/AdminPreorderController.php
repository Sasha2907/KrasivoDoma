<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preorder;
use App\Notifications\PreorderReplied;


class AdminPreorderController extends Controller
{
    public function index(Request $request)
    {
        $query = Preorder::with(['user', 'items.item']);

        // Поиск по email
        if ($request->filled('email')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->email . '%');
            });
        }

        // Фильтр по статусу
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Сортировка по дате
        $sort = $request->get('sort', 'desc'); // 'desc' по умолчанию
        $query->orderBy('created_at', $sort);

        $preorders = $query->paginate(10);

        return view('Admin.preorders.index', compact('preorders'));
    }

    public function approve(Preorder $preorder)
    {
        $preorder->update(['status' => 'approved']);
        return back()->with('success', 'Заявка одобрена.');
    }

    public function reply(Request $request, Preorder $preorder)
    {
        $request->validate([
            'admin_message' => 'required|string|max:1000',
        ]);

        $preorder->update([
            'status' => 'replied',
            'admin_message' => $request->admin_message,
            
        ]);
        $preorder->user->notify(new PreorderReplied($request->admin_message));
        return back()->with('success', 'Ответ отправлен пользователю.');
    }
    public function destroy(Preorder $preorder)
    {
        $preorder->items()->delete();
        $preorder->delete();

        return redirect()->route('admin.preorders.index')->with('success', 'Заявка удалена.');
    }
}
