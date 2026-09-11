@extends('layoutecommercepage.layoutnewfrontend')

@section('title', 'Page Not Found | Wasaaz')

@section('content')

<style>
    .error-page {
        min-height: calc(100vh - 180px);
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--light);
        text-align: center;
        padding: 80px 20px;
    }
    .error-content {
        max-width: 560px;
    }
    .error-content .number {
        font-family: 'Playfair Display', serif;
        font-size: clamp(80px, 14vw, 140px);
        font-weight: 600;
        color: var(--primary);
        line-height: 1;
        margin-bottom: 10px;
        letter-spacing: -2px;
    }
    .error-content h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(24px, 4vw, 34px);
        color: var(--primary);
        margin-bottom: 16px;
        font-weight: 600;
    }
    .error-content p {
        color: var(--secondary);
        font-size: 15px;
        line-height: 1.8;
        margin-bottom: 36px;
    }
    .error-actions {
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
    }
    .error-actions a {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 15px 30px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        transition: var(--transition-smooth);
    }
    .error-actions .primary {
        background: var(--primary);
        color: var(--white);
    }
    .error-actions .primary:hover {
        background: var(--accent);
    }
    .error-actions .outline {
        background: transparent;
        color: var(--primary);
        border: 1px solid var(--border);
    }
    .error-actions .outline:hover {
        background: var(--primary);
        color: var(--white);
        border-color: var(--primary);
    }

    @media (max-width: 480px) {
        .error-page { padding: 60px 15px; }
        .error-actions a { width: 100%; justify-content: center; }
    }
</style>

<section class="error-page">
    <div class="error-content">
        <p class="number">404</p>
        <h2>Page Not Found</h2>
        <p>Sorry, the page you are looking for does not exist or may have been moved. Let us help you get back on track.</p>
        <div class="error-actions">
            <a href="{{ route('home.new') }}" class="primary"><i class="fas fa-home"></i> Back to Home</a>
            <a href="{{ route('shop.all') }}" class="outline"><i class="fas fa-shopping-bag"></i> Continue Shopping</a>
        </div>
    </div>
</section>

@endsection
