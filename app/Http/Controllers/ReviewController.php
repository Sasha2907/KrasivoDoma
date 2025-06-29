<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\FilterRequest;
use App\Http\Requests\StoreRequest;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
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
        // $reviews = Review::all();
        // $users=User::all();
        // return view('reviews.index',compact('reviews','users'));
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

        return view('Reviews.index', compact('reviews', 'users'));
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
        return redirect()->route('review.index');
    }
}
