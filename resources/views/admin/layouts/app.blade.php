<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CitizenDocs — Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="d-flex" style="min-height:100vh">

    {{-- Sidebar --}}
    <div class="bg-dark text-white p-3" style="width:250px; min-height:100vh">
        <h5 class="mb-4">⚙️ CitizenDocs Admin</h5>
        <nav class="nav flex-column gap-2">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'fw-bold text-warning' : '' }}">
                📊 Dashboard
            </a>
            <a href="{{ route('admin.users') }}"
               class="nav-link text-white {{ request()->routeIs('admin.users') ? 'fw-bold text-warning' : '' }}">
                👥 Utilisateurs
            </a>
            <a href="{{ route('admin.type_documents') }}"
               class="nav-link text-white {{ request()->routeIs('admin.type_documents*') ? 'fw-bold text-warning' : '' }}">
                📄 Types de documents
            </a>
            <a href="{{ route('admin.rapports') }}"
               class="nav-link text-white {{ request()->routeIs('admin.rapports') ? 'fw-bold text-warning' : '' }}">
                📈 Rapports
            </a>
            <hr class="border-secondary">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-sm btn-outline-light w-100">
                    🚪 Déconnexion
                </button>
            </form>
        </nav>
    </div>

    {{-- Contenu principal --}}
    <div class="flex-grow-1 p-4 bg-light">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>