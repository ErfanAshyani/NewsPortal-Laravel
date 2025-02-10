@extends('frontend.layouts.master')




@section('content')
    <!-- Tranding news  carousel-->
    @include('frontend.home-components.breaking-news')
    <!-- End Tranding news carousel -->

    <!-- Hero news -->
    @include('frontend.home-components.hero-slider')
    <!-- End Hero news -->

    <div class="large_add_banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="large_add_banner_img">
                        <a target="_blank" href="{{$ad->home_top_bar_ad_url}}"><img src="{{$ad->home_top_bar_ad}}" alt="adds"></a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular news category -->
    @include('frontend.home-components.main-news')
    <!-- End Popular news category -->

@endsection
