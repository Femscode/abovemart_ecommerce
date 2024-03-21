@extends('admin.master')
@section('header')
@endsection

@section('content')
<div class="modal fade" id="addAdmin" tabindex="-1" aria-labelledby="addAdminLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-dark">
            <h5 class="modal-title text-white" id="addAdminLabel">Assign Admin</h5>
            <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal"
                aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
                <form method='post' action='/assignadmin' class="row text-start g-3"
                    enctype='multipart/form-data'>@csrf
                    <!-- Question -->
                  
                   

                    <div class="col-12">
                        <label class="form-label">Course</label>
                        <select id='course_id' name='course_id' required class='form-control'>
                            <option>--Select Course--</option>
                            @foreach($courses as $course)
                            <option value='{{ $course->id }}'>{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">User</label>
                        <select id='admin' name='admin' required class='form-control'>
                            <option>--Select User--</option>
                            @foreach($users as $user)
                            <option value='{{ $user->id }}'>{{ $user->firstname }} - {{ $user->lastname }}({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>

                 
                    <div class="col-12">
                        <label class="form-label">Access</label><br>
                        <input id='access' name='access[]' value='Lectures' type='checkbox'> Manage Lectures
                        <input id='access' name='access[]' value='Students' type='checkbox'> Manage Students
                        <input id='access' name='access[]' value='Edit' type='checkbox'> Edit Course
                       </div>


                   






        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger-soft my-0"
                data-bs-dismiss="modal">Close</button>
            <button id='c_submita' type="submit" class="btn btn-success my-0">Assign</button>
        </div>
        </form>
    </div>
</div>
</div>

<div class="page-content-wrapper border">

	<!-- Title -->
	<div class="row mb-3">
		<div class="col-12 d-sm-flex justify-content-between align-items-center">
			<h1 class="h3 mb-2 mb-sm-0">Admin Access</h1>
			<a href="#" class="btn btn-sm btn-primary mb-0" data-bs-toggle="modal"
				data-bs-target="#addAdmin"><i class="bi bi-plus-circle me-2"></i>Assign Admin</a>

		</div>
	</div>

	<!-- Course boxes START -->
	<div class="row g-4 mb-4">
		<!-- Course item -->
		<div class="col-sm-6 col-lg-6">
			<a href='/dashboard'>
			<div class="text-center p-4 bg-primary bg-opacity-10 border border-primary rounded-3">
				<h6>Total Courses</h6>
				<h2 class="mb-0 fs-1 text-primary">{{ count($courses) }}</h2>
			</div>
		</a>
		</div>

		<!-- Course item -->
		<div class="col-sm-6 col-lg-6">
			<a href='/announcement'>
			<div class="text-center p-4 bg-success bg-opacity-10 border border-success rounded-3">
				<h6>Admins</h6>
				<h2 class="mb-0 fs-1 text-success">{{ count($admins) }}</h2>
			</div>
			</a>
		</div>

		
	</div>
	<!-- Course boxes END -->

	<!-- Card START -->
	<div class="card bg-transparent border">

		<!-- Card header START -->
		<div class="card-header bg-light border-bottom">
			<!-- Search and select START -->
			<div class="row g-3 align-items-center justify-content-between">
				<!-- Search bar -->
				<div class="col-md-12">
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
						
							<th scope="col" class="border-0">Admin</th>
							<th scope="col" class="border-0">Access</th>
							
							<th scope="col" class="border-0 rounded-end">Action</th>
						</tr>
					</thead>

					<!-- Table body START -->
					<tbody>

						<!-- Table row -->
						@foreach($admins as $admin)
						<tr>
						

							<td>{{ $admin->course->title }}</td>

							<!-- Table data -->
							<td> 
                                {{ $admin->admin->firstname }} - {{ $admin->admin->lastname }}<br>
                                <b>{{ $admin->admin->email }}</b>
                                    
                            </td>

							<!-- Table data -->
							<td>
							@foreach($admin->access as $access)
                            <a  class='btn btn-sm btn-primary-soft'>{{ $access }}</a>

                            @endforeach
							</td>

							<!-- Table data -->
							{{-- <td> <span class="badge bg-warning bg-opacity-15 text-warning">Pending</span>
							</td> --}}

							<!-- Table data -->
							<td>
								<a  href='deleteAccess/{{ $admin->id }}' onclick="return confirm('Are you sure you want to revoke access for this user?')"
									class="btn btn-sm btn-danger mb-0">Revoke Access</a>
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
	<!-- Card END -->
</div>
@endsection

@section('script')

<script>
	const searchInput = document.getElementById('search-input');
const suggestionsList = document.getElementById('suggestions');
const apiUrl = '/searchCourseTitle';
// const apiUrl = 'https://your-api-endpoint.com/search?q=';

searchInput.addEventListener('input', function () {
    const query = searchInput.value.trim();
	
    
    if (query === '') {
        suggestionsList.style.display = 'none';
        return;
    }

    // Fetch data from the API
	fetch(apiUrl + '?search=' + query)
        .then(response => response.json())
        .then(data => {
            // Clear previous suggestions
            suggestionsList.innerHTML = '';

            // Display new suggestions
            data.forEach(item => {
                const suggestionItem = document.createElement('li');
                suggestionItem.textContent = item.title  +" - " + item.course_code;
                suggestionItem.addEventListener('click', () => {
                    searchInput.value = item.title;
                    suggestionsList.style.display = 'none';
                });
                suggestionsList.appendChild(suggestionItem);
            });

            suggestionsList.style.display = 'block';
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
});

// Close the suggestions when clicking outside the input and list
document.addEventListener('click', function (event) {
    if (event.target !== searchInput && event.target !== suggestionsList) {
        suggestionsList.style.display = 'none';
    }
});

</script>

	<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
@endsection

