<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'my_items' => Item::where('user_id', auth()->id())->count(),
            'items_found' => Item::where('user_id', auth()->id())->where('item_type', 'found')->count(),
            'pending_claims' => Item::where('user_id', auth()->id())->where('status', 'pending')->count(),
        ];

        $recent_items = Item::where('user_id', auth()->id())
            ->latest()
            ->take(3)
            ->get();

        return view('user.dashboard', compact('stats', 'recent_items'));
    }

    public function report()
    {
        return view('user.report');
    }

    public function storeReport(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'item_type' => 'required|in:lost,found',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'contact_info' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('items', 'public');
        }

        Item::create([
            'user_id' => auth()->id(),
            'item_name' => $validated['item_name'],
            'item_type' => $validated['item_type'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'date' => $validated['date'],
            'contact_info' => $validated['contact_info'] ?? null,
            'image' => $imagePath,
            'status' => 'pending',
        ]);

        return redirect()->route('myitems')->with('success', 'Item reported successfully! It will be reviewed by an admin shortly.');
    }

    public function browse()
    {
        $items = Item::where('status', 'approved')
            ->with('user')
            ->latest()
            ->paginate(12);

        return view('user.browse', compact('items'));
    }

    public function myitems()
    {
        $items = Item::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        $stats = [
            'total' => Item::where('user_id', auth()->id())->count(),
            'pending' => Item::where('user_id', auth()->id())->where('status', 'pending')->count(),
            'approved' => Item::where('user_id', auth()->id())->where('status', 'approved')->count(),
            'rejected' => Item::where('user_id', auth()->id())->where('status', 'rejected')->count(),
        ];

        return view('user.myitems', compact('items', 'stats'));
    }

    public function profile()
    {
        return view('user.profile', ['user' => auth()->user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = auth()->user();

        if (!\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->update(['password' => $request->password]);

        return back()->with('success', 'Password changed successfully!');
    }
}