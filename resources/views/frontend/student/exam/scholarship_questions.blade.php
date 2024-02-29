@extends('frontend.layouts.app')
<style>
.containers {
    /* width: 500px; */
    padding: 67px;
    margin-top: 0px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 20px;
    background-color: #fff;
    margin-left: 70px;
  }
  
  h1 {
    text-align: center;
    padding-bottom: 35px;
   
  
  }
  .right_content{
      padding-top: 50px;
  }
  .question {
    font-weight: bold;
    margin-bottom: 10px;
   
  }
  
  .options {
    margin-bottom: 20px;
  }
  
  .option {
    display: block;
    margin-bottom: 22px;
   
  }
  
  .radiobtn{
    padding-top: 20px;
  }

  .sch_exam{
    /* padding-left: 150px; */
  }
 
  .button {
    display: inline-block;
    padding: 7px 20px;
    background-color: #428bca;
    color: #fff;
    border: none;
    cursor: pointer;
    font-size: 16px;
    border-radius: 4px;
    transition: background-color 0.3s;
    /* margin-right: 10px; */
    /* margin-left: 150px; */

  }
  
  .button:hover {
    background-color: #3071a9;
  }
  
  .result {
    text-align: center;
    margin-top: 20px;
    font-weight: bold;
  }
  
  .hide{
    display: none;
  }
  .exam_tim{
  text-align: center;
  font-size: 60px;
  margin-top: 0px;
}
  @media only screen and (max-width: 768px) {
      .main_right_content {
      margin-top: 40px;
    }
  }    
   
  </style>
  @section('content')
  <script>
//       window.addEventListener('beforeunload', function (e) {
//           const confirmationMessage = 'Are you sure you want to leave?';

//           // Standard way of handling modern browsers
//           e.returnValue = confirmationMessage;

//           // For older browsers
//           return confirmationMessage;
//       });

//       // Optional: Handle tab switch
//       document.addEventListener('visibilitychange', function () {
//           if (document.visibilityState === 'hidden') {
//               // The tab is becoming hidden (user is switching tabs)
//               alert('Warning: You are leaving the page.');
//           }
//       });
//     </script>

<header class="page-banner-header gradient-bg position-relative">
    <div class="section-overlay">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                    <div class="page-banner-content text-center">
                        <h3 class="page-banner-heading text-white pb-15">Scholarship Exam</h3>

                        {{-- <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item font-14"><a href="/">Home</a></li>
                                <li class="  active" >Scholarship Exam</li>
                            </ol>
                        </nav> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="bg-page">
<section class="contact-page-area section-t-space">
  <div class="container"> 
  @if (isset($exam_time))
    @if($exam_time->start_time < now())
    <p id="demo" class="exam_tim"></p>
    @endif
  @endif

      {{-- <div class="col-10 col-md-4 col-sm-10 col-xs-12 " style="background-color: #ffff; margin-left: 40px;">
        <h1 class="right_content ">Important Notice</h1> 
        <ol>
          <li><p style="color: red;">You can only attend a maximum of one scholarship exam.</p></li><br>
          <li><p style="color: red;">Do not close or minimize the tab.</p></li><br>
          <li><p style="color: red;"style="color: red;">Any malpractice should result in termination from this exam.</p></li><br>
          <li><p style="color: red;">Do not refresh the page after starting the exam.</p></li><br>
        </ol> 
      </div> --}}
      <livewire:scholarships :idd="$id"  />
      
    
  </div>
</section>


</div>
</div>
@livewireScripts  


@if (isset($exam_time))
<script>
  // Set the date we're counting down to
  var countDownDate = new Date("<?=$exam_time->end_time?>").getTime();
  console.log(countDownDate);
  // Update the count down every 1 second
  var x = setInterval(function() {
  
    // Get today's date and time
    var now = new Date().getTime();
      
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
      
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
      
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
      
    // If the count down is over, write some text 
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("demo").innerHTML = "EXPIRED";
      var final_submit = document.getElementById("final_sub");
      final_submit.click();
     }
  
  }, 1000);
  
  
  </script> 
@endif

@endsection