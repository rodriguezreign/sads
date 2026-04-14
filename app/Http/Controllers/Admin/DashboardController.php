<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_items' => Item::count(),
            'resolved_cases' => Item::where('status', 'approved')->count(),
            'pending_claims' => Item::where('status', 'pending')->count(),
            'total_users' => User::count(),
        ];

        $recent_activity = Item::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_activity'));
    }

    public function reports()
    {
        $pending_items = Item::with('user')
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);

        $approved_items = Item::with('user')
            ->where('status', 'approved')
            ->latest()
            ->take(5)
            ->get();

        $rejected_items = Item::with('user')
            ->where('status', 'rejected')
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'pending' => Item::where('status', 'pending')->count(),
            'approved' => Item::where('status', 'approved')->count(),
            'rejected' => Item::where('status', 'rejected')->count(),
            'total' => Item::count(),
        ];

        return view('admin.reports', compact('pending_items', 'approved_items', 'rejected_items', 'stats'));
    }

    public function verifyItem(Request $request, Item $item)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'admin_notes' => 'nullable|string|max:500',
        ]);

        $item->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'verified_at' => now(),
            'verified_by' => auth()->id(),
        ]);

        $message = $request->status === 'approved' ? 'Item approved successfully!' : 'Item rejected.';
        
        return back()->with('success', $message);
    }

    public function bulkVerify(Request $request)
    {
        $request->validate([
            'item_ids' => 'required|array',
            'item_ids.*' => 'exists:items,id',
            'status' => 'required|in:approved,rejected',
        ]);

        Item::whereIn('id', $request->item_ids)->update([
            'status' => $request->status,
            'verified_at' => now(),
            'verified_by' => auth()->id(),
        ]);

        return back()->with('success', count($request->item_ids) . ' items ' . $request->status . ' successfully!');
    }
}