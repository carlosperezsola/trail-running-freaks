<div class="tab-pane fade show" id="list-stripe" role="tabpanel" aria-labelledby="list-stripe-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin_user.stripe-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>@lang('Stripe Status')</label>
                    <select name="status" id="" class="form-control">
                        <option {{ $stripeSetting->status === 1 ? 'selected' : '' }} value="1">@lang('Enable')</option>
                        <option {{ $stripeSetting->status === 0 ? 'selected' : '' }} value="0">@lang('Disable')</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>@lang('Account Mode')</label>
                    <select name="mode" id="" class="form-control">
                        <option {{ $stripeSetting->mode === 0 ? 'selected' : '' }} value="0">@lang('Sandbox')</option>
                        <option {{ $stripeSetting->mode === 1 ? 'selected' : '' }} value="1">@lang('Live')</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>@lang('Country Name')</label>
                    <select name="country_name" id="" class="form-control select2">
                        <option value="">@lang('Select')</option>
                        @foreach (config('settings.country_list') as $country)
                            <option {{ $country === $stripeSetting->country_name ? 'selected' : '' }}
                                value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>@lang('Currency Name')</label>
                    <select name="currency_name" id="" class="form-control select2">
                        <option value="">@lang('Select')</option>
                        @foreach (config('settings.currency_list') as $key => $currency)
                            <option {{ $currency === $stripeSetting->currency_name ? 'selected' : '' }}
                                value="{{ $currency }}">{{ $key }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>@lang('Currency rate') ( Per {{ $settings->currency_name }} )</label>
                    <input type="text" class="form-control" name="currency_rate"
                        value="{{ $stripeSetting->currency_rate }}">
                </div>
                <div class="form-group">
                    <label>@lang('Stripe Client Id')</label>
                    <input type="text" class="form-control" name="client_id"
                        value="{{ $stripeSetting->client_id }}">
                </div>
                <div class="form-group">
                    <label>@lang('Stripe Secret Key')</label>
                    <input type="text" class="form-control" name="secret_key"
                        value="{{ $stripeSetting->secret_key }}">
                </div>
                <button type="submit" class="btn btn-primary">@lang('Update')</button>
            </form>
        </div>
    </div>
</div>
