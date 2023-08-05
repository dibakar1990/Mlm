$(document).ready(function () {
    setTimeout(function () {
        $("#notify").remove();
    }, 5000);
    $('.openPopup').on('click',function(){
        var dataURL = $(this).attr('data-action-url');
        var title = $(this).attr('data-title');
        $('#AjaxModalBody').load(dataURL,function(){
            $('#ajaxModal').modal({show:true});
            $('#modalTitle').html(title);
        });
    }); 
});
function deleteConfirm(route){
    $(document).find('#deleteChangeForm').attr('action',route);
}

function sendMarkRequest(id = null) {
    var markasreadUrl = $(document).find('.markasreadUrl').val();
    return $.ajax(markasreadUrl, {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        
        data: {
            id
        }
    });
}
$(function() {
    $('.mark-as-read').click(function() {
        let request = sendMarkRequest($(this).data('id'));
        request.done(() => {
            $(this).parents('div.remove').remove();
            
        });
    });
    $('#mark-all').click(function() {
        let request = sendMarkRequest();
        request.done(() => {
            $('div.remove').remove();
            
        })
    });
});


