<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Rating;
use App\Models\Link;
use Illuminate\Http\Request;

Route::prefix('api')->group(function () {
    Route::get('/recent-ratings', function () {
        return Rating::with(['link', 'user'])
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($rating) {
                return [
                    'url' => $rating->link->url,
                    'user_name' => $rating->user->name,
                    'score' => $rating->score,
                    'evidence_count' => $rating->evidence->count(),
                    'show_url' => route('links.show', $rating->link)
                ];
            });
    });
    Route::post('/ratings', function (Request $request) {
        $validated = $request->validate([
            'link_id' => 'required|exists:links,id',
            'score' => 'required|numeric|between:-1,1',
            'comment' => 'nullable|string|max:500'
        ]);

        $rating = Rating::updateOrCreate(
            [
                'link_id' => $validated['link_id'],
                'user_id' => Auth::id()
            ],
            [
                'score' => $validated['score']
            ]
        );

        if ($request->filled('comment')) {
            $rating->evidence()->create([
                'comment' => $validated['comment'],
                'user_id' => Auth::id()
            ]);
        }

        return response()->json([
            'message' => 'Rating submitted successfully',
            'rating' => $rating
        ]);
    })->middleware('auth:sanctum');

    Route::get('/links/{link}', function (Link $link) {
        return [
            'id' => $link->id,
            'url' => $link->url,
            'total_rating' => $link->ratings->sum('score'),
            'positive_ratings' => $link->ratings->where('score', '>', 0)->map(function ($rating) {
                return [
                    'id' => $rating->id,
                    'score' => $rating->score,
                    'evidence_count' => $rating->evidence->count(),
                    'user_name' => $rating->user->name
                ];
            }),
            'negative_ratings' => $link->ratings->where('score', '<', 0)->map(function ($rating) {
                return [
                    'id' => $rating->id,
                    'score' => $rating->score,
                    'evidence_count' => $rating->evidence->count(),
                    'user_name' => $rating->user->name
                ];
            })
        ];
    });

    Route::post('/links', function (Request $request) {
        $validated = $request->validate([
            'url' => 'required|url|unique:links,url'
        ]);

        $link = Link::create([
            'url' => $validated['url'],
            'user_id' => Auth::id()
        ]);

        return response()->json([
            'message' => 'Link created successfully',
            'link' => $link
        ], 201);
    })->middleware('auth:sanctum');
});
