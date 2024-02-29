<?php

namespace App\Http\Controllers\Admin;
use App\Models\scholarship;
use App\Models\scholarship_exam;
use App\Models\Exam_time;
use App\Models\User;
use App\Models\scholarship_attend;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Rank_list;
use App\Models\quiz_cat;
use App\Models\quizs;
use App\Models\mock;
use App\Models\mock_cat;
use App\Models\linkk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExamController extends Controller
{
    public function index(){
        if (!Auth::user()->can('manage_course_subcategory')) {
            abort('403');
        } // end permission checking
        $scholarship = scholarship::all();
        return view('admin.exams.scholarship.scholarship',['scholarship'=>$scholarship]);
    }
    public function scholarship_add() {
        return view('admin.exams.scholarship.scholarships_add');
    }

    public function scholarship_store(Request $request) {
        $scholarship = new scholarship();
        $scholarship->heading = request("heading");
        if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/exams/'), $imageName);

            // You can also store the image path in your database if needed
             $scholarship -> icon = '/uploads/exams/'.$imageName;
        }
        $scholarship->description = request("description");
        $scholarship->save();
        return redirect('/admin/scholarships');
    
    }
    public function scholarship_edit(string $id){
        $scholarship =  scholarship::find($id);
        return view('admin.exams.scholarship.scholarship_edit', ['scholarship' => $scholarship]);

    }

    public function scholarship_update(Request $request, string $id) {
        $scholarship= scholarship::find($id);
        $scholarship->heading = request("heading");
        if ($request->file('image')) {
            if (File::exists(public_path($scholarship->icon))) {
                File::delete(public_path($scholarship->icon));
            }
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/exams/'), $imageName);

            // You can also store the image path in your database if needed
             $scholarship -> icon = '/uploads/exams/'.$imageName;
        }
        $scholarship->description = request("description");
        $scholarship->save();
        return redirect('/admin/scholarships');
    }

    public function scholarships_destroy(string $id) {
        $scholarship = scholarship :: find($id);
        $scholarships_exams =  scholarship_exam::where('scho_id',  $id)->get();
        if ($scholarship) {
            $imagePath = public_path($scholarship->icon);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        if(isset($scholarships_exams)){
            foreach($scholarships_exams as $item){
                $item->delete();
            }
        }
        $scholarship->delete();
        return redirect('admin/scholarships');
    }

    public function scholarships_exams(string $id){
        $time = null;
        $exam_times = Exam_time::all();
        
        foreach ($exam_times as $item) {
            if ($item->scho_id == $id) {
                $time = $item;
                break; 
            }
        }
        $scholarships_exams = scholarship_exam::where('scho_id',  $id)->get();
            return view('admin.exams.scholarship.exam',[
            'scholarships_exams'=>$scholarships_exams,
            'id'=>$id,
            'time'=>$time
        ]);
    }

    public function scholarships_exams_add(string $id) {
        return view('admin.exams.scholarship.exam_add',['id'=>$id]);
    }

    public function scholarships_exam_store(Request $request, string $id) {
        $scholarships_exams = new scholarship_exam();
        $scholarships_exams->scho_id = $id;
        $scholarships_exams->qustion = request("qustion");
        $scholarships_exams->option_1 = request("option_1");
        $scholarships_exams->option_2 = request("option_2");
        $scholarships_exams->option_3 = request("option_3");
        $scholarships_exams->option_4 = request("option_4");
        $scholarships_exams->save();
        return redirect('/admin/scholarships/exams/'.$id);
    }

    public function scholarships_exam_edit(string $id) {
        $scholarships_exams = scholarship_exam::find($id);
        return view('admin.exams.scholarship.exam_edit', [
            'scholarships_exams' => $scholarships_exams
        ]);
    }

    public function scholarships_exam_update(Request $request, string $id) {
        $scholarships_exams =  scholarship_exam::find($id);
        $scholarships_exams->qustion = request("qustion");
        $scholarships_exams->option_1 = request("option_1");
        $scholarships_exams->option_2 = request("option_2");
        $scholarships_exams->option_3 = request("option_3");
        $scholarships_exams->option_4 = request("option_4");
        $scholarships_exams->save();
        return redirect('/admin/scholarships/exams/'.$scholarships_exams->scho_id);
    }

    public function scholarships_exam_destroy(string $id){
        $scholarships_exams =  scholarship_exam::find($id);
        $scholarships_exams->delete();
        return redirect('/admin/scholarships/exams/'.$scholarships_exams->scho_id);
    }

    public function scholarship_time(Request $request, string $scho_id){
        // dd(request('start_time'),request('end_time') );
        $exam_time = new Exam_time();
        $exam_time->scho_id = $scho_id;
        $exam_time->start_time = request('start_time');
        $exam_time->end_time = request('end_time');
        $exam_time->save();
        return back();

    }

    public function scholarship_time_update(Request $request, string $id){
        // dd(request('start_time'),request('end_time') );
        $exam_time = Exam_time::find($id);
        $exam_time->start_time = request('start_time');
        $exam_time->end_time = request('end_time');
        $exam_time->save();
        return back();
    }

    public function get_scholarship_list(Request $request) {  

        $scholarships = scholarship::all(); 
        return view('admin.exams.scholarship.result',['scholarship'=>$scholarships ]);
    }

    public function results(Request $request) {  
        $exm_res = scholarship_attend::with('user','user.results')->where('scholarship', $request->id)->get();
        Log::info($exm_res);
        return view('admin.exams.scholarship.exam_result',['exm_res'=>$exm_res ]);   
    }

    public function exam_details(Request $request) {  
        $exm_res = User::with('results')->where('id', $request->id)->get(); 
        Log::info($exm_res);
        return view('admin.exams.scholarship.exm_res_detail',['exm_res'=>$exm_res ]);   
    }

    public function rank_calculation(Request $request) {  

        $scholarships = scholarship::all(); 
        return view('admin.exams.scholarship.rank_calc',['scholarship'=>$scholarships ]);
    }

    public function rank_calculate(Request $request) {   
        
        Rank_list::where('scholarship_id', $request->id)->delete();
        $exm_res = scholarship_attend::with('user','user.results')->where('scholarship', $request->id)->get();
        // dd($exm_res->user->results );


        foreach($exm_res as $key =>  $res) { 
           
            $name           = $res->user->name;
            $wrong_answer   = 0;
            $correct_answer = 0;
            $divisor        = 3;
            $actual_marks   = 0;
            $total_marks    = 0;
            $negative_mark  = 0;
          foreach($res->user->results as $row ) {
            if($row->result == 0)
                $wrong_answer = $wrong_answer +1;
            else 
                $correct_answer = $correct_answer +1;
            }

            $total_marks = $correct_answer;
            $negative_mark =  intdiv($wrong_answer, $divisor); 

            $actual_marks =  $total_marks - $negative_mark;          
          
            // echo $name.  "--name <br>"           ;
            // echo $wrong_answer.  "--wrong_answer <br>"   ;
            // echo $correct_answer.  "--correct_answer <br>" ;
            // echo $divisor.  "--divisor <br>"        ;
            // echo $actual_marks.  "--actual_marks <br>"   ;
            // echo $total_marks.  "--total_marks <br>"    ;
            // echo $negative_mark.  "--negative_mark <br>"  ;

            $rank_list                  = new Rank_list();
            $rank_list->name            =  $name;
            $rank_list->scholarship_id  =  $request->id;
            $rank_list->correct_ans     =  $correct_answer;
            $rank_list->wrong_ans       =  $wrong_answer;
            $rank_list->total_mark      =  $total_marks;
            $rank_list->negative_mark   =  $negative_mark;
            $rank_list->actual_marks    =  $actual_marks;
            $rank_list->save();
           
        }


        return redirect()->route('admin.rank_calculation');
 
        // return view('admin.rank_list',['exm_res'=>$exm_res ]);   
    }

    public function view_rank_list(Request $request) {

        $exm_res = Rank_list::where('scholarship_id', $request->id)->orderByRaw('CONVERT(actual_marks, SIGNED) desc')->get(); 
        $scholarship_details = scholarship::where('id', $request->id)->first();
        // foreach($exm_res as $row) {
        //     echo $row->name. "--".$row->actual_marks."<br>";
        // } 
        // dd();
        return view('admin.exams.scholarship.rank_list',['exm_res'=>$exm_res,'scholarship_details' =>$scholarship_details ]);   

    }






    // Start Quiz

    public function quiz() {
        $scholarship = quiz_cat::all();
        return view('admin.exams.quiz.quiz',['scholarship'=>$scholarship]);
    }

    public function quiz_add() {
        return view('admin.exams.quiz.quiz_add');
    }

    public function quiz_store(Request $request) {
        $scholarship = new quiz_cat();
        $scholarship->heading = request("heading");
        if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/exams/'), $imageName);

            // You can also store the image path in your database if needed
             $scholarship -> icon = '/uploads/exams/'.$imageName;
        }
        $scholarship->description = request("description");
        $scholarship->save();
        return redirect('/admin/quiz');
    }

    public function quiz_edit(string $id){
        $scholarship =  quiz_cat::find($id);
        return view('admin.exams.quiz.quiz_edit', ['scholarship' => $scholarship]);

    }

    public function quiz_update(Request $request, string $id) {
        $scholarship= quiz_cat::find($id);
        $scholarship->heading = request("heading");
        if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/exams/'), $imageName);

            // You can also store the image path in your database if needed
             $scholarship -> icon = '/uploads/exams/'.$imageName;
        }
        $scholarship->description = request("description");
        $scholarship->save();
        return redirect('/admin/quiz');
    }

    public function quiz_destroy(string $id) {
        $scholarship = quiz_cat :: find($id);
        $scholarships_exams =  quizs::where('scho_id',  $id)->get();
        if ($scholarship) {
            $imagePath = public_path($scholarship->icon);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
         foreach($scholarships_exams as $item){
            $item->delete();
        }
        $scholarship->delete();
        return redirect('admin/quiz');
    }

    public function quiz_exams(string $id) {
        $time = null;
        $exam_times = Exam_time::all();
        
        foreach ($exam_times as $item) {
            if ($item->scho_id == $id) {
                $time = $item;
                break; 
            }
        }
        $scholarships_exams = quizs::where('scho_id',  $id)->get();
            return view('admin.exams.quiz.quiz_exam',[
            'scholarships_exams'=>$scholarships_exams,
            'id'=>$id,
            'time'=>$time
        ]);
    }

    public function quiz_exams_add(string $id) {
        return view('admin.exams.quiz.quiz_exam_add',['id'=>$id]);
    }

    public function quiz_exam_store(Request $request, string $id) {
        $scholarships_exams = new quizs();
        $scholarships_exams->scho_id = $id;
        $scholarships_exams->qustion = request("qustion");
        $scholarships_exams->option_1 = request("option_1");
        $scholarships_exams->option_2 = request("option_2");
        $scholarships_exams->option_3 = request("option_3");
        $scholarships_exams->option_4 = request("option_4");
        $scholarships_exams->save();
        return redirect('/admin/quiz/exams/'.$id);
    }

    public function quiz_exam_edit(string $id) {
        $scholarships_exams = quizs::find($id);
        return view('admin.exams.quiz.quiz_exam_edit', ['scholarships_exams' => $scholarships_exams]);
    }

    public function quiz_exam_update(Request $request, string $id) {
        $scholarships_exams =  quizs::find($id);
        $scholarships_exams->qustion = request("qustion");
        $scholarships_exams->option_1 = request("option_1");
        $scholarships_exams->option_2 = request("option_2");
        $scholarships_exams->option_3 = request("option_3");
        $scholarships_exams->option_4 = request("option_4");
        $scholarships_exams->save();
        return redirect('/admin/quiz/exams/'.$scholarships_exams->scho_id);
    }

    public function quiz_exam_destroy(string $id){
        $scholarships_exams =  quizs::find($id);
        $scholarships_exams->delete();
        return redirect('/admin/quiz/exams/'.$scholarships_exams->scho_id);
    }









    public function mock() {
        $scholarship = mock_cat::all();
        return view('admin.exams.mock.mock',['scholarship'=>$scholarship]);
    }

    public function mock_add() {
        return view('admin.exams.mock.mock_add');
    }

    public function mock_store(Request $request) {
        $scholarship = new mock_cat();
        $scholarship->heading = request("heading");
        if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/exams/'), $imageName);

            // You can also store the image path in your database if needed
             $scholarship -> icon = '/uploads/exams/'.$imageName;
        }
        $scholarship->description = request("description");
        $scholarship->save();
        return redirect('/admin/mock');
    }

    public function mock_edit(string $id){
        $scholarship =  mock_cat::find($id);
        return view('admin.exams.mock.mock_edit', ['scholarship' => $scholarship]);

    }

    //scholarships_update
    public function mock_update(Request $request, string $id) {
        $scholarship= mock_cat::find($id);
        $scholarship->heading = request("heading");
        if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/exams/'), $imageName);

            // You can also store the image path in your database if needed
             $scholarship -> icon = '/uploads/exams/'.$imageName;
        }
        $scholarship->description = request("description");
        $scholarship->save();
        return redirect('/admin/mock');
    }

    public function mock_destroy(string $id) {
        $scholarship = mock_cat :: find($id);
        $scholarships_exams =  mock::where('scho_id',  $id)->get();
        if ($scholarship) {
            $imagePath = public_path($scholarship->icon);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
         foreach($scholarships_exams as $item){
            $item->delete();
        }
        $scholarship->delete();
        return redirect('admin/mock');
    }

    public function mock_exams(string $id) {
        $time = null;
        $exam_times = Exam_time::all();
        
        foreach ($exam_times as $item) {
            if ($item->scho_id == $id) {
                $time = $item;
                break; 
            }
        }
        $scholarships_exams = mock::where('scho_id',  $id)->get();
            return view('admin.exams.mock.mock_exam',[
            'scholarships_exams'=>$scholarships_exams,
            'id'=>$id,
            'time'=>$time
        ]);
    }

    public function mock_exams_add(string $id) {
        return view('admin.exams.mock.mock_exam_add',['id'=>$id]);
    }

    public function mock_exam_store(Request $request, string $id) {
        $scholarships_exams = new mock();
        $scholarships_exams->scho_id = $id;
        $scholarships_exams->qustion = request("qustion");
        $scholarships_exams->solution = request("solution");
        $scholarships_exams->option_1 = request("option_1");
        $scholarships_exams->option_2 = request("option_2");
        $scholarships_exams->option_3 = request("option_3");
        $scholarships_exams->option_4 = request("option_4");
        $scholarships_exams->save();
        return redirect('/admin/mock/exams/'.$id);
    }

    public function mock_exam_edit(string $id) {
        $scholarships_exams = mock::find($id);
        return view('admin.exams.mock.mock_exam_edit', ['scholarships_exams' => $scholarships_exams]);
    }

    public function mock_exam_update(Request $request, string $id) {
        $scholarships_exams =  mock::find($id);
        $scholarships_exams->qustion = request("qustion");
        $scholarships_exams->solution = request("solution");
        $scholarships_exams->option_1 = request("option_1");
        $scholarships_exams->option_2 = request("option_2");
        $scholarships_exams->option_3 = request("option_3");
        $scholarships_exams->option_4 = request("option_4");
        $scholarships_exams->save();
        return redirect('/admin/mock/exams/'.$scholarships_exams->scho_id);
    }

    public function mock_exam_destroy(string $id){
        $scholarships_exams =  mock::find($id);
        $scholarships_exams->delete();
        return redirect('/admin/mock/exams/'.$scholarships_exams->scho_id);
    }

    public function link(){
        $link = linkk::find($id = 1);
        return view('admin.exams.quiz.links',['link'=>$link]);
    }

    public function link_store(){
        $link =  linkk::find($id = 1);
        $link->base_url = request("base_url");
        $link->subdomain = request("subdomain");
        $link->save();
        return redirect()->back();
    }
}
