@extends('layouts.app')
@push('title')
    {{ $settings['app_name'] ?? '' . ' ' . $title[0] }}
@endpush
@section('content')
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.tailwindcss.min.css" rel="stylesheet">


    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ url('/admin') }}"
                                class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                                <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <a href="#"
                                    class="ml-1 text-gray-700 hover:text-primary md:ml-2 dark:text-gray-300 dark:hover:text-white">{{ $title[0] }}</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">List</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ $title[0] }} List</h1>
            </div>

        </div>
    </div>

    <div class="container mx-auto">

        <!-- Vertical Form -->
        <form class="p-2" action="{{ Route('settings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="name"
                       class="block mb-2 text-sm font-medium @error('name') text-red-700 dark:text-red-500 @else text-gray-900 dark:text-white @enderror">
                    Your Name
                </label>
            
                <input type="text" id="name" name="name"
                       class="block w-full p-2.5 border border-red-500 rounded-lg bg-gray-50 text-base
                              @error('name') border-red-500 text-red-900 placeholder-red-700
                              focus:ring-red-500 focus:border-red-500 dark:border-red-500 dark:text-red-500 dark:placeholder-red-500
                              @else border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:bg-gray-700
                              @enderror"
                       placeholder="@error('name') Input error @else Enter Name @enderror">
            
                @error('name')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                        <span class="font-medium">Oh, snap!</span>
                        {{ $message }}
                    </p>
                @enderror
            </div>
            
            
    </div>
    <div class="p-6 space-y-6">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input type="text" name="title" id="title"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Enter Title" >
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="icon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Icon</label>
                <input type="text" name="icon" id="icon"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Enter icon" >
            </div>

            <div class="col-span-6 sm:col-span-3">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        for="file_input">Thumbnail</label>
                    <div class="relative ">
                        <input name="thumbnail"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help" id="file_input" type="file">
                        <img class="absolute top-0 right-0 w-10 h-10 rounded preview"
                            src="{{ asset('/images/no-image.png') }}" alt="thumbnail">
                    </div>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG(MAX.
                        250x250px).</p>
                </div>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        for="file_input">Thumbnail</label>
                    <div class="relative ">
                        <input name="thumbnail"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help" id="file_input" type="file">
                        <img class="absolute top-0 right-0 w-10 h-10 rounded preview"
                            src="{{ asset('/images/no-image.png') }}" alt="thumbnail">
                    </div>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG(MAX.
                        250x250px).</p>
                </div>
            </div>
        </div>


    </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="app_name" class="form-label">App Name</label>
                <input type="text" name="key[app_name]" class="form-control"
                    value="{{ old('app_name', $settings['app_name'] ?? '') }}">
                @error('app_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" name="key[phone]" class="form-control"
                    value="{{ old('phone', $settings['phone'] ?? '') }}">
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="key[address]" class="form-control"
                    value="{{ old('address', $settings['address'] ?? '') }}">
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="contact_mail" class="form-label">Contact Mail</label>
                <input type="email" name="key[contact_mail]" class="form-control"
                    value="{{ old('contact_mail', $settings['contact_mail'] ?? '') }}">
                @error('contact_mail')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <label for="example-fileinput" class="form-label">Logo</label>
            <div class=" input-group mb-3">
                <input type="file" name="key[logo]" id="logo"
                    class="form-control  @error('logo') is-invalid @enderror">
                <img id="showImage" src="{{ asset($settings['logo'] ?? 'images/no-image.png') }}"
                    class="input-group-text img-thumbnail" alt="logo" style="height:2.4rem; padding:-1rem">
            </div>
            @error('logo')
                <span class="text-danger"> {{ $message }} </span>
            @enderror
        </div> <!-- end col -->
        <div class="col-md-6">
            <label for="example-fileinput" class="form-label">Favicon</label>
            <div class=" input-group mb-3">
                <input type="file" name="key[favicon]" id="favicon"
                    class="form-control  @error('favicon') is-invalid @enderror">
                <img id="showImage" src="{{ asset($settings['favicon'] ?? 'images/no-image.png') }}"
                    class="input-group-text img-thumbnail" alt="favicon" style="height:2.4rem; padding:-1rem">
            </div>
            @error('favicon')
                <span class="text-danger"> {{ $message }} </span>
            @enderror
        </div> <!-- end col -->
        <div class="col-md-12">
            <div class="mb-3">
                <label for="inputNanme4" class="form-label">Description</label>
                <textarea name="key[about]" class="" rows="5" id="summernote">{!! $settings['about'] ?? '' !!}
  
                          </textarea>

                @error('about')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <h5 class="text-muted">Theme</h5>
        <div class="col-md-6">
            <div class="mb-3  ">
                <label for="color" class="form-label">Color</label>
                <input type="color" name="key[color]" class="form-control"
                    value="{{ old('color', $settings['color'] ?? '') }}">

            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3 ">
                <label for="hover_color" class="form-label">Hover Color</label>
                <input type="color" name="key[hover_color]" class="form-control"
                    value="{{ old('hover_color', $settings['hover_color'] ?? '') }}">

            </div>
        </div>
        <div class="text-center mt-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
        </form><!-- Vertical Form -->

    </div>
    <!-- Add Data Modal -->
    <div class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full"
        id="data-modal">
        <div class="relative w-full h-full max-w-2xl px-4 md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
                    <h3 class="text-xl font-semibold dark:text-white" id="modelHeading">
                        Add new data
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                        data-modal-toggle="data-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <form id="dataForm" enctype="multipart/form-data">
                    <input type="hidden" name="data_id" id="data_id">
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                <input type="text" name="title" id="title"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Enter Title" required>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="icon"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Icon</label>
                                <input type="text" name="icon" id="icon"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Enter icon" required>
                            </div>

                            <div class="col-span-6">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="file_input">Thumbnail</label>
                                    <div class="relative ">
                                        <input name="thumbnail"
                                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                            aria-describedby="file_input_help" id="file_input" type="file">
                                        <img class="absolute top-0 right-0 w-10 h-10 rounded preview"
                                            src="{{ asset('/images/no-image.png') }}" alt="thumbnail">
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG,
                                        JPG(MAX.
                                        250x250px).</p>
                                </div>
                            </div>
                        </div>


                    </div>
            </div>
            <!-- Modal footer -->
            <div class="items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-700">
                <button id="saveBtn" value="create"
                    class="text-white bg-primary hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                    type="submit">Save Changes</button>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection

@push('custom-script')
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.tailwindcss.js"></script>

    <script>
        $(document).ready(function() {
            // Preview image on file selection for each file input
            $('input[type="file"]').on('change', function() {
                var file = this.files[0];
                var $preview = $(this).closest('.relative').find(
                '.preview'); // Find the corresponding preview image
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $preview.attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                } else {
                    // If no file is selected, revert to default image
                    $preview.attr('src', '{{ asset('/images/no-image.png') }}');
                }
            });

            // Trigger change event for each file input if there's already a file selected (for initial preview)
            $('input[type="file"]').trigger('change');


            /*------------------------------------------
            --------------------------------------------
            Pass Header Token
            --------------------------------------------
            --------------------------------------------*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /*------------------------------------------
            --------------------------------------------
            Render DataTable
            --------------------------------------------
            --------------------------------------------*/
            let table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('/admin/categories') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'icon',
                        name: 'icon'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            /*------------------------------------------
            --------------------------------------------
            Click to Button
            --------------------------------------------
            --------------------------------------------*/
            $('#createData').click(function() {
                $('#saveBtn').val("create-data");
                $('#data_id').val('');
                $('#dataForm').trigger("reset");
                $('#modelHeading').html("Create New data");
                // $('#data-modal').modal('show');
            });

            /*------------------------------------------
            --------------------------------------------
            Click to Edit Button
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.editData', function() {
                var data_id = $(this).data('id');
                $.get("{{ url('/admin/categories') }}" + '/' + data_id, function(data) {
                    $('#modelHeading').html("Edit Data");
                    $('#saveBtn').val("edit-Data");
                    //   $('#ajaxModel').modal('show');
                    $('#data_id').val(data.data.id);
                    $('#title').val(data.data.title);
                    $('#icon').val(data.data.icon);
                })
            });


            /*------------------------------------------
            --------------------------------------------
            Create Data Code
            --------------------------------------------
            --------------------------------------------*/
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                console.log(table);
                $(this).html('Sending..');

                $.ajax({
                    data: $('#dataForm').serialize(),
                    url: "{{ url('/admin/categories') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#dataForm').trigger("reset");
                        const $targetEl = document.getElementById('data-modal');


                        const modal = new Modal($targetEl);
                        modal.hide();
                        table.draw();

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });



        });
    </script>
@endpush
