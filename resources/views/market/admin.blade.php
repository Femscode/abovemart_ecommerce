@extends('student.master')
@section('head')

@endsection 

@section('content')
<div class="modal fade" id="editCourse" tabindex="-1" aria-labelledby="addQuestionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="addQuestionLabel">Edit Course</h5>
                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal"
                    aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <form id='editCourseForm' class="row text-start g-3" enctype='multipart/form-data'>
                    <!-- Question -->
                    <div class="col-12">
                        <label class="form-label">Title</label>
                        <input type='hidden' id='course_id' />
                        <input id='edittitle' required class="form-control" type="text"
                            placeholder="Input course title">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Course Code</label>
                        
                        <input id='editcoursecode' required class="form-control" type="text"
                            placeholder="Input course code">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Category</label>
                        <select id='editcategory' class='form-control'>
                            <option>--Select Category--</option>
                            @foreach(App\Models\CourseCategory::orderBy('name')->get() as $category)
                            <option value='{{ $category->id }}'>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 mt-3 mb-6">
                        <label class="form-label">Description</label>
                        <div id='editdescription' required class="editoredit form-control" rows="4"
                            placeholder="Input course description" spellcheck="false"></div>
                    </div>


                    <div class="col-6">
                        <label class="form-label">Duration(Hrs)</label>
                        <input id='editduration' required class="form-control" type="text"
                            placeholder="Input course duration">
                    </div>

                    <div class="col-6">
                        <label class="form-label">Price($)</label>
                        <input id='editprice' required class="form-control" type="text"
                            placeholder="Enter 0 is the course is free">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Slashed <s>Price($)</s></label>
                        <input id='editslashedprice' required class="form-control" type="text"
                            placeholder="Enter 0 is the course is free">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Package Access</label><br>
                        <div class='btn btn-success' id='editpackagelist'></div><br>
                        <input id='editpackage' name='editpackage' value='Basic' type='checkbox'> Basic
                        <input id='editpackage' name='editpackage' value='Bronze' type='checkbox'> Bronze
                        <input id='editpackage' name='editpackage' value='Silver' type='checkbox'> Silver
                        <input id='editpackage' name='editpackage' value='Gold' type='checkbox'> Gold
                        <input id='editpackage' name='editpackage' value='Platinum' type='checkbox'> Platinum
                    </div>


                    <div class="col-12">
                        <label class="form-label">Course Display Image <span
                                class='text-danger'>(Optional)</span></label>
                        <div class="rounded mx-auto d-block">
                            <img id='editcourse_img' class="rounded " style='height:100px;width:500px'
                                alt="">
                        </div>
                        <input id='editimage' class="form-control" type="file" accept="image/*"
                            placeholder="Input course title">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger-soft my-0"
                    data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success my-0">Edit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="col-xl-9">

	

	<div class="card bg-transparent border rounded-3">
		<!-- Card header START -->
		<div class="card-header bg-transparent border-bottom">
			<h3 class="mb-0">My Assigned Courses</h3>
		</div>
		<!-- Card header END -->
        <div class="card bg-transparent border">

            <!-- Card header START -->
            <div class="card-header bg-light border-bottom">
                <!-- Search and select START -->
                <div class="row g-3 align-items-center justify-content-between">
                    <!-- Search bar -->
                    <div class="col-md-8">
                        <form method='post' action='searchCourse' class="rounded position-relative">@csrf
                            <div class="search-container">
                                <input required id="search-input" class="form-control bg-body" name='search'
                                    placeholder='Search for course, course code, and description in 10,000+ courses' type="search"
                                    placeholder="Search" aria-label="Search">
                                <ul id="suggestions"></ul>
                            </div>
                            <button class="btn bg-transparent px-2 py-0 position-absolute top-50 end-0 translate-middle-y"
                                type="submit"><a class='btn btn-sm btn-success'><i class="fas fa-search fs-6 "></i>Search</a></button>
                        </form>
                    </div>
    
                    <!-- Select option -->
                    <div class="col-md-3">
                        <!-- Short by filter -->
                        <form>
                            <select class="form-select js-choice border-0 z-index-9"
                                aria-label=".form-select-sm">
                                <option value="">Sort by</option>
                                <option>Newest</option>
                                <option>Oldest</option>
                                <option>Accepted</option>
                                <option>Rejected</option>
                            </select>
                        </form>
                    </div>
                </div>
                <!-- Search and select END -->
            </div>
            <!-- Card header END -->
    
            <!-- Card body START -->
            <div class="card-body">
                <!-- Course table START -->
                <div class="table-responsive border-0 rounded-3">
                    <!-- Table START -->
                    <table class="table table-dark-gray align-middle p-4 mb-0 table-hover">
                        <!-- Table head -->
                        <thead>
                            <tr>
                                <th scope="col" class="border-0 rounded-start">Course Name</th>
                                {{-- <th scope="col" class="border-0">Instructor</th> --}}
                                <th scope="col" class="border-0">Added Date</th>
                              
                                <th scope="col" class="border-0">Price</th>
                                {{-- <th scope="col" class="border-0">Status</th> --}}
                                <th scope="col" class="border-0 rounded-end">Action</th>
                            </tr>
                        </thead>
    
                        <!-- Table body START -->
                        <tbody>
    
                            <!-- Table row -->
                            @foreach($courses as $course)
                            <tr>
                                <!-- Table data -->
                                <td>
                                    <div class="d-flex align-items-center position-relative">
                                        <!-- Image -->
                                        <div class="w-60px">
                                            <img src="https://learn.abovemarts.com/public/courseimage/{{ $course['image']}}" class="rounded" alt="">
                                            {{-- <img src="/courseimage/{{ $course->image}}" class="rounded" alt=""> --}}
                                        </div>
                                        <!-- Title -->
                                        <h6 class="mb-0 ms-2">
                                            <a href="#" class="stretched-link">{{ $course['title'] }} ({{ $course['course_code'] }})</a>
                                        </h6>
                                    </div>
                                </td>
    
    
                                <!-- Table data -->
                                {{-- <td>
                                    <div class="d-flex align-items-center mb-3">
                                        
                                        <div class="avatar avatar-xs flex-shrink-0">
                                            <img class="avatar-img rounded-circle"
                                                src="assets/images/avatar/09.jpg" alt="avatar">
                                        </div>
                                    
                                        <div class="ms-2">
                                            <h6 class="mb-0 fw-light">Fasanya Pelumi</h6>
                                        </div>
                                    </div>
                                </td> --}}
    
                                <!-- Table data -->
                                <td>{{ Date('j F Y',strtotime($course['created_at'])) }}</td>
    
                                <!-- Table data -->
                               
    
                                <!-- Table data -->
                                <td>
                                    @if($course['price'] == 0)
                                    <label class="btn-primary-soft-check border-0 m-0"
                                    for="option1">Free</label>
                                    @else 
                                    ${{ number_format($course['price']) }} <s>${{ number_format($course['slashed_price']) }}</s>
                                    @endif
                                </td>
    
                                <!-- Table data -->
                                {{-- <td> <span class="badge bg-warning bg-opacity-15 text-warning">Pending</span>
                                </td> --}}
    
                                <!-- Table data -->
                                <td>
                                    <a href='preview_course/{{ $course["uid"] }}' class='btn btn-sm btn-primary-soft'>Share</a>
                                   
                                    <a href='admincoursedetails/{{ $course["uid"] }}' class="edit_course btn btn-sm btn-info-soft me-1 mb-1 mb-md-0"
                                        >Lectures</a>
                                    <a href='coursestudents/{{ $course["uid"] }}' class="edit_course btn btn-sm btn-warning-soft me-1 mb-1 mb-md-0"
                                            >Students</a>
                                    {{-- <a data-id='{{ $course["id"] }}'
                                        class="edit_course btn btn-sm btn-primary-soft me-1 mb-1 mb-md-0"
                                        data-bs-toggle="modal" data-bs-target="#editCourse">Edit</a> --}}
                                  
                                </td>
                            </tr>
                            @endforeach
    
                        </tbody>
                        <!-- Table body END -->
                    </table>
                    <!-- Table END -->
                </div>
                <!-- Course table END -->
            </div>
            <!-- Card body END -->
    
            <!-- Card footer START -->
            <div class="card-footer bg-transparent pt-0">
                <!-- Pagination START -->
                <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                    <!-- Content -->
                    <p class="mb-0 text-center text-sm-start">Showing 1 to 8 of 20 entries</p>
                    <!-- Pagination -->
                    <nav class="d-flex justify-content-center mb-0" aria-label="navigation">
                        <ul class="pagination pagination-sm pagination-primary-soft mb-0 pb-0">
                            <li class="page-item mb-0"><a class="page-link" href="#" tabindex="-1"><i
                                        class="fas fa-angle-left"></i></a></li>
                            <li class="page-item mb-0"><a class="page-link" href="#">1</a></li>
                            <li class="page-item mb-0 active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item mb-0"><a class="page-link" href="#">3</a></li>
                            <li class="page-item mb-0"><a class="page-link" href="#"><i
                                        class="fas fa-angle-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Pagination END -->
            </div>
            <!-- Card footer END -->
        </div>

	</div>
	<!-- Main content END -->
</div><!-- Row END -->

@endsection
@section('script')

@endsection