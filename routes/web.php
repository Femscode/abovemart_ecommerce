<?php

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Models\Assignment;

// route for the courses
Route::view('mycertificate','certificate.third_certificate');
Route::any('/live_preview/{id}', [App\Http\Controllers\ExamController::class, 'live_preview'])->name('live_preview');
Route::any('/marketplace/', [App\Http\Controllers\ExamController::class, 'marketplace'])->name('marketplace');
Route::any('/preview_product/{id}', [App\Http\Controllers\CourseController::class, 'live_preview'])->name('preview_product');

Auth::routes();

Route::any('run_uid', function() {
    $courses = Assignment::all();
    foreach($courses as $course) {
        $course->uid = Str::uuid();
        $course->save();
    }
});
// Route::any('/', [App\Http\Controllers\CourseController::class, 'homepage'])->name('homepage');
Route::any('/', [App\Http\Controllers\CourseController::class, 'index'])->name('index')->middleware('auth');
Route::any('/dashboard', [App\Http\Controllers\CourseController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::any('/admin', [App\Http\Controllers\CourseController::class, 'admin'])->name('admin')->middleware('auth');
Route::any('/approve/{id}', [App\Http\Controllers\CourseController::class, 'approve'])->name('approve')->middleware('auth');
Route::any('/admin_access', [App\Http\Controllers\CourseController::class, 'admin_access'])->name('admin_access')->middleware('auth');
Route::any('/assignadmin', [App\Http\Controllers\CourseController::class, 'assignadmin'])->name('assignadmin')->middleware('auth');
Route::any('/deleteAccess/{id}', [App\Http\Controllers\CourseController::class, 'deleteAccess'])->name('deleteAccess')->middleware('auth');
Route::any('/profile', [App\Http\Controllers\CourseController::class, 'profile'])->name('profile')->middleware('auth');
Route::any('/market', [App\Http\Controllers\CourseController::class, 'market'])->name('market')->middleware('auth');
Route::any('/admindashboard', [App\Http\Controllers\CourseController::class, 'admindashboard'])->name('admindashboard')->middleware('auth');
Route::group(['middleware' => 'auth'], function() {
//route for courses

//route for course videos
Route::any('/createsection', [App\Http\Controllers\CourseController::class, 'createsection'])->name('createsection');
Route::any('/fetchsection', [App\Http\Controllers\CourseController::class, 'fetchsection'])->name('fetchsection');
Route::any('/createsectionvideo', [App\Http\Controllers\CourseController::class, 'createsectionvideo'])->name('createsectionvideo');
Route::any('/downloadsectionvideo/{id}', [App\Http\Controllers\CourseController::class, 'downloadsectionvideo'])->name('downloadsectionvideo');
Route::any('/deletesectionvideo', [App\Http\Controllers\CourseController::class, 'deletesectionvideo'])->name('deletesectionvideo');
Route::any('/deletesection/{id}', [App\Http\Controllers\CourseController::class, 'deletesection'])->name('deletesection');

//route for course enrollment
Route::any('/deliverydetails/{product_id}', [App\Http\Controllers\CourseController::class, 'deliverydetails'])->name('deliverydetails');
Route::any('/buyproduct/{product_id}', [App\Http\Controllers\CourseController::class, 'buyproduct'])->name('buyproduct');
Route::any('/moreinfo/{product_id}', [App\Http\Controllers\CourseController::class, 'moreinfo'])->name('moreinfo');
Route::any('/buyproduct', [App\Http\Controllers\CourseController::class, 'buyproduct'])->name('buyproduct');
Route::any('/lesson/{product_id}', [App\Http\Controllers\CourseController::class, 'lesson'])->name('lesson');
Route::any('/markdone/{product_id}', [App\Http\Controllers\CourseController::class, 'markdone'])->name('markdone');
Route::any('/students/{product_id}', [App\Http\Controllers\CourseController::class, 'students'])->name('students');
Route::any('/coursestudents/{product_id}', [App\Http\Controllers\CourseController::class, 'coursestudents'])->name('coursestudents');
Route::any('/view_assessment/{userId}/{product_id}', [App\Http\Controllers\ExamController::class, 'viewAssessment'])->name('viewassessment');
Route::any('/lock_certificate/{userId}/{product_id}', [App\Http\Controllers\ExamController::class, 'lockCertificate'])->name('lockcertificate');
Route::any('/payForExam/{userId}/{product_id}', [App\Http\Controllers\ExamController::class, 'payForExam'])->name('payForExam');


Route::any('/createproduct', [App\Http\Controllers\CourseController::class, 'createproduct'])->name('createproduct');
Route::any('/courseindex', [App\Http\Controllers\CourseController::class, 'courseindex'])->name('courseindex');
Route::any('/coursedetails/{id}', [App\Http\Controllers\CourseController::class, 'coursedetails'])->name('coursedetails');
Route::any('/admincoursedetails/{id}', [App\Http\Controllers\CourseController::class, 'admincoursedetails'])->name('admincoursedetails');
Route::any('/courses', [App\Http\Controllers\CourseController::class, 'course'])->name('course');
Route::any('/allproducts', [App\Http\Controllers\CourseController::class, 'allproducts'])->name('allproducts');
Route::any('/loadproduct', [App\Http\Controllers\CourseController::class, 'loadproduct'])->name('loadproduct');
Route::any('/editProduct', [App\Http\Controllers\CourseController::class, 'editProduct'])->name('editProduct');
Route::any('/loadsection', [App\Http\Controllers\CourseController::class, 'loadsection'])->name('loadsection');
Route::any('/editsection', [App\Http\Controllers\CourseController::class, 'editsection'])->name('editsection');
Route::any('/deleteproduct', [App\Http\Controllers\CourseController::class, 'deleteproduct'])->name('deleteproduct');
Route::any('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
//route for announcemet
Route::any('/createann', [App\Http\Controllers\CourseController::class, 'createann'])->name('createann');
Route::any('/announcement', [App\Http\Controllers\CourseController::class, 'ann'])->name('annindex');
Route::any('/boughtproducts', [App\Http\Controllers\CourseController::class, 'boughtproducts'])->name('boughtproducts');
Route::any('/adminboughtproducts', [App\Http\Controllers\CourseController::class, 'adminboughtproducts'])->name('adminboughtproducts');
Route::any('/marksent/{id}', [App\Http\Controllers\CourseController::class, 'marksent'])->name('marksent');
Route::any('/markreceived/{id}', [App\Http\Controllers\CourseController::class, 'markreceived'])->name('markreceived');
Route::any('/markrefund/{id}', [App\Http\Controllers\CourseController::class, 'markrefund'])->name('markrefund');
Route::any('/loadann', [App\Http\Controllers\CourseController::class, 'loadann'])->name('loadann');
Route::any('/editann', [App\Http\Controllers\CourseController::class, 'editann'])->name('editann');
Route::any('/deleteann', [App\Http\Controllers\CourseController::class, 'deleteann'])->name('deleteann');
//route for assignment
Route::any('/createassignment', [App\Http\Controllers\CourseController::class, 'createassignment'])->name('createassignment');
Route::any('/assignment', [App\Http\Controllers\CourseController::class, 'assignment'])->name('assignment');
Route::any('/loadassignment', [App\Http\Controllers\CourseController::class, 'loadassignment'])->name('loadassignment');
Route::any('/editassignment', [App\Http\Controllers\CourseController::class, 'editassignment'])->name('editassignment');
Route::any('/viewass/{id}', [App\Http\Controllers\CourseController::class, 'viewass'])->name('viewass');
Route::any('/deleteassignment', [App\Http\Controllers\CourseController::class, 'deleteassignment'])->name('deleteassignment');
Route::any('/deleteass/{id}', [App\Http\Controllers\CourseController::class, 'deleteass'])->name('deleteass');
Route::any('/upload_assessment', [App\Http\Controllers\ExamController::class, 'upload_assessment'])->name('upload_assessment');
Route::any('/view_uploaded_assessment/{user_id}/{ass_id}', [App\Http\Controllers\ExamController::class, 'view_uploaded_assessment'])->name('view_uploaded_assessment');

//Admin Ebooks
Route::any('/admin_ebooks', [App\Http\Controllers\ExamController::class, 'admin_ebooks'])->name('admin_ebooks');
Route::any('/giveaway', [App\Http\Controllers\ExamController::class, 'admin_giveaway'])->name('admin_giveaway');
Route::any('/createGiveaway', [App\Http\Controllers\ExamController::class, 'admin_createGiveaway'])->name('admin_createGiveaway');
Route::any('/check_giveaway/{id}', [App\Http\Controllers\ExamController::class, 'admin_check_giveaway'])->name('admin_check_giveaway');
Route::any('/course_categories', [App\Http\Controllers\ExamController::class, 'course_categories'])->name('course_categories');
Route::any('/categories', [App\Http\Controllers\ExamController::class, 'categories'])->name('categories');
Route::any('/all_ebooks', [App\Http\Controllers\ExamController::class, 'all_ebooks'])->name('all_ebooks');
Route::any('/allebooks', [App\Http\Controllers\ExamController::class, 'allebooks'])->name('allebooks');
Route::any('/createEbook', [App\Http\Controllers\ExamController::class, 'createEbook'])->name('createEbook');
Route::any('/createCategory', [App\Http\Controllers\ExamController::class, 'createCategory'])->name('createCategory');
Route::any('/createSubCategory', [App\Http\Controllers\ExamController::class, 'createSubCategory'])->name('createSubCategory');
Route::any('/fetchsubcategories', [App\Http\Controllers\ExamController::class, 'fetchsubcategory'])->name('fetchsubcategories');
Route::any('/createCourseCategory', [App\Http\Controllers\ExamController::class, 'createCourseCategory'])->name('createCourseCategory');
Route::any('/searchEbook', [App\Http\Controllers\ExamController::class, 'searchEbook'])->name('searchEbook');
Route::any('/searchEbookStudent', [App\Http\Controllers\ExamController::class, 'searchEbookStudent'])->name('searchEbookStudent');
Route::any('/searchEbookTitle', [App\Http\Controllers\ExamController::class, 'searchEbookTitle'])->name('searchEbookTitle');
Route::any('/searchCourse', [App\Http\Controllers\CourseController::class, 'searchCourse'])->name('searchCourse');
Route::any('/searchProduct', [App\Http\Controllers\CourseController::class, 'searchProduct'])->name('searchProduct');
Route::any('/searchCourseTitle', [App\Http\Controllers\CourseController::class, 'searchCourseTitle'])->name('searchCourseTitle');
Route::any('/edit_ebook/{id}', [App\Http\Controllers\ExamController::class, 'edit_ebook'])->name('edit_ebook');
Route::any('/update_ebook', [App\Http\Controllers\ExamController::class, 'update_ebook'])->name('update_ebook');
Route::any('/delete_ebook', [App\Http\Controllers\ExamController::class, 'delete_ebook'])->name('delete_ebook');
Route::any('/delete_category', [App\Http\Controllers\ExamController::class, 'delete_category'])->name('delete_category');
Route::any('/delete_course_category', [App\Http\Controllers\ExamController::class, 'delete_course_category'])->name('delete_course_category');
Route::any('/download_ebook/{id}', [App\Http\Controllers\ExamController::class, 'download_ebook'])->name('download_ebook');
Route::any('/preview_ebook/{id}', [App\Http\Controllers\ExamController::class, 'preview_ebook'])->name('preview_ebook');
Route::any('/download_certificate/{id}', [App\Http\Controllers\ExamController::class, 'download_certificate'])->name('download_certificate');



//route for questions and answers
Route::get('/create_question/{id}', [App\Http\Controllers\ExamController::class, 'create_question'])->name('create_question');
Route::post('/storequestion', [App\Http\Controllers\ExamController::class, 'storequestion'])->name('storequestion');
Route::any('/starttest/{id}',[ExamController::class,'starttest'])->name('starttest');

Route::any('/submittest',[ExamController::class,'submittest'])->name('submittest');
Route::any('/finishtest',[ExamController::class,'finishtest'])->name('finishtest');
Route::get('/result/user/{userId}/quiz/{quizId}',[ExamController::class, 'viewResult'])->middleware('auth');

Route::any('/checkuserresult/{userid}/{testid}',[ExamController::class,'checkuserresult'])->name('checkuserresult');

});
// Route::get('/', function () {
//     return view('welcome');
// });
