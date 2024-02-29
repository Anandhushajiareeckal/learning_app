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
                                <h2>{{__('Scholarship')}}</h2>
                            </div>
                        </div>
                        <div class="breadcrumb__content__right">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('Dashboard')}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{__('Scholarship')}}</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="customers__area bg-style mb-30">
                        <div class="item-title d-flex justify-content-between">
                            <h2>{{__('Subcategories')}}</h2>
                            <a href="{{route('admin.scholarship_add')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> {{__('Add Scholarship')}} </a>
                        </div>
                        <div class="customers__table">
                            <table id="customers-table" class="row-border data-table-filter table-style">
                                <thead>
                                <tr>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Icon')}}</th>
                                    <th>{{__('Exam')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($scholarship as $data)
                                    <tr class="removable-item">

                                        <td>
                                            {{$data->heading}}
                                        </td>
                                        <td><img src="{{$data->icon}}" alt="image" style="max-height: 4em; width: auto;"></td>
                                        <td>
                                            <a href="/admin/scholarships/exams/{{$data->id}}    "><button class="btn btn-info" >Open</button></a>
                                        </td>
                                        <td>
                                            <div class="action__buttons">
                                                <a href="/admin/scholarships/edit/{{$data->id}}" class="btn-action" title="Edit">
                                                    <img src="{{ asset('admin/images/icons/edit-2.svg') }}" alt="edit">
                                                </a>
                                                
                                                <a href="javascript:void(0);" data-url="/admin/scholarships/delete/{{$data->id}}" class="btn-action delete" title="Delete">
                                                    <img src="{{asset('admin/images/icons/trash-2.svg')}}" alt="trash">
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{-- {{$subcategories->links()}} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Page content area end -->
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('admin/css/jquery.dataTables.min.css')}}">
@endpush

@push('script')
    <script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/js/custom/data-table-page.js')}}"></script>
@endpush
