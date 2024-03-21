@extends('admin.master')
@section('header')
@endsection

@section('content')

<div class="page-content-wrapper border">

    <!-- Title -->
    <div class="row mb-3">
        <div class="col-12 d-sm-flex justify-content-between align-items-center">
            <h1 class="h3 mb-2 mb-sm-0">My Ebooks</h1>
            <div>
            <a href="#" class="btn btn-sm btn-success mb-0" data-bs-toggle="modal" data-bs-target="#addCategory"><i
                    class="bi bi-plus-circle me-2"></i>Add Categories</a>
            <a href="#" class="btn btn-sm btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#addEbook"><i
                    class="bi bi-plus-circle me-2"></i>Add E-book</a>
            </div>

        </div>
    </div>

    <!-- Course boxes START -->
    <div class="row g-4 mb-4">
        <!-- Course item -->
        <div class="col-sm-6 col-lg-4">
            <a href='/dashboard'>
                <div class="text-center p-4 bg-primary bg-opacity-10 border border-primary rounded-3">
                    <h6>My Ebooks</h6>
                    <h2 class="mb-0 fs-1 text-primary">{{ count($ebooks) }}</h2>
                </div>
            </a>
        </div>

        <div class="col-sm-6 col-lg-4">
            <a href='/all_ebooks'>
                <div class="text-center p-4 bg-success bg-opacity-10 border border-success rounded-3">
                    <h6>All Ebooks</h6>
                    <h2 class="mb-0 fs-1 text-success">{{ count($all_ebooks) }}</h2>
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
                            <th scope="col" class="border-0 rounded-start">Image</th>
                            <th scope="col" class="border-0 rounded-start">Title</th>
                            {{-- <th scope="col" class="border-0">Instructor</th> --}}
                            <th scope="col" class="border-0">Category</th>
                            <th scope="col" class="border-0">Author</th>
                            <th scope="col" class="border-0">Date Added</th>

                            <th scope="col" class="border-0 rounded-end">Action</th>
                        </tr>
                    </thead>

                    <!-- Table body START -->
                    <tbody>

                        <!-- Table row -->
                        @foreach($ebooks as $ebook)
                        <tr>
                            <!-- Table data -->
                            <td>
                                @if($ebook->image !== null)
                                <img src='{{ asset('public/ebook_images/'.$ebook->image) }}'/>
                                @else 
                                <img src='{{ asset('ebook_images/pdf.png') }}'/>
                                @endif
                            </td>
                            <td>{{ $ebook->title }}</td>
                            <td>{{ $ebook->cat->name }}</td>
                            <td>{{ $ebook->author ?? "Not added" }}</td>
                            <td>{{ Date('j F Y',strtotime($ebook->created_at)) }}</td>


                            <td>
                                @if($ebook->file == null) 
                                <a href='live_preview/{{ $ebook->uid }}' class='btn btn-sm btn-primary-soft'>Share</a>
                                <a href='{{ $ebook->link }}' class='btn btn-sm btn-primary'>Preview</a>
                              
                                @else 
                                <a href='live_preview/{{ $ebook->uid }}' class='btn btn-sm btn-primary-soft'>Share</a>
                                <a href='preview_ebook/{{ $ebook->uid }}' class='btn btn-sm btn-primary'>Preview</a>
                                <a href='download_ebook/{{ $ebook->uid }}' class='btn btn-sm btn-info'>Download</a>
                                @endif

                                <a href='edit_ebook/{{ $ebook->uid }}' class='btn btn-sm btn-info-soft'>Edit</a>
                                <button id='delete_ebook' data-id='{{ $ebook->uid }}'
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


<div class="modal fade" id="addEbook" tabindex="-1" aria-labelledby="addEbookLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="addEbookLabel">Add Ebook</h5>
                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i
                        class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <form action="/createEbook" method='post' class="row text-start g-3" enctype='multipart/form-data'>@csrf
                    <!-- Question -->
                    <div class="col-12">
                        <label class="form-label">Title/Name</label>
                        <input id='title' name='title' required class="form-control" type="text"
                            placeholder="Input course title">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Display Image<span style='color:red'> (Optional)</span></label>
                        <input id='file' name='image' accept="image/*" class="form-control" type="file">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea id='description' name='description' required class="form-control" type="text"
                            placeholder="Input ebook description"></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Category</label>
                        <select id='category' name='category_id' class='form-control'>
                            <option>--Select Category--</option>
                            @foreach($categories as $category)
                            <option value='{{ $category->id }}'>{{ $category->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Author<span class='text-danger'>(Optional)</span></label>
                        <input id='author' name='author' class="form-control" type="text">
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
                    <div id='video_link' class="col-12">
                        <label class="form-label">Ebook File</label>
                        <input id='file' name='file[]'  accept=".pdf, .doc, .docx" multiple class="form-control" type="file">
                    </div>

                    <div style='display:none' id='drive_link' class="col-md-12 mt-3">
						<label class="form-label">Drive Link</label>
						<input class="form-control" multiple='multiple' type="text" name='link'
							placeholder="Enter Drive link">
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
<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="addCategoryLabel">Add Ebook Category</h5>
                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i
                        class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <form action="/createCategory" method='post' class="row text-start g-3" enctype='multipart/form-data'>@csrf
                    <!-- Question -->
                    <div class="col-12">
                        <label class="form-label">Category Name</label>
                        <input id='title' name='name' required class="form-control" type="text"
                            placeholder="Input Category Name">
                    </div>
                  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                <button id='c_submita' type="submit" class="btn btn-success my-0">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('document').ready(function() {
        
							$('body').on('click', '#delete_ebook', function() {
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
        title: "Confirm Ebook Delete",
        text: `Are you sure you want to delete this E-Book?`,
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
        swal("Course will not be deleted  :)");
      }
    }

    $("#option1").click(function() {
		$("#drive_link").hide()
		$("#video_link").show()	
	})
	$("#option2").click(function() {
		$("#drive_link").show()
		$("#video_link").hide()	
	})
    function performDelete(el, id) {

      try {
        $.get('{{ route("delete_ebook") }}?id=' + id,
          function(data, status) {
            console.log(status);
            console.table(data);
            if (status === "success") {
              let alert = swal('success', "Course successfully deleted!.", 'success');
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
    })

</script>

<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
@endsection