@extends('frontend.layouts.app')
@section('content')
<div class>
    <header class="page-banner-header gradient-bg position-relative">
        <div class="section-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-7">
                        <!-- <div class="page-banner-content forum-banner-content">
                            <h3 class="page-banner-heading text-white pb-15">Forum</h3>
                            <div class="forum-banner-search-ask-wrap d-flex align-items-center">
                                <div class="input-group position-relative">
                                    <input class="form-control border-0 bg-transparent searchForumBar" type="search"
                                        placeholder="Type to search for solutions...">
                                    <button class="bg-transparent border-0"><span class="iconify"
                                            data-icon="akar-icons:search"></span></button>

                                    <div
                                        class="search-bar-suggestion-box searchBlogBox custom-scrollbar searchForumBox d-none">
                                        <ul class="appendForumSearchList">
                                        </ul>
                                    </div>

                                </div>
                                <p class="font-24 font-medium text-white px-4">or</p>
                                <a href="forum/ask-a-question.html" class="theme-button1">Ask a Question</a>
                            </div>
                        </div> -->
                    </div>
                    <div class="col-md-5">
                        <div class="forum-banner-right-img">
                            <img src="frontend/assets/img/forum-banner-right-img.png" alt="lmszai forum"
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
                        <h3 class="section-heading">Scholarship Categories</h3>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($scholarship as $item)
                    <div class="col-md-4">
                        <div class="single-feature-item d-flex align-items-center">
                            <div class="flex-shrink-0 feature-img-wrap">
                                <a href="{{$link->subdomain}}/mock_questions/{{$item->id}}"><img src="{{$item->icon}}" alt="feature" style="width: 80px; height:80px;"></a>
                            </div>
                            <div class="flex-grow-1 ms-3 feature-content">
                                <h6><a href="{{$link->subdomain}}/mock_questions/{{$item->id}}">{{$item->heading}}</a>
                                </h6>
                                <p>{{$item->description}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach


                


                


               


                

            </div>
        </div>
    </section>

</div>
<input type="hidden" class="renderForumCategoryPostsRoute" value="forum/render-forum-category-posts.html">
<input type="hidden" class="searchForumRoute" value="forum/search-forum-list.html">

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
