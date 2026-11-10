<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\NewsletterSubscriber;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return view('page.home', compact('product'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('page.productpages', compact('product'));
    }

    public function homenew()
    {
        $product = Product::where('is_active', true)->latest()->take(4)->get();
        return view('page.home_new', compact('product'));
    }

    /**
     * Handles the "Shop All" view and applies search query filters
     */
    public function shopall(Request $request)
    {
        $query = Product::where('is_active', true);

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('brand', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        if ($request->filled('categories')) {
            $query->whereIn('category_id', (array) $request->input('categories'));
        }

        if ($request->filled('brands')) {
            $query->whereIn('brand', (array) $request->input('brands'));
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float) $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->input('max_price'));
        }

        match ($request->input('sort')) {
            'price_low' => $query->orderBy('price', 'asc'),
            'price_high' => $query->orderBy('price', 'desc'),
            'name' => $query->orderBy('name', 'asc'),
            default => $query->latest(),
        };

        $product = $query->paginate(9)->withQueryString();
        $categories = Category::withCount('products')->get();
        $brands = Product::where('is_active', true)->whereNotNull('brand')->distinct()->pluck('brand');

        return view('page.shopall', compact('product', 'categories', 'brands'));
    }

    public function shopingcart($id)
    {
        $product = Product::with(['images', 'attributes'])->findOrFail($id);

        $variants = collect();

        if ($product->color_group_id) {
            $variants = Product::where('color_group_id', $product->color_group_id)
                ->where('is_active', 1)
                ->get();
        }

        $relatedProducts = Product::where('id', '!=', $id)->take(6)->get();

        return view('page.shopingcart', compact('product', 'variants', 'relatedProducts'));
    }


    public function contactform(){
        return view('page.contact');
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Your message has been sent. We will get back to you soon.');
    }

    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $subscriber = NewsletterSubscriber::firstOrCreate(['email' => $validated['email']]);

        $message = $subscriber->wasRecentlyCreated
            ? 'You are subscribed to the Wasaaz Club.'
            : 'You are already subscribed.';

        return back()->with('newsletter_success', $message);
    }

    public function trackForm()
    {
        return view('page.track-order', ['order' => null]);
    }

    public function trackOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'email' => 'required|email',
        ]);

        $order = Order::with('products')
            ->where('id', $request->order_id)
            ->where('email', $request->email)
            ->first();

        if (!$order) {
            return back()->with('error', 'No order found with that ID and email combination.')->withInput();
        }

        return view('page.track-order', compact('order'));
    }

    public function staticPage($slug)
    {
        $pages = [
            'faq' => [
                'title' => 'Frequently Asked Questions',
                'pretitle' => 'Help Center',
                'subtitle' => 'Everything you need to know about ordering from Wasaaz.',
                'items' => [
                    ['q' => 'How long does delivery take?', 'a' => 'Orders are dispatched within 24-48 hours and delivered within 3-5 working days across Pakistan.'],
                    ['q' => 'What is your return policy?', 'a' => 'We offer a 7-day easy exchange policy. Items must be unworn, unwashed, and with original tags attached.'],
                    ['q' => 'How do I track my order?', 'a' => 'Use the Track Order page with your order ID and email address, or contact our support team.'],
                    ['q' => 'What payment methods do you accept?', 'a' => 'We accept Cash on Delivery (COD) and secure card payments via PayFast/Stripe.'],
                    ['q' => 'Are Wasaaz products true to size?', 'a' => 'Yes — check the size guide on each product page. If between sizes, we recommend sizing up for a relaxed fit.'],
                    ['q' => 'Do you ship internationally?', 'a' => 'Currently we ship within Pakistan only. International shipping is coming soon.'],
                ],
            ],
            'privacy-policy' => [
                'title' => 'Privacy Policy',
                'pretitle' => 'Legal',
                'subtitle' => 'How we collect, use, and protect your information.',
                'items' => [
                    ['q' => 'Information We Collect', 'a' => 'We collect your name, email, phone, and delivery address to process orders. Payment details are handled securely by our payment partners and never stored on our servers.'],
                    ['q' => 'How We Use Your Data', 'a' => 'Your information is used to fulfil orders, provide customer support, and send updates you have subscribed to. We never sell your data to third parties.'],
                    ['q' => 'Cookies', 'a' => 'We use cookies to keep your cart and preferences saved. You can disable cookies in your browser, though some features may not work.'],
                    ['q' => 'Data Security', 'a' => 'All data is transmitted over encrypted connections and stored securely. Access is limited to authorized team members only.'],
                    ['q' => 'Your Rights', 'a' => 'You may request a copy or deletion of your personal data at any time by contacting support@wasaaz.com.'],
                ],
            ],
            'returns' => [
                'title' => 'Returns & Exchanges',
                'pretitle' => 'Easy Returns',
                'subtitle' => 'Not satisfied? Here is how our 7-day exchange policy works.',
                'items' => [
                    ['q' => 'Exchange Window', 'a' => 'You have 7 days from delivery to request an exchange for a different size or product of equal value.'],
                    ['q' => 'Condition', 'a' => 'Items must be unworn, unwashed, and returned with all original tags and packaging intact.'],
                    ['q' => 'How to Start a Return', 'a' => 'Contact support@wasaaz.com with your order ID, or visit the Contact page. We will arrange a courier pickup.'],
                    ['q' => 'Refund Timeline', 'a' => 'Approved refunds for COD orders are processed via bank transfer within 5-7 working days. Card payments are refunded to the original card.'],
                    ['q' => 'Non-Returnable Items', 'a' => 'For hygiene reasons, innerwear and final-sale items cannot be returned or exchanged.'],
                ],
            ],
            'shipping' => [
                'title' => 'Shipping Information',
                'pretitle' => 'Delivery',
                'subtitle' => 'Fast, tracked delivery across Pakistan.',
                'items' => [
                    ['q' => 'Delivery Time', 'a' => 'Orders are dispatched within 24-48 hours. Delivery takes 3-5 working days for major cities and 5-7 days for other areas.'],
                    ['q' => 'Shipping Charges', 'a' => 'FREE shipping on all orders over Rs. 5,000. A flat rate applies to smaller orders, calculated at checkout.'],
                    ['q' => 'Order Tracking', 'a' => 'Every order comes with a tracking ID. Use the Track Order page to check your delivery status anytime.'],
                    ['q' => 'Delivery Areas', 'a' => 'We deliver nationwide across Pakistan through trusted courier partners.'],
                    ['q' => 'Delays', 'a' => 'During sales or holidays, delivery may take 1-2 extra days. We will keep you updated via email and SMS.'],
                ],
            ],
        ];

        abort_unless(isset($pages[$slug]), 404);

        return view('page.staticpage', ['page' => $pages[$slug], 'slug' => $slug]);
    }
}