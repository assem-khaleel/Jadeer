<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 30/07/18
 * Time: 11:52 ص
 */
$assessment_loops = $data['assessment_loops'];
$item_id = $data['item_id'];
/* @var Orm_Al_Assessment_Loop[] $assessment_loops */
?>

<?php if (!empty($assessment_loops)) { ?>
    <h2 class="text-center m-t-1"><?php echo lang('Assessment Loops for') . ' : ' . ' ' . htmlfilter(Orm_Program::get_instance($item_id)->get_name()); ?></h2>
    <?php foreach ($assessment_loops as $assessment_loop): ?>
        <div class="well clearfix">
            <h3 class="m-t-1">
                <?php echo htmlfilter($assessment_loop->get_item_title()) ?>
            </h3>

            <?php if (Orm_Al_Measure::get_count(['assessment_loop_id' => $assessment_loop->get_id()]) != 0) { ?>
                <div class="panel box">
                    <div class="box-row">
                        <div class="box-container">
                            <div class="box-cell p-a-3 valign-middle bg-primary">
                                <div class="font-size-20 text-center">   <?php echo lang('Measure') ?></div>
                            </div>
                        </div> <!-- / .box-container -->
                    </div>
                    <div class="box-row">
                        <div class="box-container">
                            <?php foreach (Orm_Al_Measure::get_all(['assessment_loop_id' => $assessment_loop->get_id()]) as $measure) : ?>
                                <div class="box-row valign-middle">
                                    <div class="box-cell p-y-1 b-r-1">
                                        <div class="font-size-17"><strong> <?php echo xssfilter($measure->get_text()) ?></strong></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div> <!-- / .box-container -->
                    </div>
                </div>
            <?php } ?>

            <?php if (Orm_Al_Result::get_count(['assessment_loop_id' => $assessment_loop->get_id()]) != 0) { ?>
                <div class="panel box">
                    <div class="box-row">
                        <div class="box-cell bg-primary font-size-24">
                            <?php echo lang('Result') ?>
                        </div>
                    </div>
                    <?php foreach (Orm_Al_Result::get_all(['assessment_loop_id' => $assessment_loop->get_id()]) as $result): ?>
                        <div class="box-row">
                            <div class="box-cell p-y-2 text-xs-center font-size-20">
                                <?php echo xssfilter($result->get_text()) ?>
                            </div>
                        </div>
                    <hr>
                    <?php endforeach; ?>
                </div>
            <?php } ?>

            <?php if (Orm_Al_Analysis::get_count(['assessment_loop_id' => $assessment_loop->get_id()]) != 0) { ?>
                <div class="panel box">
                    <div class="box-row">
                        <div class="box-cell text-xs-center bg-primary font-size-24">
                            <?php echo lang('Analysis') ?>
                        </div>
                    </div>
                        <div class="box-row">
                            <div class="box-cell p-y-2 font-size-20">
                                <?php echo xssfilter(Orm_Al_Analysis::get_one(['assessment_loop_id' => $assessment_loop->get_id()])->get_text())?>
                            </div>
                        </div>
                </div>
            <?php } ?>

            <?php if (Orm_Al_Recommendation::get_count(['assessment_loop_id' => $assessment_loop->get_id()]) != 0) { ?>
                <div class="box">
                    <div class="box-row">
                        <div class="box-cell p-x-3 p-y-1 bg-primary">
                            <div class="text-center font-weight-semibold font-size-24"><?php echo lang('Recommendation')?></div>
                        </div>
                    </div>
                    <?php foreach (Orm_Al_Recommendation::get_all(['assessment_loop_id' => $assessment_loop->get_id()]) as $recommendation): ?>
                        <div class="box-row">
                            <div class="box-cell p-x-3 p-y-2 bg-primary darken">
                                <div class="font-weight-semibold font-size-20 line-height-1"><?php echo xssfilter($recommendation->get_text())?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php } ?>

            <?php  if (Orm_Al_Action::get_count(['assessment_loop_id' => $assessment_loop->get_id()]) != 0) { ?>
                <div  class="table-light">
                    <div class="table-header">
                        <div class="table-caption"><?php echo lang('Actions')?></div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th><?php echo lang('Action') ?></th>
                            <th><?php echo lang('Responsible') ?></th>
                            <th><?php echo lang('Time Frame') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach (Orm_Al_Action::get_all(['assessment_loop_id' => $assessment_loop->get_id()]) as $action): ?>
                        <tr>
                            <td><?php echo htmlfilter($action->get_action())?></td>
                            <td><?php echo htmlfilter($action->get_responsible())?></td>
                            <td><?php echo htmlfilter($action->get_time_frame())?></td>
                        </tr>

                        <?php endforeach; ?>
                        </tbody>

                    </table>

                </div>
            <?php } ?>

        </div>
    <?php endforeach; ?>
<?php } else { ?>
    <tr>
        <td colspan="10">
            <div class="well well-sm m-a-0">
                <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Assessment loop Programs  to be displayed.'); ?></h3>
            </div>
        </td>
    </tr>
<?php } ?>


