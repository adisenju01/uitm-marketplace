@extends('vendor.layouts.master')


@section('content')
  <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
        @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Create Product</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{route('vendor.products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group wsus__input">
                        <label>Preview</label>
                        <br>
                        <img src="{{asset($product->thumb_image)}}" style="width:200px" alt="">
                    </div>
                    <div class="form-group wsus__input">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <div class="form-group wsus__input">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{$product->name}}">
                    </div>


                   
                    <div class="form-group wsus__input">
                        <label>Price</label>
                        <input type="text" class="form-control" name="price" value="{{$product->price}}">
                    </div>


                    <div class="form-group wsus__input">
                        <label>Stock Quantity</label>
                        <input type="number" min="0" class="form-control" name="qty" value="{{$product->qty}}">
                    </div>

                    <div class="form-group wsus__input">
                        <label>Short Description</label>
                        <textarea name="short_description" class="form-control">{!! $product->short_description !!}</textarea>
                    </div>

                    <div class="form-group wsus__input">
                        <label for="inputState">Status</label>
                        <select id="inputState" class="form-control" name="status">
                          <option {{$product->status == 1 ? 'selected' : ''}} value="1">Active</option>
                          <option {{$product->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submmit" class="btn btn-primary">Update</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=============================
    DASHBOARD START
  ==============================-->
@endsection


