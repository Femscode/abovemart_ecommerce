@extends('student.master')
@section('head')
@endsection

@section('content')
<style>
	/* .search-container {
		width: 300px;
		margin: 0 auto;
		position: relative;
	} */

	#search-input {
		width: 100%;
		padding: 10px;
	}

	#suggestions {
		position: relative;
		top: 100%;
		left: 0;
		width: 100%;
		background-color: #fff;
		border: 1px solid #ccc;
		display: none;
		list-style: none;
		padding: 0;
		margin: 0;
	}

	#suggestions li {
		padding: 10px;
		border-bottom: 1px solid #ccc;
		cursor: pointer;
	}

	#suggestions li:hover {
		background-color: #f0f0f0;
	}
</style>
<div class="col-xl-9">
	@if($user->ebook_count < 1) <div class='m-2 alert alert-danger'>You have reached the maximum number of E-books you
		can download/preview based on your account type, upgrade
		now to have increased access. <br><a target="_blank" href='https://abovemarts.com/userpackages'
			class='btn btn-danger'>Upgrade</a>
</div>
@endif

<div class="card bg-transparent border rounded-3">
	<!-- Card header START -->
	<div class="card-header bg-transparent border-bottom">
		<h3 class="mb-0">All Available Ebooks</h3>
	</div>



	<div class="col-md-12">

		<form method='post' action='searchEbookStudent' class="rounded position-relative">@csrf
			<div class="search-container">
				<input required id="search-input" class="form-control bg-body" name='search'
					placeholder='Search for books, tutorials, manuals, and authors in 10,000+ files' type="search"
					placeholder="Search" aria-label="Search">
				<ul id="suggestions"></ul>
			</div>
			<button class="btn bg-transparent px-2 py-0 position-absolute top-50 end-0 translate-middle-y"
				type="submit"><a class='btn btn-sm btn-success'><i class="fas fa-search fs-6 "></i>Search</a></button>
		</form>
	</div>

	<!-- Card header END -->

	<!-- Card body START -->
	<div class="card-body p-3 p-md-4">
		<div class="row g-4">
			<!-- Card item START -->
			@foreach($all_ebooks as $ebook)
			<div class="card shadow p-2">
				<div class="row g-0">
					<div class="col-md-5">
						@if($ebook->image !== null)
						<img src="https://learn.abovemarts.com/public/ebook_images/{{ $ebook->image}}" class="rounded-2" alt="Card image">
						{{-- <img src="{{ asset('ebook_images/'.$ebook->image) }}" class="rounded-2" alt="Card image"> --}}

						@else
						<img src="{{ asset('ebook_images/pdf.png') }}" class="rounded-2" alt="Card image">
						@endif
					</div>
					<div class="col-md-7">
						<div class="card-body">
							<!-- Badge and rating -->
							<div class="d-flex justify-content-between align-items-center mb-2">
								<!-- Badge -->
								<a href="#" class="badge text-bg-primary mb-2 mb-sm-0">Marketing</a>
								<!-- Rating and wishlist -->
								<div>
									<span class="h6 fw-light me-3"><i
											class="fas fa-star text-warning me-1"></i>4.5</span>
									<a href="#" class="h6 fw-light"><i class="far fa-heart"></i></a>
								</div>
							</div>

							<!-- Title -->
							<h5 class="card-title"><a href="#">{{ $ebook->title }}</a></h5>
							<p class="text"><b>{{ Str::limit($ebook->cat->name,150) }}</b><br> {{ $ebook->description }} </p>

							<!-- Info -->
							<ul class="list-inline">
								<li class="list-inline-item h6 fw-light mb-1 mb-sm-0"><i
										class="far fa-clock text-danger me-2"></i>{{ Date('Y') }}</li>
								<li class="list-inline-item h6 fw-light mb-1 mb-sm-0"><i
										class="fas fa-table text-orange me-2"></i>100+ Pages</li>
								<li class="list-inline-item h6 fw-light"><i
										class="fas fa-signal text-success me-2"></i>2MB</li>
							</ul>

							<!-- Price and avatar -->
							<div class="d-sm-flex justify-content-sm-between align-items-center">
								<!-- Avatar -->
								<div class="d-flex justify-content-between">
									<span class="h6 fw-light mb-0"><i class="far fa-user text-danger me-2"></i>Author :
										{{
										$ebook->author ?? 'unknown' }}</span>
								</div>
								<!-- Price -->
								<div class="mt-3 mt-sm-0">
									<a href='live_preview/{{ $ebook->uid }}' class='btn btn-sm btn-primary-soft'>Share</a>
                                
									<a href='/preview_ebook/{{ $ebook->uid }}'
										class='btn btn-success btn-sm'>Preview</a>
									<a @if($user->rank == "Free Member") href="https://abovemarts.com/userpackages" @else href='/download_ebook/{{ $ebook->uid }}' @endif
										class='btn btn-danger btn-sm'>Download</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{-- <div class="col-sm-6 col-lg-4">
				<div class="card shadow h-100">
					<!-- Image -->
					<div class="card-body pb-0">
						<!-- Badge and favorite -->
						<div class="d-flex justify-content-between mb-2">
							<a href="#" class="badge bg-success bg-opacity-10 text-success">{{ $ebook->category }}</a>

							@if($ebook->image !== null)
							<img src='{{ asset(' ebook_images/'.$ebook->image) }}' style='width:100px;height:100px'/>
							@else
							<img src='{{ asset(' ebook_images/pdf.png') }}' style='width:100px;height:100px' />
							@endif
						</div>
						<!-- Title -->
						<h6 class="card-title fw-normal"><a href="#">{{ $ebook->title }}</a></h6>
						<p class="mb-2 text-truncate-2">{{ Str::limit($ebook->cat->name,30) }}</p>
						<!-- Rating star -->

					</div>
					<!-- Card footer -->
					<div class="card-footer pt-0 pb-3">
						<hr>
						<div class="d-flex justify-content-between">
							<span class="h6 fw-light mb-0"><i class="far fa-user text-danger me-2"></i>Author : {{
								$ebook->author ?? 'unknown' }}</span>
						</div>
						<br>
						<a href='/preview_ebook/{{ $ebook->uid }}' class='btn btn-success btn-sm'>Preview</a>
						<a href='/download_ebook/{{ $ebook->uid }}' class='btn btn-danger btn-sm'>Download</a>
					</div>
				</div>
			</div> --}}
			@endforeach
			<!-- Card item END -->

			<div class='pagination justify-content-center'>
				{!! $all_ebooks->links('pagination::bootstrap-4') !!}
			</div>


		</div>
	</div>
	<!-- Card body EMD -->
</div>
</div>
@endsection
@section('script')
<script>
	const searchInput = document.getElementById('search-input');
const suggestionsList = document.getElementById('suggestions');
const apiUrl = '/searchEbookTitle';
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
                suggestionItem.textContent = item.title +" by " + item.author;
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
@endsection