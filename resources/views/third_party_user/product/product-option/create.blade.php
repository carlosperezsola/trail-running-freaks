@extends('third_party_user.layouts.main')

@section('title')
    {{ $settings->site_name }} || Product Option Section
@endsection

@section('container')
    <section id="trf__dashboard">
        <div class="container-fluid">
            @include('third_party_user.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Create Option</h3>
                        <div class="trf__dashboard_profile">
                            <div class="trf__dash_pro_area">
                                <form action="{{ route('third_party_user.products-option.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group trf__input">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" value="">
                                    </div>
                                    <div class="form-group trf__input">
                                        <input type="hidden" class="form-control" name="product"
                                            value="{{ request()->product }}">
                                    </div>
                                    <div class="form-group trf__input">
                                        <label for="inputState">Status</label>
                                        <select id="inputState" class="form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <button type="submmit" class="btn btn-primary">Create</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection