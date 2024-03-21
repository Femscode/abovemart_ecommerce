@extends('admin.master')
@section('header')
@endsection

@section('content')
<div class="page-content-wrapper border">

	<!-- Title -->
	<div class="row mb-3">
		<div class="col-12 d-sm-flex justify-content-between align-items-center">
			<h1 class="h3 mb-2 mb-sm-0">Assignments</h1>
			<a href="#" class="btn btn-sm btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#addQuestion"><i
					class="bi bi-plus-circle me-2"></i>Create Assignment</a>

		</div>
	</div>

	<!-- Course boxes START -->
	<div class="row g-4 mb-4">
		<!-- Course item -->
		<div class="col-sm-6 col-lg-4">
			<a href='/courses'>
				<div class="text-center p-4 bg-primary bg-opacity-10 border border-primary rounded-3">
					<h6>Total Courses</h6>
					<h2 class="mb-0 fs-1 text-primary">{{ count($courses) }}</h2>
				</div>
			</a>
		</div>

		<!-- Course item -->

		<div class="col-sm-6 col-lg-4">
			<a href='/announcement'>
				<div class="text-center p-4 bg-success bg-opacity-10 border border-success rounded-3">
					<h6>Announcements</h6>
					<h2 class="mb-0 fs-1 text-success">{{ count($ann) }}</h2>
				</div>
			</a>
		</div>

		<!-- Course item -->
		<div class="col-sm-6 col-lg-4">
			<div class="text-center p-4  bg-warning bg-opacity-15 border border-warning rounded-3">
				<h6>Assignments</h6>
				<h2 class="mb-0 fs-1 text-warning">{{ count($assignments) }}</h2>
			</div>
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
					<form class="rounded position-relative">
						<input required class="form-control bg-body" type="search" placeholder="Search"
							aria-label="Search">
						<button class="btn bg-transparent px-2 py-0 position-absolute top-50 end-0 translate-middle-y"
							type="submit"><i class="fas fa-search fs-6 "></i></button>
					</form>
				</div>

				<!-- Select option -->
				<div class="col-md-3">
					<!-- Short by filter -->
					<form>
						<select class="form-select js-choice border-0 z-index-9" aria-label=".form-select-sm">
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
							<th scope="col" class="border-0 rounded-start">Title</th>
							<th scope="col" class="border-0">Description</th>
							<th scope="col" class="border-0">Date Created</th>
							<th scope="col" class="border-0">Course</th>

							{{-- <th scope="col" class="border-0">Status</th> --}}
							<th scope="col" class="border-0 rounded-end">Action</th>
						</tr>
					</thead>

					<!-- Table body START -->
					<tbody>

						<!-- Table row -->
						@foreach($assignments as $ass)
						<tr>
							<!-- Table data -->
							<td>
								<div class="d-flex align-items-center position-relative">
									<!-- Image -->

									<!-- Title -->
									<h6 class="mb-0 ms-2">
										<a href="#" class="stretched-link">{{substr($ass->title,0,20) }}...</a>
									</h6>
								</div>
							</td>


							<!-- Table data -->
							<td>
								{{substr($ass->description,0,20) }}...
							</td>

							<!-- Table data -->
							<td>{{ Date('j F Y',strtotime($ass->created_at)) }}</td>

							<!-- Table data -->
							<td> <span class="btn btn-sm btn-success-soft me-1 mb-1 mb-md-0">{{
									$ass->course->title ?? "" }}</span> </td>

							<!-- Table data -->
							<!-- Table data -->
							{{-- <td> <span class="badge bg-warning bg-opacity-15 text-warning">Pending</span>
							</td> --}}

							<!-- Table data -->
							<td>
								<a data-id='{{ $ass->id }}'
									class="edit_ann btn btn-sm btn-primary-soft me-1 mb-1 mb-md-0"
									data-bs-toggle="modal" data-bs-target="#editass">Edit</a>
								<button id='delete_ass' data-id='{{ $ass->id }}'
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
				<h5 class="modal-title text-white" id="addQuestionLabel">Create Assignment</h5>
				<button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i
						class="bi bi-x-lg"></i></button>
			</div>
			<div class="modal-body">
				<form id='create_ann' class="row text-start g-3" enctype='multipart/form-data'>
					<!-- Question -->
					<div class="col-12">
						<label class="form-label">Course</label>
						<select id='category' required class='form-control'>
							<option value=''>--Select Course--</option>
							@foreach($courses as $course)
							<option value='{{ $course->id }}'>{{ $course->title }}</option>
							@endforeach

						</select>
					</div>
					<div class="col-12">
						<label class="form-label">Section</label>
						<select id='section' required class='form-control'>


						</select>
					</div>
					<div class="col-12">
						<label class="form-label">Title</label>
						<input id='title' required class="form-control" type="text"
							placeholder="Input assignment title">
					</div>

					<div class="col-12 mt-3">
						<label class="form-label">Description</label>
						<textarea id='description' required class="form-control" rows="4"
							placeholder="Input assignment description" spellcheck="false"></textarea>
					</div>
					<div class='row ml-4'>
						<div class="form-check col-md-4">
							<input name='type' class="type form-check-input" type="radio" id="file_radio" value="file">
							<label class="form-check-label" for="inlineCheckbox1">Files/Videos</label>
						</div>
						<div class="form-check col-md-4">
							<input name='type' class="type form-check-input" type="radio" id="link_radio" value="link">
							<label class="form-check-label" for="inlineCheckbox2">Links</label>
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





			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
				<button id='c_submita' type="submit" class="btn btn-success my-0">Create</button>
			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="editass" tabindex="-1" aria-labelledby="addQuestionLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-dark">
				<h5 class="modal-title text-white" id="addQuestionLabel">Edit Annoucement</h5>
				<button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i
						class="bi bi-x-lg"></i></button>
			</div>
			<div class="modal-body">
				<form id='editCourseForm' class="row text-start g-3" enctype='multipart/form-data'>
					<!-- Question -->
					<div class="col-12">
						<label class="form-label">Name</label>
						<input type='hidden' id='course_id' />
						<input id='edittitle' required class="form-control" type="text"
							placeholder="Input course title">
					</div>

					<div class="col-12 mt-3">
						<label class="form-label">Description</label>
						<textarea id='editdescription' required class="form-control" rows="4"
							placeholder="Input course description" spellcheck="false"></textarea>
					</div>


					<div class="col-12">
						<label class="form-label">Course</label>
						<select id='editcategory' class='form-control'>
							<option value=''>--Select Course--</option>
							@foreach($courses as $course)
							<option value='{{ $course->id }}'>{{ $course->title }}</option>
							@endforeach

						</select>
					</div>

					<div class="col-12">
						<label class="form-label">Section</label>
						<select id='editsection' class='form-control'>
							<option value=''>--Select Section--</option>
							

						</select>
					</div>
					<div class="col-12 mt-3">
						<label class="form-label">Link</label>
						<input id='editlink' class="form-control" rows="4"
							/>
					</div>
					<div class="col-12 mt-3">
						<label class="form-label">File</label>
						<input id='editfile'  class="form-control" type="file"
							/>
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
@endsection

@section('script')
<script>
	$(document).ready(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
					$(".edit_ann").click(function() {
						
						id = $(this).data('id');
						
						$.get("{{ route('loadassignment') }}?id="+id, function(data) {
							console.log(data[0])
							$("#course_id").val(data[0].id)
							$("#edittitle").val(data[0].title)
							$("#editdescription").val(data[0].description)
							$("#editcategory").val(data[0].course_id)
							$("#editlink").val(data[0].link)

							var editsections = $("#editsection")
				   			$.each(data[1], function(index, value) {
    			  				var option = $("<option></option>").attr("value", value.id).text(value.title);
				  				editsections.append(option);
				});

							$("#editsection").val(data[0].section_id)
						
						})
					})
    $("#create_ann").on('submit', async function(e){
                e.preventDefault();
                swal('Creating Assignment, please wait...');
                $("#c_submit").attr('disabled',true)
							fd = new FormData();
							
							fd.append('title',  $("#title").val());
							fd.append('description', $("#description").val());
							fd.append('section_id', $("#section").val());
							fd.append('course_id', $("#category").val());
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

							
    $("#editCourseForm").on('submit', async function(e){
                e.preventDefault();
                swal('Updating Assignment, please wait...');
               
							fd = new FormData();
						
							fd.append('id',  $("#course_id").val());
							fd.append('name',  $("#edittitle").val());
							fd.append('description', $("#editdescription").val());
							fd.append('link', $("#editlink").val());
							fd.append('course_id', $("#editcategory").val());
							fd.append('section_id', $("#editsection").val());
							var importFileInput = $('#editfile')[0]; // Get the file input element
							
							if (importFileInput  && importFileInput.files.length > 0) {
								fd.append('file', importFileInput.files[0]); 
							} 

                            console.log(fd, 'this is the fd');

                            $.ajax({
                                type: 'POST',
                                url: "{{ route('editassignment') }}",
                                data: fd,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: (data) => {
                                    swal.close()
                                    swal("Success", 'Announcement edited successfully', 'success');
                                    console.log(data)
									window.location.reload();


                                },
                                error: function(data) {
                                    console.log(data);
                                    swal("Oops!", 'Announcement not created', 'error');
                                }
                            });
                            });

							$('body').on('click', '#delete_ass', function() {
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
        title: "Confirm Assignment Delete",
        text: `Are you sure you want to delete this assignment?`,
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
        swal("Assignment will not be deleted  :)");
      }
    }


    function performDelete(el, id) {

      try {
        $.get('{{ route("deleteassignment") }}?id=' + id,
          function(data, status) {
            console.log(status);
            console.table(data);
            if (status === "success") {
              let alert = swal('success', "Assignment successfully deleted!.", 'success');
              $(el).closest("tr").remove();
              // alert.then(() => {
              // });
            }
          }
        );
      } catch (e) {
        let alert = swal(e.message);
      }
    }

	$("#category").on('change', function() {
			fd = new FormData();			
			fd.append('course_id', $("#category").val());
            $.ajax({
                type: 'POST',
                url: "{{ route('fetchsection') }}",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                   console.log(data)
				   $("#section").empty()
				   var sections = $("#section")
				   $.each(data, function(index, value) {
    			  var option = $("<option></option>").attr("value", value.id).text(value.title);
    				sections.append(option);
				});
				
                },
                error: function(data) {
                    console.log(data);
                    swal("Oops!", 'Unable to fetch section', 'error');
                }
        });                       
	})

	$("#file_radio").click(function() {
		$("#file_field").show()
		$("#link_field").hide()
	})
	$("#link_radio").click(function() {
		$("#file_field").hide()
		$("#link_field").show()
	})
	
})
</script>

<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

@endsection