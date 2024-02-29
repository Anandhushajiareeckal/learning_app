<?php

namespace App\Http\Controllers\Student;
use App\Models\Exam_time;
use App\Models\scholarship_attend;
use App\Models\scholarship;
use App\Models\quiz_cat;
use App\Models\mock_cat;
use App\Models\linkk;
use App\Models\scholarship_reg;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
class ExamController extends Controller
{
    public function index(){
      
    }

    public function scholarships() {
        $link = linkk::first();
        $scholarship = scholarship::all();
        $scholarship_attend = scholarship_attend::all();
        $user = urlencode(Crypt::encryptString(Auth::user()->id));
        foreach ($scholarship_attend as $data) {
            if($data->user_id == $user){
                return redirect('/');
            }
        }
        return view('frontend.student.exam.scholarship_list',['scholarship'=>$scholarship, 'user'=>$user,'link'=>$link]);

    }


    public function scholarships_registration(){
        $reg                = false;
        $scholarships_user  = scholarship_reg::all();
        $scholarship = scholarship::all();
        foreach($scholarships_user as $item){
            if ($item->email == Auth::user()->email){
                $reg = true;
                return redirect('/student/scholarship_list');
            }
        }
        return view('frontend.student.exam.registration',['reg'=>$reg, 'scholarship'=>$scholarship]);   
    }
    
    public function scholarship_questions(string $id) {
        $exam_time = Exam_time::where('scho_id', $id)->first();
        $scholarship_attend = scholarship_attend::all();
        $user = Auth::user()->id;
        foreach ($scholarship_attend as $data) {
            if($data->user_id == $user){
                return redirect('/');
            }
        }
        return view('frontend.student.exam.scholarship_questions',[
            'id'=>$id,
            'exam_time' => $exam_time 
        ]);
    }

    public function scholarships_registration_store(Request $request){
       
       
        $scholarships_reg = new scholarship_reg;
        $scholarships_reg->name = request("name");
        $scholarships_reg->user_id = Auth::user()->id;
        $scholarships_reg->email = Auth::user()->email;
        $scholarships_reg->number = request("number");
        $scholarships_reg->parent_numb = request("parent_numb");
        $scholarships_reg->sex = request("sex");
        $scholarships_reg->scholarship = request("scholarship");
        $scholarships_reg->age = request("age");
        $scholarships_reg->adress = request("adress");
        $scholarships_reg->save();
        return redirect('/student/scholarship_list');

    }

    public function quiz(){
        $link = linkk::first();
        $quiz = quiz_cat::all();
        return view('frontend.student.exam.quiz',['scholarship'=>$quiz,'link'=>$link]);

    }

    public function mock(){
        $link = linkk::first();
        $mock = mock_cat::all();
        return view('frontend.student.exam.mock',['scholarship'=>$mock,'link'=>$link]);
    }
}
