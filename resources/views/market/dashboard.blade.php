@extends('market.master')
@section('head')
@endsection 

@section('content')
<div class="col-xl-9">

	
	
	<div class="row mb-4">
		<!-- Counter item -->

		<div class="col-sm-6 col-lg-6 mb-3 mb-lg-0">
			<div
				class="d-flex justify-content-center align-items-center p-4 bg-primary bg-opacity-15 rounded-3">
				<span class="display-6 lh-1 text-primary mb-0"><i class="bi bi-basket fa-fw"></i></span>
				<div class="ms-4">
					<h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0"
							data-purecounter-end="{{ count($allproducts) }}"
							data-purecounter-delay="200">{{ count($allproducts) }}</h5>
					<a class="mb-0 h6 fw-light" href='/allproducts'>All Products</a><br>
					<a class='btn btn-primary btn-sm' href='/allproducts'>Visit Market Place</a>
				</div>
			</div>
		</div>

		
		<div class="col-sm-6 col-lg-6 mb-3 mb-lg-0 ">
			<div
				class="d-flex justify-content-center align-items-center p-4 bg-secondary bg-opacity-15 rounded-3">
				<span class="display-6 lh-1 text-secondary mb-0"><i
						class="fas fa-wallet fa-fw"></i></span>
				<div class="ms-4">
					<div class="d-flex">
						<h5 class="mb-0 fw-bold">NGN{{ number_format($balance,2) }}</h5>
					</div>
					<p class="mb-0 h6 fw-light">Wallet Balance </p>
					<a class='btn btn-secondary btn-sm' href='https://abovemarts.com/fund'>Fund Wallet</a>


					{{-- @if($user->package !== "Basic")
					<a class='btn btn-danger btn-sm' href='https://abovemarts.com'>Visit Backoffice</a>
					@endif --}}
				
				</div>
			</div>
		</div>

	

	</div>

	<!-- Counter boxes START -->
	<div class='alert alert-success' style='border:1px dashed #155724'>
		<p>Do you have products you wish to sell? You can now sell them on Abovemarts! Click 

		<a href='/dashboard'>here</a> to start selling.</p>
	</div>
	<!-- Counter boxes END -->

	<div class="card bg-transparent border rounded-3">
		<!-- Card header START -->
		<div class="card-header bg-transparent border-bottom">
			<h3 class="mb-0">Products Bought({{ count($boughtproducts) }})</h3>
		</div>
		<!-- Card header END -->

		<!-- Card body START -->
		<div class="card-body">

			<!-- Search and select START -->
			{{-- <div class="row g-3 align-items-center justify-content-between mb-4">
				<!-- Content -->
				<div class="col-md-8">
					<form class="rounded position-relative">
						<input class="form-control pe-5 bg-transparent" type="search"
							placeholder="Search" aria-label="Search">
						<button
							class="btn bg-transparent px-2 py-0 position-absolute top-70 end-0 translate-middle-y"
							type="submit"><i class="fas fa-search fs-6 "></i></button>
					</form>
				</div>

				<!-- Select option -->
				<div class="col-md-3">
					<!-- Short by filter -->
					<form>
						<select class="form-select js-choice border-0 z-index-9 bg-transparent"
							aria-label=".form-select-sm">
							<option value="">Sort by</option>
							<option>Free</option>
							<option>Newest</option>
							<option>Most popular</option>
							<option>Most Viewed</option>
						</select>
					</form>
				</div>
			</div> --}}
			<!-- Search and select END -->

			<!-- Course list table START -->
			<div class="table-responsive border-0">
				<table class="table table-dark-gray align-middle p-4 mb-0 table-hover">
					<!-- Table head -->
					<thead>
						<tr>
							<th scope="col" class="border-0 rounded-start">Product Name</th>
							<th scope="col" class="border-0">Price</th>
							<th scope="col" class="border-0">Date Of Purchase</th>
							<th scope="col" class="border-0">Status</th>
							<th scope="col" class="border-0 rounded-end">Action</th>
						</tr>
					</thead>

					<!-- Table body START -->
					<tbody>
						<!-- Table item -->
						@foreach($boughtproducts as $product)
						<tr>
							<!-- Table data -->
							<td>
								<div class="d-flex align-items-center">
									<!-- Image -->
									<div class="w-100px">
										<a href="/lesson/{{ $product->uid }}">
										<img src="https://shop.abovemarts.com/public/productimage/{{ $product->image}}" class="rounded"
											alt=""></a>
										{{-- <img src="/courseimage/{{ $product->image}}" class="rounded"
											alt=""> --}}
									</div>
									<div class="mb-0 ms-2">
										<!-- Title -->
										<h6><a href="/lesson/{{ $product->uid }}">{{ $product->name ?? "No name" }}</a></h6>
										<!-- Info -->

									</div>
								</div>
							</td>

							<!-- Table data -->
							<td>
								<div class="overflow-hidden">
									NGN{{ number_format($product->price,2) ?? "0" }}
								</div>
								{{-- {{ $status[$product->id][$product->id] }} --}}
							</td>

							<!-- Table data -->
							<td>
								{{ Date('d-m-Y h:i',strtotime($product->created_at)) }}
							</td>
							<td>
								
								
								@if($product->downloadURL  !== null)
								<a class='btn btn-success' href='{{ $product->downloadURL }}'>Download</a>
								@endif
								@if($product->status == 1)
								<div class='alert-sm alert alert-primary'>Payment Confirmed!</div>
								@elseif($product->status == 2)
								<div class='alert-sm alert alert-warning'>Product Shipped!</div>
								
								@elseif($product->status == 3)
								<div class='alert-sm alert alert-success'>Product Received!</div>
								
								@elseif($product->status == 4)
								<div class='alert-sm alert alert-success'>Money Refunded!</div>
								
								@else
								<div class='alert-sm alert alert-warning'>Product Yet To Be Paid For!</div>

								@endif
								
							</td>

							<!-- Table data -->
							<td>
								

								<a class='btn btn-primary' href='tel:{{ $product->vendor->phoneNumber ?? ""}}'>Call Seller</a>
								@if($product->status == 2)

								<a href='markreceived/{{ $product->uid }}' onclick='return confirm("Are you sure you have received this product?")' class='btn btn-success'>Mark Received</a>
								@elseif($product->status == 3)
								{{-- <div class='alert alert-success'>Product Received!</div> --}}
								@else
								<a href='https://wa.me/2349058744473?text=' class='btn btn-danger'>Dispute</a>

								@endif
							</td>
						</tr>
						@endforeach

					</tbody>
					<!-- Table body END -->
				</table>
				{!! $boughtproducts->links('pagination::bootstrap-4') !!}
			</div>
			<!-- Course list table END -->

		</div>
		<!-- Card body START -->
	</div>
	<!-- Main content END -->
</div><!-- Row END -->

@endsection
@section('script')
@endsection