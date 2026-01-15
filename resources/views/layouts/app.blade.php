<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Inventory System') }}</title>
    
    <style>
        :root {
            --primary: #8b5cf6;
            --secondary: #ec4899;
            --accent: #06b6d4;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            
            --bg-light: #f8f7ff;
            --bg-card: #ffffff;
            --bg-lighter: #faf9ff;
            
            --text-primary: #1e1b4b;
            --text-secondary: #7c3aed;
            --text-muted: #6b7280;
            
            --neon-purple: #8b5cf6;
            --neon-pink: #ec4899;
            --neon-cyan: #06b6d4;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Space Grotesk', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--bg-light);
            background-image: 
                radial-gradient(at 0% 0%, rgba(139, 92, 246, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(236, 72, 153, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(6, 182, 212, 0.08) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(16, 185, 129, 0.08) 0px, transparent 50%);
            color: var(--text-primary);
            line-height: 1.6;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* Header */
        header {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 2px solid rgba(139, 92, 246, 0.2);
            padding: 1rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 4px 24px rgba(139, 92, 246, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.75rem;
            font-weight: 900;
            background: linear-gradient(135deg, var(--neon-purple), var(--neon-pink), var(--neon-cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            transition: all 0.3s ease;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo:hover {
            transform: translateY(-2px) scale(1.02);
            filter: drop-shadow(0 0 10px rgba(167, 139, 250, 0.8));
        }

        nav {
            display: flex;
            gap: 0.75rem;
        }

        nav a {
            padding: 0.75rem 1.5rem;
            text-decoration: none;
            color: var(--text-muted);
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 600;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.05em;
        }

        nav a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(167, 139, 250, 0.2), transparent);
            transition: left 0.5s ease;
        }

        nav a:hover::before {
            left: 100%;
        }

        nav a:hover {
            color: var(--neon-purple);
            background: rgba(139, 92, 246, 0.1);
            transform: translateY(-2px);
        }

        nav a.active {
            color: white;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: 1px solid rgba(139, 92, 246, 0.4);
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.4), 0 0 40px rgba(236, 72, 153, 0.2);
        }

        /* Grid System */
        .grid {
            display: grid;
        }

        .grid-cols-2 {
            grid-template-columns: repeat(2, 1fr);
        }

        .grid-cols-3 {
            grid-template-columns: repeat(3, 1fr);
        }

        .gap-2 { gap: 0.5rem; }
        .gap-3 { gap: 0.75rem; }
        .gap-4 { gap: 1rem; }
        .gap-6 { gap: 1.5rem; }

        /* Flex */
        .flex {
            display: flex;
        }

        .flex-between {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .inline {
            display: inline;
        }

        /* Card */
        .card {
            background: var(--bg-card);
            background-image: linear-gradient(135deg, rgba(139, 92, 246, 0.02), rgba(255, 255, 255, 0.5));
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(139, 92, 246, 0.12);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 2px solid rgba(139, 92, 246, 0.15);
            position: relative;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--neon-purple), var(--neon-pink), var(--neon-cyan));
        }

        .card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 48px rgba(139, 92, 246, 0.25), 0 0 30px rgba(236, 72, 153, 0.15);
            border-color: rgba(139, 92, 246, 0.3);
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(167, 139, 250, 0.2);
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(236, 72, 153, 0.1));
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.01em;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Forms */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.75rem;
            font-weight: 700;
            color: var(--neon-purple);
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.05em;
        }

        .form-control {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 2px solid rgba(139, 92, 246, 0.2);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.8);
            color: var(--text-primary);
            font-size: 0.9375rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--neon-purple);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.15), 0 0 20px rgba(139, 92, 246, 0.2);
            background: rgba(255, 255, 255, 1);
        }

        .form-control.error {
            border-color: var(--danger);
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.3);
        }

        .form-error {
            color: var(--danger);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            font-weight: 600;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 1.75rem;
            border: none;
            border-radius: 12px;
            font-size: 0.9375rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:hover::before {
            width: 400px;
            height: 400px;
        }

        .btn-sm {
            padding: 0.625rem 1.25rem;
            font-size: 0.875rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.3);
            border: 1px solid rgba(167, 139, 250, 0.3);
        }

        .btn-primary:hover {
            box-shadow: 0 0 30px rgba(139, 92, 246, 0.6), 0 0 60px rgba(236, 72, 153, 0.4);
            transform: translateY(-3px) scale(1.02);
        }

        .btn-secondary {
            background: rgba(167, 139, 250, 0.1);
            color: var(--neon-purple);
            border: 2px solid var(--neon-purple);
        }

        .btn-secondary:hover {
            background: rgba(167, 139, 250, 0.2);
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.4);
            transform: translateY(-3px) scale(1.02);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success), #059669);
            color: white;
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.3);
        }

        .btn-success:hover {
            box-shadow: 0 0 30px rgba(16, 185, 129, 0.6);
            transform: translateY(-3px) scale(1.02);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger), #dc2626);
            color: white;
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            box-shadow: 0 0 30px rgba(239, 68, 68, 0.6);
            transform: translateY(-3px) scale(1.02);
        }

        /* Table */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(236, 72, 153, 0.1));
        }

        th {
            padding: 1.25rem;
            text-align: left;
            font-weight: 700;
            color: var(--neon-purple);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        td {
            padding: 1.25rem;
            border-bottom: 1px solid rgba(167, 139, 250, 0.1);
            color: var(--text-muted);
        }

        tbody tr {
            transition: all 0.2s ease;
        }

        tbody tr:hover {
            background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.05), transparent);
            box-shadow: inset 0 0 20px rgba(139, 92, 246, 0.05);
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: 2px solid;
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.2);
            color: #6ee7b7;
            border-color: #10b981;
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.3);
        }

        .badge-danger {
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border-color: #ef4444;
            box-shadow: 0 0 15px rgba(239, 68, 68, 0.3);
        }

        /* Pagination */
        .pagination {
            display: flex;
            gap: 0.75rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .pagination-item {
            padding: 0.75rem 1.25rem;
            border: 2px solid rgba(139, 92, 246, 0.2);
            border-radius: 12px;
            text-decoration: none;
            color: var(--text-muted);
            transition: all 0.3s ease;
            font-weight: 600;
            background: var(--bg-card);
        }

        .pagination-item:hover {
            background: rgba(139, 92, 246, 0.2);
            border-color: var(--neon-purple);
            color: var(--text-primary);
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.4);
            transform: translateY(-2px);
        }

        .pagination-item.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-color: transparent;
            color: white;
            box-shadow: 0 0 20px rgba(236, 72, 153, 0.4);
        }

        /* Typography */
        h2 {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--neon-purple), var(--neon-pink), var(--neon-cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.02em;
            margin-bottom: 1.5rem;
        }

        .text-muted {
            color: var(--text-muted);
        }

        .text-center {
            text-align: center;
        }

        .text-danger {
            color: #fca5a5;
        }

        .text-success {
            color: #6ee7b7;
        }

        code {
            font-family: 'Courier New', monospace;
            background: rgba(167, 139, 250, 0.15);
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.875rem;
            color: var(--neon-cyan);
        }

        /* Alerts */
        .alert {
            padding: 1.25rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            border-left: 4px solid;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border-color: #10b981;
            color: #059669;
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.15);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border-color: #ef4444;
            color: #dc2626;
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.15);
        }

        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            border-color: #f59e0b;
            color: #d97706;
            box-shadow: 0 0 20px rgba(245, 158, 11, 0.15);
        }

        .alert-info {
            background: rgba(6, 182, 212, 0.1);
            border-color: #06b6d4;
            color: #0891b2;
            box-shadow: 0 0 20px rgba(6, 182, 212, 0.15);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .grid-cols-2,
            .grid-cols-3 {
                grid-template-columns: 1fr;
            }

            nav {
                flex-direction: column;
                gap: 0.5rem;
            }

            nav a {
                text-align: center;
            }
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 12px;
            height: 12px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-lighter);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--neon-purple), var(--neon-pink));
            border-radius: 10px;
            border: 2px solid var(--bg-lighter);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, var(--neon-pink), var(--neon-cyan));
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.4);
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <a href="{{ route('dashboard') }}" class="logo">
                    ⚡ {{ config('app.name', 'Inventory') }}
                </a>
                <nav>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">Products</a>
                    <a href="{{ route('suppliers.index') }}" class="{{ request()->routeIs('suppliers.*') ? 'active' : '' }}">Suppliers</a>
                    <a href="{{ route('stock.in') }}" class="{{ request()->routeIs('stock.*') ? 'active' : '' }}">Stock</a>
                </nav>
            </div>
        </div>
    </header>

    <main class="container">
        @if(session('success'))
            <div class="alert alert-success">
                <span style="font-size: 1.25rem;">✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <span style="font-size: 1.25rem;">✕</span>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <div>
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul style="margin-top: 0.5rem; margin-left: 1.25rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>