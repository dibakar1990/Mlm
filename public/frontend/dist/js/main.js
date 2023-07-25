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


