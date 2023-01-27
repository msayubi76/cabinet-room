@extends('layouts.theme')
@section('title', 'Home')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if(session('message'))
                    <div class="alert alert-success"> {{ session('message') }}</div>
                    @endif

                  @if ($errors->any())
            <div class="text-danger">
                <strong>Whoops!</strong><br> There were some<strong> problems</strong> with your input.<br><br>

            </div>
                @endif
                {{ $errors }}
                    <h4 class="card-title"> Pages Setting</h4>

                    <div class="basic-form">
                        <form action="{{route('order.payment')}}"  method="Post" id="product-form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden"  id=""  name="order_id" value="{{ $payment->id }}">
                             <input type="hidden" name="user_id" id="user_id" value="{{ $payment->user_id }}">
                            {{-- <input type="hidden" value="PUT" name="_method"> --}}

                            <div class="form-group mb-8">
                                <label for="">Amount</label>
                                <input type="text" class="form-control" id="amount" name="amount"
                             placeholder="Enter a name.." value="{{ $payment->payment->remaining_amount }}">

                                   @error('amount')
                                   <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>

                            <div class="form-group mb-8">
                                <label for=""> comment </label>
                                <textarea class="form-control h-150px " id="" name="comment" rows="6" placeholder="Write here.......">

                                   </textarea>
                                   @error('comment')
                                   <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>



                               </div>











                               <div class="modal-footer">
                               <a href="{{url('/admin/settings')}}"  type="button" class="btn btn-secondary"> Close </a>
                               <button type="submit"  id="button-save"  class="btn btn-primary">Update Setting</button>
                            </div><br>



                            </form>
                    </div>
                </div>
            </div>
        </div>
 </div>
</div>

@endsection

