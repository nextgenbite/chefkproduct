@extends('admin.master')
@section('content')
<div class="content-wrapper" style="min-height: 1727px;">
    <h1 class="page-title">Create Slider</h1>
    <div class="row">
       
      <div class="col-8 col-lg-8 offset-2 grid-margin">
        <div class="card">
            <div class="card-body align-center">
       
              <form method="POST" action="{{URL::to('/admin/slider')}}" enctype="multipart/form-data" class="forms-sample">
                @csrf
                    <div class="form-group">
                      <label>Upload file</label>

                          <p><img id="output" width="200" /></p>
                          <p><input type="file"  accept="image/*" name="slider_image" id="file"  onchange="loadFile(event)" style="display: none;"></p>
                          <p><label class="btn btn-outline-primary btn-sm" for="file" style="cursor: pointer;"><i class="mdi mdi-upload btn-label btn-label-left"></i>Browse</label></p>
                     
                      
                  
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"> Url</label>
                    <input type="url" class="form-control p-input" name="url" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Url">

                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Slider status</label>
                    <div class="form-group">
                      <div class="form-radio">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="slider_status" id="optionsRadios1" value="1" checked>
                            Active
                          </label>
                      </div>
                      <div class="form-radio">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="slider_status" id="optionsRadios2" value="0">
                            Inactive
                          </label>
                      </div>
                  </div>
                </div>
                    <button type="submit" class="btn btn-success">Create</button>
                </form>
            </div>
        </div>
    </div>
    </div>
  </div>

  <script>
    // auto image upload show
    var loadFile = function(event) {
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
@endsection