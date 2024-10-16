@php
    $popularCategories = json_decode($popularCategory->value, true);
@endphp
<section id="trf__monthly_top" class="trf__monthly_top_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="trf__section_header for_md">
                    <h3>Popular Categories</h3>
                    <div class="monthly_top_filter">
                        @php
                            $products = [];
                        @endphp

                        @foreach ($popularCategories as $key => $popularCategory)
                            @php
                                $lastKey = [];
                                foreach ($popularCategory as $key => $category) {
                                    if ($category === null) {
                                        break;
                                    }
                                    $lastKey = [$key => $category];
                                }
                                if (array_keys($lastKey)[0] === 'category') {
                                    $category = \App\Models\Category::find($lastKey['category']);
                                    $products[] = \App\Models\Product::with([
                                        'options',
                                        'category',
                                        'productImageGalleries',
                                    ])
                                        ->where('category_id', $category->id)
                                        ->orderBy('id', 'DESC')
                                        ->take(12)
                                        ->get();
                                } elseif (array_keys($lastKey)[0] === 'sub_category') {
                                    $category = \App\Models\SubCategory::find($lastKey['sub_category']);
                                    $products[] = \App\Models\Product::with([
                                        'options',
                                        'category',
                                        'productImageGalleries',
                                    ])
                                        ->where('sub_category_id', $category->id)
                                        ->orderBy('id', 'DESC')
                                        ->take(12)
                                        ->get();
                                } else {
                                    $category = \App\Models\ChildCategory::find($lastKey['child_category']);
                                    $products[] = \App\Models\Product::with([
                                        'options',
                                        'category',
                                        'productImageGalleries',
                                    ])
                                        ->where('child_category_id', $category->id)
                                        ->orderBy('id', 'DESC')
                                        ->take(12)
                                        ->get();
                                }
                            @endphp
                            <button class="{{ $loop->index === 0 ? 'auto_click active' : '' }}"
                                data-filter=".category-{{ $loop->index }}">{{ $category->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="row grid">
                    @foreach ($products as $key => $product)
                        @foreach ($product as $item)
                            <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3  category-{{ $key }}">
                                <a class="trf__hot_deals__single" href="{{ route('product-detail', $item->slug) }}">
                                    <div class="trf__hot_deals__single_img">
                                        <img src="{{ asset($item->thumb_image) }}" alt="{{ $item->name }}"
                                            class="img-fluid w-100">
                                    </div>
                                    <div class="trf__hot_deals__single_text">
                                        <h5>{!! limitText($item->name) !!}</h5>
                                        @if (checkDiscount($item))
                                            <p class="trf__tk">{{ $settings->currency_icon }}{{ $item->offer_price }}
                                                <del>{{ $settings->currency_icon }}{{ $item->price }}</del>
                                            </p>
                                        @else
                                            <p class="trf__tk">{{ $settings->currency_icon }}{{ $item->price }}</p>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
