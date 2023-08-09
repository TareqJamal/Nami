     <div>
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_Admin_edit" action="{{route('admin.update')}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_title">EDIT ADMIN</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="text" value="{{$admin->name}}" name="name" id="name" class="form-control" placeholder="Admin Name" required>
                        <br>
                        <input type="email" value="{{$admin->email}}" name="email" id="email" class="form-control" placeholder="Admin Email" required>
                        <br>
                        <input type="number" value="{{$admin->phone}}" name="phone" id="phone" class="form-control" placeholder="Admin Phone" required>
                        <br>
                        <input type="number" value="{{$admin->id}}" style="display: none" name="id" id="id" class="form-control"  required>
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







