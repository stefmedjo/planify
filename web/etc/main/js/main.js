$(document).ready(function(){

    $('.datepicker').datepicker({
        autoclose: true,
        orientation: "bottom"
    });

    $('.delete').on('click', function(e){
        e.preventDefault()
        $('#delete-modal input[hidden]').attr("value",$(this).attr("item-id"))
        $('#delete-modal form').attr('action',$(this).attr('href'));
        $('#delete-modal').modal("show")
    })



    $('.not-checked').on('click', function(e){
        e.preventDefault()

        const _this = $(this)
        const loader = $('img',$(this).parent())

        _this.hide();
        loader.show();

        $.ajax({
            url:$(this).attr('todo-path'),
            type: "POST",
            dataType: "json",
            data: {
                "id": _this.attr('todo-id')
            },
            async: true,
            success: function (data)
            {
                loader.hide()
                _this.show()
                _this.attr("name","checkmark-done-circle")
                _this.removeClass("not-checked")
                _this.addClass("text-success")
            },
            error : function(data){
                loader.hide()
                _this.show()
                $('#request-modal p').html('An error occured during this request.')
                $('#request-modal').modal('show')
            }
        })

    })

})