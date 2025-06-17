<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\FilterRequest;
use App\Http\Requests\StoreRequest;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Review::query();

        if ($request->date_filter === 'week') {
            $query->where('created_at', '>=', now()->subWeek());
        } elseif ($request->date_filter === 'month') {
            $query->where('created_at', '>=', now()->subMonth());
        } elseif ($request->date_filter === 'year') {
            $query->where('created_at', '>=', now()->subYear());
        }

        $reviews = $query->latest()->get();
        $users = User::whereIn('id', $reviews->pluck('user_id'))->get();
        return view('Admin.Reviews.index',compact('reviews','users'));
    }

    public function create()
    {
        $review = Review::all();
        return view('Reviews.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);
        $data = [
            'content' =>$request->input('content'),
            'user_id' => Auth::id(),
        ];
        Review::create($data);
        return redirect()->route('review.index');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->route('admin.review.index');
    }
}
