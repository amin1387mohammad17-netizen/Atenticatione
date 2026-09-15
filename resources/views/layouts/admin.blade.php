<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'پنل مدیریت') — پنل مدیریت</title>
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
            --space-1: 4px;
            --space-2: 8px;
            --space-3: 12px;
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

        button, input {
            font-family: inherit;
            font-size: inherit;
        }

        /* ---- shell ---- */
        .shell {
            display: flex;
            min-height: 100vh;
        }

        /* ---- sidebar ---- */
        .sidebar {
            width: 264px;
            flex-shrink: 0;
            background: var(--surface);
            border-inline-start: 1px solid var(--border);
            padding: var(--space-3) var(--space-2);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .brand {
            padding: var(--space-2) var(--space-2) var(--space-3);
            font-size: 17px;
            font-weight: 600;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .brand-mark {
            width: 26px;
            height: 26px;
            border-radius: var(--radius-sm);
            background: var(--primary);
            flex-shrink: 0;
        }

        .nav-group { display: flex; flex-direction: column; gap: var(--space-2); margin-bottom: var(--space-1); }

        .nav-group-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
            padding: 0 var(--space-1);
        }

        .nav-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-2);
            padding: 10px var(--space-2);
            border-radius: var(--radius-md);
            background: var(--elevated);
            color: var(--text);
            font-size: 14px;
            text-align: center;
            transition: background var(--duration) ease-in-out, color var(--duration) ease-in-out;
        }

        .nav-item:hover {
            background: var(--border-strong);
        }

        .nav-item.is-active {
            background: var(--primary);
            color: var(--text);
        }

        .nav-item.is-danger { background: var(--primary); color: var(--text); }
        .nav-item.is-danger:hover { background: var(--primary-hover); }

        .nav-item form { margin: 0; width: 100%; }
        .nav-item button {
            all: unset;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            cursor: pointer;
        }

        .sidebar-footer { margin-top: auto; padding-top: var(--space-3); border-top: 1px solid var(--border); }

        /* ---- main ---- */
        .main {
            flex: 1;
            min-width: 0;
            padding: 24px 32px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            gap: var(--space-3);
            flex-wrap: wrap;
        }

        .page-title { font-size: 17px; font-weight: 500; margin: 0; }
        .page-subtitle { font-size: 13px; color: var(--muted); margin-top: 2px; }

        /* ---- buttons ---- */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: var(--space-1);
            background: var(--primary);
            color: var(--text);
            border: none;
            border-radius: var(--radius-sm);
            padding: 6px 12px;
            font-weight: 400;
            font-size: 14px;
            cursor: pointer;
            transition: background var(--duration) ease-in-out;
        }
        .btn:hover { background: var(--primary-hover); }
        .btn:focus-visible { outline: none; border: 1px solid var(--text); }

        .btn-ghost {
            background: transparent;
            border: 1px solid var(--border-strong);
            color: var(--text);
        }
        .btn-ghost:hover { background: var(--elevated); }

        .btn-sm { padding: 4px 10px; font-size: 13px; }

        /* ---- card ---- */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
        }

        .card + .card { margin-top: 16px; }

        /* ---- alerts ---- */
        .alert {
            border-radius: var(--radius-md);
            padding: var(--space-2) var(--space-3);
            font-size: 14px;
            margin-bottom: 16px;
            border: 1px solid var(--border);
        }
        .alert-success { background: rgba(40, 167, 69, 0.12); color: #6fd08c; border-color: rgba(40, 167, 69, 0.25); }
        .alert-danger { background: rgba(220, 53, 69, 0.12); color: #f39aa3; border-color: rgba(220, 53, 69, 0.25); }

        /* ---- table ---- */
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        thead th {
            text-align: start;
            color: var(--muted);
            font-weight: 500;
            font-size: 13px;
            padding: var(--space-2) var(--space-3);
            border-bottom: 1px solid var(--border-strong);
        }
        tbody td {
            padding: var(--space-3);
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr { transition: background var(--duration) ease-in-out; }
        tbody tr:hover { background: var(--elevated); }

        .pill {
            display: inline-flex;
            align-items: center;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 12px;
            background: rgba(220, 53, 69, 0.15);
            color: #E35D6A;
        }

        .row-actions { display: flex; gap: var(--space-1); }

        .empty-state {
            text-align: center;
            padding: 48px 16px;
            color: var(--muted);
            font-size: 14px;
        }

        /* ---- form ---- */
        .field { margin-bottom: 16px; }
        .field label {
            display: block;
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 6px;
        }
        .field input[type="text"],
        .field input[type="email"],
        .field input[type="password"],
        .field input[type="number"],
        .field textarea {
            width: 100%;
            background: var(--elevated);
            border: 1px solid var(--border-strong);
            border-radius: var(--radius-md);
            padding: 8px 12px;
            color: var(--text);
            transition: border-color var(--duration) ease-in-out;
            font-family: inherit;
        }
        .field textarea { resize: vertical; min-height: 90px; line-height: 1.6; }
        .field input:focus,
        .field textarea:focus {
            outline: none;
            border-color: var(--primary);
        }
        .field-error { color: #E35D6A; font-size: 12px; margin-top: 4px; }
        .field-hint { color: var(--muted); font-size: 12px; margin-top: 4px; }

        .field input[type="file"] {
            width: 100%;
            background: var(--elevated);
            border: 1px dashed var(--border-strong);
            border-radius: var(--radius-md);
            padding: 10px 12px;
            color: var(--muted);
            font-size: 13px;
        }

        .field-current-image {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            margin-bottom: var(--space-2);
        }
        .field-current-image img {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border-strong);
        }

        .switch-row {
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }
        .switch-row input[type="checkbox"] {
            width: 36px;
            height: 20px;
            appearance: none;
            background: var(--elevated);
            border: 1px solid var(--border-strong);
            border-radius: 999px;
            position: relative;
            cursor: pointer;
            transition: background var(--duration) ease-in-out;
        }
        .switch-row input[type="checkbox"]::before {
            content: '';
            position: absolute;
            top: 2px;
            right: 2px;
            width: 14px;
            height: 14px;
            background: var(--text);
            border-radius: 50%;
            transition: transform var(--duration) ease-in-out;
        }
        .switch-row input[type="checkbox"]:checked {
            background: var(--primary);
        }
        .switch-row input[type="checkbox"]:checked::before {
            transform: translateX(-16px);
        }
        .switch-row label { font-size: 14px; color: var(--text); margin: 0; }

        .thumb {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border-strong);
            background: var(--elevated);
        }
        .thumb-placeholder {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-sm);
            background: var(--elevated);
            border: 1px solid var(--border-strong);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            font-size: 11px;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 12px;
        }
        .status-pill.is-on { background: rgba(40, 167, 69, 0.15); color: #6fd08c; }
        .status-pill.is-off { background: rgba(148, 148, 148, 0.15); color: var(--muted); }

        .checkbox-group { display: flex; flex-wrap: wrap; gap: var(--space-2); }
        .checkbox-pill {
            display: flex;
            align-items: center;
            gap: var(--space-1);
            background: var(--elevated);
            border: 1px solid var(--border-strong);
            border-radius: var(--radius-sm);
            padding: 6px 10px;
            font-size: 13px;
        }

        @media (max-width: 767px) {
            .shell { flex-direction: column; }
            .sidebar { width: 100%; flex-direction: row; overflow-x: auto; }
            .sidebar-footer { display: none; }
            .nav-group-label { display: none; }
            .main { padding: 16px; }
        }
    </style>
    @stack('styles')
</head>
<body>
<div class="shell">
    <aside class="sidebar">
        <div class="brand">
            <span class="brand-mark"></span>
            پنل مدیریت
        </div>

        @if(auth()->user()?->hasPermission('manage-users'))
        <nav class="nav-group">
            <span class="nav-group-label">مدیریت ادمین‌ها</span>
            <a href="{{ route('admin.admins.index') }}" class="nav-item {{ request()->routeIs('admin.admins.*') ? 'is-active' : '' }}">
                لیست ادمین‌ها
            </a>
            @if(auth()->user()->canCreateAdmins())
            <a href="{{ route('admin.admins.create') }}" class="nav-item {{ request()->routeIs('admin.admins.create') ? 'is-active' : '' }}">
                افزودن ادمین جدید
            </a>
            @endif
        </nav>
        @endif

        @if(auth()->user()?->hasPermission('manage-products'))
        <nav class="nav-group">
            <span class="nav-group-label">مدیریت محصولات</span>
            <a href="{{ route('admin.products.create') }}" class="nav-item {{ request()->routeIs('admin.products.create') ? 'is-active' : '' }}">
                افزودن محصول
            </a>
            <a href="{{ route('admin.products.index') }}" class="nav-item {{ request()->routeIs('admin.products.*') && !request()->routeIs('admin.products.create') ? 'is-active' : '' }}">
                لیست محصولات
            </a>
        </nav>
        @endif

        @if(auth()->user()?->hasPermission('manage-posts'))
        <nav class="nav-group">
            <span class="nav-group-label">مدیریت مطالب</span>
            <a href="{{ route('admin.posts.create') }}" class="nav-item {{ request()->routeIs('admin.posts.create') ? 'is-active' : '' }}">
                افزودن مطلب
            </a>
            <a href="{{ route('admin.posts.index') }}" class="nav-item {{ request()->routeIs('admin.posts.*') && !request()->routeIs('admin.posts.create') ? 'is-active' : '' }}">
                لیست مطالب
            </a>
        </nav>
        @endif

        <div class="sidebar-footer nav-group">
            <a href="{{ url('/') }}" class="nav-item">نمایش سایت</a>
            <div class="nav-item is-danger">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">خروج از حساب</button>
                </form>
            </div>
        </div>
    </aside>

    <main class="main">
        <div class="topbar">
            <div>
                <h1 class="page-title">@yield('page-title')</h1>
                @hasSection('page-subtitle')
                    <p class="page-subtitle">@yield('page-subtitle')</p>
                @endif
            </div>
            <div>@yield('page-actions')</div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>
</div>
@stack('scripts')
</body>
</html>
