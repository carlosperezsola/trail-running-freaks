
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <a href="{{route('admin_user.dashboard')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>

            <li
                class="dropdown {{ setActive(['admin_user.category.*', 'admin_user.sub-category.*', 'admin_user.child-category.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list"></i>
                    <span>Manage Categories</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin_user.category.*']) }}"><a class="nav-link"
                            href="{{ route('admin_user.category.index') }}">Category</a></li>
                    <li class="{{ setActive(['admin_user.sub-category.*']) }}"><a class="nav-link"
                            href="{{ route('admin_user.sub-category.index') }}">Sub Category</a></li>
                    <li class="{{ setActive(['admin_user.child-category.*']) }}"> <a class="nav-link"
                            href="{{ route('admin_user.child-category.index') }}">Child Category</a></li>
                </ul>
            </li>

            <li
                class="dropdown {{ setActive([
                    'admin_user.brand.*'
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box"></i>
                    <span>Manage Products</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin_user.brand.*']) }}"><a class="nav-link" href="{{ route('admin_user.brand.index') }}">Brands</a></li>
                </ul>
            </li>

            <li
                class="dropdown {{ setActive([
                    'admin_user.slider.*'
                ])}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i>
                    <span>Manage Website</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin_user.slider.*']) }}"><a class="nav-link"
                        href="{{ route('admin_user.slider.index') }}">Slider</a></li>
                </ul>
            </li>

            <?php /*<li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i> <span>Layout</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                </ul>
            </li>*/?>           
        </ul>
    </aside>
</div>