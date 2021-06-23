@extends('layouts.app')

@section('heading', 'Manage Brand')
@section('title', 'brand')

@section('main-content')

<section class="content">
  <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="card">
          <div class="row">
              <div class="card-header col-md-6 col-6">
                  <h3>Manage Brand</h3>
              </div>
              <div class="card-header col-md-6 col-6 text-right">
                  <a href="{{route('add.brand')}}" class="viewall bg-success p-2"><i class="fas fa-plus-square"></i> Add Brand</a>
              </div>
          </div>
          @include('admin.includes.message')
          <div class="card-body">
            <div class="table-responsive">
            <table id="all-category" class="table table-bordered table-hover">
              <thead>
                  <tr>
                      <th>SL NO</th>
                      <th>Brand Name</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>

                  @foreach ($brand as $brands)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $brands->brand_name }}</td>
                          <td>
                            <input type="checkbox" data-size="mini" data-toggle="toggle" data-on="Active" data-off="Inactive" id="brandStatus" data-id="{{ $brands->id}}" {{ $brands->status == 1 ? 'checked' : '' }} >
                          </td>
       
                          {{-- {{ $brands->status == 1 ? 'Active' : 'Inactive' }} --}}


                          <td style="width: 80px">
                            {{-- @if($brands->status == 1)
                            <a href="{{ route('inactive.brand',$brands->id) }}" class="btn btn-success btn-xs"> <i class="fas fa-arrow-up"></i> </a>
                            @else
                            <a href="{{ route('active.brand',$brands->id) }}" class="btn btn-info btn-xs"> <i class="fas fa-arrow-down"></i> </a>
                            @endif --}}
                             
                              <a href="{{ route('edit.brand',$brands->id) }}" class="btn btn-info btn-xs"> <i class="fas fa-pencil-alt"></i> </a>
                              <a href="{{ route('delete.brand',$brands->id) }}" class="btn btn-danger btn-xs"> <i class="fas fa-trash-alt"></i> </a>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
          </div>
      </div>

      <!-- /.row -->

  </div><!-- /.container-fluid -->
</section>


@endsection

@section('script')
    <script>
      $(document).ready(function(){
        $(function() {
            $("#all-category").DataTable();
            //   $('#example2').DataTable({
            //     "paging": true,
            //     "lengthChange": false,
            //     "searching": false,
            //     "ordering": true,
            //     "info": true,
            //     "autoWidth": false,
            //   });
        });

        $('body').on('change','#brandStatus',function(){
          var id=$(this).attr('data-id');
          if(this.checked){
            var status = 1;
          }
          else{
            var status = 0;
          }
        $.ajax({
          url:'brandStatus/'+id+'/'+status,
          method:'get',
          success:function(success){
            console.log(success);
          },
        });

        });
      });
         
    </script>
@endsection