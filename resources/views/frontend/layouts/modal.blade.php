<div class="modal-body">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
            class="far fa-times"></i></button>
    <div class="row">
        <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
            <div class="trf__quick_view_img">
                @if ($product->video_link)
                    <a class="venobox trf__pro_det_video" data-autoplay="true" data-vbtype="video"
                        href="{{ $product->video_link }}">
                        <i class="fas fa-play"></i>
                    </a>
                @endif
                <div class="row modal_slider">
                    <div class="col-xl-12">
                        <div class="modal_slider_img">
                            <img src="{{ asset($product->thumb_image) }}"
                                alt="{{ asset($product->name) }}" class="img-fluid w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="trf__pro_details_text">
                <a class="title" href="#">{{ limitText($product->name, 150) }}</a>
                @if ($product->qty > 0)
                    <p class="trf__stock_area"><span class="in_stock">in stock</span>
                        ({{ $product->qty }}
                        item)</p>
                @elseif ($product->qty === 0)
                    <p class="trf__stock_area"><span class="in_stock">stock out</span>
                        ({{ $product->qty }}
                        item)</p>
                @endif
                @if (checkDiscount($product))
                    <h4>{{ $settings->currency_icon }}{{ $product->currency_icon }}{{ $product->offer_price }}
                        <del>{{ $settings->currency_icon }}{{ $product->currency_icon }}{{ $product->price }}</del>
                    </h4>
                @else
                    <h4>{{ $settings->currency_icon }}{{ $product->currency_icon }}{{ $product->price }}
                    </h4>
                @endif
                <p class="description">{!! limitText($product->short_description, 200) !!}</p>
                <form class="shopping-cart-form">
                    <div class="trf__selectbox">
                        <div class="row">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            @foreach ($product->options as $option)
                                @if ($option->status != 0)
                                    <div class="col-xl-6 col-sm-6">
                                        <h5 class="mb-2">{{ $option->name }}: </h5>
                                        <select class="select_2" name="options_items[]">
                                            @foreach ($option->productOptionItems as $optionItem)
                                                @if ($optionItem->status != 0)
                                                    <option value="{{ $optionItem->id }}"
                                                        {{ $optionItem->is_default == 1 ? 'selected' : '' }}>
                                                        {{ $optionItem->name }}
                                                        ({{ $optionItem->price }}€)
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="trf__quentity">
                        <h5>Quantity:</h5>
                        <div class="select_number">
                            <input class="number_area" name="qty" type="text"
                                min="1" max="100" value="1" />
                        </div>
                    </div>
                    <ul class="trf__button_area">
                        <li><button type="submit" class="add_cart" href="#">add to cart</button></li>
                    </ul>
                </form>
                <p class="brand_model"><span>trademark :</span> {{ $product->trademark->name }}</p>
            </div>
        </div>
    </div>
</div>
