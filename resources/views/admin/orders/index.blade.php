@extends('admin.master')
@push('custom-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"> --}}
@endpush
@section('content')
    <div class="content-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Order List</h2>

                        {{-- <div class="form-group float-right" style="width: 8rem">
                            <select class="form-control form-control-sm" name="" id="">
                              <option selected disabled>  Action</option>
                              <option>export to excel</option>
                              <option>Confirm</option>
                              <option>Delivary</option>
                              <option id="deleteSelectedItems">Delete Selected Items</option>
                            </select>
                          </div> --}}

                        <div class="dropdown float-right">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-expanded="false">
                                Multiple record
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0)" id="exportSelected">export to excel</a>
                                <a class="dropdown-item" href="javascript:void(0)">Confirm</a>
                                <a class="dropdown-item" href="javascript:void(0)">Delivary</a>
                                <a class="dropdown-item" href="javascript:void(0)" id="deleteSelectedItems">Delete</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive ">
                            <table class="table center-aligned-table " width="100%" id="myTable">
                                <thead>

                                    <tr>

                                        <th><input type="checkbox" id="selectAll" /></th>
                                        <th>Invoice No.</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Amount</th>
                                        <th>Product Title</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="orderTableBody">
                                    @foreach ($index as $key => $item)
                                        @include('admin.pertial.order_rows', ['item' => $item])
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>


                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('custom-scripts')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#myTable').DataTable({
                order: [
                    [0, 'desc']
                ],
            });
            $('body').on('click', '#confirmBtn', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                var trObj = $(this).closest('tr');

                // Make an Ajax request
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(data) {
                        // Handle success response here
                        $.toast({
                            heading: 'Success',
                            text: 'Order is confirm successfully!',
                            position: ('top-right'),
                            showHideTransition: 'slide',
                            icon: 'success',
                            loaderBg: '#d9534f'
                        });
                        trObj.html($(data.html).html());
                    },
                    error: function(error) {
                        // Handle error response here
                        console.error(error);
                    }
                });
            });
            $('body').on('click', '#delivaryBtn', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                var trObj = $(this).closest('tr');

                // Make an Ajax request
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(data) {
                        // Handle success response here
                        $.toast({
                            heading: 'Success',
                            text: 'Order is Delivered!',
                            position: ('top-right'),
                            showHideTransition: 'slide',
                            icon: 'success',
                            loaderBg: '#d9534f'
                        });
                        trObj.html($(data.html).html());
                    },
                    error: function(error) {
                        // Handle error response here
                        console.error(error);
                    }
                });
            });


            $('#selectAll').click(function(e) {
                var table = $(e.target).closest('table');
                $('td input:checkbox', table).prop('checked', this.checked);
            });



            // multiple delete data
            $('#exportSelected').on('click', function() {
                var selectedItems = $('.itemCheckbox:checked').map(function() {
                    return $(this).data('item-id');
                }).get();

                if (selectedItems.length === 0) {
                    alert('Please select at least one item.');
                    return;
                }

                $.ajax({
                    url: '{{ route('order.exportSelected') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        selected_ids: selectedItems
                    },
                    cache: false,
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(response) {
                        const d = new Date();
                        const year = d.getFullYear();
                        const month = d.getMonth();
                        const date = d.getDate();
                        const name = date + '-' + month + '-' + year + '_Order_report.xlsx';
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(response);
                        link.download = name;
                        link.click();
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error('Export failed:', error);
                    }
                });
            });
            // multiple delete data
            $('#deleteSelectedItems').on('click', function() {
                var selectedItems = $('.itemCheckbox:checked').map(function() {
                    return $(this).data('item-id');
                }).get();

                if (selectedItems.length === 0) {
                    alert('Please select at least one item.');
                    return;
                }

                $.ajax({
                    url: '{{ route('multiple.order.delete') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        selected_ids: selectedItems
                    },
                    success: function(data) {
                        // Handle success (e.g., show a success message)
                        alert(data.message);
                        location.reload(); // Reload the page or update the UI as needed
                    },
                    error: function(xhr, status, error) {
                        // Handle error (e.g., show an error message)
                        console.error(error);
                    }
                });
            });

        });
        // document.addEventListener('DOMContentLoaded', function () {
        //     const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
        //     const form = document.querySelector('#orderform');

        //     checkboxes.forEach(checkbox => {
        //         checkbox.addEventListener('change', function () {
        //             form.submit();
        //         });
        //     });
        // });
    </script>
@endpush
