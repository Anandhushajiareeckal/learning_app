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
                                <h2>{{__('Add Exam')}}</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('Dashboard')}}</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('subcategory.index')}}">{{__('Scholarship')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{__('Add Exam')}}</li>
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
                                <h2>{{__('Add Exam')}}</h2>
                            </div>
                            <form action="{{route('admin.mock_exam_store',['id'=>$id])}}" method="post" enctype="multipart/form-data">
                                @csrf

                             
                                <div class="input__group mb-25">
                                    <label for="name"> {{__('Question')}} </label>
                                    <div>
                                        <input type="text" name="qustion" id="name"  class="form-control" placeholder="{{__('Question')}} " required>
                                       
                                    </div>
                                </div>

                                <div class="input__group mb-25">
                                    <label>{{ __('Answer') }}</label>
                                    <input type="text" name="option_1"  placeholder="{{ __('Answer') }}" class="form-control" required> 
                                   
                                </div>

                                <div class="input__group mb-25">
                                    <label>{{ __('Solution') }}</label>
                                    <input type="text" name="solution"  placeholder="{{ __('solution') }}" class="form-control" required> 
                                   
                                </div>

                                <div class="input__group mb-25">
                                    <label>{{ __('Option') }}</label>
                                    <input type="text" name="option_2"  placeholder="{{ __('Option') }}" class="form-control" required>
                                   
                                </div>

                                <div class="input__group mb-25">
                                    <label>{{ __('Option') }}</label>
                                    <input type="text" name="option_3"  placeholder="{{ __('Option') }}" class="form-control" required>
                                  
                                </div>

                                <div class="input__group mb-25">
                                    <label>{{ __('Option') }}</label>
                                    <input type="text" name="option_4"  placeholder="{{ __('Option') }}" class="form-control" required>
                                   
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

