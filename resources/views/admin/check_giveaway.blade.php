@extends('admin.master')
@section('header')
@endsection

@section('content')

<div class="page-content-wrapper border">

    <!-- Title -->
    <div class="row mb-3">
        <div class="col-12 d-sm-flex justify-content-between align-items-center">
            <h1 class="h3 mb-2 mb-sm-0">My Giveaways</h1>
            

        </div>
    </div>

    <!-- Course boxes START -->
    <div class="row g-4 mb-4">
        <!-- Course item -->
        <div class="col-sm-6 col-lg-4">
            <a href='/dashboard'>
                <div class="text-center p-4 bg-primary bg-opacity-10 border border-primary rounded-3">
                    <h6>Giveaway Details</h6>
                    <ul>
                        <li>Name : {{ $giveaway->name }}</li>
                        <li>Description : {{ $giveaway->description }}</li>
                        <li>Number Of Participants : {{ $giveaway->participant }}</li>
                        <li>No. Of Lucky Winner : {{ $giveaway->no_of_lucky_numbers }}</li>
                        <li>Date : {{ Date('d-m-Y',strtotime($giveaway->created_at)) }}</li>
                    </ul>
                </div>
            </a>
        </div>

        <div class="col-sm-6 col-lg-4">
            <a href='/all_ebooks'>
                <div class="text-center p-4 bg-success bg-opacity-10 border border-success rounded-3">
                    <h6>Lucky Numbers</h6>
                    <h2 class="mb-0 fs-1 text-success">{{ $giveaway->lucky_numbers }}</h2>
                </div>
            </a>
        </div>

    </div>
    <!-- Course boxes END -->
    <h4>Lucky Winners</h4>
    <div class="card-body">
        <!-- Course table START -->
        <div class="table-responsive border-0 rounded-3">
            <!-- Table START -->
            <table class="table table-dark-gray align-middle p-4 mb-0 table-hover">
                <!-- Table head -->
                <thead>
                    <tr>
                      
                        <th scope="col" class="border-0 rounded-start">Name</th>
                        {{-- <th scope="col" class="border-0">Instructor</th> --}}
                        <th scope="col" class="border-0">Phone Number</th>
                        <th scope="col" class="border-0">Email</th>
                        <th scope="col" class="border-0">Number</th>

                        <th scope="col" class="border-0 rounded-end">Action</th>
                    </tr>
                </thead>

                <!-- Table body START -->
                <tbody>


                </tbody>
                <!-- Table body END -->
            </table>
            <!-- Table END -->
        </div>
        <!-- Course table END -->
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