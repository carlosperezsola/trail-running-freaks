@extends('admin_user.layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Product')</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('Update Product')</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin_user.products.update', $product->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>@lang('Preview')</label>
                                    <br>
                                    <img src="{{ asset($product->thumb_image) }}" style="width:200px" alt="">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Image')</label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">@lang('Category')</label>
                                            <select id="inputState" class="form-control main-category" name="category">
                                                <option value="">@lang('Select')</option>
                                                @foreach ($categories as $category)
                                                    <option {{ $category->id == $product->category_id ? 'selected' : '' }}
                                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">Sub @lang('Category')</label>
                                            <select id="inputState" class="form-control sub-category" name="sub_category">
                                                <option value="">@lang('Select')</option>
                                                @foreach ($subCategories as $subCategory)
                                                    <option
                                                        {{ $subCategory->id == $product->sub_category_id ? 'selected' : '' }}
                                                        value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">@lang('Child Category')</label>
                                            <select id="inputState" class="form-control child-category"
                                                name="child_category">
                                                <option value="">@lang('Select')</option>
                                                @foreach ($childCategories as $childCategory)
                                                    <option
                                                        {{ $childCategory->id == $product->child_category_id ? 'selected' : '' }}
                                                        value="{{ $childCategory->id }}">{{ $childCategory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Trademark</label>
                                    <select id="inputState" class="form-control" name="trademark">
                                        <option value="">@lang('Select')</option>
                                        @foreach ($trademarks as $trademark)
                                            <option {{ $trademark->id == $product->trademark_id ? 'selected' : '' }}
                                                value="{{ $trademark->id }}">{{ $trademark->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>SKU</label>
                                    <input type="text" class="form-control" name="sku" value="{{ $product->sku }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Price')</label>
                                    <input type="text" class="form-control" name="price"
                                        value="{{ $product->price }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Offer Price')</label>
                                    <input type="text" class="form-control" name="offer_price"
                                        value="{{ $product->offer_price }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('Offer Start Date')</label>
                                            <input type="text" class="form-control datepicker" name="offer_start_date"
                                                value="{{ $product->offer_start_date }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('Offer End Date')</label>
                                            <input type="text" class="form-control datepicker" name="offer_end_date"
                                                value="{{ $product->offer_end_date }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Stock Quantity')</label>
                                    <input type="number" min="0" class="form-control" name="qty"
                                        value="{{ $product->qty }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Video Link')</label>
                                    <input type="text" class="form-control" name="video_link"
                                        value="{{ $product->video_link }}">
                                </div>
                                @foreach (config('app.available_locales') as $locale)
                                    <div class="form-group">
                                        <label for="short_description_{{ $locale }}">@lang('Short Description')
                                            ({{ strtoupper($locale) }})</label>
                                        <textarea name="short_description_{{ $locale }}" id="short_description_{{ $locale }}"
                                            class="form-control">{!! $product->{'short_description_' . $locale} ?? '' !!}
                                        </textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="long_description_{{ $locale }}">@lang('Long Description')
                                            ({{ strtoupper($locale) }})</label>
                                        <textarea name="long_description_{{ $locale }}" id="long_description_{{ $locale }}"
                                            class="form-control summernote">{!! $product->{'long_description_' . $locale} ?? '' !!}
                                        </textarea>
                                    </div>
                                @endforeach
                                <div class="form-group">
                                    <label for="inputState">@lang('Product Type')</label>
                                    <select id="inputState" class="form-control" name="product_type">
                                        <option value="">@lang('Select')</option>
                                        <option {{ $product->product_type == 'new_arrival' ? 'selected' : '' }}
                                            value="new_arrival">@lang('New Arrival')</option>
                                        <option {{ $product->product_type == 'featured_product' ? 'selected' : '' }}
                                            value="featured_product">@lang('Featured')</option>
                                        <option {{ $product->product_type == 'top_product' ? 'selected' : '' }}
                                            value="top_product">@lang('Top Product')</option>
                                        <option {{ $product->product_type == 'best_product' ? 'selected' : '' }}
                                            value="best_product">@lang('Best Product')</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Seo Title')</label>
                                    <input type="text" class="form-control" name="seo_title"
                                        value="{{ $product->seo_title }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Seo Description')</label>
                                    <textarea name="seo_description" class="form-control">{!! $product->seo_description !!}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">@lang('Status')</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $product->status == 1 ? 'selected' : '' }} value="1">@lang('Active')
                                        </option>
                                        <option {{ $product->status == 0 ? 'selected' : '' }} value="0">@lang('Inactive')
                                        </option>
                                    </select>
                                </div>
                                <button type="submmit" class="btn btn-primary">@lang('Create')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(e) {

                $('.child-category').html('<option value="">Select</option>')

                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin_user.product.get-subcategories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('.sub-category').html('<option value="">Select</option>')

                        $.each(data, function(i, item) {
                            $('.sub-category').append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })


            /** get child categories **/
            $('body').on('change', '.sub-category', function(e) {
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin_user.product.get-child-categories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('.child-category').html('<option value="">Select</option>')

                        $.each(data, function(i, item) {
                            $('.child-category').append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
