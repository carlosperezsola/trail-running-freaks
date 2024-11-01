@extends('admin_user.layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Count Down')</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('Count Down End Date')</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin_user.count-down.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="">
                                    <div class="form-group">
                                        <label>@lang('Count Down Name')</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name', $countDownName) }}">
                                    </div>                                                                        
                                    <div class="form-group">
                                        <label>@lang('Sale End Date')</label>
                                        <input type="text" class="form-control datepicker" name="end_date"
                                            value="{{ @$countDownDate->end_date }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">@lang('Save')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('Add Count Down Products')</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin_user.count-down.add-product')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>@lang('Add Product')</label>
                                    <select name="product" id="" class="form-control select2">
                                        <option value="">@lang('Select')</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('Show at home?')</label>
                                            <select name="show_at_home" id="" class="form-control">
                                                <option value="">@lang('Select')</option>
                                                <option value="1">@lang('Yes')</option>
                                                <option value="0">@lang('No')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('Status')</label>
                                            <select name="status" id="" class="form-control">
                                                <option value="">@lang('Select')</option>
                                                <option value="1">@lang('Active')</option>
                                                <option value="0">@lang('Inactive')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">@lang('Save')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('All Count Down Products')</h4>
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
    <script>
        $(document).ready(function() {
            // change the Count Down status
            $('body').on('click', '.change-status', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin_user.count-down-status') }}",
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

            // change show at home status
            $('body').on('click', '.change-at-home-status', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin_user.count-down.show-at-home.change-status') }}",
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
