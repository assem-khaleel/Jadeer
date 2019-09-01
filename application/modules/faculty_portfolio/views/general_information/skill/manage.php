<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 3/8/16
 * Time: 12:06 PM
 */

/**
 * @var $skill Orm_Fp_Skill
 */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/faculty_portfolio/skill_manage" , array('id' => 'skill-form','class' => 'form-horizontal')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Skills'); ?></span>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered" id="more_skill">
                <tr class="item">
                    <td class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Skill')?></label>
                            <div class="col-md-9">
                                <input type="text" name="skill" value="<?php echo htmlfilter($skill->get_name()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('skill'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Rank')?></label>
                            <div class="col-md-9">
                                <select name="rank" class="form-control" >
                                    <option value=""><?php echo lang('Rank')?>...</option>
                                    <?php foreach(Orm_Fp_Skill::$skill_ranks as $skill_key => $skill_rank) { ?>
                                        <?php $selected = ($skill_key == $skill->get_rank() ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $skill_key; ?>" <?php echo $selected; ?>><?php echo lang($skill_rank); ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo Validator::get_html_error_message('rank'); ?>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo intval($skill->get_id()); ?>" >
                    </td>
                </tr>
            </table>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">

    $('#skill-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status == 1) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>