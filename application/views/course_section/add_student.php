<?php
/** @var Orm_Iaa_Group $group_obj */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <?php echo form_open("/course_section/add_student/{$section->get_id()}", 'id="boa-group-form"'); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">
                <?php echo htmlfilter($section->get_name()) ?> - <?php echo htmlfilter($course->get_name()) ?>
            </h4>
        </div>

        <div class="modal-body">

            <?php echo Orm_User_Student::draw_find_users('user_id'); ?>

        </div>

        <div class="modal-footer">

            <input type="hidden" name="course_id" value="<?php echo intval($course->get_id()); ?>">
            <button type="button" class="btn btn-sm pull-left"
                    data-dismiss="modal"><span
                        class="btn-label-icon left fa fa-times"></span><?php echo lang('Close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right"
                <?php echo data_loading_text() ?>><span
                        class="btn-label-icon  left fa fa-plus"></span><?php echo lang('Add'); ?></button>
        </div>
        <?php echo form_close() ?>

    </div>
</div>

<script type="text/javascript">
    $('#boa-group-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status == true) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>