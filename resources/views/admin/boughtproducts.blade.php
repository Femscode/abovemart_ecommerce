@extends('admin.master')
@section('header')
@endsection

@section('content')

<div class="page-content-wrapper border">

    <!-- Title -->
    <div class="row mb-3">
        <div class="col-12 d-sm-flex justify-content-between align-items-center">
            <h1 class="h3 mb-2 mb-sm-0">Purchase Records ({{ count($products) }})</h1>
         

        </div>
    </div>


    <!-- Card START -->
    <div class="card bg-transparent border">

       
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
                            <th scope="col" class="border-0 rounded-start">Name</th>
                            {{-- <th scope="col" class="border-0">Instructor</th> --}}
                            <th scope="col" class="border-0">Customer</th>
                            <th scope="col" class="border-0">Purchase Date</th>
                            <th scope="col" class="border-0">Status</th>

                            <th scope="col" class="border-0 rounded-end">Action</th>
                        </tr>
                    </thead>

                    <!-- Table body START -->
                    <tbody>

                        <!-- Table row -->
                        @foreach($products as $product)
                        <tr>
                            <td>
                               
                                <img src="https://shop.abovemarts.com/public/productimage/{{ $product->image}}" class="rounded-2" alt="Product image">

                              
                            </td>
                            <td>{{ $product->name }}<br>NGN{{ $product->price  }}</td>
                            <td>
                                {{ $product->user->firstName ?? "Not Added" }} - {{ $product->user->lastName ?? "" }}<br>
                                <i>{{ $product->user->email ?? "Not Added" }}</i><br>
                            
                            </td>
                            <td>{{ Date('j F Y ~ h:i',strtotime($product->created_at)) }}</td>
                            <td>
								@if($product->status == 1)
								<div class='bg bg-primary p-1 text-white rounded'>Payment Confirmed!</div>
								@elseif($product->status == 2)
								<div class='bg bg-warning p-1 rounded'>Product Shipped!</div>
								
								@elseif($product->status == 3)
								<div class='bg bg-success p-1 rounded'>Product Received!</div>
								
								@else
								<div class='bg bg-warning p-1 rounded'>Product Yet To Be Paid For!</div>

								@endif
								
							</td>


                            <td>
                              
                                <a href='/moreinfo/{{ $product->uid }}' class='btn btn-sm btn-info-soft'>More Info</a>
                                <a href='tel:{{ $product->user->phoneNumber }}' class='btn btn-sm btn-primary-soft'>Call Buyer</a>
                                @if($product->status == 1)
                                <a onclick='return confirm("Are you sure you want to mark this product sent?")' href='marksent/{{ $product->uid }}' class='btn btn-sm btn-primary'>Mark Shipped</a>
                                <a onclick='return confirm("Are you sure you want to mark this product sent?")' href='markreceived/{{ $product->uid }}' class='btn btn-sm btn-info'>Mark Received</a>
                                <a onclick='return confirm("Are you sure you want to refund this user?")' href='markrefund/{{ $product->uid }}' class='btn btn-sm btn-danger'>Refund User</a>
                                @elseif($product->status == 2)
                                <a onclick='return confirm("Are you sure you want to mark this product sent?")' href='markreceived/{{ $product->uid }}' class='btn btn-sm btn-info'>Mark Received</a>
                                <a onclick='return confirm("Are you sure you want to refund this user?")' href='markrefund/{{ $product->uid }}' class='btn btn-sm btn-danger'>Refund User</a>
                                
                                @elseif($product->status == 3)
                                <a onclick='return confirm("Are you sure you want to mark this product sent?")' href='markreceived/{{ $product->uid }}' class='btn btn-sm btn-info'>Mark Received</a>
                                <a onclick='return confirm("Are you sure you want to refund this user?")' href='markrefund/{{ $product->uid }}' class='btn btn-sm btn-danger'>Refund User</a>


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