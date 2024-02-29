@extends('layouts.admin')

@section('content')
    <!-- Page content area start -->
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb__content">
                        <div class="breadcrumb__content__left">
                            <div class="breadcrumb__title">
                                <h2>{{__('Add Links')}}</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('Dashboard')}}</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('subcategory.index')}}">{{__('Scholarship')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{__('Add Links')}}</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-vertical__item bg-style">
                            <div class="item-top mb-30">
                                <h2>{{__('Add Links')}}</h2>
                            </div>
                            <form action="{{route('admin.link-store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                             
                                <div class="input__group mb-25">
                                    <label for="name"> {{__('Base URL')}} </label>
                                    <div>
                                        <input type="text" value="{{$link->base_url}}"  name="base_url" id="base_url"  class="form-control" placeholder="{{__('Base URL')}} " required>
                                       
                                    </div>
                                </div>

                                <div class="input__group mb-25">
                                    <label>{{ __('Subdoman') }}</label>
                                    <input type="text" name="subdomain"  value="{{$link->subdomain}}" placeholder="{{ __('Subdoman') }}" class="form-control" required> 
                                   
                                </div>

                                <button class="btn btn-primary" type="submit">Submit</button>

                                
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <!-- Page content area end -->
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('admin/css/custom/image-preview.css')}}">
@endpush

@push('script')
    <script src="{{asset('admin/js/custom/image-preview.js')}}"></script>
@endpush

