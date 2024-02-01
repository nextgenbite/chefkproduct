@extends('admin.master')
@section('content')
<div class="content-wrapper" style="min-height: 1727px;">
    <h1 class="page-title">Update color</h1>

    @if(count($errors) > 0 )
    <div class="alert alert-danger alert-dismissble fade in">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}
                <a href="" class="close" data-dismis="alert">&times;</a>
            </li>
        @endforeach
    </ul>
    </div>
    @endif
    <div class="row">
       
        <div class="col-12 col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    {{-- <h2 class="card-title">Horizontal form</h2> --}}
                    <form method="POST" action="{{URL::to('/admin/color', $color->id)}} "  class="forms-sample">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="exampleInputtext2" class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control p-input" name="name" value="{{$color->name}} " id="exampleInputtext2" aria-describedby="textHelp2" placeholder="Enter color Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputtext2" class="col-sm-4 col-form-label">Color Code</label>
                            <div class="col-sm-8">
                              <input type="color" class="form-control p-input" name="code" value="{{$color->code}}" id="exampleInputtext2" aria-describedby="textHelp2" placeholder="Enter color Name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <div class="form-radio">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" value="1" name="status" id="optionsRadios1" value="" checked="">
                                     Active
                                    <i class="input-helper"></i></label>
                                </div>
                                <div class="form-radio">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" value="0" name="status" id="optionsRadios2" value="option2">
                                      Inactive
                                    <i class="input-helper"></i></label>
                                </div>
                            </div>
                        </div>
                       
                        
                        <button type="submit"  class="btn btn-success mt-4">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection