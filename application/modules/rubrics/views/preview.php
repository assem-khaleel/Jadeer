<?php
/** @var Orm_Rb_Rubrics $rubric */
?>


<div class="col-md-3 col-lg-3">
    <div class="well">
        <div class="form-group">
            <label class="control-label" for="name_ar"> <?php echo lang('Name'); ?> (<?php echo lang('Arabic'); ?>
                )</label>
            <label  style="height: auto !important;"  class="form-control"><?php echo htmlfilter($rubric->get_name_ar()); ?>
            </label>
        </div>

        <div class="form-group">
            <label class="control-label" for="name_en"> <?php echo lang('Name'); ?> (<?php echo lang('English'); ?>
                )</label>
            <label  style="height: auto !important;"  class="form-control"><?php echo htmlfilter($rubric->get_name_en()); ?></label>
        </div>
        <div class="form-group">
            <label class="control-label" for="desc_en"> <?php echo lang('Description'); ?>
                (<?php echo lang('Arabic'); ?>)</label>
            <label  style="height: auto !important;"  class="form-control"><?php echo htmlfilter($rubric->get_desc_ar()); ?></label>
        </div>
        <div class="form-group">
            <label class="control-label" for="desc_ar"> <?php echo lang('Description'); ?>
                (<?php echo lang('English'); ?>)</label>
            <label  style="height: auto !important;"  class="form-control"><?php echo htmlfilter($rubric->get_desc_en()); ?></label>
        </div>
        <div class="form-group">
            <label class="control-label" for="desc_ar"> <?php echo lang('Classification'); ?> </label>
            <label  style="height: auto !important;"  class="form-control"><?php echo lang($rubric->get_rubric_class()); ?></label>
        </div>
        <?php echo $rubric->draw(); ?>

    </div>
</div>
<div class="col-md-9 col-lg-9">
    <div class="table-primary">

        <div class="table-header">
            <div class="row form-group">
                <div class="table-caption m-b-1">
                    <?php echo lang('Rubrics') ?>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th><?php echo lang('Skills'); ?>/<?php echo lang('Scales'); ?></th>
                    <?php

                    foreach ($rubric->get_scales() as $key => $scale) {
                        echo '<th>' . Orm_Rb_Settings::get_value(UI_LANG == 'arabic' ? 'scale_text_ar' : 'scale_text_en') . ' ' . ($key + 1) . '</th>';
                    }
                    ?>
                </tr>
                </thead>
                <tbody>
                <?php

                foreach ($rubric->get_skills() as $skill):?>
                    <tr>
                        <td>
                            <label>
                                <?php
                                echo $rubric->get_weight_type() == Orm_Rb_Rubrics::WEIGHT_TYPE_PERCENTAGE ? '<span class="lbl">%</span>' : '';
                                echo $skill->get_value();
                                ?></label><br/>
                            <label><?php echo $skill->get_name() ?></label>
                        </td>

                        <?php foreach ($rubric->get_table($skill->get_id()) as $row): ?>
                            <td>
                                <pre class="form-control"><?php echo $row->get_description() ?></pre>
                                <br/>
                                <label class="form-control"><?php echo $row->get_target() ?></label>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>


    </div>



</div>

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
                    <?php echo htmlfilter($scale->get_name()) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>