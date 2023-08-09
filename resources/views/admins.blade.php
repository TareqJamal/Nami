<!DOCTYPE html>
<html>
<head>
    <title>Nami Task</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .error{
            color: #FF0000;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul>
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li>
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                </li>
            @endforeach
        </ul>

    </div>
</nav>
<div class="container mt-5">
    <h2 class="mb-4">{{trans('admins.Nami Task')}}</h2>
    <br>
    <button type="button" id="btn_Add" class="btn btn-primary">{{__('admins.Add Admin')}}</button>

    <br>
    <table id="myTable" class="table table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <div class="modal" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_Admin" data-action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_title">{{__('admins.Add Admin')}}</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="text" data-validation="length" data-validation-length="min4"  data-validation="required" name="name"  class="form-control" placeholder="{{__('admins.Admin Name')}}" >
                        <br>
                        <input type="email" data-validation="email" name="email"  class="form-control" placeholder="Admin Email">
                        <br>
                        <input type="number" data-validation="number" name="phone"  class="form-control" placeholder="Admin Phone">
                        <br>
                        <input type="password" name="password"  class="form-control" placeholder="Admin Password">
                        <br>
                        <input type="password" name="password_confirmation"  class="form-control" placeholder="Confirm Password">
                        <br>
                        <input type="file"  name="image"  class="form-control" placeholder="Admin Image">
                        <br>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button id="submit" type="submit" class="btn btn-info">ADD</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div class="modal" id="modal_edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_Admin_edit" data-action="{{route('admin.update')}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_title">EDIT ADMIN</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Admin Name" required>
                        <br>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Admin Email" required>
                        <br>
                        <input type="number" name="phone" id="phone" class="form-control" placeholder="Admin Phone" required>
                        <br>
                        <input type="number" style="display: none" name="id" id="id" class="form-control" placeholder="Admin Phone" required>
                        <br>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button id="submit_edit" type="submit" class="btn btn-info">Edit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('')}}Js/jquery.min.js"></script>
<script src="{{asset('')}}Js/form-validator/jquery.form-validator.min.js"></script>
<script type="text/javascript">
    /////////////////////////////  CODE FOR Datatable ///////////////////////////////////////////////////
    var myTable;
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(function () {
        myTable = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax:"{{ route('admins_data') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'image', name: 'image',
                    render: function( data, type, full, meta ) {
                        return "<img src=\"/" + data + "\" height=\"80\"/>";
                    }},
                {data: 'action', name: 'action',
                    orderable: false,
                    searchable: false},
            ]
        });
    });

    ///////////////////////////  CODE FOR show Model Form to Store Admin ///////////////////////////////////////////////////

    $("#btn_Add").on('click',function()
    {
        $("#modal").modal('show');
        $("#form_Admin").trigger('reset');

    });

    ///////////////////////////// AJAX CODE FOR Store Admin ///////////////////////////////////////////////////

    $(document).ready(function(){
        $('#form_Admin').on('submit', function(event){
            event.preventDefault();
            var url = $(this).attr('data-action');
            $.ajax({
                url: url,
                method: 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(response)
                {
                    myTable.ajax.reload();
                    $('#modal').modal('hide');
                },
                error: function(response) {
                }
            });
        });
    });

    ///////////////////////////// AJAX CODE FOR Delete Admin ///////////////////////////////////////////////////

    $('#myTable').on('click','#btn_delete',function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{ route('admin.delete')}}",
            type: 'Post',
            data: {_token: CSRF_TOKEN, id: id},
            success: function (response) {
                    alert("Record deleted");
                    myTable.ajax.reload();
            }
        });
    });

    ///////////////////////////// AJAX CODE FOR Edit Admin ///////////////////////////////////////////////////

    $('#myTable').on('click','#btn_edit',function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{ route('admin.edit')}}",
            type: 'Post',
            data: {_token: CSRF_TOKEN, id: id},
            success: function (response) {
                $('#modal_edit').html(response.html);
                $('#modal_edit').modal('show');
            }
        });
    });

    $(document).ready(function(){
        $('#form_Admin_edit').on('submit_edit', function(event){
            event.preventDefault();
            var url = $(this).attr('data-action');
            $.ajax({
                url: url,
                method: 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(response)
                {
                    $('#model').trigger("reset");
                    $('#modal').modal('hide');
                    myTable.ajax.reload();

                },
                error: function(response) {
                }
            });
        });
    });

</script>
<script>
    // Add validator
    $.formUtils.addValidator({
        name : 'name',
        validatorFunction : function(value, $el, config, language, $form) {
           return value.length < 4;
        },
        errorMessage : 'You have to write name',
        errorMessageKey: 'name'
    });

    // Initiate form validation
    $.validate({
        modules : 'date, security'
    });
</script>
</html>
