@extends('admin_user.layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Product Image Gallery')</h1>
        </div>
        <div class="mb-3">
            <a href="{{ route('admin_user.products.index') }}" class="btn btn-primary">@lang('Back')</a>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('Product'): {{ $product->name }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin_user.products-image-gallery.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">@lang('Image') <code>(@lang('Multiple image supported!'))</code></label>
                                    <input type="file" name="image[]" class="form-control" multiple>
                                    <input type="hidden" name="product" value="{{ $product->id }}">
                                </div>
                                <button type="submit" class="btn btn-primary">@lang('Upload')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('All Images')</h4>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
