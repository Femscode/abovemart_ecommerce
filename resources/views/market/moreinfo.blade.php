@extends('market.master')
@section('head')
@endsection

@section('content')
<div class="col-xl-9">

    <!-- Payment method START -->
    <div class="card bg-transparent border rounded-3 mb-4 z-index-9">
        <!-- Card header START -->
        <div class="card-header bg-transparent d-sm-flex justify-content-sm-between align-items-center border-bottom">
            <h3 class="mb-2 mb-sm-0">More Info</h3>
           
        </div>
        <!-- Card header END -->

        <!-- Card body START -->
        <div class="card-body">
            <div class="accordion accordion-circle" id="accordioncircle">
                <!-- Credit or debit card START -->
                <div class='alert alert-success'>
                    {{ $purchase->name }} (NGN{{ $purchase->price }})
                </div>
                <div class="accordion-item mb-3">
                   
                    <div id="collapse-1" class="mt-4 accordion-collapse collapse show" aria-labelledby="heading-1"
                        data-bs-parent="#accordioncircle">
                        <!-- Accordion body -->
                        <div class="accordion-body">
                            <!-- Form START -->
                            <form class="row text-start g-3" >@csrf
                                <!-- Card number -->

                                <div class="col-6">
                                    <label class="form-label">Customer's Full Name <span class="text-danger">*</span></label>
                                    <input  type="text" name='name' class="form-control" value='{{ $user->firstName }}'
                                        aria-label="Enter Name" placeholder="Enter name">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input  type="text" name='phone' class="form-control" value='{{ $purchase->phone }}'
                                        aria-label="Enter Phone Number" placeholder="Enter phone number">
                                </div>
                                <!-- Expiration Date -->
                                <div class="col-md-6">
                                    <label class="form-label">Address <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" value='{{ $purchase->country }}' class="form-control" maxlength="2" >

                                    

                                        <input   value='{{ $purchase->state }}' type="text" class="form-control" name='state' >
                                    </div>
                                </div>
                                <!--Cvv code  -->
                                <div class="col-md-6">
                                    <label class="form-label">Home address <span class="text-danger">*</span></label>
                                    <input  type="text"  value='{{ $purchase->address }}' name='address' class="form-control" placeholder="">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Quantity</label>
                                    <input type="number"  value='{{ $purchase->quantity }}'  value='1' name='quantity' class="form-control" placeholder="">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Additional Info</label>
                                    <textarea name='info'  value='{{ $purchase->info }}' class="form-control" placeholder=""></textarea>
                                </div>
                                <!-- Card name -->


                                <div class="col-12">
                                    <div class='alert alert-danger'>
                                        Please note that delivery fee is not included, the seller is expecting an update.</div>
                                    </div>
                                  
                                    <button class='btn btn-secondary' href="/boughtproducts" >
                                      Back  </button>
                                </div>

                        </div>
                    </div>
                </div>
                <!-- Credit or debit card END -->

            </div>
        </div>
        <!-- Card body START -->
    </div>

</div>
@endsection
@section('script')
@endsection