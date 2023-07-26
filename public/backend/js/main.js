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
    $(document).find('#deleteForm').attr('action',route);
}

function statusChange(route,title){
    $('#modalTitle').html(title);
    $(document).find('#statusChangeForm').attr('action', route);
  
}

function paymentRequest(route){
    $(document).find('#paymentRequestForm').attr('action', route);
}

function checkall(){
    var id=[];
    if ($("#multi_check").is(':checked')) {
        $(".single_check").each(function () {
            $(this).prop("checked", true);
        });    
        } else {
        $(".single_check").each(function () {
            $(this).prop("checked", false);
        });
        }
}
$(document).ready(function(){
    $(".single_check").click(function(){
        $("#multi_check").prop("checked", false);
            var i=0;
        $(".single_check").each(function () {
            if(!$(this).is(':checked')) {
                i=1;
            }
        });
        if(i == 0){
            $("#multi_check").prop("checked", true);
        }
    });
});
$('body').on('click','.apply_action',function(){
   
    var actionUrl = $(document).find('.actionUrl').val();
    var action_value = $('#id_label_single option:selected').val();
    var ids = [];
    $.each($("input[name='single_check']:checked"), function(){
        ids.push($(this).val());
    });
    
    if(action_value =='' || action_value==null || typeof action_value=="undefined")
    {
        toastr.error("Please select action", "Select Action", {
            positionClass: "toast-top-center",
            timeOut: 5e3,
            closeButton: !0,
            newestOnTop: !0,
            progressBar: !0
        })
    }else if($.isEmptyObject(ids)) {
        toastr.error("Please Checked At lest One item", "Select Checkbox", {
            positionClass: "toast-top-center",
            timeOut: 5e3,
            closeButton: !0,
            newestOnTop: !0,
            progressBar: !0
        })
    }else{
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: actionUrl,
            data: {action_value:action_value,ids:ids},
            beforeSend: function(){
                ajaxindicatorstart();
            },
            success: function (response) {
                ajaxindicatorstop();
                if(response.status==true){
                        window.location.href=response.url;
                }else{
                    toastr.error(response.msg, "", {
                        positionClass: "toast-top-center",
                        timeOut: 5e3,
                        closeButton: !0,
                        progressBar: !0
                        
                    })
                    $('#example4').load(' #example4');
                    $('#activeCount').html('<a href="javascript:void(0)" class="badge badge-rounded badge-info" id="activeCount">All ('+response.activeCount+')</a>');
                    $('#trashedCount').html('<a href="javascript:void(0)" class="badge badge-rounded badge-danger" id="trashedCount">Trashed ('+response.trashedCount+')</a>');
                    
                }
            }
        });
    }
});

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
            $(this).parents('div.timeline-panel').remove();
        });
    });
    $('#mark-all').click(function() {
        let request = sendMarkRequest();
        request.done(() => {
            $('div.timeline-panel').remove();
        })
    });
});


