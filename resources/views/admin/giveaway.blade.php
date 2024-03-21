@extends('admin.master')
@section('header')
@endsection

@section('content')

<div class="page-content-wrapper border">

    <!-- Title -->
    <div class="row mb-3">
        <div class="col-12 d-sm-flex justify-content-between align-items-center">
            <h1 class="h3 mb-2 mb-sm-0">My Giveaways</h1>
            <div>
            <a href="#" class="btn btn-sm btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#addGiveaway"><i
                    class="bi bi-plus-circle me-2"></i>Add Giveaway</a>
            </div>

        </div>
    </div>

    <!-- Course boxes START -->
    <div class="row g-4 mb-4">
        <!-- Course item -->
        <div class="col-sm-6 col-lg-4">
            <a href='/dashboard'>
                <div class="text-center p-4 bg-primary bg-opacity-10 border border-primary rounded-3">
                    <h6>My Giveaways</h6>
                    <h2 class="mb-0 fs-1 text-primary">{{ count($giveaways) }}</h2>
                </div>
            </a>
        </div>

        <div class="col-sm-6 col-lg-4">
            <a href='/all_ebooks'>
                <div class="text-center p-4 bg-success bg-opacity-10 border border-success rounded-3">
                    <h6>Active</h6>
                    <h2 class="mb-0 fs-1 text-success">{{ count($giveaways) }}</h2>
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
                          
                            <th scope="col" class="border-0 rounded-start">Title</th>
                            {{-- <th scope="col" class="border-0">Instructor</th> --}}
                            <th scope="col" class="border-0">Description</th>
                            <th scope="col" class="border-0">No Of Participants</th>
                            <th scope="col" class="border-0">Date Added</th>

                            <th scope="col" class="border-0 rounded-end">Action</th>
                        </tr>
                    </thead>

                    <!-- Table body START -->
                    <tbody>

                        <!-- Table row -->
                        @foreach($giveaways as $ebook)
                        <tr>
                          
                          
                            <td>{{ $ebook->name }}</td>
                            <td>{{ $ebook->description ?? "no desc" }}</td>
                            <td>{{ $ebook->participant }} <span class='text-red'>({{ $ebook->no_of_lucky_numbers }})</span></td>
                            <td>{{ Date('j F Y',strtotime($ebook->created_at)) }}</td>


                            <td>
                                <a href='#' class='btn btn-sm btn-primary-soft'>Share</a>
                                <a href='/check_giveaway/{{ $ebook->id }}' class='btn btn-sm btn-primary'>Check Lucky Numbers</a>
                              
                               

                                <a href='#' class='btn btn-sm btn-info-soft'>Edit</a>
                                <button id='@' data-id='{{ $ebook->uid }}'
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


<div class="modal fade" id="addGiveaway" tabindex="-1" aria-labelledby="addGiveawayLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="addGiveawayLabel">Add Giveaway</h5>
                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i
                        class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <form action="/createGiveaway" method='post' class="row text-start g-3" enctype='multipart/form-data'>@csrf
                    <!-- Question -->
                    <div class="col-12">
                        <label class="form-label">Title/Name</label>
                        <input id='title' name='name' required class="form-control" type="text"
                            placeholder="Give your giveaway a befiting name">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <input id='title' name='description' required class="form-control" type="text"
                            placeholder="Enter a short description">
                    </div>
                   
                    <div class="col-12">
                        <label class="form-label">No. Of Participants</label>
                        <input id='description' name='no_of_participant' required class="form-control" type="number"
                            placeholder="Enter the expected number of participant"/>
                    </div>
                    <div class="col-12">
                        <label class="form-label">No. Of Lucky Numbers</label>
                        <input id='description' name='no_of_lucky_numbers' required class="form-control" type="number"
                            placeholder="Enter the number of giveaway"/>
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