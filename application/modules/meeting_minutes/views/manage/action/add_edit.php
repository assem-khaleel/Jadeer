<?php
/** @var $meeting Orm_Mm_Meeting */
/** @var $action Orm_Mm_Action */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("meeting_minutes/action_add_edit/{$meeting->get_id()}/{$action->get_id()}", array('id' => 'action-form')); ?>
        <div class="modal-header">
            <span
                class="panel-title"><?php echo $action->get_id() ? lang('Edit') . ' ' . lang('Action') : lang('Add') . ' ' . lang('Action'); ?></span>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div class="row">
                    <label class="control-label col-sm-3" for="owner_name"><?php echo lang('Owner Name'); ?></label>
                    <div class="col-sm-9">

                        <input id="owner_label" type="text"
                               onclick="find_users(this,'owner_name','owner_label','',['Orm_User_Faculty','Orm_User_Staff'],'<?php echo lang('Find Users'); ?>')"
                               readonly class="form-control"
                               value="<?php echo($action->get_owner_name() ? htmlfilter(Orm_User::get_instance($action->get_owner_name())->get_full_name()) : ''); ?>"/>
                        <input id="owner_name" name="owner_name"
                               type="hidden" placeholder="<?php echo lang('Select Owner');?>"
                               value="<?php echo $action->get_owner_name(); ?>"/>
                        <?php echo Validator::get_html_error_message('owner_name'); ?>

                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="control-label col-sm-3" for="due"><?php echo lang('Due Date'); ?></label>
                    <div class="col-sm-9">
                        <input class="form-control date" name="due" id="due"
                               value="<?php echo htmlfilter($action->get_due()) ?>">
                        <?php echo Validator::get_html_error_message('due'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="control-label col-sm-3" for="action"><?php echo lang('Action'); ?></label>
                    <div class="col-sm-9">
                        <textarea placeholder="<?php echo lang('Enter Action'); ?>" class="form-control"
                                  name="action" id="action"><?php echo htmlfilter($action->get_action()) ?></textarea>
                        <?php echo Validator::get_html_error_message('action'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right "
                <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>


<script type="text/javascript">
    $(".date").datepicker({format: 'yyyy-mm-dd', autoclose: true});
    init_tinymce();
    function init_tinymce() {
        tinymce.remove("#action");
        tinymce.init({
            selector: "#action",
            plugins: "paste",
            paste_use_dialog: false,
            paste_auto_cleanup_on_paste: true,
            paste_convert_headers_to_strong: false,
            paste_strip_class_attributes: "all",
            paste_remove_spans: true,
            paste_remove_styles: true,
            paste_retain_style_properties: "",
            height: 200,
            theme: "modern",
            menubar: false,
            statusbar: false
        });
    }


    $('#action-form').on('submit', function (e) {
        e.preventDefault();

        var files = $(":file:enabled", this);

        var $ajaxProp = {
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        };

        if (files.length) {
            $ajaxProp['files'] = files;
            $ajaxProp['iframe'] = true;
        }

        $.ajax($ajaxProp).done(function (msg) {
            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>
