@extends('frontend.dashboard.layouts.main')

@section('title')
    {{ $settings->site_name }} || @lang('Product')
@endsection

@section('container')
    <section id="trf__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> @lang('Purchases')</h3>
                        <div class="trf__dashboard_profile">
                            <div class="trf__dash_pro_area  overflow-auto overflow-auto">
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
@endpush
