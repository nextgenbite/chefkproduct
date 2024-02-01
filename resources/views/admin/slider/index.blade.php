@extends('admin.master')
@section('content')
<div class="content-wrapper">
  <link rel="stylesheet" href="{{asset('/backend/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" />
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">


          
          <h2 class="card-title">Slider List</h2>
          <div class="table-responsive ps ps--theme_default" data-ps-id="f342432d-4b6c-93b1-a6b9-79f39bb5a069">
            <table class="table center-aligned-table">
              <thead>
                
                <tr>
                
       
                  <th>Sl </th>
                  <th>Slider Image</th>
                  <th>Status</th>
                  <th  >Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($index as $key => $item)
                    
                <tr class="">
        
               <td>{{$item->id}} </td>
        
                  <td><img src="{{URL::to($item->slider_image)}} " class="img-rounded" width="100px" alt="sadd"> </td>
          
                  @if ($item->slider_status ==1)
                      
                  <td><a href="{{URL::to('/admin/slider/'.$item->id.'/inactive')}} " class="badge badge-success">Active</a></td>
                  @else
                  <td><a href="{{URL::to('/admin/slider/'.$item->id.'/active')}} " class="badge badge-danger">Inactive</a></td>
                  @endif
        
                 
                  <td>
                    <form action="{{URL::to('/admin/slider/'.$item->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" name="submit" class="btn btn-danger btn-sm" value="Remove">
                    </form>
                   
                  </td>
                </tr>
                @endforeach
              
              </tbody>
             
            </table>
            
          <div class="ps__scrollbar-x-rail" style="width: 276px; left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 105px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
        </div>
      </div>
    </div>
  </div>

</div>

<script src="{{asset('/backend/node_modules/datatables.net/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('/backend/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('/backend/js/data-table.js')}}"></script>
@endsection