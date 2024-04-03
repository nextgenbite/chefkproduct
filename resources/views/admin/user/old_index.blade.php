@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title">Category Page</h2>
          <div class="table-responsive ps ps--theme_default" data-ps-id="f342432d-4b6c-93b1-a6b9-79f39bb5a069">
            <table class="table center-aligned-table">
              <thead>
                
                <tr>
                
                  <th>Title</th>
                  <th>Category Discription</th>
                  <th>Status</th>
                  <th class="text-center" colspan="3">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)
                    
                <tr class="">
        
                  <td>{{$item->title}}</td>
                  <td>{{$item->category_dis}}</td>
                  @if ($item->category_status ==1)
                      
                  <td><a href="{{URL::to('/admin/category/'.$item->id.'/inactive')}} " class="badge badge-success">Active</a></td>
                  @else
                  <td><a href="{{URL::to('/admin/category/'.$item->id.'/active')}} " class="badge badge-danger">Inactive</a></td>
                  @endif
        
                  <td><a href="{{URL::to('/admin/category/'.$item->id.'/edit')}}" class="btn btn-primary btn-sm">Manage</a></td>
                  <td>
                    <form action="{{URL::to('/admin/category/'.$item->id)}}" method="post">
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


@endsection