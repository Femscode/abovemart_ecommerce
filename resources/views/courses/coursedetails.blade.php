@extends('admin.master')
@section('header')
@endsection

@section('content')

<div class="page-content-wrapper border">

	<!-- Title -->
	<section class="py-0 bg-blue h-100px align-items-center d-flex h-200px rounded-0"
		style="background:url('/courseimage/{{ $course->image}}') no-repeat center center; background-size:cover;">
		<!-- Main banner background image -->
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<!-- Title -->
					<h1 class="text-white" style='text-shadow:1px 1px 1px black'>{{ $course->title }}</h1>
					<p class="text-white mb-0" style='text-shadow:1px 1px 1px black'>{!! Str::limit($course->description,50) !!}</p>
				</div>
			</div>
		</div>
	</section>



	<!-- Card START -->
	<div class="card bg-transparent border">

		<!-- Card header START -->

		<!-- Card header END -->

		<!-- Card body START -->
		<div class="card-body">
			<!-- Course table START -->

			<div class="row m-5 p-25">
				<!-- Add Section Modal button -->
				<div class="d-sm-flex justify-content-sm-between align-items-center mb-3">
					<h5 class="mb-2 mb-sm-0">Upload Lecture</h5>
					<a href="#" class="btn btn-sm btn-primary-soft mb-0" data-bs-toggle="modal"
						data-bs-target="#addLecture"><i class="bi bi-plus-circle me-2"></i>Add Section</a>
				</div>
				@if(Session::has('message'))
				<div class='alert alert-success'>{{ Session::get('message') }}</div>
				@endif

				<!-- Edit lecture START -->
				<div class="accordion accordion-icon accordion-bg-light" id="accordionExample2">
					<!-- Item START -->
					{{-- <div class="accordion-item mb-3">
						<h6 class="accordion-header font-base" id="heading-0">
							<button class="accordion-button fw-bold rounded d-inline-block collapsed d-block pe-5"
								type="button" data-bs-toggle="collapse" data-bs-target="#collapse-0"
								aria-expanded="false" aria-controls="collapse-0">
								Course Introduction
							</button>
						</h6>

						<div id="collapse-0" class="accordion-collapse collapse show" aria-labelledby="heading-0"
							data-bs-parent="#accordionExample2">
							<!-- Topic START -->
							<div class="accordion-body mt-3">
								<!-- Video item START -->
								<div class="d-flex justify-content-between align-items-center">
									<div class="position-relative">
										<a href="#"
											class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static"><i
												class="fas fa-play"></i></a>
										<span class="ms-2 mb-0 h6 fw-light">Introduction</span>
									</div>
									<!-- Edit and cancel button -->
									<div>
										<a href="#" class="btn btn-sm btn-success-soft btn-round me-1 mb-1 mb-md-0"><i
												class="far fa-fw fa-edit"></i></a>
										<button class="btn btn-sm btn-danger-soft btn-round mb-0"><i
												class="fas fa-fw fa-times"></i></button>
									</div>
								</div>
								<!-- Divider -->
								<hr>

								<!-- Add topic -->
								<a href="#" data-id='0' class="add_topic btn btn-sm btn-dark mb-0"
									data-bs-toggle="modal" data-bs-target="#addTopic"><i
										class="bi bi-plus-circle me-2"></i>Add topic</a>
							</div>
							<!-- Topic END -->
						</div>
					</div> --}}

					@foreach($sections as $key => $section)
					<div class="accordion-item mb-3">
						<h6 class="accordion-header font-base" id="heading-{{ ++$key }}">
							<button class="accordion-button fw-bold rounded d-inline-block collapsed d-block pe-5"
								type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$key }}"
								aria-expanded="false" aria-controls="collapse-{{$key }}">
								{{$section->title}}
							</button>
							<a data-id='{{ $section->id }}'
								class="edit_section btn btn-sm btn-primary-soft me-1 mb-1 mb-md-0"
								data-bs-toggle="modal" data-bs-target="#editSection" class='btn btn-success btn-sm'>Edit</a>

						</h6>

						<div id="collapse-{{$key }}" class="accordion-collapse collapse hide"
							aria-labelledby="heading-{{ ++$key }}" data-bs-parent="#accordionExample{{ ++$key }}">
							<!-- Topic START -->
							<div class="accordion-body mt-3">
								<!-- Video item START -->
								@foreach(App\Models\SectionVideo::where('section_id',$section->id)->get() as
								$video)
								<div class="d-flex justify-content-between align-items-center">
									<div class="position-relative">
										@if($video->ext == 'jpg' || $video->ext == 'png' || $video->ext ==
										'jpeg' || $video->ext == 'jfif')
										<a href='#' data-bs-toggle="modal" data-bs-target="#gallery"
											class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
											<i class="fas fa-image"></i>
										</a>
										@elseif($video->ext == 'pdf' || $video->ext == 'docs' || $video->ext
										== 'docx' || $video->ext == 'xls')
										<a href="#" data-bs-toggle="modal" data-bs-target="#gallery"
											class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
											<i class="fas fa-file"></i>
										</a>
										@elseif($video->ext == 'mp4' || $video->ext == 'mkv' || $video->ext
										== 'webm')
										<a href="#" data-bs-toggle="modal" data-bs-target="#gallery"
											class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
											<i class="fas fa-play"></i>
										</a>
										@else
										<a href="/downloadsectionvideo/{{ $video->id }}"
											class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
											<i class="fas fa-error"></i>
										</a>
										@endif
										<span class="ms-2 mb-0 h6 fw-light">{{ $video->title }}</span>
										@if($video->status == 0)
										<a href="#"
											class="btn btn-info-soft btn-round btn-sm mb-0 stretched-link position-static">
											<i class="fas fa-unlock"></i>
										</a>
										@else
										<a href="#"
											class="btn btn-secondary-soft btn-round btn-sm mb-0 stretched-link position-static">
											<i class="fas fa-lock"></i>
										</a>
										@endif
									</div>
									<!-- Edit and cancel button -->
									<div>
										@if($video->video == null)
										<a href="{{ $video->link }}" class="btn btn-sm btn btn-info-soft">View</a>
										@else
										<a href="/downloadsectionvideo/{{ $video->id }}"
											class="btn btn-sm btn btn-info-soft">View</a>

										@endif
										<a href="#" class="btn btn-sm btn-success-soft btn-round me-1 mb-1 mb-md-0"><i
												class="far fa-fw fa-edit"></i></a>
										<button id='delete_topic' data-id={{ $video->id }}
											class="btn btn-sm btn-danger-soft btn-round mb-0"><i
												class="fas fa-fw fa-times"></i></button>
									</div>
								</div>
								<!-- Divider -->
								<hr>
								@endforeach
								<!-- Video item END -->

								<!-- Video item START -->

								<!-- Divider -->
								<hr>
								<!-- Video item END -->
								@if(count(App\Models\Assignment::where('section_id', $section->id)->get()) > 0)

								<h5>Examination </h5>
								@foreach(App\Models\Assignment::where('section_id',$section->id)->get() as
								$ass)
								<div class="d-flex justify-content-between align-items-center">
									<div class="position-relative">
										@if($ass->ext == 'jpg' || $ass->ext == 'png' || $ass->ext ==
										'jpeg' || $ass->ext == 'jfif')
										<a href='#' data-bs-toggle="modal" data-bs-target="#gallery"
											class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
											<i class="fas fa-image"></i>
										</a>
										@elseif($ass->ext == 'pdf' || $ass->ext == 'docs' || $ass->ext
										== 'docx' || $ass->ext == 'xls')
										<a href="#" data-bs-toggle="modal" data-bs-target="#gallery"
											class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
											<i class="fas fa-file"></i>
										</a>
										@elseif($ass->ext == 'mp4' || $ass->ext == 'mkv' || $ass->ext
										== 'webm')
										<a href="#" data-bs-toggle="modal" data-bs-target="#gallery"
											class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
											<i class="fas fa-play"></i>
										</a>
										@else
										<a href="/downloadsectionvideo/{{ $ass->id }}"
											class="btn btn-danger-soft btn-round btn-sm mb-0 stretched-link position-static">
											<i class="fas fa-exam"></i>
										</a>
										@endif
										<span class="ms-2 mb-0 h6 fw-light">{{ $ass->title }}</span>
										@if($ass->status == 0)
										<a href="#"
											class="btn btn-info-soft btn-round btn-sm mb-0 stretched-link position-static">
											<i class="fas fa-unlock"></i>
										</a>
										@else
										<a href="#"
											class="btn btn-secondary-soft btn-round btn-sm mb-0 stretched-link position-static">

										</a>
										@endif
									</div>
									<!-- Edit and cancel button -->
									<div>
										@if($ass->type == 'objectives')
										<a href="/create_question/{{ $ass->uid }}"
											class="btn btn-sm btn btn-info-soft">Create Question</a>
										@else
										<a href="/viewass/{{ $ass->id }}" class="btn btn-sm btn btn-info-soft">View</a>
										@endif
										<a href="#" class="btn btn-sm btn-success-soft btn-round me-1 mb-1 mb-md-0"><i
												class="far fa-fw fa-edit"></i></a>
										<a href='/deleteass/{{ $ass->id }}' data-id={{ $ass->id }}
											class="btn btn-sm btn-danger-soft btn-round mb-0"><i
												class="fas fa-fw fa-times"></i></a>
									</div>
								</div>
								<!-- Divider -->
								<hr>
								@endforeach
								@endif
								<hr>
								<h5>Announcements</h5>

								<!-- Add topic -->
								<a href="#" data-id='{{$section->id }}' class="add_topic btn btn-sm btn-dark mb-0"
									data-bs-toggle="modal" data-bs-target="#addTopic"><i
										class="bi bi-plus-circle me-2"></i>Add
									topic</a>
								<a onclick='populate_c({{ $section->id}})' data-bs-toggle="modal"
									data-bs-target="#addQuestion" class='btn btn-info btn-sm mb-0'>Create Exam</a>
								<a href='/announcement' class='btn btn-warning btn-sm mb-0'>Create Announcement</a>
								<a onclick='return confirm("Are you sure you want to delete this section");'
									class='btn btn-danger btn-sm mb-0' href='/deletesection/{{ $section->id }}'>Delete
									Section</a>

							</div>
							<!-- Topic END -->
						</div>
					</div>
					@endforeach
					<!-- Item END -->


					<!-- Item END -->

				</div>
				<!-- Edit lecture END -->

				<!-- Step 3 button -->
				<div class="d-flex justify-content-between">
					<button class="btn btn-secondary prev-btn mb-0">Previous</button>
					<button class="btn btn-primary next-btn mb-0">Next</button>
				</div>
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
						<li class="page-item mb-0"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
						</li>
					</ul>
				</nav>
			</div>
			<!-- Pagination END -->
		</div>
		<!-- Card footer END -->
	</div>
	<!-- Card END -->
</div>

<div class="modal fade" id="addQuestion" tabindex="-1" aria-labelledby="addQuestionLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-dark">
				<h5 class="modal-title text-white" id="addQuestionLabel">Create Exam</h5>
				<button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i
						class="bi bi-x-lg"></i></button>
			</div>
			<div class="modal-body">
				<form id='create_ann' class="row text-start g-3" enctype='multipart/form-data'>
					<!-- Question -->

					<div class="col-12">
						<label class="form-label">Title</label>
						<input type='hidden' id='course_id' value='{{ $course->id }}' />
						<input type='hidden' id='my_section_id' value='' />
						<input id='title' required class="form-control" type="text"
							placeholder="Input assignment title">
					</div>

					<div class="col-12 mt-3">
						<label class="form-label">Description</label>
						<textarea id='description' required class="form-control" rows="4"
							placeholder="Input assignment description" spellcheck="false"></textarea>
					</div>
					<div class="col-12 mt-3">
						<label class="form-label">Exam Price</label>
						<input id='price' type='number' required class="form-control" rows="4"
							placeholder="Input price of the examination" spellcheck="false"/>
					</div>
					<div class='row ml-4'>
						<div class="form-check col-md-4">
							<input name='type' class="type form-check-input" checked type="radio" id="file_radio"
								value="file">
							<label class="form-check-label" for="inlineCheckbox1">Files/Videos</label>
						</div>
						<div class="form-check col-md-4">
							<input name='type' class="type form-check-input" type="radio" id="link_radio" value="link">
							<label class="form-check-label" for="inlineCheckbox2">Links</label>
						</div>
						<div class="form-check col-md-4">
							<input name='type' class="type form-check-input" type="radio" id="obj_radio"
								value="objectives">
							<label class="form-check-label" for="inlineCheckbox2">Q & A (Objectives)</label>
						</div>
					</div>

					<div id='file_field' class="col-12 mt-3">
						<label class="form-label">File(PDF/Docs/Videos)</label>
						<input id='file' class="form-control" type='file' />
					</div>
					<div style='display:none' id='link_field' class="col-12 mt-3">
						<label class="form-label">Links</label>
						<input id='link' placeholder="https://..." class="form-control" type='text' />
					</div>
					<div style='display:none' id='obj_field' class="col-12 mt-3">
						<div class='alert alert-info'>Please note that you'll need to proceed to create questions for
							this assignment.</div>
					</div>





			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
				<button id='c_submita' type="submit" class="btn btn-success my-0">Create</button>
			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="editSection" tabindex="-1" aria-labelledby="addQuestionLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-dark">
				<h5 class="modal-title text-white" id="addQuestionLabel">Edit Section</h5>
				<button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i
						class="bi bi-x-lg"></i></button>
			</div>
			<div class="modal-body">
				<form id='editSectionForm' class="row text-start g-3" enctype='multipart/form-data'>
					<!-- Question -->
					<div class="col-12">
						<label class="form-label">Title</label>

						<input id='edittitle' required class="form-control" type="text"
							placeholder="Input section title">
					</div>

					

				


					<div class="col-6">
						<label class="form-label">Rank</label>
						<input id='editrank' required class="form-control" type="number"
							placeholder="Input ranks">
					</div>

					

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success my-0">Edit</button>
			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="addLecture" tabindex="-1" aria-labelledby="addLectureLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-dark">
				<h5 class="modal-title text-white" id="addLectureLabel">Add Section</h5>
				<button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i
						class="bi bi-x-lg"></i></button>
			</div>
			<div class="modal-body">
				<form class="row text-start g-3" method='post' action='{{ route('createsection') }}'>@csrf
					<!-- Course name -->
					<div class="col-12">
						<label class="form-label">Section Title <span class="text-danger">*</span></label>
						<input type="text" name='title' class="form-control" placeholder="Enter section title">
						<input type="hidden" name='course_id' class="form-control" value="{{ $course->id }}">
					</div>
					

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success my-0">Create</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- Popup modal for add Section END -->

<!-- Popup modal for add topic START -->
<div class="modal fade" id="gallery" tabindex="-1" aria-labelledby="addTopicLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-dark">
				<h5 class="modal-title text-white" id="addTopicLabel">Add topic</h5>
				<button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i
						class="bi bi-x-lg"></i></button>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success my-0">Create</button>
			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="addTopic" tabindex="-1" aria-labelledby="addTopicLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-dark">
				<h5 class="modal-title text-white" id="addTopicLabel">Add topic</h5>
				<button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i
						class="bi bi-x-lg"></i></button>
			</div>
			<div class="modal-body">
				<form class="row text-start g-3" method='post' action='{{ route("createsectionvideo") }}'
					enctype="multipart/form-data">@csrf
					<!-- Topic name -->
					<div class="col-md-12">
						<label class="form-label">Topic name</label>
						<input class="form-control" name='title' type="text" placeholder="Enter topic name">
						<input class="form-control" name='course_id' type="hidden" value="{{ $course->id }}">
						<input class="form-control" name='section_id' type="hidden" id='section_id' value="">
					</div>
					<div class='col-md-6'>
						<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
							<!-- Free button -->
							<input type="radio" value='0' class="btn-check" name="options" id="option1" checked="">
							<label class="btn btn-sm btn-light btn-primary-soft-check border-0 m-0" for="option1">Upload
								Resource</label>
							<!-- Premium button -->
							<input type="radio" value='1' class="btn-check" name="options" id="option2">
							<label class="btn btn-sm btn-light btn-primary-soft-check border-0 m-0" for="option2">Drive
								Link</label>
						</div>
					</div>
					<!-- Video link -->
					<div id='video_link' class="col-md-12 mt-3">
						<label class="form-label">Videos/PDFS/DOCS</label>
						<input class="form-control" multiple='multiple' type="file" name='video[]'
							placeholder="Enter Video link">
					</div>
					<div style='display:none' id='drive_link' class="col-md-12 mt-3">
						<label class="form-label">Drive Link</label>
						<input class="form-control" multiple='multiple' type="text" name='link'
							placeholder="Enter Drive link">
					</div>
					<!-- Description -->

					<!-- Buttons -->
					{{-- <div class="col-6 mt-3">
						<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
							<!-- Free button -->
							<input type="radio" value='0' class="btn-check" name="options" id="option1" checked="">
							<label class="btn btn-sm btn-light btn-primary-soft-check border-0 m-0"
								for="option1">Free</label>
							<!-- Premium button -->
							<input type="radio" value='1' class="btn-check" name="options" id="option2">
							<label class="btn btn-sm btn-light btn-primary-soft-check border-0 m-0"
								for="option2">Premium</label>
						</div>
					</div> --}}

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success my-0">Create</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- Popup modal for add topic END -->

<!-- Popup modal for add faq START -->
<div class="modal fade" id="addQuestion" tabindex="-1" aria-labelledby="addQuestionLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-dark">
				<h5 class="modal-title text-white" id="addQuestionLabel">Add FAQ</h5>
				<button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i
						class="bi bi-x-lg"></i></button>
			</div>
			<div class="modal-body">
				<form class="row text-start g-3">
					<!-- Question -->
					<div class="col-12">
						<label class="form-label">Question</label>
						<input class="form-control" type="text" value="Write a question">
					</div>
					<!-- Answer -->
					<div class="col-12 mt-3">
						<label class="form-label">Answer</label>
						<textarea class="form-control" rows="4" value="Write a answer" spellcheck="false"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success my-0">Save topic</button>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

<!-- Vendors -->
<script src="{{ asset('assets/vendor/choices/js/choices.min.js')}}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js')}}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.js')}}"></script>
<script src="{{ asset('assets/vendor/quill/js/quill.min.js')}}"></script>
<script src="{{ asset('assets/vendor/stepper/js/bs-stepper.min.js')}}"></script>

<!-- Template Functions -->
<script src="{{ asset('assets/js/functions2.js')}}"></script>
<script src="{{ asset('assets/jquery.js')}}"></script>
<script src="{{ asset('assets/sweetalert.js')}}"></script>
<script>
	$(document).ready(function() {
		
		$(".add_topic").click(function() {
			id = $(this).data('id')
			$("#section_id").val(id)
		
		})

		$("#create_ann").on('submit', async function(e){
                e.preventDefault();
                swal('Creating Assignment, please wait...');
                $("#c_submit").attr('disabled',true)
							fd = new FormData();
							
							fd.append('title',  $("#title").val());
							fd.append('description', $("#description").val());
							fd.append('price', $("#price").val());
						
							fd.append('section_id', $("#my_section_id").val());
							fd.append('course_id', $("#course_id").val());
							fd.append('type',  $("input[name='type']:checked").val());
							
							var importFileInput = $('#file')[0]; // Get the file input element
							var myLink = $('#link'); // Get the file input element
							
							if (importFileInput  && importFileInput.files.length > 0) {
								fd.append('file', importFileInput.files[0]); 
							} 
							if(myLink) {
							fd.append('link', $("#link").val());

							}
							
							
                         

                            console.log(fd, 'this is the fd');

                            $.ajax({
                                type: 'POST',
                                url: "{{ route('createassignment') }}",
                                data: fd,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: (data) => {
                                    swal.close()
                                    swal("Success", 'Assignment Created successfully', 'success');
                                    console.log(data)
									window.location.reload();


                                },
                                error: function(data) {
                                    console.log(data);
                                    swal("Oops!", 'Assignment not created', 'error');
                                }
                            });
                            });



	$('body').on('click', '#delete_topic', function() {
  // var id = $("#delete_id").val();
  id = $(this).data('id');
  console.log(id)
  var token = $("meta[name='csrf-token']").attr("content");
  var el = this;
  // alert(user_id);
  resetAccount(el, id);
});


async function resetAccount(el, id) {
  const willUpdate = await swal({
	title: "Confirm Topic Delete",
	text: `Are you sure you want to delete this topic?`,
	icon: "warning",
	confirmButtonColor: "#DD6B55",
	confirmButtonText: "Yes!",
	showCancelButton: true,
	buttons: ["Cancel", "Yes, Delete"]
  });
  if (willUpdate) {
	//performReset()
	performDelete(el, id);
  } else {
	swal("Topic will not be deleted  :)");
  }
}

function performDelete(el, id) {

  try {
	$.get('{{ route("deletesectionvideo") }}?id=' + id,
	  function(data, status) {
		console.log(status);
		console.table(data);
		if (status === "success") {
		  let alert = swal('success', "Topic successfully deleted!.", 'success');
		  $(el).closest("tr").remove();
		//   window.location.reload();
		  // alert.then(() => {
		  // });
		}
	  }
	);
  } catch (e) {
	let alert = swal(e.message);
  }
}

$("#file_radio").click(function() {
		$("#file_field").show()
		$("#link_field").hide()
		$("#obj_field").hide()
	})
	$("#link_radio").click(function() {
		$("#file_field").hide()
		$("#link_field").show()
		$("#obj_field").hide()
	})
	$("#obj_radio").click(function() {
		$("#file_field").hide()
		$("#link_field").hide()
		$("#obj_field").show()
	})
	$("#option1").click(function() {
		$("#drive_link").hide()
		$("#video_link").show()	
	})
	$("#option2").click(function() {
		$("#drive_link").show()
		$("#video_link").hide()	
	})

	
})

				$(".edit_section").click(function() {
						
						id = $(this).data('id');
						
						$.get("{{ route('loadsection') }}?id="+id, function(data) {
							console.log(data)
							$("#section_id").val(data.id)
							$("#edittitle").val(data.title)							
							$("#editrank").val(data.rank)
						
						})
					})

				$("#editSectionForm").on('submit', async function(e){
                e.preventDefault();
				
                swal('Editing Section, please wait...');
               
							fd = new FormData();
							
							fd.append('id',  $("#section_id").val());
							fd.append('title',  $("#edittitle").val());
							fd.append('rank', $("#editrank").val());
							$.ajax({
                                type: 'POST',
                                url: "{{ route('editsection') }}",
                                data: fd,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: (data) => {
                                    swal.close()
                                    swal("Success", 'Section Updated successfully', 'success');
                                    console.log(data)
									window.location.reload();


                                },
                                error: function(data) {
                                    console.log(data);
                                    swal("Oops!", 'Section not Updated', 'error');
                                }
                            });
                            });

   

function populate_c(section_id) {
	
	$("#my_section_id").val(section_id)
}
</script>
@endsection