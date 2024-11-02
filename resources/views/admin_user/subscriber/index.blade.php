@extends('admin_user.layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Subscribers')</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('Send Email to all subscribers')</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin_user.subscribers-send-mail') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">@lang('Subject')</label>
                                    <input type="text" class="form-control" name="subject" value="{{ old('subject') }}">
                                </div>
                                <div class="form-group">
                                    <label for="">@lang('Message')</label>
                                    <textarea name="message" class="form-control">{{ old('message') }}</textarea>
                                </div>
                                <button class="btn btn-primary" type="submit">@lang('Send')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('All Subscribers')</h4>
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
