var myTable;
$(function () {
    myTable = $('#myTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admins_data') }}",
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
