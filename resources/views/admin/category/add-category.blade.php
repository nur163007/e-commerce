@extends('layouts.app')

@section('heading', 'Add Category')
@section('title', 'category')

@section('main-content')

<section class="content">
  <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="card">
          <div class="row">
              <div class="card-header col-md-6 col-6">
                  <h3>Add Category</h3>
              </div>
              <div class="card-header col-md-6 col-6 text-right">
                  <a href="{{route('manage.category')}}" class="viewall bg-success p-2"><i class="fas fa-list"></i> All Category</a>
              </div>
          </div>
          @include('admin.includes.message')
          <div class="card-body">
            <form method="POST"  enctype="multipart/form-data" id="form" action="{{ route('save.category') }}">
                @csrf
                   <div class="row">
                       
                       <div class="form-group col-md-6">
                           <label for="category_name">Category Name</label>
                           <input class="form-control" type="text" id="category_name" name="category_name" placeholder="Enter Category Name" data-validation="required">
                           @if ($errors->has('category_name'))
                               <p class="text-danger">{{ $errors->first('category_name') }}</p>
                           @endif
                       </div>
                   </div>
                   <input class="btn btn-success" type="submit" id="submit" name="submit" value="Save Category">
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