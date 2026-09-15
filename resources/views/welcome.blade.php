<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>فروشگاه من | بهترین محصولات با بهترین کیفیت</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>

    {{-- =========================================
         Navbar
    ========================================= --}}

<nav class="navbar">
    <div class="container navbar-content">

        <a href="{{ route('home') }}" class="logo">
            <div class="logo-icon">
                <svg width="22" height="22" viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2.5"
                     stroke-linecap="round"
                     stroke-linejoin="round">

                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <path d="M16 10a4 4 0 0 1-8 0"/>

                </svg>
            </div>

            <span class="logo-text">
                فروشگاه من
            </span>
        </a>


        <ul class="nav-links">

            <li>
                <a href="{{ route('home') }}">
                    خانه
                </a>
            </li>

            <li>
                <a href="{{ route('products.index') }}">
                    محصولات
                </a>
            </li>


            @auth

                {{-- اگر کاربر Super Admin باشد --}}
                @if(auth()->user()->roles->contains('name', 'super-admin'))

                    <li>
                        <a href="{{ route('admin.products.index') }}" class="btn-admin">
                            پنل مدیریت
                        </a>
                    </li>


                {{-- اگر کاربر Admin باشد --}}
                @elseif(auth()->user()->roles->contains('name', 'admin'))

                    <li>
                        <a href="{{ route('admin.products.index') }}" class="btn-admin">
                            پنل ادمین
                        </a>
                    </li>

                @endif


            @else

                <li>
                    <a href="{{ route('login') }}" class="btn-login">
                        ورود / ثبت‌نام
                    </a>
                </li>

            @endauth

        </ul>

    </div>
</nav>



    <main class="container">

        {{-- =========================================
             Hero Section
        ========================================= --}}
        <section class="hero">
            <div class="hero-content">

                <div class="hero-badge">
                    <span class="dot"></span>
                    <span>فروش ویژه فعال است</span>
                </div>

                <h1>
                    به فروشگاه ما خوش آمدید
                </h1>

                <p>
                    بهترین محصولات را با بالاترین کیفیت و مناسب‌ترین قیمت از ما بخواهید. تجربه‌ای متفاوت از خرید آنلاین.
                </p>

                <div class="hero-buttons">
                    <a href="#products" class="btn btn-primary">
                        مشاهده محصولات
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="19" y1="12" x2="5" y2="12"/>
                            <polyline points="12 19 5 12 12 5"/>
                        </svg>
                    </a>
                    <a href="#" class="btn btn-outline">
                        درباره ما
                    </a>
                </div>

            </div>
        </section>


        {{-- =========================================
             Features Bar
        ========================================= --}}
        <section class="features">

            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="3" width="15" height="13"/>
                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                        <circle cx="5.5" cy="18.5" r="2.5"/>
                        <circle cx="18.5" cy="18.5" r="2.5"/>
                    </svg>
                </div>
                <h4>ارسال سریع</h4>
                <p>تحویل در کمتر از ۲۴ ساعت</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                
                </div>
                <h4>پرداخت امن</h4>
                <p>تضمین امنیت تراکنش‌ها</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                </div>
                <h4>پشتیبانی ۲۴/۷</h4>
                <p>همیشه در کنار شما هستیم</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                        <polyline points="17 6 23 6 23 12"/>
                    </svg>
                </div>
                <h4>کیفیت برتر</h4>
                <p>محصولات اصل و با گارانتی</p>
            </div>

        </section>


        {{-- =========================================
             Products Section
        ========================================= --}}
        <section class="products-section" id="products">

            <div class="section-header">

                <div class="section-title">
                    <h2>محصولات ما</h2>
                    <p>جدیدترین و پرفروش‌ترین محصولات فروشگاه</p>
                    <div class="accent-line"></div>
                </div>

                <a href="{{ route('products.index') }}" class="view-all">
                    مشاهده همه
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"/>
                        <polyline points="12 19 5 12 12 5"/>
                    </svg>
                </a>

            </div>


            <div class="products-grid">

                @forelse ($products as $product)

                    <a href="{{ route('products.show', $product) }}" class="product-card">

                        {{-- Product Image --}}
                        <div class="product-image-wrapper">

                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                            @else
                                <div class="no-image">
                                    <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                        <circle cx="8.5" cy="8.5" r="1.5"/>
                                        <polyline points="21 15 16 10 5 21"/>
                                    </svg>
                                    <span>بدون تصویر</span>
                                </div>
                            @endif

                            {{-- Badges --}}
                            <div class="product-badges">
                                @if ($loop->first)
                                    <span class="badge badge-new">جدید</span>
                                @endif
                            </div>

                            {{-- Quick Actions --}}
                            <div class="quick-actions">
                                <span class="action-btn wishlist" title="افزودن به علاقه‌مندی‌ها">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                    </svg>
                                </span>
                                <span class="action-btn" title="مشاهده سریع">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </span>
                            </div>

                        </div>


                        {{-- Product Information --}}
                        <div class="product-info">

                            <span class="product-category">فروشگاه</span>

                            <h3 class="product-name">
                                {{ $product->name }}
                            </h3>

                            {{-- Rating --}}
                            <div class="product-rating">
                                <div class="stars">
                                    @for ($i = 0; $i < 5; $i++)
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="rating-count">(۴.۸)</span>
                            </div>

                            <p class="product-description">
                                {{ $product->description ?? 'توضیحی برای این محصول ثبت نشده است.' }}
                            </p>


                            <div class="product-footer">

                                <div class="price-wrapper">
                                    <span class="price">
                                        {{ number_format($product->price) }}
                                        <small>تومان</small>
                                    </span>
                                </div>

                                <span class="add-to-cart" title="مشاهده محصول">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="9" cy="21" r="1"/>
                                        <circle cx="20" cy="21" r="1"/>
                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                                    </svg>
                                </span>

                            </div>

                        </div>

                    </a>

                @empty

                    <div class="empty">
                        <div class="empty-icon">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="9" cy="21" r="1"/>
                                <circle cx="20" cy="21" r="1"/>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                            </svg>
                        </div>
                        <h3>هنوز محصولی ثبت نشده است</h3>
                        <p>برای شروع، از پنل مدیریت اولین محصول خود را اضافه کنید.</p>
                        @auth
                            <a href="{{ route('admin.products.index') }}" class="btn">
                                رفتن به پنل مدیریت
                            </a>
                        @endauth
                    </div>

                @endforelse

            </div>

        </section>


        {{-- =========================================
             Newsletter
        ========================================= --}}
        <section class="newsletter">
            <div class="newsletter-content">
                <h3>از تخفیف‌ها باخبر شوید</h3>
                <p>ایمیل خود را وارد کنید تا از جدیدترین پیشنهادات و تخفیف‌های ویژه مطلع شوید.</p>
                <form class="newsletter-form" onsubmit="event.preventDefault();">
                    <input type="email" placeholder="ایمیل خود را وارد کنید..." required>
                    <button type="submit">عضویت</button>
                </form>
            </div>
        </section>

    </main>


    {{-- =========================================
         Footer
    ========================================= --}}
    <footer class="footer">
        <div class="container">

            <div class="footer-grid">

                <div class="footer-col">
                    <h4>درباره فروشگاه</h4>
                    <p>
                        فروشگاه ما با هدف ارائه بهترین محصولات با بالاترین کیفیت و مناسب‌ترین قیمت، تجربه‌ای لذت‌بخش از خرید آنلاین را برای شما فراهم می‌کند.
                    </p>
                    <div class="social-links">
                        <a href="#" title="اینستاگرام">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                            </svg>
                        </a>
                        <a href="#" title="تلگرام">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M21.5 4.5l-3 15c-.2.9-.7 1.1-1.5.7l-4.5-3.3-2.2 2.1c-.2.2-.4.4-.9.4l.3-4.8 8.7-7.9c.4-.3-.1-.5-.6-.2l-10.7 6.7-4.6-1.4c-1-.3-1-1 .2-1.5l18-6.9c.8-.3 1.5.2 1.3 1.4z"/>
                            </svg>
                        </a>
                        <a href="#" title="توییتر">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>دسترسی سریع</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">صفحه اصلی</a></li>
                        <li><a href="{{ route('products.index') }}">محصولات</a></li>
                        <li><a href="#">درباره ما</a></li>
                        <li><a href="#">تماس با ما</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>خدمات مشتریان</h4>
                    <ul>
                        <li><a href="#">سوالات متداول</a></li>
                        <li><a href="#">شرایط استفاده</a></li>
                        <li><a href="#">حریم خصوصی</a></li>
                        <li><a href="#">گارانتی محصولات</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>تماس با ما</h4>
                    <ul>
                        <li>📞 ۰۲۱-۱۲۳۴۵۶۷۸</li>
                        <li>📧 info@myshop.com</li>
                        <li>📍 تهران، خیابان ولیعصر</li>
                        <li>🕐 شنبه تا پنج‌شنبه ۹-۱۸</li>
                    </ul>
                </div>

            </div>

            <div class="footer-bottom">
                © ۱۴۰۵ تمامی حقوق برای <strong>فروشگاه من</strong> محفوظ است.
            </div>

        </div>
    </footer>

    <script>
        // افکت خم‌شدن سه‌بعدی کارت محصولات با حرکت موس
        if (window.matchMedia('(hover: hover)').matches) {
            document.querySelectorAll('.product-card').forEach(function (card) {
                card.addEventListener('mousemove', function (e) {
                    var rect = card.getBoundingClientRect();
                    var x = e.clientX - rect.left;
                    var y = e.clientY - rect.top;
                    var rotateX = ((y / rect.height) - 0.5) * -12;
                    var rotateY = ((x / rect.width) - 0.5) * 12;
                    card.style.setProperty('--rx', rotateX.toFixed(2) + 'deg');
                    card.style.setProperty('--ry', rotateY.toFixed(2) + 'deg');
                });
                card.addEventListener('mouseleave', function () {
                    card.style.setProperty('--rx', '0deg');
                    card.style.setProperty('--ry', '0deg');
                });
            });
        }
    </script>

</body>

</html>