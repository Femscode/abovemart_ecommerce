@extends('student.master')
@section('head')
@endsection 

@section('content')
<div class="col-xl-9">

	<!-- Counter boxes END -->
    <div class="card bg-transparent">

		<!-- Card header START -->
		<div class="card-header bg-transparent border-bottom px-0">
			<!-- Search and select START -->
			<div class="row g-3 align-items-center justify-content-between">

				<!-- Search bar -->
				<div class="col-md-8">
					<form class="rounded position-relative">
						<input class="form-control bg-transparent" type="search" placeholder="Search" aria-label="Search">
						<button class="btn bg-transparent px-2 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit"><i class="fas fa-search fs-6 "></i></button>
					</form>
				</div>

				<!-- Tab button -->
				<div class="col-md-3">
					<!-- Tabs START -->
					<ul class="list-inline mb-0 nav nav-pills nav-pill-dark-soft border-0 justify-content-end" id="pills-tab" role="tablist">
						<!-- Grid tab -->
						<li class="nav-item">
							<a href="#nav-preview-tab-1" class="nav-link mb-0 me-2 active" data-bs-toggle="tab">
								<i class="fas fa-fw fa-th-large"></i>
							</a>
						</li>
						<!-- List tab -->
						<li class="nav-item">
							<a href="#nav-html-tab-1" class="nav-link mb-0" data-bs-toggle="tab">
								<i class="fas fa-fw fa-list-ul"></i>
							</a>
						</li>
					</ul>
					<!-- Tabs end -->
				</div>
			</div>
			<!-- Search and select END -->
		</div>
		<!-- Card header END -->

		<!-- Card body START -->
		<div class="card-body px-0">

			<!-- Tabs content START -->
			<div class="tab-content">

				<!-- Tabs content item START -->
				<div class="tab-pane fade show active" id="nav-preview-tab-1">
					<div class="row g-4">

						<!-- Card item START -->
						@foreach($users as $user)
						<div class="col-md-6 col-xxl-4">
							<div class="card bg-transparent border h-100"> 
								<!-- Card header -->
								<div class="card-header bg-transparent border-bottom d-flex justify-content-between">
									<div class="d-sm-flex align-items-center">
										<!-- Avatar -->
										<div class="avatar avatar-md flex-shrink-0">
											<img class="avatar-img rounded-circle" src="{{ asset('assets/images/avatar/01.jpg')}}" alt="avatar">
										</div>
										<!-- Info -->
										<div class="ms-0 ms-sm-2 mt-2 mt-sm-0">
											<h5 class="mb-0"><a href="#">{{ $user->firstName }} {{ $user->lastName }}</a></h5>
											<span class="text-body small"><i class="fas fa-fw fa-map-marker-alt me-1 mt-1"></i>Nigerian</span>
										</div>
									</div>

									<!-- Edit dropdown -->
									<div class="dropdown text-end">
										<a href="#" class="btn btn-sm btn-light btn-round small mb-0" role="button" id="dropdownShare2" data-bs-toggle="dropdown" aria-expanded="false">
											<i class="bi bi-three-dots fa-fw"></i>
										</a>
										<!-- dropdown button -->
										<ul class="dropdown-menu dropdown-w-sm dropdown-menu-end min-w-auto shadow rounded" aria-labelledby="dropdownShare2">
											<li><a class="dropdown-item" href="/view_assessment/{{ $user->id }}/{{ $course->uid }}"><i class="bi bi-eye fa-fw me-2"></i>View Assessments</a></li>
											@if($user->enr->completed == 1)
											<li><a class="dropdown-item" href="/lock_certificate/{{ $user->id }}/{{ $course->id }}"><i class="bi bi-lock fa-fw me-2"></i>Lock Certificate</a></li>
											@else
											<li><a class="dropdown-item" href="/lock_certificate/{{ $user->id }}/{{ $course->id }}"><i class="bi bi-unlock fa-fw me-2"></i>Unlock Certificate</a></li>
											@endif
										</ul>
									</div>
								</div>

								<div class="card-body">
									<!-- Payments -->
									<div class="d-flex justify-content-between align-items-center mb-3">
										<div class="d-flex align-items-center">
											<div class="icon-md bg-success bg-opacity-10 text-success rounded-circle flex-shrink-0"><i class="bi bi-currency-dollar fa-fw"></i></div>
											<h6 class="mb-0 ms-2 fw-light">Payments</h6>
										</div>
										<span class="mb-0 fw-bold">${{ number_format($course->price,2) }}</span>
									</div>

									<!-- Total courses -->
									<div class="d-flex justify-content-between align-items-center mb-3">
										<div class="d-flex align-items-center">
											<div class="icon-md bg-purple bg-opacity-10 text-purple rounded-circle flex-shrink-0"><i class="fas fa-book fa-fw"></i></div>
											<h6 class="mb-0 ms-2 fw-light">{{ $user->email }}</h6>
										</div>
										{{-- <span class="mb-0 fw-bold">	{{
											count(App\Models\SectionVideo::where('course_id',$course->id)->get())
											}}</span> --}}
									</div>
									
									<!-- Progress -->
									{{-- <div class="overflow-hidden">
										<h6 class="mb-0">0%</h6>
										<div class="progress progress-sm bg-primary bg-opacity-10">
											<div class="progress-bar bg-primary aos" role="progressbar" data-aos="slide-right" data-aos-delay="200" data-aos-duration="1000" data-aos-easing="ease-in-out" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
											</div>
										</div>
									</div> --}}
								</div>

								<!-- Card footer -->
								<div class="card-footer bg-transparent border-top">
									<div class="d-sm-flex justify-content-between align-items-center">

										<div class="overflow-hidden">
											<h6 class="mb-0">0%</h6>
											<div class="progress progress-sm bg-primary bg-opacity-10">
												<div class="progress-bar bg-primary aos" role="progressbar" data-aos="slide-right" data-aos-delay="200" data-aos-duration="1000" data-aos-easing="ease-in-out" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
												</div>
											</div>
										</div>
										<!-- Rating star -->
										{{-- <h6 class="mb-2 mb-sm-0">
											<i class="bi bi-calendar fa-fw text-orange me-2"></i><span class="text-body">Enrolled at:</span> {{ Date('d M, Y',strtotime($user->created_at)) }}
										</h6> --}}
										<!-- Buttons -->
										<div class="text-end text-primary-hover">
											<a href="mailto:{{ $user->email }}" class="btn btn-link text-body p-0 mb-0 me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Message" aria-label="Message">
												<i class="bi bi-envelope-fill"></i>
											</a>
											<a href="tel:{{ $user->phone }}" class="btn btn-link text-body p-0 mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Block" aria-label="Block">
												<i class="fas fa-phone"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
						<!-- Card item END -->
					</div>
				</div>
				<!-- Tabs content item END -->

				<!-- Tabs content item START -->
				<div class="tab-pane fade" id="nav-html-tab-1">
					<div class="table-responsive border-0">
						<table class="table table-dark-gray align-middle p-4 mb-0 table-hover">
							<!-- Table head -->
							<thead>
								<tr>
									<th scope="col" class="border-0 rounded-start">Student name</th>
									<th scope="col" class="border-0">Enrolled date</th>
									<th scope="col" class="border-0">Progress</th>
									<th scope="col" class="border-0">Courses</th>
									<th scope="col" class="border-0">Payments</th>
									<th scope="col" class="border-0 rounded-end">Action</th>
								</tr>
							</thead>

							<!-- Table body START -->
							<tbody>

								<!-- Table row -->
								@foreach($users as $user)
								<tr>
									<!-- Table data -->
									<td>
										<div class="d-flex align-items-center position-relative">
											<!-- Image -->
											<div class="avatar avatar-md">
												<img src="assets/images/avatar/09.jpg" class="rounded-circle" alt="">
											</div>
											<div class="mb-0 ms-3">
												<!-- Title -->
												<h6 class="mb-0"><a href="#" class="stretched-link">{{ $user->name }}</a></h6>
												<span class="text-body small"><i class="fas fa-fw fa-map-marker-alt me-1 mt-1"></i>Nigeria</span>
											</div>
										</div>
									</td>

									<!-- Table data -->
									<td>{{ Date('d M, Y',strtotime($user->created_at)) }}</td>

									<!-- Table data -->
									<td class="text-center text-sm-start">
										<div class="overflow-hidden">
											<h6 class="mb-0">85%</h6>
											<div class="progress progress-sm bg-primary bg-opacity-10">
												<div class="progress-bar bg-primary aos" role="progressbar" data-aos="slide-right" data-aos-delay="200" data-aos-duration="1000" data-aos-easing="ease-in-out" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
												</div>
											</div>
										</div>
									</td>

									<!-- Table data -->
									<td>21</td>

									<!-- Table data -->
									<td>$0.00</td>

									<!-- Table data -->
									<td>
										<a href="#" class="btn btn-light btn-round me-1 mb-1 mb-md-0" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
											<i class="bi bi-eye"></i>
										</a>
										<a href="mailto:{{ $user->email }}" class="btn btn-light btn-round me-1 mb-1 mb-md-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Message">
											<i class="bi bi-envelope"></i>
										</a>
										<button class="btn btn-light btn-round mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Block">
											<i class="fas fa-phone"></i>
										</button>
									</td>
								</tr>
								@endforeach


							</tbody>
							<!-- Table body END -->
						</table>
					</div>
				</div>
				<!-- Tabs content item END -->

			</div>
			<!-- Tabs content END -->
		</div>
		<!-- Card body END -->

		<!-- Card footer START -->
		<div class="card-footer bg-transparent pt-0 px-0">
			<!-- Pagination START -->
			<div class="d-sm-flex justify-content-sm-between align-items-sm-center">
				<!-- Content -->
				<p class="mb-0 text-center text-sm-start">Showing 1 to 8 of 20 entries</p>
				<!-- Pagination -->
				<nav class="d-flex justify-content-center mb-0" aria-label="navigation">
					<ul class="pagination pagination-sm pagination-primary-soft mb-0 pb-0 px-0">
						<li class="page-item mb-0"><a class="page-link" href="#" tabindex="-1"><i class="fas fa-angle-left"></i></a></li>
						<li class="page-item mb-0"><a class="page-link" href="#">1</a></li>
						<li class="page-item mb-0 active"><a class="page-link" href="#">2</a></li>
						<li class="page-item mb-0"><a class="page-link" href="#">3</a></li>
						<li class="page-item mb-0"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a></li>
					</ul>
				</nav>
			</div>
			<!-- Pagination END -->
		</div>
		<!-- Card footer END -->
	</div>
	<!-- Main content END -->
</div><!-- Row END -->

@endsection
@section('script')
@endsection