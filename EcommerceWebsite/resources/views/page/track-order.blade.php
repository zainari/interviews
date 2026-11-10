@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'Track Order | Wasaaz')

@section('content')
<div class="track-page">
    <div class="track-hero">
        <p class="track-pretitle">Order Tracking</p>
        <h1 class="track-title">Track Your Order</h1>
        <p class="track-sub">Enter your order ID and email to check delivery status.</p>
    </div>

    <div class="track-wrap">
        <form method="POST" action="{{ route('track.submit') }}" class="track-form">
            @csrf

            @if(session('error'))
                <div class="track-error">{{ session('error') }}</div>
            @endif

            <div class="track-field">
                <label>Order ID</label>
                <input type="number" name="order_id" value="{{ old('order_id') }}" placeholder="e.g. 12" required>
                @error('order_id')<span class="field-err">{{ $message }}</span>@enderror
            </div>
            <div class="track-field">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email used at checkout" required>
                @error('email')<span class="field-err">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="track-btn">Track Order</button>
        </form>

        @if($order)
        @php
            $steps = ['pending', 'processing', 'shipped', 'delivered'];
            $currentStep = $order->status === 'paid' ? 'processing' : $order->status;
            $currentIndex = array_search($currentStep, $steps);
            if ($currentIndex === false) $currentIndex = 0;
        @endphp
        <div class="track-result">
            <div class="track-result-head">
                <div>
                    <span class="track-order-no">Order #{{ $order->id }}</span>
                    <span class="track-order-date">Placed {{ $order->created_at->format('M d, Y') }}</span>
                </div>
                <span class="track-badge {{ $order->status === 'cancelled' ? 'cancelled' : '' }}">{{ ucfirst($order->status) }}</span>
            </div>

            @if($order->status === 'cancelled')
                <p class="track-cancelled-note">This order has been cancelled. Contact support if you have questions.</p>
            @else
                <div class="track-steps">
                    @foreach($steps as $i => $step)
                        <div class="track-step {{ $i <= $currentIndex ? 'done' : '' }} {{ $i === $currentIndex ? 'current' : '' }}">
                            <div class="track-dot"></div>
                            <span>{{ ucfirst($step) }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="track-items">
                @foreach($order->products as $item)
                    <div class="track-item">
                        <span>{{ $item->name }} × {{ $item->pivot->quantity }}</span>
                        <span>Rs. {{ number_format($item->pivot->price * $item->pivot->quantity) }}</span>
                    </div>
                @endforeach
                <div class="track-item track-item-total">
                    <span>Total ({{ strtoupper($order->payment_method) }})</span>
                    <span>Rs. {{ number_format($order->total) }}</span>
                </div>
            </div>

            <div class="track-address">
                <strong>Delivering to:</strong> {{ $order->address }}, {{ $order->city }}, {{ $order->country }}
            </div>
        </div>
        @endif
    </div>
</div>

<style>
.track-page { padding: 40px 6% 80px; }
.track-hero { text-align: center; padding: 40px 0 48px; }
.track-pretitle { font-size: 12px; letter-spacing: 4px; text-transform: uppercase; color: var(--accent); font-weight: 700; margin-bottom: 12px; }
.track-title { font-family: 'Playfair Display', serif; font-size: clamp(32px, 5vw, 52px); font-weight: 800; margin-bottom: 8px; }
.track-sub { color: var(--secondary); font-size: 15px; }
.track-wrap { max-width: 640px; margin: auto; }
.track-form { background: var(--white); border: 1px solid var(--border); padding: 36px; }
.track-field { margin-bottom: 20px; }
.track-field label { display: block; font-size: 12px; letter-spacing: 1.5px; text-transform: uppercase; color: var(--muted); font-weight: 700; margin-bottom: 8px; }
.track-field input { width: 100%; padding: 14px; background: transparent; border: 1px solid var(--border); color: var(--primary); font-size: 15px; font-family: inherit; }
.track-field input:focus { border-color: var(--accent); outline: none; }
.field-err { color: var(--danger); font-size: 12px; margin-top: 6px; display: block; }
.track-error { background: rgba(196,91,77,.12); border: 1px solid var(--danger); color: var(--danger); padding: 12px 16px; font-size: 13px; margin-bottom: 20px; }
.track-btn { width: 100%; padding: 15px; background: var(--accent); color: #000; border: none; font-weight: 800; font-size: 13px; letter-spacing: 2px; text-transform: uppercase; cursor: pointer; transition: opacity .3s; }
.track-btn:hover { opacity: 0.85; }

.track-result { background: var(--white); border: 1px solid var(--border); padding: 32px; margin-top: 28px; }
.track-result-head { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 28px; flex-wrap: wrap; gap: 10px; }
.track-order-no { font-family: 'Playfair Display', serif; font-size: 24px; font-weight: 800; display: block; }
.track-order-date { font-size: 12px; color: var(--muted); }
.track-badge { background: rgba(201,168,108,.15); color: var(--accent); font-size: 12px; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase; padding: 8px 16px; }
.track-badge.cancelled { background: rgba(196,91,77,.15); color: var(--danger); }
.track-cancelled-note { color: var(--danger); font-size: 14px; }

.track-steps { display: flex; justify-content: space-between; margin-bottom: 32px; position: relative; }
.track-steps::before { content: ''; position: absolute; top: 8px; left: 0; right: 0; height: 2px; background: var(--border); }
.track-step { display: flex; flex-direction: column; align-items: center; gap: 10px; position: relative; z-index: 1; flex: 1; }
.track-dot { width: 18px; height: 18px; border-radius: 50%; background: var(--border); border: 3px solid var(--light); }
.track-step span { font-size: 11px; letter-spacing: 1px; text-transform: uppercase; color: var(--muted); font-weight: 700; }
.track-step.done .track-dot { background: var(--accent); }
.track-step.done span { color: var(--primary); }
.track-step.current span { color: var(--accent); }
.track-step.current .track-dot { box-shadow: 0 0 0 5px rgba(201,168,108,.2); }

.track-items { border-top: 1px solid var(--border); padding-top: 20px; }
.track-item { display: flex; justify-content: space-between; font-size: 14px; padding: 8px 0; color: var(--secondary); }
.track-item-total { border-top: 1px dashed var(--border); margin-top: 10px; padding-top: 14px; color: var(--primary); font-weight: 800; }
.track-address { margin-top: 20px; font-size: 13px; color: var(--muted); line-height: 1.7; }
</style>
@endsection
