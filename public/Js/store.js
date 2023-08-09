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
