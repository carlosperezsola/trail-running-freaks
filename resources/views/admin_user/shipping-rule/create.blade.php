@extends('admin_user.layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Shipping Rule')</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('Create Shipping Rule')</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin_user.shipping-rule.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input type="text" class="form-control" name="name" value="">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">@lang('Type')</label>
                                    <select id="" class="form-control shipping-type" name="type">
                                        <option value="flat_cost">@lang('Flat Cost')</option>
                                        <option value="min_cost">@lang('Minimum Purchase Amount')</option>
                                    </select>
                                </div>
                                <div class="form-group min_cost d-none">
                                    <label>@lang('Minimum Amount')</label>
                                    <input type="text" class="form-control" name="min_cost" value="">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Cost')</label>
                                    <input type="text" class="form-control" name="cost" value="">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">@lang('Status')</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option value="1">@lang('Active')</option>
                                        <option value="0">@lang('Inactive')</option>
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
            $('body').on('change', '.shipping-type', function() {
                let value = $(this).val();

                if (value != 'min_cost') {
                    $('.min_cost').addClass('d-none')
                } else {
                    $('.min_cost').removeClass('d-none')
                }
            })
        })
    </script>
@endpush
