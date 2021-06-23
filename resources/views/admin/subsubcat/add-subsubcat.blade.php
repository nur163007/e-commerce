@extends('layouts.app')

@section('heading', 'Add Sub Subcategory')
@section('title', 'subsubcategory')

@section('main-content')

<section class="content">
  <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="card">
          <div class="row">
              <div class="card-header col-md-6 col-6">
                  <h3>Add Sub Subcategory</h3>
              </div>
              <div class="card-header col-md-6 col-6 text-right">
                  <a href="{{route('manage.subSubCategory')}}" class="viewall bg-success p-2"><i class="fas fa-list"></i> All Sub Subcategory</a>
              </div>
          </div>
          @include('admin.includes.message')
          <div class="card-body">
            <form method="POST"  enctype="multipart/form-data" id="form" action="{{ route('save.subSubCat') }}">
                @csrf
                   <div class="row">
                    <div class="form-group col-md-6">
                        <label for="category">Category Name</label>

                        <select id="" class="custom-select category" id="category" name="cat_id">
                            <option value="" selected disabled>--select category name--</option>
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

                        <select id="" class="custom-select sub_cat" id="sub_cat" name="sub_cat_id">
                         
                            <option value="0" selected disabled>--select sub category--</option>
                           
                        </select>
                        @if ($errors->has('sub_cat'))
                            <p class="text-danger">{{ $errors->first('sub_cat') }}</p>
                        @endif
                    </div>  
                       <div class="form-group col-md-6">
                           <label for="sub_sub_cat">Sub Subcategory Name</label>
                           <input class="form-control" type="text" id="sub_-sub_cat" name="sub_sub_cat" placeholder="Enter Sub subcategory Name" data-validation="required">
                           @if ($errors->has('sub_sub_cat'))
                               <p class="text-danger">{{ $errors->first('sub_sub_cat') }}</p>
                           @endif
                       </div>
                   </div>
                   <input class="btn btn-success" type="submit" id="submit" name="submit" value="Save Subsubcat">
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

            $(document).on('change',".category" ,function(){
            
               var cat_id = $(this).val();
         
            // var div = $(this).parent();
            var output = "";
                $.ajax({
                        url: "{{ route('load.subSubCat') }}",
                        type:"get",
                        data:{'id':cat_id},
                        success:function(success){
                            
                            output+='<option value="0" selected disabled>--select sub category--</option>';

                            for(var i=0; i<success.length;i++){
                                output+='<option value="'+success[i].id+'" >'+success[i].sub_cat+'</option>';
                            }

                            $('.sub_cat').html("");
                            $('.sub_cat').append(output);

                        },
                        error:function(){

                        }
                });

                // if($(this).val() != ''){
                //     var select = $(this).attr("id");
                //     var value = $(this).val();
                //     var dependent = $(this).data('dependent');
                //     var _token = $('input[name="_token"])'.val();

                //     $.ajax({
                //         url: "{{ route('load.subSubCat') }}",
                //         method:"POST",
                //         data:{select:select,value:value,_token:_token,dependent:dependent},
                //         success:function(success){
                //             $("#"+dependent).html(success);
                //         }
                //     });
                // }
            });

        });
         
    </script>
@endsection