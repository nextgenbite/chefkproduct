@extends('admin.master')
@push('custom-css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" />
@endpush
@section('content')
<div class="content-wrapper">
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        
      </div>
      <div class="card">
        <div class="card-body">



          <h2 class="card-title">Product List</h2>
          <div class="table-responsive ps ps--theme_default"      >

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                      <th>Product Name</th>
                      <th>Category</th>
                      <th>Product Image</th>
                      <th>Product Price</th>
                       <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($index as $key => $item)

                    <tr>

                      <td>{{$item->product_name}}</td>
                      <td>{{$item->category->category_name}}</td>
                      <td><img src="{{URL::to($item->product_image)}} " class="img-rounded" width="100px" alt="sadd"> </td>
                      <td class="text-center">{{$item->selling_price}}</td>
                      <td >
                        <div class="d-flex justify-content-between">

                            @if ($item->status ==1)

                              <a href="{{URL::to('/admin/product/'.$item->id.'/inactive')}} " class="btn btn-success">Active</a>
                            @else
                            <a href="{{URL::to('/admin/product/'.$item->id.'/active')}} " class="btn btn-danger">Inactive</a>
                            @endif

                            <a href="{{URL::to('/admin/product/'.$item->id.'/edit')}}" class="btn btn-primary btn-sm">Manage</a>

                                                    <form action="{{URL::to('/admin/product/'.$item->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" name="submit" class="btn btn-danger btn-sm">Remove</button>
                                                    </form>
                        </div>

                      </td>
                    </tr>
                    @endforeach

                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Product Image</th>
                        <th>Product Price</th>
                        <th class="text-center">Action</th>
                      </tr>
               </tfoot>
              </table>
          <div class="ps__scrollbar-x-rail" style="width: 276px; left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 105px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
@push('custom-scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
    $('#example').DataTable();
});
</script>

@endpush
