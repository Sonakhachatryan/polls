
    var phone_next = 1;
    $(document).on('click', '.phoneNumbers .add-more', function(e){

        e.preventDefault();
        var addto = "#phone" + phone_next;
        var addRemove = "#phone" + (phone_next);
        phone_next = phone_next + 1;
        var newIn = '<div class="input-group" id="phone' + phone_next + '">'+
                '<input type="text" name="phone[]" class="form-control"  placeholder="Phone Number">'+
                '<div class="add-more input-group-addon">+</div>'+
            '</div>';
        var newInput = $(newIn);
        var removeBtn = '<div id="remove' + (phone_next - 1) + '" class="remove-me input-group-addon">-</div>';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).find('input').after(removeButton);
        $(addRemove).find('.add-more').remove();
        $("#phone" + phone_next).find('input').attr('data-source',$(addto).attr('data-source'));
        $("#count").val(phone_next);

        $('.remove-me').click(function(e){
            e.preventDefault();
            var fieldNum = this.id.charAt(this.id.length-1);
            var fieldID = "#phone" + fieldNum;
            $(this).remove();
            $(fieldID).remove();
        });
    });



    var address_next = 1;
    $(document).on('click', '.addresses .add-more', function(e){

        e.preventDefault();
        var addto = "#address" + address_next;
        var addRemove = "#address" + (address_next);
        address_next = address_next + 1;
        var newIn = '<div class="input-group" id="address' + address_next + '">'+
                '<input type="text" name="address[]" class="form-control"  placeholder="Address">'+
                '<div class="add-more input-group-addon">+</div>'+
            '</div>';
        var newInput = $(newIn);
        var removeBtn = '<div id="remove' + (address_next - 1) + '" class="remove-me input-group-addon">-</div>';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).find('input').after(removeButton);
        $(addRemove).find('.add-more').remove();
        $("#address" + address_next).find('input').attr('data-source',$(addto).attr('data-source'));
        $("#count").val(address_next);

        $('.remove-me').click(function(e){
            e.preventDefault();
            var fieldNum = this.id.charAt(this.id.length-1);
            var fieldID = "#address" + fieldNum;
            $(this).remove();
            $(fieldID).remove();
        });
    });





$(document).find('.employees input[type="checkbox"]').on('click', function(){
    if($(document).find('.employees input[type="checkbox"]:checked').length>0){
        $('.delete_all').removeClass('disabled');
    }
    else{
        $('.delete_all').addClass('disabled');
    }
});
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
    });

    $.ajax({
        url: '/delete',
        type: 'get',
        data: {
            ids: ids
        },
        success: function(data){
            $('#deleteModal').modal('hide');

            $.each(ids, function(index, value){

                $('.employees tbody').find('input[value="'+value+'"]').closest('tr').remove();

                if($('.employees tbody').find('tr').length == 0){
                    $('.employees').find('tbody').append('<tr>'+
                        '<td colspan="11" class="text-center">There are not any employees</td>'+
                        '</tr>')
                }
            });

            $('.delete_all').addClass('disabled');
        }
    })

});

