@extends('admin.master')
@section('header')
@endsection

@section('content')

<div class="page-content-wrapper border">

	<!-- Title -->
	<div class="row mb-3">
		<div class="col-12 d-sm-flex justify-content-between align-items-center">
			<h1 class="h3 mb-2 mb-sm-0">Products</h1>
			<div>
			<a href="#" class="btn btn-sm btn-primary mb-0" data-bs-toggle="modal"
				data-bs-target="#addQuestion"><i class="bi bi-plus-circle me-2"></i>Add Product</a>
			{{-- <a href="/admin_access" class="btn btn-sm btn-info mb-0"><i class="bi bi-plus-circle me-2"></i>Admin Access</a> --}}
			</div>
		</div>
		<div class='alert alert-success'>
			My Vendor's URL : <a target="_blank" href='https://shop.abovemarts.com/vendor/{{ $user->username }}' style='color:red'><i>https://shop.abovemarts.com/vendor/{{ $user->username }}</i></a>
		</div>
	</div>

	<!-- Course boxes START -->
	<div class="row g-4 mb-4">
		<!-- Course item -->
		<div class="col-sm-6 col-lg-4">
			<a href='/dashboard'>
			<div class="text-center p-4 bg-primary bg-opacity-10 border border-primary rounded-3">
				<h6>Total Products</h6>
				<h2 class="mb-0 fs-1 text-primary">{{ count($products) }}</h2>
			</div>
		</a>
		</div>

		<!-- Course item -->
		<div class="col-sm-6 col-lg-4">
			<a href='/boughtproducts'>
			<div class="text-center p-4 bg-success bg-opacity-10 border border-success rounded-3">
				<h6>Bought Products</h6>
				<h2 class="mb-0 fs-1 text-success">{{ count($boughtproducts) }}</h2>
			</div>
			</a>
		</div>
		<div class="col-sm-6 col-lg-4">
			<a href='/categories'>
			<div class="text-center p-4 bg-secondary bg-opacity-10 border border-secondary rounded-3">
				<h6>Categories</h6>
				<h2 class="mb-0 fs-1 text-secondary">{{ count($categories) }}</h2>
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
				<div class="col-md-8">
					<form method='post' action='searchCourse' class="rounded position-relative">@csrf
						<div class="search-container">
							<input required id="search-input" class="form-control bg-body" name='search'
								placeholder='Search for products' type="search"
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
							<th scope="col" class="border-0 rounded-start">Product Name</th>
							{{-- <th scope="col" class="border-0">Instructor</th> --}}
							<th scope="col" class="border-0">Added Date</th>
							<th scope="col" class="border-0">Type</th>
							<th scope="col" class="border-0">Price</th>
							{{-- <th scope="col" class="border-0">Status</th> --}}
							<th scope="col" class="border-0 rounded-end">Action</th>
						</tr>
					</thead>

					<!-- Table body START -->
					<tbody>

						<!-- Table row -->
						@foreach($products as $product)
						<tr>
							<!-- Table data -->
							<td>
								<div class="d-flex align-items-center position-relative">
									<!-- Image -->
									<div class="w-60px">
										<img src="https://shop.abovemarts.com/public/productimage/{{ $product->image}}" class="rounded" alt="">
										{{-- <img src="/courseimage/{{ $product->image}}" class="rounded" alt=""> --}}
									</div>
									<!-- Title -->
									<h6 class="mb-0 ms-2">
										<a href="#" class="stretched-link">{{ $product->title }}<br>{{ $product->sku }}</a>
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
							<td>{{ Date('j F Y',strtotime($product->created_at)) }}</td>

							<!-- Table data -->
							<td> <span class="btn btn-sm btn-success-soft me-1 mb-1 mb-md-0">{{
									$product->cat->name ?? "not specified" }}({{ $product->subcat->name ?? "not specified" }})</span> </td>

							<!-- Table data -->
							<td>
								@if($product->price == 0)
								<label class="btn-primary-soft-check border-0 m-0"
								for="option1">Free</label>
								@else 
								NGN{{ number_format($product->price) }} <s>NGN{{ number_format($product->slashed_price) }}</s>
								<br>Quantity : {{ number_format($product->quantity) }}
								@endif
							</td>

							<!-- Table data -->
							{{-- <td> <span class="badge bg-warning bg-opacity-15 text-warning">Pending</span>
							</td> --}}

							<!-- Table data -->
							<td>
								<a href='preview_product/{{ $product->uid }}' class='btn btn-sm btn-primary-soft'>Share</a>
                             
								<a data-id='{{ $product->id }}'
									class="edit_course btn btn-sm btn-primary-soft me-1 mb-1 mb-md-0"
									data-bs-toggle="modal" data-bs-target="#editProduct">Edit</a>
								<button id='delete_course' data-id='{{ $product->id }}'
									class="btn btn-sm btn-danger-soft mb-0">Delete</button>
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

