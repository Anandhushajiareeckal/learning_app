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
                                <h2>{{__('Add Scholarship')}}</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('Dashboard')}}</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('subcategory.index')}}">{{__('Quiz')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{__('Add Quiz')}}</li>
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
                                <h2>{{__('Add Quiz')}}</h2>
                            </div>
                            <form action="{{route('admin.quiz_store',)}}" method="post" enctype="multipart/form-data">
                                @csrf


                                <div class="input__group mb-25">
                                    <label for="name"> {{__('Heading')}} </label>
                                    <div>
                                        <input type="text"  name="heading" id="name"  class="form-control" placeholder="{{__('Heading')}} ">
                                        @if ($errors->has('name'))
                                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="input__group mb-25">
                                    <label>{{ __('Description') }}</label>
                                    <input type="text"   name="description"  placeholder="{{ __('Description') }}" class="form-control">
                                    @if ($errors->has('meta_title'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('meta_title') }}</span>
                                    @endif
                                </div>
                             
                                <div class="input__group mb-25">
                                    <label>{{ __('Image') }}</label>
                                    <div class="upload-img-box" style="width: 100px; height:100px;">
                                        <img src="">
                                        <input type="file" name="image" id="og_image" accept="image/*" onchange="previewFile(this)">
                                        <div class="upload-img-box-icon">
                                            <i class="fa fa-camera"></i>
                                            <p class="m-0">{{__('Image')}}</p>
                                        </div>
                                    </div>
                                    @if ($errors->has('og_image'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('og_image') }}</span>
                                    @endif
                                    <p><span class="text-black">{{ __('Accepted Files') }}:</span> PNG, JPG <br> <span class="text-black">{{ __('Recommend Size') }}:</span> 60 x 60</p>
                                </div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                                {{-- <div class="input__group">
                                    <div>
                                       @saveWithAnotherButton
                                    </div>
                                </div> --}}
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

