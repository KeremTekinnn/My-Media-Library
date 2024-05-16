<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\User;
use App\Models\Activity;
use App\Models\Setting;
class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = auth()->user()->role;

        switch ($role) {
            case 'admin':
                return $this->adminDashboard($request);
            case 'user':
                return $this->userDashboard($request);
            default:
                abort(403, 'Unauthorized action.');
        }
    }

    private function adminDashboard(Request $request)
    {
        $userCount = User::count();
        $photoCount = Photo::count();
        $activities = Activity::with('user')->orderBy('created_at', 'desc')->paginate(5);
        $photosToday = Photo::whereDate('created_at', today())->count();
        $maxStorage = Setting::first()->max_storage;

        return view('admin.dashboard', compact('userCount', 'photoCount', 'photosToday', 'activities', 'maxStorage'));
    }

    private function userDashboard(Request $request)
    {
        $search = $request->query('search');
        $photos = Photo::with('user')
            ->where('user_id', auth()->id())
            ->where(function($query) use ($search) {
                $query->where('file_path', 'LIKE', "%{$search}%")
                      ->orWhere('description', 'LIKE', "%{$search}%");
            })
            ->paginate(12);

        return view('user.dashboard', compact('photos'));
    }

    public function createPost(Request $request)
    {

        $maxStorage = Setting::first()->max_storage;

        $request->validate([
            'photo' => 'required|mimes:jpeg,png,jpg,gif,svg|max:' . $maxStorage,
            'description' => 'required|string|max:255',
        ]);

        $photo = $request->file('photo');
        $photoName = time() . '.' . $photo->getClientOriginalExtension();
        $photoPath = 'photos/' . $photoName;

        $photo->move(public_path('photos'), $photoName);

        Photo::create([
            'user_id' => auth()->id(),
            'file_path' => $photoPath,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Photo posted successfully.');
    }

    public function destroy(Photo $photo)
    {
        // Delete the photo
        $photo->delete();

        return back()->with('success', 'Photo deleted successfully.');
    }

}
