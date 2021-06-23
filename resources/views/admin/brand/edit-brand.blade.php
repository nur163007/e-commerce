@extends('layouts.app')

@section('heading', 'Add Brand')
@section('title', 'brand')

@section('main-content')
<section class="content">
  <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="card">
          <div class="row">
              <div class="card-header col-md-6 col-6">
                  <h3>Update Brand</h3>
              </div>
              <div class="card-header col-md-6 col-6 text-right">
                  <a href="{{route('manage.brand')}}" class="viewall bg-success p-2"><i class="fas fa-list"></i> All Brands</a>
              </div>
          </div>
          @include('admin.includes.message')
          <div class="card-body">
              <form method="POST"  enctype="multipart/form-data" id="form" action="{{ route('update.brand') }}">
               @csrf
                  <div class="row">
                      <input type="hidden" name="brandID" value="{{ $editBrand->id }}">
                      <div class="form-group col-md-6">
                          <label for="brand_name">Brand Name</label>
                          <input class="form-control" type="text" id="brand_name" name="brand_name" value="{{ $editBrand->brand_name }}"placeholder="Enter Brand Name" data-validation="required">
                          @if ($errors->has('brand_name'))
                              <p class="text-danger">{{ $errors->first('brand_name') }}</p>
                          @endif
                      </div>
                  </div>
                  <input class="btn btn-success" type="submit" id="submit" name="submit" value="Update Brand">
              </form>
          </div>
      </div>

      <!-- /.row -->

  </div><!-- /.container-fluid -->
</section>
@endsection

@section('script')
<script>
 $.validate({
        lang: 'en'
    });
</script>
   
@endsection