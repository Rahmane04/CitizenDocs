<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CitizenDocs — Agent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .sidebar {
            min-height: 100vh;
            background: #1e3a5f;
            padding-top: 20px;
        }
        .sidebar a {
            color: #cdd9e8;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            border-radius: 6px;
            margin: 2px 10px;
            transition: background 0.2s;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #2e5490;
            color: white;
        }
        .sidebar .brand {
            font-size: 1.3rem;
            font-weight: 700;
            color: white;
            padding: 0 20px 20px;
            border-bottom: 1px solid #2e5490;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">

        <div class="col-md-2 sidebar px-0">
            <div class="brand">🏛️ CitizenDocs</div>
            <a href="{{ route('agent.demandes.index') }}"
               class="{{ request()->routeIs('agent.demandes.*') ? 'active' : '' }}">
                📋 Demandes
            </a>
            <hr style="border-color:#2e5490; margin:10px;">
            <form method="POST" action="{{ route('logout') }}" style="padding:0 10px;">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light w-100">
                    Déconnexion
                </button>
            </form>
        </div>

        <div class="col-md-10 p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    ✅ {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    ❌ {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
