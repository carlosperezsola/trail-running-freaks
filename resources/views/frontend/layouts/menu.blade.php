@php
    $categories = \App\Models\Category::where('status', 1)
        ->with([
            'subCategories' => function ($query) {
                $query->where('status', 1)->with([
                    'childCategories' => function ($query) {
                        $query->where('status', 1);
                    },
                ]);
            },
        ])
        ->get();
@endphp

<nav class="trf__main_menu d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="relative_contect d-flex">
                    <div class="trf_menu_category_bar">
                        <i class="far fa-bars"></i>
                    </div>
                    <ul class="trf_menu_cat_item show_home toggle_menu">
                        @foreach ($categories as $category)
                            <li><a class="{{ count($category->subCategories) > 0 ? 'trf__droap_arrow' : '' }}"
                                    href="{{route('products.index', ['category' => $category->slug])}}"><i
                                        class="{{ $category->icon }}"></i> {{ $category->name }} </a>
                                @if (count($category->subCategories) > 0)
                                    <ul class="trf_menu_cat_droapdown">
                                        @foreach ($category->subCategories as $subCategory)
                                            <li><a href="{{route('products.index', ['subcategory' => $subCategory->slug])}}">{{ $subCategory->name }} <i
                                                        class="{{ count($subCategory->childCategories) > 0 ? 'fas fa-angle-right' : '' }}"></i></a>
                                                @if (count($subCategory->childCategories) > 0)
                                                    <ul class="trf__sub_category">
                                                        @foreach ($subCategory->childCategories as $childCategory)
                                                            <li><a href="{{route('products.index', ['childcategory' => $childCategory->slug])}}">{{ $childCategory->name }}</a> </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <ul class="trf__menu_item">
                        <li><a class="{{ setActive(['home']) }}" href="{{ url('/') }}">home</a></li>
                        <li><a class="{{ setActive(['thirdParty.index']) }}"
                                href="{{ route('thirdParty.index') }}">@lang('third party')</a></li>
                        <li><a class="{{ setActive(['count-down']) }}" href="{{ route('count-down') }}">@lang('trending race')</a>
                        </li>
                        <li><a class="{{ setActive(['who-we-are']) }}" href="{{ route('who-we-are') }}">@lang('who we are')</a></li>
                        <li><a class="{{ setActive(['contact']) }}" href="{{ route('contact') }}">@lang('contact')</a></li>
                    </ul>
                    <ul class="trf__menu_item trf__menu_item_right">                        
                        <li><a href="{{route('product-tracking.index')}}">@lang('track my purchases')</a></li>
                        @if (auth()->check())
                            @if (auth()->user()->type_user === 'regular')
                                <li><a href="{{ route('user.dashboard') }}">@lang('my account')</a></li>
                            @elseif (auth()->user()->type_user === 'third-party')
                                <li><a href="{{ route('third_party_user.dashboard') }}">@lang('Third Party Dashboard')</a></li>
                            @elseif (auth()->user()->type_user === 'admin')
                                <li><a href="{{ route('admin_user.dashboard') }}">@lang('Admin Dashboard')</a></li>
                            @endif
                        @else
                            <li><a href="{{ route('login') }}">@lang('login')</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<section id="trf__mobile_menu">
    <div class="row">
        <div class="col-10">   
            <form class="mt-2" action="{{ route('products.index') }}">
                <input type="text" placeholder="Search..." name="search" value="{{ request()->search }}">
                <button type="submit"><i class="far fa-search"></i></button>
            </form>
        </div>
        <div class="col-2">
            <span class="trf__mobile_menu_close"><i class="fal fa-times"></i></span>
        </div>
    </div>
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                role="tab" aria-controls="pills-home" aria-selected="true">@lang('Categories')</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                role="tab" aria-controls="pills-profile" aria-selected="false">@lang('main menu')</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="trf__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <ul class="trf_mobile_menu_category">
                        @foreach ($categories as $categoryItem)
                            <li>
                                <a href="#"
                                    class="{{ count($categoryItem->subCategories) > 0 ? 'accordion-button' : '' }} collapsed"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThreew-{{ $loop->index }}" aria-expanded="false"
                                    aria-controls="flush-collapseThreew-{{ $loop->index }}"><i
                                        class="{{ $categoryItem->icon }}"></i> {{ $categoryItem->name }}</a>
                                @if (count($categoryItem->subCategories) > 0)
                                    <div id="flush-collapseThreew-{{ $loop->index }}"
                                        class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul>
                                                @foreach ($categoryItem->subCategories as $subCategoryItem)
                                                    <li><a href="#">{{ $subCategoryItem->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="trf__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample2">
                    <ul>
                        <li><a class="{{ setActive(['home']) }}" href="{{ url('/') }}">home</a></li>
                        <li><a class="{{ setActive(['thirdParty.index']) }}"
                                href="{{ route('thirdParty.index') }}">@lang('third party')</a></li>
                        <li><a class="{{ setActive(['count-down']) }}" href="{{ route('count-down') }}">@lang('trending race')</a>
                        </li>
                        <li><a class="{{ setActive(['who-we-are']) }}" href="{{ route('who-we-are') }}">@lang('who we are')</a>
                        </li>
                        <li><a class="{{ setActive(['contact']) }}" href="{{ route('contact') }}">@lang('contact')</a></li>
                        <li><a href="{{route('product-tracking.index')}}">@lang('track my purchases')</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
