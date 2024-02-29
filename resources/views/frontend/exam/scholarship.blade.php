@extends('frontend.layouts.app')
@section('meta')
    @php
        $metaData = getMeta('forum');
    @endphp

    <meta name="description" content="{{ $metaData['meta_description'] }}">
    <meta name="keywords" content="{{ $metaData['meta_keyword'] }}">

    <!-- Open Graph meta tags for social sharing -->
    <meta property="og:type" content="Learning">
    <meta property="og:title" content="{{ $metaData['meta_title'] }}">
    <meta property="og:description" content="{{ $metaData['meta_description'] }}">
    <meta property="og:image" content="{{ $metaData['og_image'] }}">
    <meta property="og:url" content="{{ url()->current() }}">

    <meta property="og:site_name" content="{{ get_option('app_name') }}">

    <!-- Twitter Card meta tags for Twitter sharing -->
    <meta name="twitter:card" content="Learning">
    <meta name="twitter:title" content="{{ $metaData['meta_title'] }}">
    <meta name="twitter:description" content="{{ $metaData['meta_description'] }}">
    <meta name="twitter:image" content="{{ $metaData['og_image'] }}">
@endsection
@section('content')
    <div class="">
        <!-- Consultation Page Header Start -->
        <header class="page-banner-header gradient-bg position-relative">
            <div class="section-overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-7">
                            <div class="page-banner-content forum-banner-content">
                                <h3 class="page-banner-heading text-white pb-15">{{ __('Forum') }}</h3>
                                <div class="forum-banner-search-ask-wrap d-flex align-items-center">
                                    <div class="input-group position-relative">
                                        <input class="form-control border-0 bg-transparent searchForumBar" type="search"
                                            placeholder="{{ __('Type to search for solutions...') }}">
                                        <button class="bg-transparent border-0"><span class="iconify"
                                                data-icon="akar-icons:search"></span></button>

                                        <!-- Search Bar Suggestion Box Start -->
                                        <div class="search-bar-suggestion-box searchBlogBox custom-scrollbar searchForumBox d-none">
                                            <ul class="appendForumSearchList">

                                            </ul>
                                        </div>
                                        <!-- Search Bar Suggestion Box End -->
                                    </div>

                                    <p class="font-24 font-medium text-white px-4">{{ __('or') }}</p>
                                    <a href="{{ route('forum.askQuestion') }}"
                                        class="theme-button1">{{ __('Ask a Question') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="forum-banner-right-img">
                                <img src="{{ asset('frontend/assets/img/forum-banner-right-img.png') }}" alt="lmszai forum"
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Consultation Page Header End -->

        <!-- Special Feature / Forum Categories Area Start -->
        <section class="special-feature-area forum-categories-area section-t-space section-b-85-space bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title ">
                            <h3 class="section-heading">{{ __('Forum Categories') }}</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($forumCategories as $forumCategory)
                        <!-- Single Feature Item start-->
                        <div class="col-md-4">
                            <div class="single-feature-item d-flex align-items-center">
                                <div class="flex-shrink-0 feature-img-wrap">
                                    <a href="{{ route('forum.forumCategoryPosts', $forumCategory->uuid) }}"><img
                                            src="{{ getImageFile($forumCategory->logo) }}" alt="feature"></a>
                                </div>
                                <div class="flex-grow-1 ms-3 feature-content">
                                    <h6><a
                                            href="{{ route('forum.forumCategoryPosts', $forumCategory->uuid) }}">{{ $forumCategory->title }}</a>
                                    </h6>
                                    <p>{{ Str::limit($forumCategory->subtitle, 70) }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Single Feature Item End-->
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Special Feature / Forum Categories Area End -->
    </div>
    <input type="hidden" class="renderForumCategoryPostsRoute" value="{{ route('forum.renderForumCategoryPosts') }}">
    <input type="hidden" class="searchForumRoute" value="{{ route('forum.search-forum.list') }}">
@endsection

@push('script')
    <script>
        'use strict'

        $(document).on('change', '.forumCategory', function() {
            var forum_category_id = this.value;
            var renderForumCategoryPostsRoute = $('.renderForumCategoryPostsRoute').val();
            $.ajax({
                type: "GET",
                url: renderForumCategoryPostsRoute,
                data: {
                    "forum_category_id": forum_category_id,
                },
                datatype: "json",
                success: function(response) {
                    $('.appendForumCategoryPosts').html(response)
                }
            });
        });

        $(document).keyup('.searchForumBar',function() {
            var title = $('.searchForumBar').val()
            var searchForumRoute = $('.searchForumRoute').val()
            console.log(searchForumRoute, title)

            if (title) {
                $('.searchForumBox').removeClass('d-none')
                $('.searchForumBox').addClass('d-block')
            } else {
                $('.searchForumBox').removeClass('d-block')
                $('.searchForumBox').addClass('d-none')
            }

            $.ajax({
                type: "GET",
                url: searchForumRoute,
                data: {'title': title},
                success: function (response) {
                    $('.appendForumSearchList').html(response);
                }
            });
        });

    </script>
@endpush
