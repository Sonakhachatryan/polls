
$(document).find('.employees .delete').on('click', function(){
    var id = $(this).data('id');
    var _this = $(this);
    var ids = [];
    ids.push(id);

    $.ajax({
        url: '/delete',
        type: 'get',
        data: {
            ids: ids
        },
        success: function(data){

            _this.closest('tr').remove();

            if($('.employees tbody').find('tr').length == 0){
                $('.employees').find('tbody').append('<tr>'+
                        '<td colspan="11" class="text-center">There are not any employees</td>'+
                    '</tr>')
            }
        }
    })
});

$('#deleteModal').find('.delete_all').on('click', function(){
    var items = $(document).find('.employees input[type="checkbox"]:checked');

    var ids = [];
    $.each(items, function(index, value){

        ids.push($(value).val());
    })

    $.ajax({
        url: '/delete',
        type: 'get',
        data: {
            ids: ids
        },
        success: function(data){

            _this.closest('tr').remove();

            if($('.employees tbody').find('tr').length == 0){
                $('.employees').find('tbody').append('<tr>'+
                    '<td colspan="11" class="text-center">There are not any employees</td>'+
                    '</tr>')
            }
        }
    })

});

