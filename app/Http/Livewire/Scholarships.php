<?php

namespace App\Http\Livewire;
use App\Models\scholarship;
use App\Models\scholarship_exam;
use App\Models\scholarship_reg;
use App\Models\Exam_time;
use GuzzleHttp\Psr7\Request;
use Livewire\Component;
use App\Models\scholarship_attend;
use App\Models\scholarship_result;
use Termwind\Components\Raw;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Scholarships extends Component
{
    public $scholarship = null;//to find which scholarship
    public $a = 0;//for question array operation
    public $idd; //
    public $group; //cheack box input 
    public $finish = false; // to cheack the exam is finish or not
    public $total_qustions;// total question count
    public $correct_answer = 0;// to count total correct answer
    public $attent_status = []; // to check question is answered or not (1,2,3)
    public $cheack= 1;
    public $exam_time;
    public $riv = false;
    public $exam_status = false;
    public $scholarship_res;
    public $sample = false;
    public $finish_exams = false;
    public $sta = true;
    public $next = false;
    public $rel_chek = true;
    public $shuffledOptions;
    // public $hide_next = false;
    //To save the exam after finish exam 
    public function saveexam()
    {
     
        // dd($this->group);
        // Log::info('Showing user profile for user: '.$this->group);
        // $scholarship_reg = scholarship_reg::where('email', Auth::user()->email)->first();
        // $scholarship_reg->scholarship = $this->id;
        // $scholarship_reg->marck = $this->correct_answer . "/" . $this->total_qustions;
        // $scholarship_reg->save();
        $user = Auth::user()->id;
        $scholarship_result = new scholarship_result();
        $scholarship_result->attend_id =$user;
        $scholarship_result->question = $this->scholarship->qustion;
        $scholarship_result->question_id = $this->scholarship->id;
        $scholarship_result->answer = $this->group;
        if($this->group == $this->scholarship->option_1){
            $scholarship_result->result = true;
        }
        else{
            $scholarship_result->result = false;
        }
        // $scholarship_result->exam_status = 2;

        $scholarship_result->save();

        // $this->finish = true;

  

    }
    
    public function finish_exam()
    {
        // Check if the record already exists
        $existingRecord = scholarship_attend::where('user_id', Auth::user()->id)
            ->where('scholarship', $this->idd)
            ->first();
    
        if ($existingRecord) {
            // Record already exists, no need to save again
            return redirect('https://kpscpositive.in/');
        }
    
        // Create and save the new record
        $scholarship_attend = new scholarship_attend();
        $scholarship_attend->user_id = Auth::user()->id;
        $scholarship_attend->scholarship = $this->idd;
        $scholarship_attend->save();
    
        return redirect('https://kpscpositive.in/');
    }
    

    public function select_question($id)
    {
        $this->a = $id;

        $data = scholarship_exam::where('scho_id', $this->idd)->get();
        $this->scholarship = $data[$this->a];
        $this->qustion();
    }

    public function rivew($id)
    {
         for ($i = 0; $i < count($this->attent_status); $i++) {
            $item = $this->attent_status[$i];
            
            // Check if 'id' key exists in the subarray
            if (isset($item['id']) && $item['id'] == $id) {
                $this->attent_status[$this->a]['status'] = 3;
                // $this->finish_exam();
                break;
            }
        }
        $this->qustion(); 
    }


    public function next_btn(){
        $this->next = true;
        $this->qustion();
    }




    public function check_attends(){
        $data = scholarship_exam::where('scho_id', $this->idd)->get();
        $scholarship_results = scholarship_result::where('attend_id', Auth::user()->id)->get();
        $scholarship_results_id = [];
        
        foreach ($data as $val){
            $data_id[] = $val->id;
        }
        
        if($scholarship_results){
            foreach($scholarship_results as $res){
                $scholarship_results_id[] = $res->question_id;
            }
            $difference = array_diff($data_id, $scholarship_results_id);
            if(empty($difference)){ 
                return redirect('https://www.facebook.com/');
            }
            else{
                for($i = 0; $i<count($this->attent_status); $i++){
                    if($this->attent_status[$i]['status'] == 1 ){
                        $this->a = $i -1;
                        $this->rel_chek = false;
                        break;
                    }
                }
            }
        }
    }
    
    

















    public function qustion()
    {        

        $data = scholarship_exam::where('scho_id', $this->idd)->get();
        if ($this->group == null && $this->cheack == 1) {   
            for ($i = 0; $i < count($data); $i++) {
                $item = $data[$i];
                $this->attent_status[$i] = [
                    'id' => $item->id,
                    'status' => 1,
                    'qno'=>$i
                ];
            }
            $user = Auth::user()->id;
            $this->scholarship_res = scholarship_result::where('attend_id', $user)->get();
        }
        


        $scholarship_r = scholarship_result::all();

        foreach ($scholarship_r as $items) {
            if (Auth::user()->id == $items->attend_id) {
                for($i = 0; $i<count($this->attent_status); $i++){
                    if($this->attent_status[$i]['id'] == $items->question_id){
                        $this->attent_status[$i]['status'] = 2;
                    }
                }
            }
            
        }

        

        if($this->rel_chek == true){
            for($i = 0; $i<count($this->attent_status); $i++){
                if($this->attent_status[$i]['status'] == 1 ){
                    $this->a = $i;
                    $this->rel_chek = false;
                    break;
                }
            }
        }

        
        


        $this->total_qustions = count($data);
        if($this->sample == false && $this->a <= count($data)){
            $this->scholarship = $data[$this->a];
        }
        if ($this->a > count($data) &&  $this->sample == false) {
            $this->finish = true;
            return;
        }
        
        for($i = 0; $i < count($this->attent_status)-1;$i++){
            $item = $this->attent_status[$i];
            if($item['id'] == $this->scholarship['id']  ){
                Log::info($this->scholarship['id'].'  scholo loop');
                Log::info($item['id'].'  item loop');
                Log::info($item['status'].'  status loop');
                if($item['status'] == 2 ){
                     $this->a++;
                    Log::info('attended');
                    $this->qustion();
                }
                elseif($item['status'] == 1){
                    // Log::info('break');
                    break;
                }
            }
        }

        $cheack_finish = 0;
        for($i = 0; $i < count($this->attent_status);$i++){
            $item = $this->attent_status[$i];
            if($item['status'] == 2){
                $cheack_finish++;
            }
        }
        if($cheack_finish  === count($this->attent_status)){
            // Log::info('Exam finish');
            $this->finish_exam();
        }

        if(count($this->attent_status) == $this->a+1 && isset($this->group )){
            $this->check_attends();
        }
        
       

        if ($this->a >= count($data) - 1 && $this->group != null) {
            $user = Auth::user()->id;
            $ans =array();
            $result =array();
            $this->scholarship_res = scholarship_result::select('question_id')->where('attend_id', $user)->get();
            foreach( $data as $row ){
                $ids[]= $row->id ;
            }
            foreach($this->scholarship_res as $value){
                $ans[] = $value->question_id;
            }
            if(!empty($ans)){
                $result = array_diff($ids, $ans);

            }
            if(!empty($result)){
                foreach($result as $item){
                    // dd($data[1]);
                    // $this->scholarship = scholarship_exam::where('id', $item)->first();

                    // $this->scholarship = scholarship_exam::all();
                }
                $this->finish = false;
                $this->sample = true;
            }
         
        }

        if(isset($this->group ) && $this->next == true){
            $this->saveexam();
        }

        if($this->a > count($data) && $this->exam_status == false && $this->sample == false){
            $this->finish =true;//to cheack the exam is finish or not
            $this->total_qustions = count($data);//Count total number of questions
            $this->correct_answer;
            //cheack the answer is correct or not.
            // if($this->group == $this->scholarship->option_1){
            //     $this->correct_answer++ ;
            // }
        }
        
        else{

            if(isset($this->group ) && $this->a < count($data)-1){
                for($i = 0; $i<count($this->attent_status); $i++){
                    

                    if($this->a == count($this->attent_status)-1 && $this->attent_status[$this->a]['status'] == 2){
                        $this->check_attends();
                    }
                    if($this->attent_status[0]['status'] == 1){
                        $this->a++;
                        break;
                    }
                    elseif($this->attent_status[$i]['status'] == 2){
                        $this->a++;
                        break;
                        
                    }
                }
                
            }
            elseif(isset($this->group ) && $this->exam_status == false && $this->sample == false){
                // $this->finish =true;


            }
            if($this->a > $this->total_qustions && $this->exam_status == false && isset($this->group ) && $this->sample == false){
                $this->finish = true;

            }
            elseif($this->a < count($data) && $this->sample == false ){
                $this->scholarship = $data[$this->a];

            }
           
            
        }

        if($this->a === count($this->attent_status)-1 && $this->attent_status[$this->a]['status'] === 2){
            for($i = 0 ; $i < count($this->attent_status); $i++ ){
                
                $values = $this->attent_status[$i];
                if($values['status'] == 1){
                    // dd($i);
                    $this->a = $i;
                    break;
                }
            }
        }

        $this->group = null;
        $this->cheack = 2;
        $this->next = false;
        // $this->hide_next = false;

        $this->shuffledOptions = $this->shuffleOptions([
            $this->scholarship->option_1,
            $this->scholarship->option_2,
            $this->scholarship->option_3,
            $this->scholarship->option_4,
            ]);
    }



    public function shuffleOptions($options)
    {
        //  Log::info('Showing user profile for user: ');

        shuffle($options);
        return $options;
    }

    public function render()
    {

        $this->exam_time = Exam_time::where('scho_id', $this->idd)->first();
        return view('livewire.scholarships',[
            'scholarship'=>$this->scholarship,
            'abc'=>$this->group,
            'finish'=>$this->finish,
            'attent_status'=>$this->attent_status,
            'a'=>$this->a,
            'total_qustions'=>$this->total_qustions,
            'exam_time' => $this->exam_time,
            'sample' => $this->sample,
            'finish_exams'=>$this->finish_exams,
        ]);
    }
}
