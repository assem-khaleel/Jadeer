<?php

$modals = array();

$number_of_assessors = 4;

function collect_type($node_types, $function_name) {
    $finished = 0;
    $in_process = 0;

    foreach ($node_types as $node_type) {
        $finished_type = 0;
        $in_process_type = 0;
        $node_type->$function_name($finished_type, $in_process_type);

        $finished += $finished_type;
        $in_process += $in_process_type;
    }

    $progress = 0;
    if (($finished + $in_process) > 0) {
        $progress = round(($finished / ($finished + $in_process)) * 100, 2);
    }

    return $progress;
}

$per_page = $this->config->item('dashboard_per_page');
$plan_page = intval($this->input->get_post('plan_page') ?: 1);
$course_keyword = trim($this->input->get_post('course_keyword'));

$filters = array('program_id' => $program_id);

if (!empty($course_keyword)) {
    $filters['keyword'] = $course_keyword;
}

$pager_count = Orm_Program_Plan::get_count($filters);

if (!($plan_page > 1 && $plan_page <= ceil($pager_count / $per_page))) {
    $plan_page = 1;
}


?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="panel-title"><?php echo lang('Program') . ' : ' . htmlfilter(Orm_Program::get_instance($program_id)->get_name()) ?></span>
        <div class="panel-heading-controls col-sm-4">
            <form action="<?php echo handle_url(array('type' => 'plans'), array('course_keyword')); ?>" method="get" id="course-search" data-toggle="ajaxSubmit" data-target="program_container" class="pull-right">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="<?php echo lang('Search'); ?>" name="course_keyword" value="<?php echo $course_keyword; ?>">
                    <span class="input-group-btn"><button class="btn" type="submit"><span class="fa fa-search"></span></button></span>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <?php $courses = Orm_Program_Plan::get_all($filters, $plan_page, $per_page); ?>
        <?php foreach ($courses as $plan) { ?>

            <?php
            $children_types = array();

            if ($plan->get_course_obj()->get_type() == 'theoretical') {
                $children_types[Orm_Node::FORM_CS] = 'Course Specification';
                $children_types[Orm_Node::FORM_CR] = 'Course Report';
            } elseif ($plan->get_course_obj()->get_type() == 'practical') {
                $children_types[Orm_Node::FORM_FS] = 'Field Experience Specification';
                $children_types[Orm_Node::FORM_FR] = 'Field Report';
            }

            $node_course = Orm_Node::get_one(array('system_number' => $course_active_node->get_system_number(), 'class_type' => Orm_Node::COURSE_COURSE, 'item_id' => $plan->get_course_id()));
            ?>

            <div class="box panel p-y-2 p-x-3">
                <div class="box-row">
                    <div class="box-cell col-md-5 col-lg-4 col-xl-3 p-r-4">
                        <div class="font-size-14">
                            <a data-toggle="ajaxRequest" data-target="sections_container" href="<?php echo handle_url(array('plan_id' => $plan->get_id(), 'type' => 'sections')); ?>"><?php echo htmlfilter($plan->get_course_obj()->get_name()); ?> - <strong><?php echo htmlfilter($plan->get_course_obj()->get_code()) ?></strong></a>
                        </div>

                        <div class="visible-md visible-lg position-absolute" style="bottom: 0">
                            <?php
                            $assessors = $node_course->get_parent_assessors();

                            foreach(array_slice($assessors, 0, $number_of_assessors) as $user) {
                                echo $user->draw_compose_link();
                            }

                            if(count($assessors) > $number_of_assessors) {
                                ?>
                                <div>
                                    <button class="btn-link p-a-0" data-toggle="modal" data-target="#plan-coordinators-<?php echo intval($plan->get_id()) ?>">
                                        <?php echo lang('Show More') ?>
                                    </button>

                                    <?php ob_start(); ?>
                                    <div class="modal fade" tabindex="-1" role="dialog" id="plan-coordinators-<?php echo $plan->get_id() ?>">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title"><?php echo lang('Coordinators') ?></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <?php
                                                        foreach(array_slice($assessors, $number_of_assessors, count($assessors)) as $user) {
                                                            echo "<div class='col-sm-4'>".$user->draw_compose_link()."</div>";
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn" data-dismiss="modal"><?php echo lang('Close') ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $modals[] = ob_get_contents();
                                    ob_end_clean();
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Spacer -->
                    <hr class="visible-xs visible-sm m-y-2">

                    <div class="box-cell col-md-7 col-lg-8 col-xl-9 valign-middle text-md-center">
                        <!-- Reset container's height by wrapping in a div -->
                        <div class="widget-pricing widget-pricing-expanded">
                            <div class="widget-pricing-inner row p-x-1">
                                <?php foreach ($children_types as $class_type => $child_type) { ?>
                                    <?php
                                    $node_types = array();
                                    if($node_course->get_id()) {
                                        $node_types = Orm_Node::get_all(array('system_number' => $course_active_node->get_system_number(), 'class_type' => $class_type, 'parent_lft' => $node_course->get_parent_lft(), 'parent_rgt' => $node_course->get_parent_rgt()));
                                    }

                                    $progress = collect_type($node_types, 'collect_progress');
                                    $review = collect_type($node_types, 'collect_reviewing');
                                    ?>
                                    <div class="col-md-6">
                                        <div class="widget-pricing-item p-b-1 m-b-0">
                                            <?php if(!$node_course->get_id()) { ?>
                                                <div class="label label-ribbon right label-danger"><strong><?php echo lang('Not Started')?></strong></div>
                                            <?php } ?>
                                            <div class="widget-pricing-plan font-size-14" style="height: 30px;"><?php echo lang($child_type)?></div>
                                            <div class="widget-pricing-section p-a-2 bg-white darker m-t-1">
                                                <div class="row">
                                                    <div class="col-xs-6 col-md-12 col-lg-12 col-xl-6">
                                                        <div class="font-size-11"><?php echo $node_course->get_progress_bar(75, $progress) ?></div>
                                                        <div class="font-size-11 text-muted line-height-1 text-md-center"><?php echo lang('Progress'); ?></div>
                                                    </div>
                                                    <div class="col-xs-6 col-md-12 col-lg-12 col-xl-6 b-l-1">
                                                        <div class="font-size-11"><?php echo $node_course->get_review_bar(75, $review) ?></div>
                                                        <div class="font-size-11 text-muted line-height-1 text-md-center"><?php echo lang('Review'); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-pricing-section m-t-1">
                                                <span>
                                                    <?php $assessors = $node_course->get_assessors(); ?>
                                                    <?php if(count($assessors)) { ?>
                                                        <button class="btn-link p-a-0" data-toggle="modal" data-target="#plan-<?php echo md5($child_type) ?>-<?php echo $plan->get_id() ?>">
                                                        <?php echo '</strong>' . count($assessors) . '</strong> ' . lang('Coordinators'); ?>
                                                    </button>

                                                    <?php ob_start(); ?>
                                                    <div class="modal fade" tabindex="-1" role="dialog" id="plan-<?php echo md5($child_type) ?>-<?php echo $plan->get_id() ?>">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title"><?php echo lang('Coordinators') ?></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <?php
                                                                        foreach ($assessors as $key => $user) {
                                                                            echo "<div class='col-sm-4'>" . $user->get_user_obj()->draw_compose_link() . "</div>";
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn" data-dismiss="modal"><?php echo lang('Close') ?></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <?php
                                                        $modals[] = ob_get_contents();
                                                        ob_end_clean();
                                                        ?>
                                                    <?php } else { echo '<strong>0</strong> '. lang('Coordinators'); } ?>
                                                </span>
                                                <br>
                                                <span class="font-size-11 text-muted"><?php echo $node_course->get_days_remaining(); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if (empty($courses)) { ?>
            <div class="alert m-a-0 m-b-1">
                <?php echo lang('There are no') . ' ' . lang('Courses'); ?>
            </div>
        <?php } ?>
    </div>

    <?php
    $pager = new Pager(array('url' => handle_url(array('type' => 'plans', 'course_keyword' => $course_keyword)), 'page_label' => 'plan_page'));
    $pager->set_page($plan_page);
    $pager->set_per_page($per_page);
    $pager->set_total_count($pager_count);
    $pager->set_pager_style('margin: 0px;');
    $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="program_container"');

    if ($pager->get_total_count() > $pager->get_per_page()) {
        echo '<div class="panel-footer">';
        echo $pager->render();
        echo '</div>';
    }
    ?>
</div>

<?php echo implode("\n", $modals)?>

<div id="sections_container" ></div>