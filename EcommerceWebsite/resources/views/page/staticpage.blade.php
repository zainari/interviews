@extends('layoutecommercepage.layoutnewfrontend')

@section('title', $page['title'] . ' | Wasaaz')

@section('content')
<div class="static-page">
    <div class="static-hero">
        <p class="static-pretitle">{{ $page['pretitle'] }}</p>
        <h1 class="static-title">{{ $page['title'] }}</h1>
        <p class="static-sub">{{ $page['subtitle'] }}</p>
    </div>

    <div class="static-wrap">
        @foreach($page['items'] as $item)
            <details class="static-item" {{ $loop->first ? 'open' : '' }}>
                <summary>
                    <span>{{ $item['q'] }}</span>
                    <i class="fas fa-plus"></i>
                </summary>
                <div class="static-item-body">{{ $item['a'] }}</div>
            </details>
        @endforeach

        <div class="static-help">
            <p>Still have questions?</p>
            <a href="{{ route('contact.form') }}" class="static-help-link">Contact Us</a>
            <a href="{{ route('track.form') }}" class="static-help-link">Track Order</a>
        </div>
    </div>
</div>

<style>
.static-page { padding: 40px 6% 80px; }
.static-hero { text-align: center; padding: 40px 0 48px; }
.static-pretitle { font-size: 12px; letter-spacing: 4px; text-transform: uppercase; color: var(--accent); font-weight: 700; margin-bottom: 12px; }
.static-title { font-family: 'Playfair Display', serif; font-size: clamp(32px, 5vw, 52px); font-weight: 800; margin-bottom: 8px; }
.static-sub { color: var(--secondary); font-size: 15px; max-width: 520px; margin: auto; }
.static-wrap { max-width: 760px; margin: auto; }
.static-item { background: var(--white); border: 1px solid var(--border); margin-bottom: 12px; }
.static-item summary { display: flex; justify-content: space-between; align-items: center; padding: 22px 26px; cursor: pointer; font-size: 16px; font-weight: 700; list-style: none; transition: color .3s; }
.static-item summary::-webkit-details-marker { display: none; }
.static-item summary i { color: var(--accent); font-size: 14px; transition: transform .3s; }
.static-item[open] summary { color: var(--accent); }
.static-item[open] summary i { transform: rotate(45deg); }
.static-item-body { padding: 0 26px 22px; color: var(--secondary); font-size: 15px; line-height: 1.8; }
.static-help { text-align: center; margin-top: 48px; }
.static-help p { color: var(--muted); font-size: 14px; margin-bottom: 16px; }
.static-help-link { display: inline-block; margin: 0 6px; padding: 12px 28px; border: 1px solid var(--accent); color: var(--accent); font-size: 12px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; text-decoration: none; transition: all .3s; }
.static-help-link:hover { background: var(--accent); color: #000; }
</style>
@endsection
