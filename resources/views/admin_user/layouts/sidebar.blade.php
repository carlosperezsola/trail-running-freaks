<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="">{{ $settings->site_name }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="">||</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <a href="{{ route('admin_user.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Ecommerce</li>
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
                    'admin_user.brand.*',
                    'admin_user.products.*',
                    'admin_user.products-image-gallery.*',
                    'admin_user.products-variant.*',
                    'admin_user.products-variant-item.*',
                    'admin_user.seller-products.*',
                    'admin_user.seller-pending-products.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box"></i>
                    <span>Manage Products</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin_user.brand.*']) }}"><a class="nav-link"
                            href="{{ route('admin_user.brand.index') }}">Brands</a></li>
                    <li
                        class="{{ setActive([
                            'admin_user.products.*',
                            'admin_user.products-image-gallery.*',
                            'admin_user.products-variant.*',
                            'admin_user.products-variant-item.*',
                            'admin_user.payment-settings.*',
                        ]) }}">
                        <a class="nav-link" href="{{ route('admin_user.products.index') }}">Products</a>
                    </li>
                    <li class="{{ setActive(['admin_user.seller-products.*']) }}"><a class="nav-link"
                            href="{{ route('admin_user.seller-products.index') }}">Seller Products</a></li>
                    <li class="{{ setActive(['admin_user.seller-pending-products.*']) }}"><a class="nav-link"
                            href="{{ route('admin_user.seller-pending-products.index') }}">Seller Pending Products</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{ setActive(['admin_user.third-party-profile.*', 'admin_user.shipping-rule.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i><span>Ecommerce</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin_user.third-party-profile.*']) }}"><a class="nav-link"
                            href="{{ route('admin_user.count-down.index') }}">Count Down</a>
                    </li>
                    <li class="{{ setActive(['admin_user.shipping-rule.*']) }}"><a class="nav-link"
                            href="{{ route('admin_user.shipping-rule.index') }}">Shipping Rule</a></li>
                    <li class="{{ setActive(['admin_user.third-party-profile.*']) }}">
                        <a class="nav-link" href="{{ route('admin_user.third-party-profile.index') }}">Third Party
                            Profile</a>
                    </li>
                    <li class="{{ setActive(['admin_user.payment-settings.*']) }}"><a class="nav-link"
                            href="{{ route('admin_user.payment-settings.index') }}">Payment Settings</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin_user.order.index') }}">
                    <i class="fas fa-cart-plus"></i><span>Orders</span>
                </a>
            </li>
            <li
                class="dropdown {{ setActive(['admin_user.slider.*', 'admin_user.about-us.*', 'admin_user.terms-and-conditions.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i>
                    <span>Manage Website</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin_user.slider.*']) }}">
                        <a class="nav-link" href="{{ route('admin_user.slider.index') }}">Slider</a>
                    </li>
                    <li class="{{ setActive(['admin_user.slider.*']) }}">
                        <a class="nav-link" href="{{ route('admin_user.home-page-setting.index') }}">Home Page
                            Settings</a>
                    </li>
                    <li class="{{ setActive(['admin_user.about-us.index']) }}">
                        <a class="nav-link" href="{{ route('admin_user.about-us.index') }}">About Us Page</a>
                    </li>
                    <li class="{{ setActive(['admin_user.terms-and-conditions.index']) }}">
                        <a class="nav-link" href="{{ route('admin_user.terms-and-conditions.index') }}">Terms &
                            Conditions Page</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="nav-link {{ setActive(['admin_user.banner.*']) }}"
                    href="{{ route('admin_user.banner.index') }}">
                    <i class="fas fa-ad"></i> <span>Banners</span>
                </a>
            </li>
            <li class="menu-header">More features</li>
            <li
                class="dropdown {{ setActive(['admin_user.footer-info.index', 'admin_user.footer-socials.*', 'admin_user.footer-grid.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-th-large"></i><span>Footer</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin_user.footer-info.index']) }}"><a class="nav-link"
                            href="{{ route('admin_user.footer-info.index') }}">Footer Info</a></li>
                    <li class="{{ setActive(['admin_user.footer-socials.*']) }}"><a class="nav-link"
                            href="{{ route('admin_user.footer-socials.index') }}">Footer Socials</a></li>
                    <li class="{{ setActive(['admin_user.footer-grid.*']) }}"><a class="nav-link"
                            href="{{ route('admin_user.footer-grid.index') }}">Footer General Info</a></li>
                </ul>
            </li>
            <li>
                <a class="nav-link {{ setActive(['admin_user.subscribers.*']) }}"
                    href="{{ route('admin_user.subscribers.index') }}">
                    <i class="fas fa-user"></i><span>Subscribers</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin_user.settings.index') }}">
                    <i class="fas fa-wrench"></i><span>Settings</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
