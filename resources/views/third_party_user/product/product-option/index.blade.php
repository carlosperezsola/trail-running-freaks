@extends('third_party_user.layouts.main')

@section('title')
    {{ $settings->site_name }} || @lang('Product Option Section')
@endsection

@section('container')
    <section id="trf__dashboard">
        <div class="container-fluid">
            @include('third_party_user.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <a href="{{ route('third_party_user.products.index') }}" class="btn btn-warning mb-4"><i
                            class="fas fa-long-arrow-left"></i> @lang('Back')</a>
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> @lang('Product Option')</h3>
                        <h6>@lang('Product'): {{ $product->name }}</h6>
                        <div class="create_button">
                            <a href="{{ route('third_party_user.products-option.create', ['product' => $product->id]) }}"
                                class="btn btn-primary"><i class="fas fa-plus"></i> @lang('Create Option')</a>
                        </div>
                        <div class="trf__dashboard_profile">
                            <div class="trf__dash_pro_area  overflow-auto">
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('third_party_user.products-option.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data) {
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
