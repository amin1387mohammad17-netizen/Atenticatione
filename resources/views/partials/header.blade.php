{{-- Announcement bar --}}
    <div class="announce-bar">
        ارسال رایگان برای خریدهای بالای <strong>۵۰۰ هزار تومان</strong>
    </div>

    {{-- =========================================
         Header
    ========================================= --}}
    <header class="site-header">
        <div class="container header-row">

            <div class="header-icons">
                @auth
                    <span class="icon-link" title="{{ auth()->user()->name }}">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </span>
                @else
                    <a href="{{ route('login') }}" class="icon-link" title="ورود">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </a>
                @endauth

                <span class="icon-link" title="علاقه‌مندی‌ها">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                    <span class="icon-badge">0</span>
                </span>
            </div>

            <a href="{{ route('home') }}" class="brand-logo">فروشگاه من</a>

            <div class="header-icons">
                <span class="icon-link" title="جستجو">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                </span>
                <span class="icon-link" title="سبد خرید">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"/>
                        <circle cx="20" cy="21" r="1"/>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                    </svg>
                    <span class="icon-badge">0</span>
                </span>
            </div>

        </div>

        <nav class="main-nav">
            <div class="container nav-row">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'is-active' : '' }}">خانه</a>
                <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'is-active' : '' }}">فروشگاه</a>
                <a href="#">درباره ما</a>
                <a href="#">تماس با ما</a>

                @auth
                    @if(auth()->user()->roles->contains('name', 'super-admin'))
                        <a href="{{ route('admin.products.index') }}" class="nav-admin-link">پنل مدیریت</a>
                    @elseif(auth()->user()->roles->contains('name', 'admin'))
                        <a href="{{ route('admin.products.index') }}" class="nav-admin-link">پنل ادمین</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="nav-admin-link">ورود / ثبت‌نام</a>
                @endauth
            </div>
        </nav>
    </header>