@extends('admin.master')
@section('header')
@endsection

@section('content')
<div class="page-content-wrapper border">

    <!-- Title -->
    <div class="row mb-3">
        <div class="col-12 d-sm-flex justify-content-between align-items-center">
            <h1 class="h3 mb-2 mb-sm-0">{{ $assignment->title }}</h1>
            <a href="#" class="btn btn-sm btn-primary mb-0" data-bs-toggle="modal"
                data-bs-target="#exampleModalCenter"><i class="bi bi-plus-circle me-2"></i>Create Questions</a>

        </div>
    </div>



    <!-- Card START -->
    <div class="card bg-transparent border">

        <!-- Card header START -->
       
        <!-- Card header END -->

        <!-- Card body START -->
        <div class="card-body">
            <div class="table-responsive border-0 rounded-3">
				<!-- Table START -->
				<table class="table table-dark-gray align-middle p-4 mb-0 table-hover">
					<!-- Table head -->
					<thead>
						<tr>
							<th scope="col" class="border-0 rounded-start">Question</th>
							
							<th scope="col" class="border-0 rounded-end">Action</th>
						</tr>
					</thead>

					<!-- Table body START -->
					<tbody>

						<!-- Table row -->
						@foreach($questions as $question)
						<tr>
							<!-- Table data -->
							<td>
								<div class="d-flex align-items-center position-relative">
									<!-- Image -->
									
									<!-- Title -->
									<h6 class="mb-0 ms-2">
										<a href="#" class="stretched-link">{{ $question->question }}</a>
									</h6>
								</div>
							</td>

							<!-- Table data -->
							<td>
								<a href='view_options/{{ $question->id }}' class="edit_question btn btn-sm btn-info-soft me-1 mb-1 mb-md-0"
									>View Options</a>
								
								<a data-id='{{ $question->id }}'
									class="edit_question btn btn-sm btn-primary-soft me-1 mb-1 mb-md-0"
									data-bs-toggle="modal" data-bs-target="#editquestion">Edit</a>
								<button id='delete_question' data-id='{{ $question->id }}'
									class="btn btn-sm btn-danger-soft mb-0">Delete</button>
							</td>
						</tr>
						@endforeach

					</tbody>
					<!-- Table body END -->
				</table>
				<!-- Table END -->
			</div>

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

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create Question</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('storequestion')}}" method="POST">@csrf
                    <!--begin::Modal header-->

                    <div class="modal-body py-10 px-lg-17">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_new_address_scroll" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#kt_modal_new_address_header"
                            data-kt-scroll-wrappers="#kt_modal_new_address_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Notice-->

                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="required fs-5 fw-bold mb-2">Question Name</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input name='test' type='hidden' value='{{ $assignment->id }}' />
                                <input class="form-control" placeholder="" name="question" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bold mb-2">Options</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <style>
                                    .option-container {
                                        display: flex;
                                        align-items: center;
                                        margin-bottom: 10px;
                                    }
                                    
                                    .option-container input[type="radio"] {
                                        margin-left: 10px;
                                    }
                                </style>
                                
                               
                                    @for($i = 0; $i < 4; $i++)
                                    <div class="option-container">
                                       
                                        <input type="text" name="options[]" class="form-control form-small" placeholder="Option {{ $i + 1 }}" required>
                                        <input required type="radio" name="correct_answer" value="{{ $i }}">
                                        <span>Is correct</span>
                                    </div>
                                    @endfor
                              
                                
                                    <!--end::Input-->
                            </div>
                        </div>
                        <!--end::Scroll-->
                    </div>
                    <!--end::Modal body-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create question</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>


@endsection

@section('script')

<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

@endsection