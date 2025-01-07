<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LikedMusic;
use App\Models\Music;

class LikedMusicController extends Controller
{
    public function like(Request $request, $musicId)
    {
        $user = auth()->user();

        if (!$user->likedMusicItems->contains($musicId)) {
            LikedMusic::create([
                'user_id' => $user->id,
                'music_id' => $musicId,
            ]);
        }

        return back()->with('success', 'Music liked successfully!');
    }

    public function unlike(Request $request, $musicId)
    {
        $user = auth()->user();

        $likedMusic = LikedMusic::where('user_id', $user->id)
            ->where('music_id', $musicId)
            ->first();

        if ($likedMusic) {
            $likedMusic->delete();
        }

        return back()->with('success', 'Music unliked successfully!');
    }
    /**
     * Get all liked musics for the authenticated user.
     */
    public function index()
    {
        $musics = Music::whereHas('likedMusics', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();
        // Calculate the sum of a specific property, for example, 'duration' (assuming it exists in the `music` table)
        $sum = $musics->sum(function ($likedMusic) {
            return 1; // Replace 'duration' with the property you want to sum
        });
        return view('user.liked', compact('musics', 'sum'));
    }
}
