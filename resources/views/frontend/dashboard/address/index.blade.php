@extends('frontend.dashboard.layouts.main')

@section('container')
    <section id="trf__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content">
                        <h3><i class="fal fa-gift-card"></i> @lang('address')</h3>
                        <div class="trf__dashboard_add">
                            <div class="row">
                                @foreach ($addresses as $address)
                                    <div class="col-xl-6">
                                        <div class="trf__dash_add_single">
                                            <h4>@lang('Billing Address')</h4>
                                            <ul>
                                                <li><span>@lang('name'):</span> {{ $address->name }}</li>
                                                <li><span>@lang('Phone'):</span> {{ $address->phone }}</li>
                                                <li><span>@lang('email'):</span> {{ $address->email }}</li>
                                                <li><span>@lang('country'):</span> {{ $address->country }}</li>
                                                <li><span>@lang('state'):</span> {{ $address->state }}</li>
                                                <li><span>@lang('city'):</span> {{ $address->city }}</li>
                                                <li><span>@lang('zip code'):</span> {{ $address->zip }}</li>
                                                <li><span>@lang('address') :</span> {{ $address->address }}</li>
                                            </ul>
                                            <div class="trf__address_btn">
                                                <a href="{{ route('user.address.edit', $address->id) }}" class="edit"><i
                                                        class="fal fa-edit"></i> @lang('edit')</a>
                                                <a href="{{ route('user.address.destroy', $address->id) }}"
                                                    class="del delete-item"><i class="fal fa-trash-alt"></i> @lang('delete')</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-12">
                                    <a href="{{ route('user.address.create') }}" class="add_address_btn common_btn"><i
                                            class="far fa-plus"></i>
                                        @lang('add new address')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
