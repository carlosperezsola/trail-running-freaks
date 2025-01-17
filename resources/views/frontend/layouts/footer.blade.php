@php
    $footerInfo = Cache::rememberForever('footer_info', function () {
        return \App\Models\FooterInfo::first();
    });
    $FooterSocial = Cache::rememberForever('footer_socials', function () {
        return \App\Models\FooterSocial::where('status', 1)->get();
    });
    $footerGridLinks = Cache::rememberForever('footer_grids', function () {
        return \App\Models\FooterGrid::where('status', 1)->get();
    });
@endphp
<footer class="footer_2">
    <div class="container">
        <div class="row justify-content-md-between">
            <div class="col-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                <div class="trf__footer_content">
                    <a class="trf__footer_2_logo" href="{{ url('/') }}">
                        <img src="{{ asset(@$footerInfo->logo) }}" alt="logo">
                    </a>
                    <a class="action" href="callto:{{ @$footerInfo->phone }}">
                        <p><i class="fas fa-phone-alt me-3 fa-fw me-3 fa-fw"></i>{{ @$footerInfo->phone }}</p>
                    </a>
                    <a class="action" href="mailto:{{ @$footerInfo->email }}">
                        <p><i class="far fa-envelope me-3 fa-fw"></i>{{ @$footerInfo->email }}</p>
                    </a>
                    <p>
                        <i class="fal fa-map-marker-alt me-3 fa-fw"></i>{{ @$footerInfo->address }}
                    </p>
                    <ul class="trf__footer_social">
                        @foreach ($FooterSocial as $link)
                            <li><a class="behance" target="_blank" href="{{ $link->url }}"><i
                                        class="{{ $link->icon }}"></i></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-2 col-xl-2 my-4 my-lg-0">
                <div class="trf__footer_content">
                    <h5>General Info</h5>
                    <ul class="trf__footer_menu">
                        @foreach ($footerGridLinks as $link)
                            <li><a target="_blank" href="{{ route($link->url) }}"><i class="fas fa-caret-right"></i>
                                    {{ $link->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-5 col-xl-4 mt-4 mt-lg-0">
                <div class="trf__footer_content trf__footer_content_2">
                    <h3>@lang('Subscríbete a nuestra Newsletter')</h3>
                    <p>@lang('Get all the latest information on Events, Sales and Offers.
                        Get all the latest information on Events.')</p>
                    <form action="" method="POST" id="newsletter">
                        @csrf
                        <input type="text" placeholder="Email" name="email" class="newsletter_email">
                        <button type="submit" class="common_btn subscribe_btn">@lang('Subscribe')</button>
                    </form>
                    <div class="footer_payment">
                        <p>@lang('We\'re using safe payment for:')</p>
                        <img src="{{ asset('frontend/images/credit2.png') }}" alt="card" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="trf__footer_bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="trf__copyright d-flex justify-content-center">
                        <p>{{ @$footerInfo->copyright }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
