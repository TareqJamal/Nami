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
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('admins')}}">Admins <span class="sr-only">(current)</span></a>
            </li>
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li>
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                </li>
            @endforeach

            <li class="nav-item">
                <a class="nav-link active" href="{{route('products')}}">Products</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<div class="container mt-5">
    <h2 class="mb-4">{{__('products.add new product')}}</h2>
    <br>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal">
        {{__('products.add new product')}}
    </button>
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                </div>
                <div class="modal-body">
                    <form id="form_product" data-action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal_title">{{__('products.add new product')}}</h4>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            @foreach(config('translatable.locales') as $locale)
                                <input type="text" data-validation="length" data-validation-length="min4"  data-validation="required" name="name:{{$locale}}"  class="form-control" placeholder="{{__('products.product name')}}.{{$locale}} " >
                                <br>
                            @endforeach
                            <input type="number" data-validation="number" data-validation="required" name="price"  class="form-control" placeholder="{{__('products.product price')}}">
                            <br>
                            <input type="file"  name="image"  class="form-control" placeholder="{{__('product.product image')}}">
                            <br>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button id="submit" type="submit" class="btn btn-info">{{__('products.add product')}}</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('products.close')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <br>
    <table id="Table_product" class="table table-bordered">
        <thead>
        <tr>
            <th>Product No</th>
            <th>Product Name</th>
            <th>ProductPrice</th>
            <th>Produce Image</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <div class="modal" id="modal-product-edit">

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
        myTable = $('#Table_product').DataTable({
            processing: true,
            serverSide: true,
            ajax:"{{ route('products_data') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name',name:'name'},
                {data: 'price', name: 'price'},
                {data: 'image', name: 'image'},
                {data: 'action', name: 'action',
                    orderable: false,
                    searchable: false},
            ]
        });
    });
    ///////////////////////////  CODE FOR show Model Form to Store Admin ///////////////////////////////////////////////////
    $("#btn_Add").on('click',function()
    {
        $("#modal-product").modal('show');
        $("#form_product").trigger('reset');

    });
    ///////////////////////////// AJAX CODE FOR Store Admin ///////////////////////////////////////////////////
    $(document).ready(function ()
    {
        $('#form_product').on('submit',function (e)
        {
            var url = $(this).attr('data-action');
            e.preventDefault();
            $.ajax({
                url : url,
                method : "POST",
                data : new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(responce)
                {
                    $('#Modal').modal('hide');
                    myTable.ajax.reload();

                },
                error: function(response) {
                    console.log(response);
                }
            })


        })

    });

    ///////////////////////////// AJAX CODE FOR Delete Admin ///////////////////////////////////////////////////
    $('#Table_product').on('click','#btn_delete',function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{ route('product.delete')}}",
            type: 'Post',
            data: {_token: CSRF_TOKEN, id: id},
            success: function (response) {
                alert(response.message);
                myTable.ajax.reload();
            }
        });
    });

    $('#Table_product').on('click','#btn_edit',function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{ route('product.edit')}}",
            type: 'Post',
            data: {_token: CSRF_TOKEN, id: id},
            success: function (response) {
                $('#modal-product-edit').html(response.html);
                $('#modal-product-edit').modal('show');
            }
        });
    });

    $(document).ready(function(){
        $('#form_product_edit').on('btn_edit', function(event){
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
                    console.log(response.message);
                    $('#modal-product').trigger("reset");
                    $('#modal-product').modal('hide');
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
