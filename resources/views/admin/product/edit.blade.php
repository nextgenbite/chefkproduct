@extends('admin.master')
@push('custom-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.css" integrity="sha512-uKwYJOyykD83YchxJbUxxbn8UcKAQBu+1hcLDRKZ9VtWfpMb1iYfJ74/UIjXQXWASwSzulZEC1SFGj+cslZh7Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
    <div class="content-wrapper" style="min-height: 1727px;">
        <h1 class="page-title">Edit Product</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">

            <div class="col-12 col-lg-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <form method="POST" action="{{ URL::to('/admin/product', $product->id) }}"
                                    enctype="multipart/form-data" class="forms-sample">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category</label>
                                        <select class="form-control p-input" name="category_id" id="">

                                            @foreach ($cat as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $product->category_id ? 'selected' : '' }}>
                                                    {{ $item->category_name }} </option>
                                            @endforeach
                                        </select>

                                    </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Name</label>
                                    <input type="text" class="form-control p-input" value="{{ $product->product_name }}"
                                        name="product_name" id="exampleInputText1" aria-describedby="textlHelp"
                                        placeholder="Enter Product Name">
                                    <small id="emailHelp" class="form-text text-muted text-success">Product name is must be
                                        uniqe.</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">

                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Product Price</label>
                                    <input type="number" class="form-control p-input" value="{{ $product->selling_price }}"
                                        name="selling_price" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        placeholder="Enter Product Price">

                                </div>
                            </div>
                            <div class="col-4">

                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Product Discount Price</label>
                                    <input type="number" class="form-control p-input"
                                        value="{{ $product->discount_price }}" name="discount_price" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter Product Discount Price">

                                </div>
                            </div>
                            <div class="col-4">

                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Product Quantity</label>
                                    <input type="number" class="form-control p-input" value="{{ $product->product_qty }}"
                                        name="product_qty" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        placeholder="Enter Product Quantity">

                                </div>
                            </div>


                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea">Product Discription</label>
                            <textarea class="form-control p-input" name="short_descp_en" id="exampleTextarea" rows="3">{{ $product->short_descp_en }}</textarea>
                        </div>



                        <div class="form-group">
                            <label>Upload Thumbnail</label>
                            <div class="row">
                                <div class="col-4">

                                    {{-- <p><img id="output" width="200" /></p> --}}
                                    <p><input type="file" accept="image/*" name="product_image" id="file"
                                            onchange="loadFile(event)" style="display: none;"></p>
                                    <p><label class="btn btn-outline-primary btn-sm" for="file"
                                            style="cursor: pointer;"><i
                                                class="mdi mdi-upload btn-label btn-label-left"></i>Browse</label></p>
                                </div>
                                <div class="col-4">
                                    <label>New Image</label>
                                    <p><img id="output" width="200" /></p>
                                </div>
                                <div class="col-4">
                                    <label>Old Image</label>
                                    <p><img src="{{ URL::to($product->product_image) }} " width="200" /></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Multiple Images</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="file" name="multi_image[]" multiple>
                                </div>
                                <div class="col-6 d-flex justify-content-between">
                                    @foreach ($product->images()->get() as $image)
                                    <p><img src="{{ URL::to($image->path) }} " width="80" /></p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Youtube Video</label>
                            <div class="row">
                              <div class="col-6">
                                  <input type="text"class="form-control" value="{{ $product->video }}" name="video" >
                                  <p>https://www.youtube.com/watch?v=<strong class="text-danger bold">Q4UAFyriRWg</strong></p>
                              </div>
                            </div>
                        </div>
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-6">
                                  <label>Colors</label>
                                  <input type="text" name="color" id="colors" value="{{ $product->color ? implode(',', json_decode($product->color)) : null }}" placeholder="Colors">
                                </div>
                              <div class="col-6">
                                  <label>Sizes</label>
                                  <input type="text" name="size" id="size" value="{{$product->size ? implode(',', json_decode($product->size)) : null }}"  placeholder="Sizes">
                              </div>
                            </div>
                        </div>
        <div class="row">
            <div class="form-group col-4">
                <label for="exampleInputEmail1">Trend Product</label>
                <div class="form-group">
                    <div class="form-radio">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="trend"
                                id="optionsRadios1" value="1" {{ $product->trend == '1' ? 'checked' : ''}}>
                            Active
                        </label>
                    </div>
                    <div class="form-radio">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="trend"
                                id="optionsRadios2" value="0" {{ $product->trend == '0' ? 'checked' : ''}}>
                            Inactive
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group col-4">
                <label for="exampleInputEmail1">Top Product</label>
                <div class="form-group">
                    <div class="form-radio">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="top"
                                id="optionsRadios1" value="1" {{ $product->top == '1' ? 'checked' : ''}} >
                            Active
                        </label>
                    </div>
                    <div class="form-radio">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="top"
                                id="optionsRadios2" value="0" {{ $product->top == '0' ? 'checked' : ''}}>
                            Inactive
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group col-4">
                <label for="exampleInputEmail1">Status</label>
                <div class="form-group">
                    <div class="form-radio">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status"
                                id="optionsRadios1" value="1" {{ $product->status == '1' ? 'checked' : ''}}>
                            Active
                        </label>
                    </div>
                    <div class="form-radio">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status"
                                id="optionsRadios2" value="0" {{ $product->status == '0' ? 'checked' : ''}}>
                            Inactive
                        </label>
                    </div>
                </div>
            </div>
        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
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
@push('custom-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js" integrity="sha512-wTIaZJCW/mkalkyQnuSiBodnM5SRT8tXJ3LkIUA/3vBJ01vWe5Ene7Fynicupjt4xqxZKXA97VgNBHvIf5WTvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

$(document).ready(function() {
        $('#colors').tagsInput();
        $('#size').tagsInput();
    });
</script>
@endpush
