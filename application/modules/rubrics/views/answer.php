<?php
/** @var Orm_Rb_Rubrics $rubric */
?>

<style>
    pre.form-control {
        background: none;
        color: #fff;
        height: auto;
    }

</style>

<?php echo form_open('/rubrics/assigned/answer/' . $rubric->get_id(), ['method' => 'post', 'id' => 'answer_form']); ?>
<div class="col-md-3 col-lg-3">
    <div class="well">
        <div class="form-group">
            <label class="control-label" for="name_ar"> <?php echo lang('Name'); ?> (<?php echo lang('Arabic'); ?>
                )</label>
            <label  style="height: auto !important;" class="form-control"><?php echo htmlfilter($rubric->get_name_ar()); ?>
            </label>
        </div>

        <div class="form-group">
            <label class="control-label" for="name_en"> <?php echo lang('Name'); ?> (<?php echo lang('English'); ?>
                )</label>
            <label  style="height: auto !important;" class="form-control"><?php echo htmlfilter($rubric->get_name_en()); ?></label>
        </div>
        <div class="form-group">
            <label class="control-label" for="desc_en"> <?php echo lang('Description'); ?>
                (<?php echo lang('Arabic'); ?>)</label>
            <label  style="height: auto !important;" class="form-control"><?php echo htmlfilter($rubric->get_desc_ar()); ?></label>
        </div>
        <div class="form-group">
            <label class="control-label" for="desc_ar"> <?php echo lang('Description'); ?>
                (<?php echo lang('English'); ?>)</label>
            <label  style="height: auto !important;" class="form-control"><?php echo htmlfilter($rubric->get_desc_en()); ?></label>
        </div>
        <div class="form-group">
            <label class="control-label" for="desc_ar"> <?php echo lang('Classification'); ?> </label>
            <label  style="height: auto !important;" class="form-control"><?php echo lang($rubric->get_rubric_class()); ?></label>
        </div>
        <?php echo $rubric->answer_draw(); ?>

    </div>
</div>
<div class="col-md-9 col-lg-9">
    <div class="table-primary">
        <div class="table-header">
            <div class="row form-group">
                <div class="table-caption">
                    <?php
                    echo lang('Rubrics');

                    if ($rubric->get_rubric_class() == Orm_Rb_Rubrics_Course::class) {
                        echo ': ';

                        $user_id = intval($this->input->get_post('user_id'));
                        if ($user_id > 0) {
                            echo Orm_user::get_instance($user_id)->get_full_name();
                        }
                    }

                    ?>

                </div>
            </div>

        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <td><?php echo lang('Skills'); ?>/<?php echo lang('Scales'); ?></td>
                <?php

                foreach ($rubric->get_scales() as $key => $scale) {
                    echo '<th>' . Orm_Rb_Settings::get_value(UI_LANG == 'arabic' ? 'scale_text_ar' : 'scale_text_en') . ' ' . ($key + 1) . '</th>';
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($rubric->get_skills() as $skill): ?>
                <tr>
                    <td>
                        <label>
                            <?php
                            echo $rubric->get_weight_type() == Orm_Rb_Rubrics::WEIGHT_TYPE_PERCENTAGE ? '<span class="lbl">%</span>' : '';
                            echo $skill->get_value();
                            ?></label><br/>
                        <label>
                            <div class="form-group label-danger">
                                <pre class="form-control" style=" word-break: break-word"><?php echo htmlfilter($skill->get_name()) ?></pre>
                                <?php echo Validator::get_html_error_message('skill_' . $skill->get_id()); ?>
                            </div>
                        </label>
                    </td>

                    <?php foreach ($rubric->get_table($skill->get_id()) as $row): ?>
                        <td>
                            <div class="radio ">
                                <label>
                                    <input type="radio"
                                           class="px " <?php if (isset($answers[$skill->get_id()]) && $answers[$skill->get_id()] == $row->get_scale_id()) {
                                        echo 'checked="checked"';
                                    } ?> value="<?php echo $row->get_scale_id() ?>"
                                           name="answer[<?php echo $skill->get_id() ?>]">
                                    <br/>
                                    <pre class="form-control label-danger" style=" word-break: break-word"><?php echo $row->get_description() ?></pre>
                                </label>
                            </div>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="controls-row pull-right">
            <button class="btn btn-sm btn-success" type="submit"><?php echo lang('save') ?></button>
        </div>
    </div>
</div>
<?php echo form_close(); ?>

<div class="col-md-offset-3 col-md-9">
    <table class="table m-t-4">
        <colgroup>
            <col class="col-md-2"/>
            <col class="col-md-10"/>
        </colgroup>
        <thead>
        <tr>
            <td><?php echo lang('Legend') ?></td>
            <td><?php echo lang('Description') ?></td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rubric->get_scales() as $key => $scale): ?>
            <tr>
                <td>
                    <?php echo Orm_Rb_Settings::get_value(UI_LANG == 'arabic' ? 'scale_text_ar' : 'scale_text_en') . ' ' . ($key + 1) ?>
                </td>
                <td>
                    <?php echo $scale->get_name() ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>