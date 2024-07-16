@extends('layouts.app')
@push('title')
{{ isset($settings['app_name']) ? $settings['app_name'] : '' . ' ' . $title[0] }}
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
                                    class="ml-1 text-gray-700 hover:text-primary md:ml-2 dark:text-gray-300 dark:hover:text-white">{{ $title[0]}}</a>
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
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ $title[0]}} List</h1>
            </div>
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                    viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="simple-search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Search" required="">
                        </div>
                    </form>
                </div>
                <div
                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button type="button" id="createData" data-modal-target="data-modal" data-modal-toggle="data-modal"
                        class="flex items-center justify-center text-white bg-primary-700  hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Add {{$title[0]}}
                    </button>
                    <!-- Rest of the buttons and dropdowns -->
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                
                <div class="overflow-hidden shadow">
                    {{-- <table id="dataTable" class="display">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Icon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table> --}}

                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto">
        <table id="dataTable" class="display dark:text-white" style="width:100%">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Your table rows here -->
            </tbody>
        </table>
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
             <form id="dataForm">
                 <input type="hidden" name="data_id" id="data_id">
                 <!-- Modal body -->
                 <div class="p-6 space-y-6">
                     <div class="grid grid-cols-6 gap-6">
                         <div class="col-span-6">
                             <label for="title"
                                 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                             <input type="text" name="title" id="title"
                                 class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                 placeholder="Enter Title" required>
                         </div>
                         <div class="col-span-6">
                             <label for="body"
                                 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content</label>
                             <textarea type="text" name="body" id="body"
                                 class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                 placeholder="Enter body" required></textarea>
                         </div>

                 
                         </div>


                         <button id="saveBtn" value="create"
                             class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                             type="submit">Save Changes</button>
                     </div>
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
        var $preview = $(this).closest('.relative').find('.preview'); // Find the corresponding preview image
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $preview.attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        } else {
            // If no file is selected, revert to default image
            $preview.attr('src', '{{asset('/images/no-image.png')}}');
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
                ajax: "{{ url('/admin/pages') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'title',
                        name: 'title'
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
            });

            /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
            $('body').on('click', '.editData', function() {
                var data_id = $(this).data('id');
                $.get("{{ url('/admin/pages') }}" + '/' + data_id, function(data) {
                    $('#modelHeading').html("Edit Data");
                    $('#saveBtn').val("edit-Data");
                    //   $('#data-modal').show();
                      window
    .FlowbiteInstances
    .getInstance('Modal', 'data-modal')
    ?.show();
                    $('#data_id').val(data.data.id);
                    $('#title').val(data.data.title);
                    $('#body').val(data.data.body);
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
                    url: "{{ url('/admin/pages') }}",
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
