@extends('layouts.app')

@section('heading', 'Add SubCategory')
@section('title', 'subcategory')

@section('main-content')

<section class="content">
  <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="card">
          <div class="row">
              <div class="card-header col-md-6 col-6">
                  <h3>Add SubCategory</h3>
              </div>
              <div class="card-header col-md-6 col-6 text-right">
                  <a href="{{route('manage.subCategory')}}" class="viewall bg-success p-2"><i class="fas fa-list"></i> All SubCategory</a>
              </div>
          </div>
          @include('admin.includes.message')
          <div class="card-body">
            <form method="POST"  enctype="multipart/form-data" id="form" action="{{ route('save.subcategory') }}">
                @csrf
                   <div class="row">
                    <div class="form-group col-md-6">
                        <label for="category">Category Name</label>

                        <select id="" class="custom-select" id="category" name="cat_id">
                            <option value="">--select category name--</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{ucwords($category->category_name)}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('category'))
                            <p class="text-danger">{{ $errors->first('category') }}</p>
                        @endif
                    </div>   

                       <div class="form-group col-md-6">
                           <label for="sub_cat">SubCategory Name</label>
                           <input class="form-control" type="text" id="sub_cat" name="sub_cat" placeholder="Enter Subcategory Name" data-validation="required">
                           @if ($errors->has('sub_cat'))
                               <p class="text-danger">{{ $errors->first('sub_cat') }}</p>
                           @endif
                       </div>
                   </div>
                   <input class="btn btn-success" type="submit" id="submit" name="submit" value="Save Subcategory">
               </form>
          </div>
      </div>

      <!-- /.row -->

  </div><!-- /.container-fluid -->
</section>


@endsection

@section('script')
    <script>
      $(document).ready(function(){
       
            $.validate({
                lang: 'en'
            });

        });
         
    </script>
@endsection