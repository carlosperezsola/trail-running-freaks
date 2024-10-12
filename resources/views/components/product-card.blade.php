<div class="col-xl-3 col-sm-6 col-lg-4">
    <div class="trf__product_item">
        <span class="trf__new">{{productType($product->product_type)}}</span>
        @if(checkDiscount($product))
            <span class="trf__minus">-{{calculateDiscountPercent($product->price, $product->offer_price)}}%</span>
        @endif
        <a class="trf__pro_link" href="{{route('product-detail', $product->slug)}}">
            <img src="{{asset($product->thumb_image)}}" alt="product" class="img-fluid w-100 img_1"/>
            <img src="
            @if(isset($product->productImageGalleries[0]->image))
                {{asset($product->productImageGalleries[0]->image)}}
            @else
                {{asset($product->thumb_image)}}
            @endif
            " alt="product" class="img-fluid w-100 img_2" />
        </a>
        <ul class="trf__single_pro_icon">
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#product" class="show_product_modal"
                    data-id="{{ $product->id }}"><i class="far fa-eye"></i></a>
            </li>
        </ul>
        <div class="trf__product_details">
            <a class="trf__category" href="#">{{ $product->category->name }} </a>
            <a class="trf__pro_name" href="{{ route('product-detail', $product->slug) }}">{{ $product->name }}</a>
            @if (checkDiscount($product))
                <p class="trf__price">{{ $product->offer_price }}€ <del>{{ $product->price }}€</del>
                </p>
            @else
                <p class="trf__price">{{ $product->price }}€</p>
            @endif
            <form class="shopping-cart-form">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                @foreach ($product->options as $option)
                    <select class="d-none" name="options_items[]">
                        @foreach ($option->productOptionItems as $optionItem)
                            <option value="{{ $optionItem->id }}"
                                {{ $optionItem->is_default == 1 ? 'selected' : '' }}>
                                {{ $optionItem->name }}
                                ({{ $optionItem->price }}€)
                            </option>
                        @endforeach
                    </select>
                @endforeach
                <input name="qty" type="hidden" min="1" max="100" value="1" />
                <button class="add_cart" href="#" type="submit">add to cart</button>
            </form>
        </div>
    </div>
</div>
