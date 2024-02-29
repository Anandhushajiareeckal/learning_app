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
                           
                        </div>
                        <div class="customers__table">
                            <table class="myDataTable1 table table-hover align-middle mb-0" style="width: 100%;text-align:center;">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th> 
                                        <th>Wrong Ans</th>
                                        <th>Correct Ans</th>
                                        <th>Total Questions Attend</th>
                                        <th>View Answers</th>
    
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                <?php  
                                    foreach($exm_res as $key =>  $res){ 
                                        $key = $key +1;
                                        echo  "<tr><td>".$key ."</td>";
                                        echo  "<td>".$res->user->name."</td>";
                                        $wrong_answer   = 0;
                                        $correct_answer = 0;
                                      foreach($res->user->results as $row ) {
                                        if($row->result == 0)
                                            $wrong_answer = $wrong_answer +1;
                                        else 
                                            $correct_answer = $correct_answer +1;
                                      }
                                      echo  "<td>".$wrong_answer."</td>";
                                      echo  "<td>".$correct_answer."</td>";
                                      echo   "<td>".$wrong_answer+$correct_answer ."</td>";
    
                                      ?>
                                       
                                       <td> <a href="{{  route('admin.exam_details',['id' =>$res->user->id])}}" class="btn btn-primary">View Result</a></td></tr> 
    
                                      <?php
                                     
                                      
                                    }
                                      
                                 ?>  
                                    
    
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
        $('.myDataTable1').DataTable({
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
