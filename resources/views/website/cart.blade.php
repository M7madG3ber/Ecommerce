@extends('website.layouts.layout')

@section('title')
Cart | @parent
@endsection

@section('content')

<!-- Content Header -->
<div class="content-header">
      <div class="container-fluid">
            <div class="row mb-2">
                  <div class="col-sm-12">
                        <h1 class="m-0">Cart</h1>
                  </div>
            </div>
      </div>
</div>
<!-- Content Header -->

<!-- Main content -->
<div class="content">
      <div class="container-fluid">
            <div class="row">
                  <div class="col-sm-12">


                        @if ( $carts->isEmpty())
                        <div class="col-sm-12 mt-3">
                              <div class="d-flex justify-content-center mt-5">
                                    <h4 class="text-danger">Cart is empty</h4>
                              </div>
                        </div>
                        @else
                        <div class="col-sm-12 mt-3">
                              <table class="table table-striped table-hover">
                                    <thead>
                                          <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Actions</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          @foreach ($carts as $cart)
                                          <tr>
                                                <td>{{ $cart->product->name }}</td>
                                                <td>{{ $cart->product->price }}</td>
                                                <td>
                                                      <input type="text" id="{{ $cart->id }}"
                                                            value="{{ $cart->quantity }}" placeholder="Enter quantity"
                                                            min="0" onchange="changeCart(this)" class="quantityInputs">
                                                </td>
                                                <td>
                                                      <form action="{{ route('deleteFromCart', $cart->id ) }}"
                                                            method="POST" class="mx-2">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger">
                                                                  <i class="fas fa-trash"></i>
                                                            </button>
                                                      </form>
                                                </td>
                                          </tr>
                                          @endforeach

                                    </tbody>
                              </table>
                        </div>
                        <div class="col-sm-12 mt-3">
                              <button class="btn btn-primary" id="CreateOrder">Order Now</button>
                        </div>
                        @endif

                  </div>
            </div>
      </div>
</div>
<!-- Main content -->

@endsection

@section('scripts')
<script>
      $("#CreateOrder").on("click",function()
      {
            $("#CreateOrder").prop('disabled', true);
            $(".quantityInputs").prop('disabled', true);

            $.ajax({
                  type: "post",
                  url:  "{{ route('createOrder') }}",
                  data: {},
                  headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  beforeSend: function(){
                  },
                  success: function(response){
                        if( response.status )
                        {
                              location.href = "{{ route('cart')}}";
                        }
                        else
                        {
                              alert(response.message);
                              $("#CreateOrder").prop('disabled', false);
                              $(".quantityInputs").prop('disabled', false);
                        }
                  },
                  complete: function(response){
                  }
            });
      });

      function isInt(value) 
      {
            return !isNaN(value) && 
                  parseInt(Number(value)) == value && 
                  !isNaN(parseInt(value, 10));
      }

      function changeCart(ele)
      {
            var inputVal =  $(ele).val();
            var id =  $(ele).attr('id');

            if( ! isInt(inputVal) )
            {
                  inputVal = 1;
                  $(ele).val(1);
            }

            $.ajax({
                  type: "post",
                  url:  "{{ route('updateCart') }}",
                  data: {
                        'id': id,
                        'value': inputVal
                  },
                  headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  beforeSend: function(){
                  },
                  success: function(response){
                        if( response.status )
                        {
                        }
                        else
                        {
                              alert(response.message);
                        }
                  },
                  complete: function(response){
                  }
            });
      }

</script>
@endsection