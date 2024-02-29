{{-- 
<div class="col-12 col-sm-12 col-xs-12 col-md-5 containers ">
        <h1>Exam </h1>
        <form wire:submit.prevent="qustion">
          @csrf
          <div class="row">
            <div class="col-4"></div>
            <div class="sch_exam col-8">
              @if ($scholarship != null)
                @if ($finish == true)
                <div class="radiobtn">git 
                  <b>Total Qustion: {{$total_qustions}}</b>
                </div>
                <div class="radiobtn">
                  <b>Correct Answers: {{$correct_answer}}</b>
                </div>  
                <div class="radiobtn">
                  <button wire:click="saveexam" type="button" class="button">Done</button>
                </div> 
                  
                @else
                @php
                            $shuffledOptions = $this->shuffleOptions([
                                $scholarship->option_1,
                                $scholarship->option_2,
                                $scholarship->option_3,
                                $scholarship->option_4,
                            ]);
                        @endphp
                  <div class="row">
                  <b style="font-size:20px">{{$scholarship->qustion}}</b>
                </div>
                <div class="radiobtn">
                  <input type="radio" wire:model="group"  value="{{$shuffledOptions[0]}} " > {{$shuffledOptions[0]}}  <br>
                </div>
                <div class="radiobtn">
                  <input type="radio" wire:model="group" value="{{$shuffledOptions[1]}}"> {{$shuffledOptions[1]}}  <br>
                </div>
                <div class="radiobtn">
                  <input type="radio" wire:model="group" value="{{$shuffledOptions[2]}} "> {{$shuffledOptions[2]}}  <br>
                </div>
                <div class="radiobtn">
                  <input type="radio" wire:model="group" value="{{$shuffledOptions[3]}}"> {{$shuffledOptions[3]}}  <br>
                </div><br>
                <button  type="submit" class="button ">Next</button>
                @endif
              @else 
            
                <button  type="submit" class="button ">Start</button>
              @endif
            </div>
        </div>
       
      
        </form>
      </div> 
      @livewireScripts --}}

      <div class="row" style="padding: 50px;">
        @if ($finish_exams == true)
        <h3 style="color: green; text-align:center;"> Exam finish</h3>
        <div class="text-center" style="margin-top:100px; ">
          <button  class="btn btn-primary"><a href="https://kpscpositive.in/">Home</a></button>
        </div>
        @else
        <div class="col-7 main_exam " > 
          <form wire:submit.prevent="qustion">
            @if ($scholarship != null)
              @if ($finish == true && $sample == false)
                      {{-- <div class="radiobtn">
                        <b>Total Qustion: {{$total_qustions}}</b>
                      </div> --}}
                      <div class="radiobtn">
                        <b>Exam completed.</b>
                      </div>  
                      <div class="radiobtn">
                        {{-- <button wire:click="saveexam" type="button" class="button">Done</button> --}}
                        <div class=" text-center">
                          <button type="button" id="final_sub" wire:click="saveexam" class="btn btn-success "><p> <i class="fas fa-save"></i>  Final submit</p></button>
                        </div>
                      </div> 
                        
              @else
      
                    {{-- @php
                      $shuffledOptions = $this->shuffleOptions([
                        $scholarship->option_1,
                        $scholarship->option_2,
                        $scholarship->option_3,
                        $scholarship->option_4,
                        ]);
                    @endphp --}}
                  {{-- @dd( $a, $scholarship->qustion, $scholarship) --}}
              <div class="qus_no">  
                <h6>Q {{$a+1}}</h6>
              </div>
              <b> {{$scholarship->qustion}}</b>
              {{-- <i style="color: red">{{$error}}</i> --}}
              <div class="qus_form">
                <div class="radio_btn">
                  <input type="radio" wire:model="group" value="{{$shuffledOptions[0]}}"> {{$shuffledOptions[0]}}
                </div>
                <div class="radio_btn">
                  <input type="radio" wire:model="group" value="{{$shuffledOptions[1]}}"> {{$shuffledOptions[1]}}
                </div>
                <div class="radio_btn">
                  <input type="radio" wire:model="group" value="{{$shuffledOptions[2]}}"> {{$shuffledOptions[2]}}
                </div>
                <div class="radio_btn">
                  <input type="radio" wire:model="group" value="{{$shuffledOptions[3]}}"> {{$shuffledOptions[3]}}
                </div>    
              </div>
              <div class="text-center">
              @if (isset($exam_time))
                  @if ($exam_time->end_time <= now())
                    <button type="button" wire:click="next_btn" class="btn btn-primary" disabled>Next</button>
                  @else
                          <button type="button" wire:click="next_btn" class="btn btn-primary">Next</button>
      
                @endif
            
              @endif
              </div>
              <div class="main_exam_footer"> 
                <!--<button disabled type="button" wire:click="rivew('{{$scholarship->id}}')" class="btn btn" style="background: orange;"> <p>Mark for Review & Next</p></button>-->
                <button type="button" id="final_sub" wire:click="finish_exam" class="btn btn-success " onclick="return confirm('Are you sure confirm submit')"><p> <i class="fas fa-save"></i>  Final submit</p></button>
              </div>
                @endif
            @else 
            <div class=" " style="background-color: #ffff; margin-bottom:10px;">
              <h1 class="right_content " style="color: red;">Important Notice</h1> 
              <ol style="margin-left: 20px;">
                <li><p>You can only attend a maximum of one scholarship exam.</p></li><br>
                <li><p >Do not close or minimize the tab.</p></li><br>
                <li><p >Any malpractice should result in termination from this exam.</p></li><br>
                <li><p >Do not refresh the page after starting the exam.</p></li><br>
              </ol> 
              <div class="text-center">
      
                 @if (isset($exam_time))
                  @if ($exam_time->end_time <= now() || $exam_time->start_time > now())
                    <button id="start_btn" type="submit" class="btn btn-primary"  disabled>Start</button>
                  @else
                    <button id="start_btn" type="submit" class="btn btn-primary"  >Start</button>
                  @endif
                @endif 
      
      
               
              </div>
            </div>
            
            @endif
         
          </form>
        
            
        
        </div> 
        <div class="col-4 main_questin">
            <div class="main_questin_header">
                <h6>QUESTIONS </h6>
                <div class="underline"></div>
            </div>
            <div class="row overflow-auto" style="max-height: 300px;">
                @for ($i = 0; $i < count($attent_status); $i++)
                    @php
                      $item = $attent_status[$i];
                    @endphp
                    <div class="col-3 col-xs-4 list_ques" 
                    @if ($item['status'] == 2)
                      style="background: #7393ff;"
                    @elseif ($item['status'] == 3)
                      style="background: orange;"
                    @endif>
                        <a  @if ($item['status'] == 2)
                              @disabled(true)
                              @else
                              wire:click="select_question('{{$i}}')"
                            @endif>
                            <p>Q {{$i+1}}</p>
                        </a>
                    </div>
                @endfor
            </div>
            <div class="underline"></div>
            <div class="attempt_no">
                <b>Total Questions :{{$total_qustions}} </b>
            </div>
            <div class=" warning">
                <div class=" war_1 "></div><p> Not Answered</p><br>
                <div class="war_2"></div><p> Answered</p><br>
                <!--<div class="war_3"></div><p> Mark for Review</p>-->
            </div>
        </div>
        @endif 
      </div>