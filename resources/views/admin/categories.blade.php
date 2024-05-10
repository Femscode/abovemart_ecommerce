@extends('admin.master')
@section('header')
@endsection

@section('content')

<div class="page-content-wrapper border">

    <!-- Title -->
    <div class="row mb-3">
        <div class="col-12 d-sm-flex justify-content-between align-items-center">
            <h1 class="h3 mb-2 mb-sm-0">AboveMarts Product Categories ({{ count($categories) }})</h1>
            <div>
            <a href="#" class="btn btn-sm btn-success mb-0" data-bs-toggle="modal" data-bs-target="#addCategory"><i
                    class="bi bi-plus-circle me-2"></i>Add Category</a>
            <a href="#" class="btn btn-sm btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#addSubCategory"><i
                    class="bi bi-plus-circle me-2"></i>Add Sub Category</a>
            </div>

        </div>
    </div>


    <!-- Card START -->
    <div class="card bg-transparent border">

      
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
                          
                            <th scope="col" class="border-0 rounded-start">S/N</th>
                            {{-- <th scope="col" class="border-0">Instructor</th> --}}
                            <th scope="col" class="border-0">Name</th>
                            <th scope="col" class="border-0">Sub Categories</th>
                           
                            <th scope="col" class="border-0 rounded-end">Action</th>
                        </tr>
                    </thead>

                    <!-- Table body START -->
                    <tbody>

                        <!-- Table row -->
                        @foreach($categories as $key => $category)
                        <tr>
                            <td>{{ ++$key }}</td>
                          
                            <td>{{ $category->name }}
                           
                            </td>
                            <td>
                                <div class='col-md-6'>
                                    <ul>
                                @foreach($category->subcategories as $subcategory)
                                <li>{{ $subcategory->name }}</li>
                                @endforeach
                                    </ul>
                                </div>
                              </td>
                           <td>

                                 <button id='delete_ebook' data-id='{{ $category->id }}'
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

<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="addCategoryLabel">Add Product Category</h5>
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

<div class="modal fade" id="addSubCategory" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="addCategoryLabel">Add Product Sub Category</h5>
                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i
                        class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <form action="/createSubCategory" method='post' class="row text-start g-3">@csrf
                    <!-- Question -->
                    <div class="col-12">
                        <label class="form-label">Select Category</label>
                        <select name='category_id' required class="form-control" >
                            <option> -- Select Category --</option>
                            @foreach($categories as $cat)
                            <option value='{{ $cat->id }}'>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <label class="form-label">Sub Category Name</label>
                        <input id='title' name='name' required class="form-control" type="text"
                            placeholder="Input Sub-Category Name">
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
        title: "Please note that deleting this category will also delete all products under them!",
        // text: `Please note that deleting this category will also delete all ebooks under them!`,
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
        swal("Category will not be deleted  :)");
      }
    }


    function performDelete(el, id) {

      try {
        $.get('{{ route("delete_category") }}?id=' + id,
          function(data, status) {
            console.log(status);
            console.table(data);
            if (status === "success") {
              let alert = swal('success', "Category successfully deleted!.", 'success');
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