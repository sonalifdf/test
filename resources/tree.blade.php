@extends('layout')

@section('title', 'Products')

@section('content')

    <div class="container products">
        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif

	 @if(session('message'))

            <div class="alert alert-success">
                {{ session('message') }}
            </div>

        @endif

        <div class="row">

            @foreach($products as $product)
                <div class="col-xs-18 col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="{{ $product->photo }}" width="500" height="300">
                        <div class="caption">
                            <h4>{{ $product->name }}</h4>
                            <p>{{ strtolower($product->description) }}</p>
                            <p><strong>Price: </strong> {{ $product->price }}$</p>
							@auth   
								<p class="btn-holder"><a href="#" data-id="{{ $product->id }}" class="btn btn-warning btn-block text-center add-to-db-ajax" role="button">Add to cart</a> </p>
							@else   
								<p class="btn-holder"><a href="#" data-id="{{ $product->id }}" class="btn btn-warning btn-block text-center add-to-cart-ajax" role="button">Add to cart</a> </p>
							@endauth
						</div>
                    </div>
                </div>
            @endforeach

        </div><!-- End row -->

    </div>

@endsection


@section('scripts')


    <script type="text/javascript">

		$(".add-to-cart-ajax").click(function (e) {
           e.preventDefault();

           var ele = $(this);
				
            $.ajax({
               // url: '{{ url('update-cart') }}',
               url: '{{ url('add-to-cart-session-ajax') }}',
               method: "post",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
               success: function (response) {
                   // window.location.reload();
				   document.getElementById("total_items").innerHTML=response;
				   // console.log(response);
               }
            });
        });
		
		
		$(".add-to-db-ajax").click(function (e) {
           e.preventDefault();

           var ele = $(this);
				
            $.ajax({
               // url: '{{ url('update-cart') }}',
               url: '{{ url('add-to-cart-db-ajax') }}',
               method: "post",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
               success: function (response) {
                   // window.location.reload();
				   document.getElementById("total_items").innerHTML=response;
				   console.log(response);
               }
            });
        });
		
    </script>
	
@endsection

