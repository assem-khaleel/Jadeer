<?php
/** @var $meeting Orm_Mm_Meeting */
/** @var $agenda Orm_Mm_Agenda */
/** @var $attendance Orm_Mm_Attendance */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("meeting_minutes/agenda_add_edit/{$meeting->get_id()}/{$agenda->get_id()}", array('id' => 'agenda-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo $agenda->get_id()? lang('Edit').' '.lang('Topic'): lang('Add').' '.lang('Topic'); ?></span>
        </div>
        <div class="modal-body">
            <?php if(Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_NOT_ADMIN) && Orm_Mm_Meeting::need_advisory()){

            }else{
                ?>
            <div class="form-group">
                <div class="row">
                    <label class="control-label col-sm-3" for="user_id"><?php echo lang('Owner Name'); ?></label>
                    <div class="col-sm-9">
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="0"><?php echo lang('Select Owner') ?></option>
                            <?php foreach($meeting->get_attendances() as $attendance):
                                if(!$attendance->get_user_id()){
                                    continue;
                                }
                                ?>
                            <option <?php echo $attendance->get_user_id() == $agenda->get_user_id()? 'selected = "selected"': '' ?> value="<?php echo intval($attendance->get_user_id()) ?>"><?php echo htmlfilter($attendance->get_user_id(true)->get_full_name()); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo Validator::get_html_error_message('user_id'); ?>
                    </div>
                </div>
            </div>
            <?php }?>
            <div class="form-group">
                <div class="row">
                    <label class="control-label col-sm-3" for="topic"><?php echo lang('Topic'); ?></label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="<?php echo lang('Insert Topic'); ?>" class="form-control" name="topic" id="topic" value="<?php echo htmlfilter($agenda->get_topic()) ?>" />
                        <?php echo Validator::get_html_error_message('topic'); ?>
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

    $('#agenda-form').on('submit', function (e) {
        e.preventDefault();

        var files = $(":file:enabled", this);

        var $ajaxProp = {
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        };

        if(files.length) {
            $ajaxProp['files']  = files;
            $ajaxProp['iframe'] =  true;
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