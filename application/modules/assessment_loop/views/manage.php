<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 1/4/17
 * Time: 10:56 AM
 *
 * @var $assessment_loop Orm_Al_Assessment_Loop
 * @var string $type
 *
 */
$type = isset($type) ? $type : 'recommendation';
?>
<div class="row">
    <div class="col-lg-12">
        <div class="well well-sm">
            <?php echo $assessment_loop->draw() ?>
        </div>
    </div>
</div>
<ul class="nav nav-tabs nav-tabs-sm nav-justified m-b-1">
    <li <?php echo ($type == 'measure' ? 'class="active"' : ''); ?>>
        <a href="/assessment_loop/manage/measure/<?php echo (int) $assessment_loop->get_id();?>" title="<?php echo lang('Measure'); ?>">
            <?php echo lang('Measure'); ?>
        </a>
    </li>
    <li <?php echo ($type == 'result' ? 'class="active"' : ''); ?>>
        <a href="/assessment_loop/manage/result/<?php echo (int)$assessment_loop->get_id();?>" title="<?php echo lang('Result'); ?>">
            <?php echo lang('Result'); ?>
        </a>
    </li>
    <li <?php echo ($type == 'analysis' ? 'class="active"' : ''); ?>>
        <a href="/assessment_loop/manage/analysis/<?php echo (int)$assessment_loop->get_id();?>" title="<?php echo lang('Analysis'); ?>">
            <?php echo lang('Analysis'); ?>
        </a>
    </li>
    <li <?php echo ($type == 'recommendation' ? 'class="active"' : ''); ?>>
        <a href="/assessment_loop/manage/recommendation/<?php echo (int)$assessment_loop->get_id();?>" title="<?php echo lang('Recommendation'); ?>">
            <?php echo lang('Recommendation'); ?>
        </a>
    </li>
    <li <?php echo ($type == 'action' ? 'class="active"' : ''); ?>>
        <a href="/assessment_loop/manage/action/<?php echo (int)$assessment_loop->get_id();?>" title="<?php echo lang('Action'); ?>">
            <?php echo lang('Action'); ?>
        </a>
    </li>
</ul>
