<?php
/**
 * Created by PhpStorm.
 * User: appleuser
 * Date: 9/21/15
 * Time: 9:50 AM
 */
/** @var Orm_Sp_Goal $goal */
/** @var Orm_Sp_Strategy $strategy */
/** @var int $strategy_id */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            if (!($goal->get_id())) {
                echo lang('Create').' '.lang('Goal');
            } else {
                echo lang('Edit').' '.lang('Goal');
            }
            ?>
        </div>

        <?php echo form_open("/strategic_planning/goal/add_edit?strategy_id={$strategy->get_id()}",'id="mission-form" class="form-horizontal"') ?>
            <div class="modal-body">

                <?php if($strategy->get_parent_id()) { ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="parent_id"><?php echo lang('Parent Goal'); ?></label>

                        <div class="col-sm-10">
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value=""><?php echo lang('Select One'); ?></option>
                                <?php foreach (Orm_Sp_Goal::get_all(array('strategy_id' => $strategy->get_parent_id())) as $key => $parent_goal) : ?>
                                    <?php $selected = ($parent_goal->get_id() == $goal->get_parent_id() ? 'selected="selected"' : '') ?>
                                    <option
                                        value="<?php echo (int)$parent_goal->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($parent_goal->get_code()) . ". " . htmlfilter(substr($parent_goal->get_title(), 0, 100) . (strlen($parent_goal->get_title()) > 100 ? '...' : '')); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php echo Validator::get_html_error_message('parent_id'); ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="form-group">
                    <label for="goal_title" class="col-sm-2 control-label"><?php echo lang('Code'); ?>: *</label>

                    <div class="col-sm-10">
                        <input type="text" name="code" class="form-control"
                               value="<?php echo htmlfilter($goal->get_code()); ?>" id="goal_code"/>
                        <?php echo Validator::get_html_error_message('code'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="goal_title" class="col-sm-2 control-label"><?php echo lang('Title'); ?>
                        (<?php echo lang('English'); ?>): *</label>

                    <div class="col-sm-10">
                        <input type="text" name="title_en" class="form-control"
                               value="<?php echo htmlfilter($goal->get_title_en()); ?>" id="goal_title"/>
                        <?php echo Validator::get_html_error_message('title_en'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="goal_title" class="col-sm-2 control-label"><?php echo lang('Title'); ?>
                        (<?php echo lang('Arabic'); ?>): *</label>

                    <div class="col-sm-10">
                        <input type="text" name="title_ar" class="form-control"
                               value="<?php echo htmlfilter($goal->get_title_ar()); ?>" id="goal_title"/>
                        <?php echo Validator::get_html_error_message('title_ar'); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="<?php echo urlencode($goal->get_id()); ?>">
                <button type="button" class="btn btn-sm pull-left "
                        data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
            </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
      init_data_toggle();
    $('form#mission-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: '/strategic_planning/goal/save?strategy_id=<?php echo urlencode($strategy->get_id()); ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.error == false) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>