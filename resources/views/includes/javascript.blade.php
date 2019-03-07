<?php
/**
 * Created by PhpStorm.
 * User: iankibet
 * Date: 2016/07/18
 * Time: 2:22 AM
 */
?>
<div class="bootstrap-iso">
<div class="modal fade" role="dialog" id="status_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Action Status<a data-dismiss="modal" class="pull-right btn-danger btn">&times;</a></div>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
<div style="font-size: large;" class="modal fade" role="dialog" id="info_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><a data-dismiss="modal" class="btn btn-danger pull-right"><i class="fa fa-remove"></i> </a> </div>

            <div class="modal-body" id="info_body">

            </div>

        </div>
    </div>
</div>
<div class="modal fade" role="dialog" id="delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" style="left:40%">
                    <button class="btn btn-danger pull-right" data-dismiss="modal">&times;</button>
                    <h4>Are you sure?</h4>
                </div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal ajax-post" id="delete_form" action="" method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <input type="hidden" name="delete_id">
                    <div class="form-group">
                        <label class="control-label col-md-5">&nbsp;</label>
                        <div class="col-md-5">
                            <button data-dismiss="modal" class="btn btn-success">NO</button>
                            <button type="submit" class="btn btn-danger">YES</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" role="dialog" id="run_action_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" style="left:40%">
                    <button class="btn btn-danger pull-right" data-dismiss="modal">&times;</button>
                    <h4>Are you sure?</h4>
                </div>
            </div>
            <div class="modal-body">
                <div class="alert alert-info plain_info" style="display: none;">
                    <i class="fa fa-info fa-2x"></i>
                    <span class="plain_info_pos"></span>
                </div>
                <form class="form-horizontal ajax-post" id="run_action_form" action="" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="action_element_id">
                    <div class="form-group">
                        <label class="control-label col-md-5">&nbsp;</label>
                        <div class="col-md-5">
                            <button data-dismiss="modal" class="btn btn-success">NO</button>
                            <button type="submit" class="btn btn-danger">YES</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
  $('a[href="' + window.location.hash + '"]').trigger('click');
  $('input[name="deadline"]').datetimepicker();
</script>
<script type="text/javascript">
    var csrf = '{{ csrf_token() }}';
    function showLoading(){
        $(".alert_status").remove();
        $('.modal-body').prepend('<div id="" class="alert alert-success alert_status"><img style="" class="loading_img" src="{{ URL::to("img/ajax-loader.gif") }}"></div>');
    }
    function endLoading(data){
        $(".alert_status").html('Success!');
        setTimeout(function(){
            $(".modal").modal('hide');
            $(".alert_status").slideUp();
        },800);
    }
    function endWithMinorErrors(errors){
        $(".loading_img").slideUp();
        $(".alert_status").removeClass('alert-success');
        $(".alert_status").addClass('alert-danger');
        if(typeof  errors =='object'){
            $(".alert_status").html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                    '<strong>An Error Occurred</strong> <br/>');
            $(".alert_status").append('<ul>');
            for(var i=0;i<errors.length;i++){
                $(".alert_status").append('<li>'+errors[i]+'</li>')
            }
            $(".alert_status").append('</ul>');
        }else{
            $(".alert_status").html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                    '<strong>An Error Occurred</strong> <br/>'+errors);
        }
        setTimeout(function(){
            $(".alert_status").fadeOut('slow');
        },2500);
    }
    function endWithError(xhr){
        $(".loading_img").hide();
        $(".alert_status").removeClass('alert-success');
        $(".alert_status").addClass('alert-danger');
        $(".alert_status").html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                '<strong>Error:'+xhr.status+'</strong> ' +
                ''+xhr.statusText+'');
        setTimeout(function(){
            $(".alert_status").fadeOut('slow');
        },1500);

    }

    $(".ajax-post").submit(function(){
        showLoading();
        $form = $(this);
        var url = $form.attr('action');
        var data = $form.serialize();
        var xhr = $.post(url,data,function(response){
            if(response.redirect){
                endLoading();
                setTimeout(function(){
                    window.location.href = response.redirect;
                },600);
                return false;
            }
            if(response.reload){
                endLoading();
                setTimeout(function(){
                    window.location.reload();
                },600);
                return false;
            }
            if(response.id){
                endLoading();
                runAfterSubmit(response);
            }else{
                endWithMinorErrors(response);
            }
        });
        xhr.fail(function(data){
            endWithError(data);
        });
        return false;
    });

    function autofillForm(data){
        for(key in data){
            var in_type = $('input[name="'+key+'"]').attr('type');
            if(in_type != 'file'){
                $('input[name="'+key+'"]').val(data[key]);
                $('textarea[name="'+key+'"]').val(data[key]);
                $('select[name="'+key+'"]').val(data[key]);
            }
        }
        $(".chosen-select").trigger("chosen:updated");
    }

    function deleteItem(url,id){
        var url = url+'/'+id;
        $("#delete_modal").modal('show');
        $("input[name='delete_id']").val(id);
        $("#delete_form").attr('action',url);
        return false;
    }

    function runPlainRequest(url,id,info){
        if(id != undefined){
            var url = url+'/'+id;
        }
        if(info != undefined){
            $(".plain_info_pos").html(info);
            $(".plain_info").slideDown();
        }
        $("#run_action_modal").modal('show');
        $("input[name='action_element_id']").val(id);
        $("#run_action_form").attr('action',url);
        return false;
    }

    function reloadCsrf(){
    }

    function getEditItem(url,id,modal){
        var url = url+'/'+id;
        $.get(url,null,function(response){
            autofillForm(response);
            $("#"+modal).modal('show');
        });
    }

    function resetForm(id){
        $("#"+id).find("input[type=text],textarea").val("");
        $("input[name='id']").val('');
//        tinyMCE.activeEditor.setContent('');
    }

    function autoFillSelect(name,url){
        $.get(url,null,function(response){
            for(var i =0;i<response.length;i++){
                $("select[name='"+name+"']").append('<option value="'+response[i].id+'">'+response[i].name+'</option>');
            }
            setTimeout(function(){
                $(".chosen-select").trigger("chosen:updated");
                $(".chosen-container").width('100%');
            },1000)
        });
    }
    $(document).ready(function() {
$(window).resize(function(){
    var width = $(window).width();
    //console.log(width);
    if(width>750){
        $(".gridular").hide();
        $(".tabular").show();
    }else{
        $(".tabular").hide();
        $(".gridular").show();
    }
});

    });
    
$(window).ready(function(){

    var width = $(window).width();
    //console.log(width);
    if(width>750){
        $(".gridular").hide();
        $(".tabular").show();
    }else{
        $(".tabular").hide();
        $(".gridular").show();
    }
});
    // pre-submit callback
    function showRequest(formData, jqForm, options) {
        $(".alert_status").remove();
        $('.file-form').prepend('<div id="" class="alert alert-success alert_status"><img style="" class="loading_img" src="{{ URL::to("img/ajax-loader.gif") }}"></div>');
    }
    function showInfo(info){
        $("#info_body").html('<p>'+info+'</p>');
        $("#info_modal").modal('show');
    }
</script>
