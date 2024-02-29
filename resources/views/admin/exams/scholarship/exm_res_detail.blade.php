@extends('layouts.admin')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

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
                            <h2>{{__('Exam Result')}}</h2>
                            {{-- <button type="button"  class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModalLive" style="margin-right:20px;">Exam Time</button>
                            <a href="" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> {{__('Add Question')}} </a> --}}
                        </div>
                        <div class="customers__table">
                            <table class="myDataTable2 table table-hover align-middle mb-0" style="width: 100%;text-align:center;">
                                <thead>
                                <tr>
                                    <th>{{__('SI')}}</th>
                                    <th>{{__('Question')}}</th>
                                    <th>{{__('Answer')}}</th>
                                    <th>{{__('Correct / Wrong ')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($exm_res as $row)
                                    @foreach ( $row->results as $key => $res)
                                        <tr class="removable-item">

                                            <td>
                                                {{$key + 1}}
                                            </td>

                                            <td>
                                                {{$res->question}}
                                            </td>

                                            <td>
                                                {{$res->answer}}
                                            </td>
                                            @if ($res->result == 1)
                                                <td>correct</td>
                                            @else
                                                <td>Wrong</td>
                                            @endif
                                        </tr>
                                    @endforeach
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

@endpush

@push('script')

    <script>
        $(document).ready(function() {
            $('.myDataTable2').DataTable({
                // Your DataTable options here
                "paging": true, // Enable paging
                // Add other options as needed
                "buttons": [ 'csv', 'excel', 'pdf' ] // Enable export buttons
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
@endpush
