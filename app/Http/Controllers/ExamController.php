<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ebook;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Result;
use App\Models\Giveaway;
use App\Models\Question;
use Barryvdh\DomPDF\PDF;
use App\Models\Assignment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EbookCategory;
use App\Models\CourseCategory;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SubCategory;
use App\Models\UploadedAssessment;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ExamController extends Controller
{
    public function create_question($id)
    {
        $data['user'] = $user = Auth::user();
        $data['assignment'] = $ass = Assignment::where('uid', $id)->first();
        $data['courses']  = Course::where('user_id', $user->id)->get();
        $data['questions'] = Question::where('test_id', $ass->id)->get();
        // dd($ass);
        return view('ass.create', $data);
    }
    public function storequestion(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'test' => ['required'],
            'question' => ['required', 'min:10'],
            'correct_answer' => ['required']

        ]);
        $data = $request->all();
        // dd($data);
        $question = (new Question)->storeQuestion($data);
        // dd($data);
        $answer = (new Answer)->storeAnswer($data, $question);
        return redirect()->back()->with('message', 'Question Created Successfully');
        return redirect()->route('question.index')->with('message', 'Question created successfully!');
    }
    public function starttest(Request $request, $testId)
    {
        $authUser = Auth::user()->id;

        //check if user has been assigned a particular test
        // $userId = DB::table('test_users')->where('user_id', $authUser)->pluck('test_id')->toArray();
        // if (!in_array($testId, $userId)) {
        //     return redirect()->back()->with('error', 'You are not assigned this test');
        // }

        $data['test'] = $test = Assignment::find($testId);
        $data['time'] = $time = Assignment::where('id', $testId)->value('minutes');
        $data['testQuestions'] = $testQuestions = Question::where('test_id', $testId)->with('answers')->get();
        $data['authUserHasPlayedtest'] = $authUserHasPlayedtest = Result::where(['user_id' => $authUser, 'test_id' => $testId])->get();
        // dd($testQuestions);
        //has user played particular test
        $wasCompleted = Result::where('user_id', $authUser)->whereIn('test_id', (new Assignment)->hasTestAttempted())->pluck('test_id')->toArray();

        if (in_array($testId, $wasCompleted)) {

            return redirect()->back()->with('error', 'You already participated in this test');
        }

        return view('ass.testpage', $data);
    }

    public function submittest(Request $request)
    {
        $questionId = $request['questionId'];
        $answerId = $request['answerId'];
        $data['active'] = 'test';
        $testId = $request['testId'];

        $question_id  = Answer::where('id', $answerId)->pluck('question_id')[0];
        // dd($question_id);
        $data['active'] = 'test';
        return $userQuestionAnswer = Result::updateOrCreate(
            ['user_id' => Auth::user()->id, 'test_id' => $testId, 'question_id' => $question_id],
            ['answer_id' => $answerId]

        );
    }

    public function finishtest()
    {
        $attemptTest  = [];
        $authUser = Auth::user()->id;
        $user = Result::where('user_id', $authUser)->get();
        $user->is_attempted = 1;
        foreach ($user as $u) {
            array_push($attemptTest, $u->test_id);
        }
        return $attemptTest;
    }
    public function upload_assessment(Request $request)
    {
        // dd($request->all());
        foreach ($request->file as $key => $ass_file) {
            $file = $ass_file;
            $ext = $ass_file->extension();
            $filename = $file->hashName();
            $file->move(public_path() . '/uploaded_assessments/', $filename);
            // dd($filename,$ext,$request->user_id,$request->ass_id,$request->section_id);
            UploadedAssessment::create([
                'user_id' => $request->user_id,
                'test_id' => $request->ass_id,
                'section_id' => $request->section_id,
                'is_done' => true,
                'ext' => $ext,
                'file' => $filename
            ]);
        }
        return redirect()->back()->with('message', 'Assessment Uploaded Successfully');
    }
    public function view_uploaded_assessment($user_id, $ass_id)
    {
        // dd($user_id,$ass_id);
        $data['user'] = User::find($user_id);
        $ass = UploadedAssessment::where('user_id', $user_id)->where('test_id', $ass_id)->first();

        $path = public_path() . '/uploaded_assessments/' . $ass->file;
        $data['pdfPath'] = $pdfPath = asset('uploaded_assessments/' . $ass->file);

        // You can use an iframe to embed the PDF in your HTML page
        return view('student.real_pdf_viewer', $data);
        dd($ass);
    }
    public function checkuserresult($userId, $testId)
    {
        // $user = User::get();
        // $userId = $request->userId;
        // $testId = $request->testId;



        $results = Result::where('user_id', $userId)->where('test_id', $testId)->get();
        $totalQuestions = Question::where('test_id', $testId)->count();
        $attemptQuestion = Result::where('test_id', $testId)->where('user_id', $userId)->count();
        $Test = Assignment::where('id', $testId)->get();
        dd($Test);

        $ans = [];
        foreach ($results as $answer) {
            array_push($ans, $answer->answer_id);
        }
        $userCorrectedAnswer = Answer::whereIn('id', $ans)->where('is_correct', 1)->count();
        $userWrongAnswer = $totalQuestions - $userCorrectedAnswer;
        if ($attemptQuestion) {
            $percentage = ($userCorrectedAnswer / $totalQuestions) * 100;
        } else {
            $percentage = 0;
        }
        $user = Auth::user();
        $test = Assignment::find($testId);
        // dd($userCorrectedAnswer,'corrent',$userWrongAnswer,'wrong',$totalQuestions,'all questions',$attemptQuestion,'attempted questions');

        return view('ass.result', compact('user', 'results', 'totalQuestions', 'attemptQuestion', 'userCorrectedAnswer', 'userWrongAnswer', 'percentage', 'Test', 'test'));
    }

    public function viewResult($userId, $testId)
    {
        $data['results'] = $results = Result::where('user_id', $userId)->where('test_id', $testId)->get();
        $data['totalQuestions'] = $totalQuestions = Question::where('test_id', $testId)->count();
        $data['attemptQuestion'] = $attemptQuestion = Result::where('test_id', $testId)->where('user_id', $userId)->count();
        $ans = [];
        foreach ($results as $answer) {
            array_push($ans, $answer->answer_id);
        }
        $data['userCorrectedAnswer'] = $userCorrectedAnswer  = Answer::whereIn('id', $ans)->where('is_correct', 1)->count();
        $data['userWrongAnswer'] = $userWrongAnswer  = $totalQuestions - $userCorrectedAnswer;
        if ($attemptQuestion) {
            $data['percentage'] = $percentage  = round(($userCorrectedAnswer / $totalQuestions) * 100, 2);
        } else {
            $data['percentage'] = $percentage = 0;
        }
        $data['test'] = Test::find($testId);
        return view('dashboard.viewresult', $data);
    }
    public function viewAssessment($userId, $courseId)
    {
        $data['user'] = User::find($userId);
        $data['courses'] = Course::where('user_id', Auth::user()->id)->get();
        $data['course'] = $course = Course::where('uid', $courseId)->firstOrFail();
        $data['assignments'] = $ass = Assignment::where('course_id', $course->id)->get();
        //  dd($course,$ass);
        return view('admin.student_assessments', $data);
    }
    public function lockCertificate($userId, $courseId)
    {
        $enroll = Enroll::where('user_id', $userId)->where('course_id', $courseId)->firstOrFail();
        if ($enroll->completed == 0) {
            $enroll->completed = 1;
        } else {
            $enroll->completed = 0;
        }
        $enroll->save();
        return redirect()->back()->with('message', 'Certificate Status Updated');
    }
    public function payForExam($userId, $courseId)
    {
        // dd($userId,$courseId);
        $user = Auth::user();
        $exam = Assignment::find($courseId);
        $paidUsers = $exam->paid_user ?? [];
        // dd($paidUsers,$rand_no,$request->all());
        $existingNumbers = $exam->paid_user ?? [];
        $existingNumbers = array_merge($existingNumbers, array($userId));
        // dd($paidUsers,$userId, array($userId));
        $amount = $exam->price * 1300;


        if (!in_array($userId, $paidUsers)) {
            // check user balance

            $expenses = DB::table('transactions')
                ->where('userId', $user->userId)
                ->where('transactionType', '!=', 'Deposit')
                ->where('status', 'CONFIRM')
                ->sum('amount');

            $walletamount = DB::table('funds')
                ->where('userId', $user->userId)
                ->where('status', 'success')
                ->sum('amount');

            $balance = $walletamount - $expenses;
           

            if($balance < $amount) {
                return redirect()->back()->with('error','Insufficient balance, kindly fund your wallet to pay for the examination');

            }
            //here should charge the user.  
            DB::table('transactions')
                ->where('userId', $user->userId)
                ->insert([
                    'transactionId' => $this->randomDigit(),
                    'userId' => $user->userId,
                    'username' => $user->username,
                    'email' => $user->email,
                    'phoneNumber' => $user->phoneNumber,
                    'amount' => $amount,
                    'transactionType' => 'Examination',
                    'transactionService' => 'Examination',
                    'status' => 'CONFIRM',
                    'paymentMethod' => 'wallet',
                    'Admin' => 'None',
                    "created_at" => date('Y-m-d H:i:s'),
                    "updated_at" => date('Y-m-d H:i:s'),
                ]);

            $exam->update(['paid_user' => $existingNumbers]);
        }


        return redirect()->back()->with('message', 'Examination Payment Made Successfully!');
    }
    public function randomDigit()
    {
        $pass = substr(str_shuffle("01234561089abcDEfadsasfdasdfasdsfa3425542FGHIJnostXYZ"), 0, 30);
        return $pass;
    }
    public function admin_ebooks()
    {
        $data['user'] = $user = Auth::user();
        if ($user->type == 0) {
            return redirect('/dashboard');
        }
        $data['ebooks'] = Ebook::where('user_id', $user->id)->latest()->orderBy('category_id')->get();
        $data['all_ebooks'] = Ebook::latest()->orderBy('category_id')->get();
        $data['categories'] = EbookCategory::orderBy('name')->get();
        $data['courses'] = Course::where('user_id', $user->id)->latest()->get();

        return view('admin.ebooks', $data);
    }
    public function admin_giveaway()
    {
        $data['user'] = $user = Auth::user();
        if ($user->type == 0) {
            return redirect('/dashboard');
        }
        $data['giveaways'] = Giveaway::where('user_id', $user->id)->latest()->get();
        $data['all_ebooks'] = Ebook::latest()->orderBy('category_id')->get();
        $data['categories'] = EbookCategory::orderBy('name')->get();
        $data['courses'] = Course::where('user_id', $user->id)->latest()->get();

        return view('admin.giveaway', $data);
    }
    public function admin_createGiveaway(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        Giveaway::create([
            'name' => $request->name,
            'description' => $request->description,
            'participant' => $request->no_of_participant,
            'user_id' => Auth::user()->id,
            'no_of_lucky_numbers' => $request->no_of_lucky_numbers,
        ]);
        return redirect()->back()->with('message', 'Giveaway Created Successfully');
        dd($request->all());
    }
    public function admin_check_giveaway($id)
    {
        $data['user'] = $user = Auth::user();
        $giveaway = Giveaway::where('id', $id)->first();
        $randomNumbers = collect([]);
        // dd($giveaway);

        while ($randomNumbers->count() < $giveaway->no_of_lucky_numbers) {
            $randomNumber = rand(0, $giveaway->participant);
            if (!$randomNumbers->contains($randomNumber)) {
                $randomNumbers->push($randomNumber);
            }
        }


        // Serialize the array to a JSON-formatted string
        $serializedData = json_encode($randomNumbers);
        // dd($serializedData,$giveaway);
        $giveaway->lucky_numbers = $serializedData;
        $giveaway->save();


        // Store the serialized data in the database
        $data['giveaway'] = $giveaway;

        $data['categories'] = EbookCategory::orderBy('name')->get();
        $data['courses'] = Course::where('user_id', $user->id)->latest()->get();

        return view('admin.check_giveaway', $data);
    }
    public function all_ebooks()
    {
        $data['user'] = $user = Auth::user();
        $data['ebooks'] = Ebook::where('user_id', $user->id)->latest()->orderBy('category_id')->get();
        $data['all_ebooks'] = Ebook::latest()->orderBy('category_id')->get();
        $data['categories'] = EbookCategory::orderBy('name')->get();
        $data['courses'] = Course::where('user_id', $user->id)->latest()->get();

        return view('admin.all_ebooks', $data);
    }

    public function categories()
    {
        $data['user'] = $user = Auth::user();
        $data['categories'] = ProductCategory::where('user_id', $user->id)->orderBy('name')->with('subcategories')->get();
        $data['courses'] = Product::where('user_id', $user->id)->latest()->get();
        return view('admin.categories', $data);
    }
    public function fetchsubcategory(Request $request) {
        $id = $request->id;
        $subcategory = SubCategory::where('category_id',$id)->get();
        return $subcategory;
    }
    public function course_categories()
    {
        $data['user'] = $user = Auth::user();
        $data['ebooks'] = Ebook::where('user_id', $user->id)->latest()->orderBy('category_id')->get();
        $data['all_ebooks'] = Ebook::latest()->orderBy('category_id')->get();
        $data['categories'] = CourseCategory::orderBy('name')->get();
        $data['courses'] = Course::where('user_id', $user->id)->latest()->get();

        return view('admin.course_categories', $data);
    }
    public function edit_ebook($id)
    {
        $data['user'] = $user = Auth::user();
        $data['ebooks'] = Ebook::where('user_id', $user->id)->latest()->orderBy('category_id')->get();
        $data['all_ebooks'] = Ebook::latest()->orderBy('category_id')->get();
        $data['categories'] = EbookCategory::orderBy('name')->get();
        $data['courses'] = Course::where('user_id', $user->id)->latest()->get();

        $data['ebook'] = Ebook::where('uid', $id)->first();

        return view('admin.edit_ebook', $data);
    }
    public function allebooks()
    {
        $data['user'] = $user = Auth::user();
        $data['all_ebooks'] = Ebook::latest()->orderBy('category_id')->paginate(9);
        $data['categories'] = EbookCategory::orderBy('name')->get();
        $data['courses'] = Course::where('user_id', $user->id)->latest()->get();

        return view('student.all_ebooks', $data);
    }
    public function searchEbook(Request $request)
    {
        $search = $request->search;
        // dd($request->all(),$search);
        $data['user'] = $user =  Auth::user();
        $data['courses'] = Course::where('user_id', $user->id)->latest()->get();

        $data['all_ebooks'] = Ebook::where('title', 'like', '%' . $request->search . '%')
            ->orWhere('author', '%like%', $search)
            ->orWhere('description', '%like%', $search)
            ->get();

        $data['categories'] = EbookCategory::orderBy('name')->get();
        return view('admin.all_ebooks', $data);
    }
    public function searchEbookStudent(Request $request)
    {
        $search = $request->search;
        // dd($request->all(),$search);
        $data['user'] = $user =  Auth::user();
        $data['courses'] = Course::where('user_id', $user->id)->latest()->get();
        // dd($request->search);

        $data['all_ebooks'] = Ebook::where('title', 'like', '%' . $request->search . '%')
            ->orWhere('author', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->paginate(9);
        $data['categories'] = EbookCategory::orderBy('name')->get();
        // dd($data);
        return view('student.all_ebooks', $data);
    }
    public function searchEbookTitle(Request $request)
    {
        $search = $request->search;
        $ebooks = Ebook::where('title', 'like', '%' . $request->search . '%')
            ->orWhere('author', 'like', '%' . $request->search . '%')
            ->orWhere('description', 'like', '%' . $request->search . '%')
            ->get();
        return response()->json($ebooks);
    }
  
 
    public function createCategory(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $check = ProductCategory::where('user_id', Auth::user()->id)->where('name', $request->name)->first();
        if($check) {
            return redirect()->back()->with('error', 'Sub Category Addeed Existed!');
        }

        ProductCategory::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
        ]);


        return redirect()->back()->with('message', 'Category Addeed Successfully!');
    }
    public function createSubCategory(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required',
        ]);

        $check = SubCategory::where('category_id',$request->category_id)->where('user_id', Auth::user()->id)->where('name', $request->name)->first();
        if($check) {
            return redirect()->back()->with('error', 'Sub Category Addeed Existed!');
        }
        SubCategory::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id,

        ]);
       


        return redirect()->back()->with('message', 'Sub Category Addeed Successfully!');
    }
    public function createCourseCategory(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        ProductCategory::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
        ]);


        return redirect()->back()->with('message', 'Category Addeed Successfully!');
    }
    public function marketplace() {
        $data['categories'] = ProductCategory::latest()->get();
        $data['products'] = Product::where('active',1)->orderBy('rank')->latest()->paginate(10);

        return view('market.marketplace', $data);
    }
    public function vendorpage($slug) {
        $vendor = $data['vendor'] = User::where('username',$slug)->first();
        if($vendor) {
            
            $data['categories'] = ProductCategory::where('user_id',$vendor->id)->latest()->get();
            $data['products'] = Product::where('user_id',$vendor->id)->where('active',1)->orderBy('rank')->latest()->paginate(10);
    
            return view('market.vendorspace', $data);

        }
        else {
            return redirect('https://shop.abovemarts.com/marketplace');
        }

       
    }

    public function delete_category(Request $request)
    {
        $id = $request->id;
        $category = ProductCategory::find($id);
        $ebooks = Product::where('category', $id)->delete();
        $subcat = SubCategory::where('category', $id)->delete();

        // dd($ebooks);

        $category->delete();
        return true;
    }
    public function delete_course_category(Request $request)
    {
        $id = $request->id;
        $category = ProductCategory::find($id);
        $ebooks = Product::where('category', $id)->delete();
        $category->delete();
        return true;
    }
 
}
