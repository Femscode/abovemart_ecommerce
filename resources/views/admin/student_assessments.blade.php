@extends('admin.master')
@section('header')
@endsection

@section('content')

<div class="page-content-wrapper border">

    <!-- Title -->
    <div class="row mb-3">
        <div class="col-12 d-sm-flex justify-content-between align-items-center">
            <h1 class="h3 mb-2 mb-sm-0">{{ $course->title }} Assessments ({{ count($assignments) }})</h1>
            <h4>{{ $user->name }}</h4>
          
        </div>
    </div>


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
                            <th scope="col" class="border-0">Type</th>
                            <th scope="col" class="border-0">Section</th>
                            <th scope="col" class="border-0">Status</th>
                            <th scope="col" class="border-0">Date Added</th>

                            <th scope="col" class="border-0 rounded-end">Action</th>
                        </tr>
                    </thead>

                    <!-- Table body START -->
                    <tbody>

                        <!-- Table row -->
                        @foreach($assignments as $ass)
                        <tr>
                            <!-- Table data -->
                            <td>{{ $ass->title }}</td>
                            <td>{{ $ass->type }}</td>
                            <td>{{ $ass->sec->title ?? "No sec" }}</td>
                            <td><span class='text text-success'>{{ $ass->uploaded($user->id,$ass->id)->is_done ?? "Not Done"  }}</span></td>
                            <td>{{ Date('j F Y',strtotime($ass->created_at)) }}</td>


                            <td>
                                @if($ass->type == 'objectives')
                                <a href='/checkuserresult/{{ $user->id }}/{{ $ass->id }}' class='btn btn-sm btn-success'>View Result</a>
                                @else 
                                <a href='/view_uploaded_assessment/{{ $user->id }}/{{ $ass->id }}' class='btn btn-sm btn-info'>View Assessment</a>
                                @endif
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