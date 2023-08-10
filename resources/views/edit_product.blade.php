     <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_product_edit" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">EDIT Product</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    @foreach(config('translatable.locales') as $locale)
                        <label>Product Name In {{$locale}} : </label>
                        <input type="text" value="{{$product->translate($locale)->name}}" data-validation="length" data-validation-length="min4"  data-validation="required" name="name:{{$locale}}"  class="form-control"  >
                        <br>
                    @endforeach
                        <label>Product Price :</label>
                        <input type="number" value="{{$product->price}}" data-validation="number" data-validation="required" name="price"  class="form-control" >
                        <br>
                        <input type="number" value="{{$product->id}}" style="display: none" name="id" id="id" class="form-control"  required>
                        <br>
                        <label>Current Product Image :</label>
                        <img  width="250" height="250" src="{{asset('').$product->image}}" >
                        <br>
                        <label>Change Product Price :</label>
                        <input type="file"  name="image"  class="form-control">
                        <br>


                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button id="btn_edit" type="submit" class="btn btn-info">Edit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>








