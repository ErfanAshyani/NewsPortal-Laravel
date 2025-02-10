<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@hasSection('title') @yield('title') @else {{ $settings['site_seo_title'] }} @endif </title>
    <meta name="description" content="@hasSection('meta_description') @yield('meta_description') @else {{ $settings['site_seo_description'] }} @endif " />
    <meta name="keywords" content="{{ $settings['site_seo_keywords'] }}" />

    <meta name="og:title" content="@yield('meta_og_title')" />
    <meta name="og:description" content="@yield('meta_og_description')" />
    <meta name="og:image" content="@hasSection('meta_og_image') @yield('meta_og_image') @else {{ asset($settings['site_logo']) }} @endif" />
    <meta name="twitter:title" content="@yield('meta_tw_title')" />
    <meta name="twitter:description" content="@yield('meta_tw_description')" />
    <meta name="twitter:image" content="@yield('meta_tw_image')" />

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset($settings['site_favicon']) }}" type="image/png">

    <link href="{{ asset('frontend/assets/css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap-iconpicker.min.css') }}">
    <style>
        :root {
            --colorPrimary: {{ $settings['site_color'] }};
        }

    </style>


    <style id='classic-theme-styles-inline-css' type='text/css'>
        /*! This file is auto-generated */
        .wp-block-button__link{color:#fff;background-color:#32373c;border-radius:9999px;box-shadow:none;text-decoration:none;padding:calc(.667em + 2px) calc(1.333em + 2px);font-size:1.125em}.wp-block-file__button{background:#32373c;color:#fff;text-decoration:none}
    </style>
{{--    <style id='ez-toc-exclude-toggle-css-inline-css' type='text/css'>--}}
{{--        #ez-toc-container input[type="checkbox"]:checked + nav, #ez-toc-widget-container input[type="checkbox"]:checked + nav {opacity: 0;max-height: 0;border: none;display: none;}--}}
{{--    </style>--}}
{{--    <link rel="https://api.w.org/" href="https://hamyar.in/wp-json/" /><link rel="alternate" title="JSON" type="application/json" href="https://hamyar.in/wp-json/wp/v2/posts/15866" /><link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://hamyar.in/xmlrpc.php?rsd" />--}}
{{--    <meta name="generator" content="WordPress 6.6.2" />--}}
{{--    <link rel='shortlink' href='https://hamyar.in/?p=15866' />--}}
{{--    <link rel="alternate" title="oEmbed (JSON)" type="application/json+oembed" href="https://hamyar.in/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fhamyar.in%2F%25d8%25ac%25d9%2588%25d8%25a7%25d8%25a8-%25d8%25af%25d8%25b1%25d8%25b3-3-%25d8%25b9%25d9%2584%25d9%2588%25d9%2585-%25d9%25be%25d9%2586%25d8%25ac%25d9%2585-%25d8%25a7%25d8%25a8%25d8%25aa%25d8%25af%25d8%25a7%25db%258c%25db%258c%2F" />--}}
{{--    <link rel="alternate" title="oEmbed (XML)" type="text/xml+oembed" href="https://hamyar.in/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fhamyar.in%2F%25d8%25ac%25d9%2588%25d8%25a7%25d8%25a8-%25d8%25af%25d8%25b1%25d8%25b3-3-%25d8%25b9%25d9%2584%25d9%2588%25d9%2585-%25d9%25be%25d9%2586%25d8%25ac%25d9%2585-%25d8%25a7%25d8%25a8%25d8%25aa%25d8%25af%25d8%25a7%25db%258c%25db%258c%2F&#038;format=xml" />--}}
{{--    <noscript><style id="rocket-lazyload-nojs-css">.rll-youtube-player, [data-lazy-src]{display:none !important;}</style></noscript><link href="https://hamyar.in/wp-content/themes/hamyarin/favicon.png" rel="shortcut icon">--}}



</head>

<body>

<!-- Global Variables -->
@php
    $socialLinks = \App\Models\SocialLink::where('status', 1)->get();
    $footerInfo = \App\Models\FooterInfo::where('language', getLangauge())->first();
    $footerGridOne = \App\Models\FooterGridOne::where(['status' => 1, 'language' => getLangauge()])->get();
    $footerGridTwo = \App\Models\FooterGridTwo::where(['status' => 1, 'language' => getLangauge()])->get();
    $footerGridThree = \App\Models\FooterGridThree::where(['status' => 1, 'language' => getLangauge()])->get();
    $footerGridOneTitle = \App\Models\FooterTitle::where(['key' => 'grid_one_title', 'language' => getLangauge()])->first();
    $footerGridTwoTitle = \App\Models\FooterTitle::where(['key' => 'grid_two_title', 'language' => getLangauge()])->first();
    $footerGridThreeTitle = \App\Models\FooterTitle::where(['key' => 'grid_three_title', 'language' => getLangauge()])->first();
@endphp

    <!-- Header news -->
@include('frontend.layouts.header')
<!-- End Header news -->

@yield('content')

<!-- Footer Section -->
@include('frontend.layouts.footer')
<!-- End Footer Section -->


<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

<script type="text/javascript" src="{{ asset('frontend/assets/js/index.bundle.js') }}"></script>
@include('sweetalert::alert')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('admin/assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })


    // Add csrf token in ajax request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        /** change language **/
        $('#site-language').on('change', function() {
            let languageCode = $(this).val();
            $.ajax({
                method: 'GET',
                url: "{{ route('language') }}",
                data: {
                    language_code: languageCode
                },
                success: function(data) {
                    if (data.status === 'success') {
                        window.location.href = "{{ url('/') }}";
                    }
                },
                error: function(data) {
                    console.error(data);
                }
            })
        })


        /** Subscribe Newsletter**/
        $('.newsletter-form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: "{{ route('subscribe-newsletter') }}",
                data: $(this).serialize(),
                beforeSend: function() {
                    $('.newsletter-button').text('loading...');
                    $('.newsletter-button').attr('disabled', true);
                },
                success: function(data) {
                    if (data.status === 'success') {
                        Toast.fire({
                            icon: 'success',
                            title: data.message
                        })
                        $('.newsletter-form')[0].reset();
                        $('.newsletter-button').text('sign up');

                        $('.newsletter-button').attr('disabled', false);
                    }
                },
                error: function(data) {
                    $('.newsletter-button').text('sign up');
                    $('.newsletter-button').attr('disabled', false);

                    if (data.status === 422) {
                        let errors = data.responseJSON.errors;
                        $.each(errors, function(index, value) {
                            Toast.fire({
                                icon: 'error',
                                title: value[0]
                            })
                        })
                    }
                }
            })
        })
    })
</script>



@stack('content')

</body>

</html>
