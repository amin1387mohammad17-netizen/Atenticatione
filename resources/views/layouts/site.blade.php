<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'فروشگاه')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #1E1E2F;
            --surface: #262636;
            --elevated: #303040;
            --primary: #DC3545;
            --primary-hover: #E35D6A;
            --text: #FFFFFF;
            --muted: #949494;
            --border: rgba(222, 226, 230, 0.10);
            --border-strong: rgba(222, 226, 230, 0.18);
            --radius-sm: 4px;
            --radius-md: 6px;
            --radius-lg: 12px;
            --duration: 0.15s;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: 'Vazirmatn', sans-serif;
            font-size: 16px;
            line-height: 1.6;
        }

        a { color: inherit; text-decoration: none; }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 32px;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 17px;
            font-weight: 600;
        }
        .brand-mark {
            width: 26px;
            height: 26px;
            border-radius: var(--radius-sm);
            background: var(--primary);
        }

        .nav-links { display: flex; gap: 8px; }
        .nav-links a {
            padding: 8px 14px;
            border-radius: var(--radius-sm);
            font-size: 14px;
            color: var(--muted);
            transition: background var(--duration) ease-in-out, color var(--duration) ease-in-out;
        }
        .nav-links a:hover,
        .nav-links a.is-active {
            background: var(--elevated);
            color: var(--text);
        }

        .container {
            max-width: 1317px;
            margin: 0 auto;
            padding: 32px;
        }

        .page-heading { margin-bottom: 24px; }
        .page-heading h1 { font-size: 22px; font-weight: 600; margin: 0 0 4px; }
        .page-heading p { color: var(--muted); font-size: 14px; margin: 0; }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: var(--primary);
            color: var(--text);
            border: none;
            border-radius: var(--radius-sm);
            padding: 8px 14px;
            font-size: 14px;
            cursor: pointer;
            transition: background var(--duration) ease-in-out;
        }
        .btn:hover { background: var(--primary-hover); }

        .btn-ghost {
            background: transparent;
            border: 1px solid var(--border-strong);
            color: var(--text);
        }
        .btn-ghost:hover { background: var(--elevated); }

        .empty-state {
            text-align: center;
            padding: 64px 16px;
            color: var(--muted);
            font-size: 14px;
            background: var(--surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
        }

        footer {
            text-align: center;
            padding: 24px;
            color: var(--muted);
            font-size: 13px;
        }

        @media (max-width: 575px) {
            .navbar { padding: 12px 16px; }
            .container { padding: 16px; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar">
        <a href="{{ url('/') }}" class="brand">
            <span class="brand-mark"></span>
            فروشگاه
        </a>
        <div class="nav-links">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'is-active' : '' }}">خانه</a>
            <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'is-active' : '' }}">محصولات</a>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer>© {{ date('Y') }} تمام حقوق محفوظ است.</footer>
</body>
</html>
