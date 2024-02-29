@extends('frontend.layouts.app')

@section('content')
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
           
        </div>
    </div>
</section>
@endsection