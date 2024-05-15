<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Enroll;
use App\Models\Product;
use App\Models\Section;
use App\Models\Purchase;
use App\Models\AdminAccess;
use Illuminate\Support\Str;
use App\Models\Announcement;
use App\Models\SectionVideo;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $data['ann'] = Announcement::latest()->get();
        $data['user'] = $user = Auth::user();
        // $data['products'] = Product::where('user_id', $user->id)->latest()->get();
        $data['products'] = Product::latest()->get();
        // $data['boughtproducts'] = Purchase::where('vendor_id', $user->id)->get();
        $data['boughtproducts'] = Purchase::get();
        $data['categories'] = ProductCategory::get();
        if (Auth::user()->type == 1) {

            return view('admin.index', $data);
        } else {
            return redirect()->route('market');
        }
    }
    public function fetchsection(Request $request)
    {
        $sections = Section::where('course_id', $request->course_id)->get();
        return $sections;
    }

    public function boughtproducts()
    {
        $data['user'] = $user = Auth::user();
        $data['categories'] = ProductCategory::where('user_id', $user->id)->get();
        $data['products'] = Purchase::where('vendor_id', $user->id)->latest()->get();
        $data['categories'] = ProductCategory::get();
        $data['products'] = Purchase::latest()->get();
        return view('admin.boughtproducts', $data);
    }
    public function adminboughtproducts()
    {
        $data['user'] = $user = Auth::user();
        $data['categories'] = ProductCategory::where('user_id', $user->id)->get();
        $data['products'] = Purchase::where('vendor_id', $user->id)->latest()->get();
        // $data['categories'] = ProductCategory::get();
        // $data['products'] = Purchase::latest()->get();
        return view('admin.boughtproducts', $data);
    }
    public function profile()
    {
        return 'this is the profile page';
    }
    public function course()
    {
        $data['courses'] = Product::latest()->get();
        $data['ann'] = Announcement::latest()->get();

        if (Auth::user()->type == 1) {

            return view('courses.course', $data);
        } else {
            return redirect()->route('market');
        }
    }
    public function dashboard()
    {
        
        $data['user'] = $user = Auth::user();
        $data['products'] = Product::where('user_id', $user->id)->latest()->get();
        // $data['products'] = Product::latest()->get();
        $data['allproducts'] = Product::latest()->get();
        $data['boughtproducts'] = Purchase::where('vendor_id', $user->id)->get();
        $data['ann'] = Announcement::latest()->get();
        $data['categories'] = ProductCategory::where('user_id', $user->id)->orderBy('name')->get();

        return view('admin.index', $data);

        if (Auth::user()->type == 1) {
                      return view('admin.index', $data);
        } else {
            return redirect()->route('market');
        }
    }
    public function admin()
    {
        
        $data['user'] = $user = Auth::user();
        $data['products'] = Product::latest()->get();
        $data['allproducts'] = Product::latest()->get();
        $data['boughtproducts'] = Purchase::get();
        $data['ann'] = Announcement::latest()->get();
        $data['categories'] = ProductCategory::orderBy('name')->get();

        if (Auth::user()->type == 1) {
          

            return view('admin.admin', $data);
        } else {
            return redirect()->route('market');
        }
    }
    public function approve($id)
    {
        
       

        $product = Product::where('uid',$id)->first();
        if (Auth::user()->type == 1) {
            if($product->active == 1) {
                $product->active = 0;

            }
            else {
                $product->active = 1;

            }
            $product->save();
          
            return redirect()->back()->with('message','Product Status Updated Successfully!');

        } else {
            return redirect()->route('market');
        }
    }
    public function admindashboard()
    {
        $data['user'] = $user = Auth::user();
        $assignadmin = AdminAccess::where('admins', $user->id)->get();
        // foreach ($assignadmin as $add) {

        //     $data['courses'] = Product::whereIn('id', explode(',', $add->course_id))->get();
        // }
        $data['courses'] = [];

        foreach ($assignadmin as $add) {
            $courseIds = explode(',', $add->course_id);
            // Retrieve courses for each admin and add them to the $data['courses'] array
            $courses = Product::whereIn('id', $courseIds)->get();
            $data['courses'] = array_merge($data['courses'], $courses->toArray());
        }

        // Now $data['courses'] contains all courses associated with the admins linked to the user
        // dd($data['courses']);

        // Now $data['courses'] contains the courses associated with the admins linked to the user


        $data['ann'] = Announcement::where('user_id', $user->id)->latest()->get();
        $data['categories'] = ProductCategory::orderBy('name')->get();
        return view('student.admin', $data);
    }
    public function admin_access()
    {
        $data['user'] = $user = Auth::user();
        $data['users'] = User::orderBy('firstname')->get();
        $data['courses'] = Product::where('user_id', $user->id)->latest()->get();
        $data['ann'] = Announcement::where('user_id', $user->id)->latest()->get();
        $data['admins'] = AdminAccess::where('user_id', $user->id)->latest()->get();
        $data['categories'] = ProductCategory::orderBy('name')->get();

        if (Auth::user()->type == 1) {

            return view('admin.admin_access', $data);
        } else {
            return redirect()->route('market');
        }
    }
    public function assignadmin(Request $request)
    {
        $this->validate($request, [
            'course_id' => 'required',
            'access' => 'required',
        ]);
        $user = Auth::user();

        // dd($request->all());
        $access = AdminAccess::create([
            'user_id' => $user->id,
            'course_id' => $request->course_id,
            'access' => $request->access,
            'admins' => $request->admin,
        ]);
        return redirect()->back()->with('message', 'Access Granted Successfully!');
    }
    public function deleteAccess($id)
    {
        $access = AdminAccess::find($id);
        $user = Auth::user();


        if ($user->id !== $access->user_id) {
            $access->delete();
            return redirect()->back()->with('message', 'Access Deleteted Successfully!');
        } else {
            return redirect()->back()->with('error', 'Access Denied');
        }
    }
    public function market()
    {
        $data['user'] = $user = Auth::user();
        $data['products'] = Product::latest()->get();
        $data['allproducts'] = Product::latest()->get();
        $data['boughtproducts'] = Purchase::where('user_id', $user->id)->latest()->paginate(10);

        $data['ann'] = Announcement::latest()->get();
        $data['categories'] = ProductCategory::orderBy('name')->get();
        $data['status'] = $status = [];
        $data['expenses'] =$expenses = DB::table('transactions')
            ->where('userId', $user->userId)
            ->where('transactionType', '!=', 'Deposit')
            ->where('status', 'CONFIRM')
            ->sum('amount');

        $data['walletamount'] = $walletamount = DB::table('funds')
            ->where('userId', $user->userId)
            ->where('status', 'success')
            ->sum('amount');

            
            

        $data['balance'] = $walletamount - $expenses;


        return view('market.dashboard', $data);
    }


    public function ann()
    {
        $data['ann'] = Announcement::latest()->get();
        $data['courses'] = Product::latest()->get();
        $data['user'] = Auth::user();
        return view('ann.index', $data);
    }
    public function createann(Request $request)
    {
        $user = Auth::user();

        $ann = Announcement::create([
            'uid' => Str::uuid(),
            'user_id' => $user->id,
            'name' => $request->name,
            'description' => $request->description,
            'course_id' => $request->course_id,

        ]);
        return $ann;
    }
    public function coursedetails($id)
    {
        $data['course'] = $course = Product::where('uid', $id)->first();
        $data['courses']  = Product::latest()->get();
        $data['sections'] = Section::where('course_id', $course->id)->orderBy('rank')->get();
        $data['sectionvideos'] = SectionVideo::where('course_id', $course->id)->get();
        $data['user'] = Auth::user();
        return view('courses.coursedetails', $data);
    }
    public function admincoursedetails($id)
    {
        $data['course'] = $course = Product::where('uid', $id)->first();
        $data['courses']  = Product::latest()->get();
        $data['sections'] = Section::where('course_id', $course->id)->orderBy('rank')->get();
        $data['sectionvideos'] = SectionVideo::where('course_id', $course->id)->get();
        $data['user'] = Auth::user();
        return view('student.coursedetails', $data);
    }
    public function lesson($id)
    {
        $data['user'] = $user = Auth::user();
        $data['course'] = $course = Product::where('uid', $id)->firstOrFail();

        $data['payment'] = false;

        if ($ass->isNotEmpty()) {
            $ass = $ass[0];
            if ($ass->paid_user == null) {
                $realass = array($ass->paid_user);
            } else {
                $realass = $ass->paid_user;
            }
            if (in_array($user->id, $realass)) {
                $data['payment'] = true;
            }
        }

        $data['sections'] = Section::where('course_id', $course->id)->get();

        $expenses = DB::table('transactions')
            ->where('userId', $user->userId)
            ->where('transactionType', '!=', 'Deposit')
            ->where('status', 'CONFIRM')
            ->sum('amount');

        $walletamount = DB::table('funds')
            ->where('userId', $user->userId)
            ->where('status', 'success')
            ->sum('amount');

        $data['balance'] = $walletamount - $expenses;




        $data['sectionvideos'] = SectionVideo::where('course_id', $course->id)->get();
        return view('courses.lesson', $data);
    }
    public function markdone($course_id)
    {
        $course = Product::find($course_id);
        $enrol = Enroll::where('course_id', $course->id)->first();
        $enrol->progress += 1;
        $enrol->save();
        return redirect()->back()->with('message', 'Mark Completed');
    }
    public function students($id)
    {
        $data['course'] = $course = Product::where('uid', $id)->firstOrFail();
        $data['courses']  = Product::latest()->get();
        $user_id = Enroll::where('course_id', $course->id)->pluck('user_id');
        $data['users'] = User::whereIn('id', $user_id)->latest()->get();
        $data['user'] = Auth::user();
        return view('courses.courseusers', $data);
    }
    public function coursestudents($id)
    {
        $data['course'] = $course = Product::where('uid', $id)->firstOrFail();
        $data['courses']  = Product::latest()->get();
        $user_id = Enroll::where('course_id', $course->id)->pluck('user_id');
        $data['users'] = User::whereIn('id', $user_id)->latest()->get();
        $data['user'] = Auth::user();
        return view('student.coursestudent', $data);
    }
    public function downloadsectionvideo($id)
    {
        $section = SectionVideo::find($id);
        $path = public_path() . '/sectionvideos/' . $section->video;
        return response()->download($path);
    }
    public function deletesectionvideo(Request $request)
    {
        $section = SectionVideo::find($request->id);
        $section->delete();
        return 'topic deleted';
    }
    public function createsection(Request $request)
    {
        $this->validate($request, [
            'course_id' => 'required',
            'title' => 'required',


        ]);
        Section::create([
            'course_id' => $request->course_id,
            'user_id' => Auth::user()->id,
            'title' => $request->title,

        ]);
        return redirect()->back()->with('message', 'Section Created Successfully');
        return 'section created';
    }
    public function deletesection($id)
    {
        $section = Section::find($id);
        $sectionvideos = SectionVideo::where('section_id', $section->id)->delete();
        $section->delete();
        return redirect()->back()->with('message', 'Section Deleted Successfully!');
    }
    public function createsectionvideo(Request $request)
    {
        // $this->validate($request,[
        //     'video' => ''
        // ])
        // dd($request->all());
        if ($request->has('video')) {
            foreach ($request->video as $key => $video) {
                $videofile = $video;
                $ext = $video->extension();
                $filename = $videofile->hashName();
                $videofile->move(public_path() . '/sectionvideos/', $filename);
                // dd($filename);
                SectionVideo::create([
                    'user_id' => Auth::user()->id,
                    'course_id' => $request->course_id,
                    'section_id' => $request->section_id,
                    'status' => $request->options,
                    'ext' => $ext,
                    'title' => $request->title . ' ' . ++$key,
                    'video' => $filename
                ]);
            }
        } else {
            SectionVideo::create([
                'user_id' => Auth::user()->id,
                'course_id' => $request->course_id,
                'section_id' => $request->section_id,
                'status' => $request->options,
                'ext' => 'drive',
                'link' => $request->link,
                'title' => $request->title,
                'video' => null
            ]);
        }

        return redirect()->back()->with('message', 'Materials Uploaded Successfully');
        return 'video uploaded successfully';
    }
    public function loadann(Request $request)
    {
        $id = $request->id;
        $ann = Announcement::find($id);
        // dd($request->all(),$ann);
        return $ann;
    }
    public function editann(Request $request)
    {
        $ann = Announcement::find($request->id);


        $ann->name = $request->name;
        $ann->description = $request->description;
        $ann->course_id = $request->course_id;


        $ann->save();


        return $ann;
    }
    public function deleteann(Request $request)
    {
        $id = $request->id;
        $ann = Announcement::find($id);
        $ann->delete();
        return 'course deleted';
    }


    public function assignment()
    {
        $data['user'] = Auth::user();
        $data['ann'] = Announcement::latest()->get();
        $data['courses'] = Product::latest()->get();
        return view('ass.index', $data);
    }

    public function courseindex()
    {
        // dd('here');
        return view('courses.index');
    }
    public function allproducts()
    {
        
        $data['user'] =  $user = Auth::user();
        $data['products'] = Product::where('active',1)->latest()->paginate(10);
        $data['ann'] = Announcement::latest()->get();

        $data['expenses'] =$expenses = DB::table('transactions')
            ->where('userId', $user->userId)
            ->where('transactionType', '!=', 'Deposit')
            ->where('status', 'CONFIRM')
            ->sum('amount');

        $data['walletamount'] = $walletamount = DB::table('funds')
            ->where('userId', $user->userId)
            ->where('status', 'success')
            ->sum('amount');

            
            

        $data['balance'] = $walletamount - $expenses;


        return view('market.allproducts', $data);
    }
    public function live_preview($id)
    {


        $data['product'] = $course = Product::where('uid', $id)->firstOrFail();


        return view('market.course_preview', $data);
    }

    public function createproduct(Request $request)
    {

        $package = explode(', ', $request->package);


        $user = Auth::user();
        $image = $request->file('image');
        $imageName = $image->hashName();
        $image->move(public_path() . '/productimage/', $imageName);
        $course = Product::create([
            'uid' => Str::uuid(),
            'sku' => "SKU-".Str::random(7),
            'user_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'slashed_price' => $request->slashed_price,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'packages' => $package,
            'image' => $imageName,
        ]);
        return $course;
        return redirect()->back()->with('message', 'Course Created Successfully');
    }
    public function loadproduct(Request $request)
    {
        $id = $request->id;
        $course = Product::find($id);
        return $course;
    }
    public function editProduct(Request $request)
    {
        // dd($request->all());
        $course = Product::find($request->id);
        $package = explode(', ', $request->package);
        // $package = array($myarray);
        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->move(public_path() . '/productimage/', $imageName);
            $course->image = $imageName;
        }
        $course->title = $request->title;

        $course->description = $request->description;

        $course->price = $request->price;
        $course->quantity = $request->quantity;
        $course->slashed_price = $request->slashed_price;
        $course->category = $request->category;
        $course->subcategory = $request->subcategory;
        $course->packages = $package;

        $course->save();


        return $course;
    }
    public function marksent($id)
    {
        $purchase = Purchase::where('uid', $id)->firstOrFail();
        $purchase->status = 2;
        $purchase->save();
        return redirect()->back()->with('message', "Product Status Updated Successfully!");
    }
    public function markreceived($id)
    {
        $purchase = Purchase::where('uid', $id)->firstOrFail();
        $purchase->status = 3;
        $purchase->save();
        return redirect()->back()->with('message', "Product Marked Received!");
    }
    public function markrefund($id)
    {
        $purchase = Purchase::where('uid', $id)->firstOrFail();

        $user = User::find($purchase->user_id);

        DB::table('funds')->insert([
            'transactionId' => $this->randomDigit(),
            'userId' => $user->userId,
            'name' => $user->username,
            'email' => $user->email,
            'amount' => $purchase->price,
            'status' => 'success',
            'paymentType' => 'Product Refund',
            'accountName' => 'Admin',
            'accountNumber' => 'Admin',
            'bankName' => 'Admin',
            'Admin' => 'None',
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);

        DB::table('transactions')->insert([
            'transactionId' => $this->randomDigit(),
            'userId' => $user->userId,
            'username' => $user->username,
            'email' => $user->email,
            'phoneNumber' => $user->phoneNumber,
            'amount' => $purchase->price,
            'transactionType' => 'Deposit',
            'transactionService' => 'Product Refund',
            'status' => 'PENDING',
            'paymentMethod' => 'Admin',
            'Admin' => 'None',
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);


        $purchase->status = 4;
        $purchase->save();
        return redirect()->back()->with('message', "Product Has Been Refunded!");
    }
    public function loadsection(Request $request)
    {
        $id = $request->id;
        $section = Section::find($id);
        return $section;
    }
    public function editsection(Request $request)
    {
        // dd($request->all());
        $section = Section::find($request->id);

        $section->title = $request->title;
        $section->rank = $request->rank;


        $section->save();


        return $section;
    }
    public function deleteproduct(Request $request)
    {
        $id = $request->id;
        $course = Product::find($id);
        $course->delete();
        return 'course deleted';
    }

    public function searchCourse(Request $request)
    {
        $search = $request->search;
        // dd($request->all(),$search);
        $data['ann'] = Announcement::latest()->get();
        $data['user'] = $user =  Auth::user();
        $data['products'] = Product::where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            })
            ->paginate(9);
            $data['boughtproducts'] = Purchase::where('vendor_id', $user->id)->get();
        


        $data['categories'] = ProductCategory::orderBy('name')->get();
        return view('admin.index', $data);
    }
    public function searchProduct(Request $request)
    {
        $search = $request->search;
        // dd($request->all(),$search);
        $data['user'] = $user =  Auth::user();
        // dd($request->search);
     

        $data['products'] = Product::where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            })
            ->paginate(9);

        $data['categories'] = ProductCategory::orderBy('name')->get();
        // dd($data);
        return view('market.allproducts', $data);
    }
    public function searchCourseTitle(Request $request)
    {
        $search = $request->search;
        $enroll = Enroll::where('user_id', Auth::user()->id)->pluck('course_id');
        $Courses = Product::whereNotIn('id', $enroll)
            ->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('course_code', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            })
            ->get();


        // $Courses = Product::whereNotIn('id', $enroll)->where('title', 'like', '%' . $request->search . '%')
        //     ->orWhere('course_code', 'like', '%' . $request->search . '%')
        //     ->orWhere('description', 'like', '%' . $request->search . '%')
        //     ->get();
        return response()->json($Courses);
    }
    public function randomDigit()
    {
        $pass = substr(str_shuffle("0123456789abcnost"), 0, 12);
        return $pass;
    }

    public function buyproduct(Request $request)
    {
       
        $product = Product::where('uid', $request->product_id)->first();
        $user = Auth::user();

        if($product->quantity < $request->quantity) {
            return redirect()->back()->with('error', "Quantity booked is more than the quantity of product left!");
        }
        // dd($course);

        //Here is where you charge the user for the course, create transaction for the course, after that

        $expenses = DB::table('transactions')
            ->where('userId', $user->userId)
            ->where('transactionType', '!=', 'Deposit')
            ->where('status', 'CONFIRM')
            ->sum('amount');
        $capital = DB::table('funds')
            ->where('userId', $user->userId)
            ->where('status', 'success')
            ->sum('amount');
        $bonusamount = DB::table('bonuses')
            ->where('sponsor', $user->mySponsorId)
            ->sum('amount');
        $balance = $capital + 0 - $expenses;

        // $balance = 5000;
        $realprice =  $product->price *  $request->quantity;
      
      
        if ($balance >= $realprice) {

            $transactionId = $this->randomDigit();
            $transactionServiceId = $this->randomDigit();
            // dd($request->all());

            DB::table('transactions')->insert([
                'transactionId' => $transactionId,
                'userId' => $user->userId,
                'username' => $user->username,
                'email' => $user->email,
                'phoneNumber' => $user->phoneNumber,
                'amount' =>  $realprice,
                'transactionType' => 'Product Purchase',
                'transactionService' => 'Product Purchase',
                'status' => 'CONFIRM',
                'paymentMethod' => 'wallet',
                'Admin' => 'None',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ]);

            Purchase::create([
                'uid' => Str::uuid(),
                'user_id' => $user->id,
                'vendor_id' => $product->user_id,
                'product_id' => $product->id,
                'image' => $product->image,
                'name' => $product->title,
                'price' =>  $realprice,
                'status' => 1,
                'username' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'state' => $request->state,
                'country' => $request->country,
                'quantity' => $request->quantity,
                'info' => $request->info,
                
            ]);
            $product->quantity -= $request->quantity;
            $product->save();
            return redirect()->route('allproducts')->with('message', "Product bought successfully!");
        } else {

            return redirect()->back()->with('error', "Insufficient balance!");
        }
    }
    public function deliverydetails($product_id)
    {
        $data['product'] = $product = Product::where('uid', $product_id)->first();
        $data['user'] =  $user = Auth::user();
        $data['expenses'] =$expenses = DB::table('transactions')
            ->where('userId', $user->userId)
            ->where('transactionType', '!=', 'Deposit')
            ->where('status', 'CONFIRM')
            ->sum('amount');

        $data['walletamount'] = $walletamount = DB::table('funds')
            ->where('userId', $user->userId)
            ->where('status', 'success')
            ->sum('amount');

            
            

        $data['balance'] = $walletamount - $expenses;



        return view('market.delivery', $data);
    }
    public function moreinfo($product_id)
    {
        $data['purchase'] = $product = Purchase::where('uid', $product_id)->first();
    //   dd($product);
        $data['user'] =  $user = Auth::user();

        return view('market.moreinfo', $data);
    }
}
