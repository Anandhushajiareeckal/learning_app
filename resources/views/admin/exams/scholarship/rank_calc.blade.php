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
                            <h2>{{__('Exam Questions')}}</h2>
                            
                        </div>
                        <div class="customers__table">
                            <table id="customers-table" class="row-border data-table-filter table-style">
                                <thead>
                                <tr>
                                    <th>{{__('Id')}}</th>
                                    <th>{{__('Scholarship')}}</th>
                                    <th>{{__('Options   ')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @for($i=0; $i < count($scholarship); $i++)
                                        @php
                                            $item = $scholarship[$i];
                                        @endphp
                                        <tr>
                                            <td>{{$i+1}}</td>
                                            <td>{{$item->heading}}</td> 
                                            <td>
                                                <a href="{{  route('admin.rank_calculate',['id' =>$item->id])}}" class="btn btn-xs btn-info">Calculate Rank</a>
                                                <a href="{{  route('admin.view_rank_list',['id' =>$item->id])}}" class="btn btn-xs btn-info">View Rank List</a>
                                            
                                            </td>
                                        </tr>
                                    @endfor 
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
