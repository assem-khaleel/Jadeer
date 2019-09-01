<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 3/7/16
 * Time: 6:18 PM
 *
 * @var $general_info Orm_Fp_General_Information
 */

/** @var $evaluation_obj Orm_Fp_Evaluation */

$levels = Orm_Fp_Evaluation::get_levels();
?>
<div class="modal-dialog">
    <div class="modal-content">

        <?php echo form_open("/faculty_portfolio/evaluation/manage_score/{$user_id}/{$tab_id}/{$tab_row_id}/{$tab_col_id}", 'id="score-form"','class="form-horizontal"'); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">
                <?php echo lang('Score'); ?> : <?php echo htmlfilter(Orm_User_Faculty::get_instance($user_id)->get_full_name()) ?>
            </h4>
            <?php echo htmlfilter(Orm_Fp_Eva_Tabs::get_instance($tab_id)->get_title()) ?>: <?php echo htmlfilter(Orm_Fp_Eva_Tab_Row::get_instance($tab_row_id)->get_title()) ?><br>
            <?php echo lang('Skill') ?>: <?php echo htmlfilter(Orm_Fp_Eva_Tab_Col::get_instance($tab_col_id)->get_title()) ?>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <label class="control-label"><?php echo lang($title) ?></label>
                <input type="text" name="score" class="form-control" value="<?php echo floatval(isset($score) ? $score : 0); ?>" >
                <?php echo Validator::get_html_error_message('score'); ?>
            </div>

            <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
                <?php
                echo Orm_User::draw_find_users(
                    'peer_id',
                    intval(isset($peer_id) ? $peer_id : 0),
                    lang('Peer'),
                    [Orm_User_Faculty::class, Orm_User_Staff::class]
                );
                ?>

                <?php
                echo Orm_User::draw_find_users(
                    'supervisor_id',
                    intval(isset($supervisor_id) ? $supervisor_id : 0),
                    lang('Supervisor'),
                    [Orm_User_Faculty::class, Orm_User_Staff::class]
                );
                ?>
            <?php } ?>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?></button>
        </div>
        <?php echo form_close() ?>

    </div>
</div>

<script type="text/javascript">

    $('#score-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status == true) {
                $('#profile-evaluation-info').html(msg.html);
                $('#ajaxModal').modal('toggle');
                window.history.go(0);
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

</script>

