<aside class="main-sidebar sidebar-dark-primary elevation-4">
    {{-- Logo du dashboard --}}
    <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
        <span class="brand-text font-weight-light">Admin Meubles</span>
    </a>

    {{-- Contenu de la sidebar --}}
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                {{-- Lien Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- Lien Produits --}}
                <li class="nav-item">
                    <a href="{{route('admin.products.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Produits</p>
                    </a>
                </li>

                {{-- Lien Catégories --}}
                <li class="nav-item">
                    <a href="{{route('admin.categories.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Catégories</p>
                    </a>
                </li>

                {{-- Lien Commandes --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-receipt"></i>
                        <p>Commandes</p>
                    </a>
                </li>
                 {{-- Lien Profile --}}
                <li class="nav-item">
                    <a href="{{route('admin.profile.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>

