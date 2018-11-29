<!-- Sidebar -->
<div id="sidebar-container" class="sidebar-expanded d-none d-md-block col-2">
        <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group sticky-top sticky-offset">
            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>MAIN MENU</small>
            </li>
            <!-- /END Separator -->

            <a href="{{route('management.dashboard')}}" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <i class="fas fa-tachometer-alt fa-fw mr-3"></i>
                    <span class="menu-collapsed">Dashboard</span>
                </div>
            </a>
            <!-- Menu with submenu -->
            <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-user fa-fw mr-3"></span>
                    <span class="menu-collapsed">User</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id="submenu2" class="collapse sidebar-submenu">
                <a href="{{route('users.index')}}" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">User</span>
                </a>
                <a href="{{route('permissions.index')}}" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Permission</span>
                </a>
                <a href="{{route('roles.index')}}" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Roles</span>
                </a>
            </div>
            <a href="{{route('packages.index')}}" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-map-marked-alt fa-fw mr-3"></span>
                    <span class="menu-collapsed">Package</span>
                </div>
            </a>
            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>Articles</small>
            </li>
            <!-- /END Separator -->
            <a href="{{route('pages.index')}}" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-sticky-note fa-fw mr-3"></span>
                    <span class="menu-collapsed">Pages</span>
                </div>
            </a>
            <a href="{{route('posts.index')}}" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-pen-nib fa-fw mr-3"></span>
                    <span class="menu-collapsed">Post</span>
                </div>
            </a>
            <!-- Separator without title -->
            <li class="list-group-item sidebar-separator menu-collapsed"></li>
            <!-- /END Separator -->
            <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-question fa-fw mr-3"></span>
                    <span class="menu-collapsed">Help</span>
                </div>
            </a>

        </ul>
        <!-- List Group END-->
    </div>
    <!-- sidebar-container END -->
