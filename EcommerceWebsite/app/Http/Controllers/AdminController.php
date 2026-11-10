<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Coupon;
use App\Models\NewsletterSubscriber;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalRevenue = Order::whereIn('status', ['paid', 'shipped', 'delivered', 'completed'])->sum('total');
        $totalOrders = Order::count();
        $totalCustomers = User::count();
        $totalProducts = Product::where('is_active', true)->count();
        $lowStock = Product::where('stock', '<=', 5)->count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();

        $recentOrders = Order::orderBy('created_at', 'desc')->take(6)->get();

        // Last 7 days revenue for chart
        $salesData = Order::whereIn('status', ['paid', 'shipped', 'delivered', 'completed', 'pending'])
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total'))
            ->groupBy('date')
            ->pluck('total', 'date');

        $chartLabels = [];
        $chartValues = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $chartLabels[] = $date->format('D');
            $chartValues[] = (float) ($salesData[$date->format('Y-m-d')] ?? 0);
        }

        // Top categories by product count
        $categoryData = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.is_active', true)
            ->select('categories.name', DB::raw('COUNT(*) as total'))
            ->groupBy('categories.name')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRevenue', 'totalOrders', 'totalCustomers', 'totalProducts',
            'lowStock', 'pendingOrders', 'unreadMessages', 'recentOrders',
            'chartLabels', 'chartValues', 'categoryData'
        ));
    }

    // --- Contact Messages Inbox ---
    public function messages()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }

    public function markMessageRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => !$message->is_read]);

        return back()->with('success', $message->is_read ? 'Message marked as read.' : 'Message marked as unread.');
    }

    public function deleteMessage($id)
    {
        ContactMessage::findOrFail($id)->delete();
        return back()->with('success', 'Message deleted.');
    }

    // --- Customers ---
    public function customers()
    {
        $customers = User::withCount('orders')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.customers.index', compact('customers'));
    }

    // --- Newsletter Subscribers ---
    public function subscribers()
    {
        $subscribers = NewsletterSubscriber::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function deleteSubscriber($id)
    {
        NewsletterSubscriber::findOrFail($id)->delete();
        return back()->with('success', 'Subscriber removed.');
    }

    // --- Coupons ---
    public function coupons()
    {
        $coupons = Coupon::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function storeCoupon(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code',
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:1',
            'min_order' => 'nullable|numeric|min:0',
        ]);

        $validated['code'] = strtoupper(trim($validated['code']));
        $validated['min_order'] = $validated['min_order'] ?? 0;

        Coupon::create($validated);

        return back()->with('success', 'Coupon created successfully.');
    }

    public function toggleCoupon($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update(['is_active' => !$coupon->is_active]);

        return back()->with('success', 'Coupon ' . ($coupon->is_active ? 'activated' : 'deactivated') . '.');
    }

    public function deleteCoupon($id)
    {
        Coupon::findOrFail($id)->delete();
        return back()->with('success', 'Coupon deleted.');
    }
}
