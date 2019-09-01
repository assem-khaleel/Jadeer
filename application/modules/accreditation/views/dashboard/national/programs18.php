<?php

$modals = array();

$number_of_assessors = 4;

$per_page = $this->config->item('dashboard_per_page');;
$program_page = (int)$this->input->get_post('program_page');
$program_keyword = trim($this->input->get_post('program_keyword'));

if (!$program_page) {
    $program_page = 1;
}

$filters = array('college_id' => $college_id);

if(!empty($program_id)) {
    $filters['id'] = $program_id;
}
if (!empty($program_keyword)) {
    if ($this->input->post('program_keyword')) {
        $program_page = 1;
    }
    $filters['keyword'] = $program_keyword;
}

$pager_count = Orm_Program::get_count($filters);

if (!($program_page > 1 && $program_page <= ceil($pager_count / $per_page))) {
    $program_page = 1;
}

?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="panel-title"><?php echo lang('Programs').': '.htmlfilter(Orm_College::get_instance($college_id)->get_name()); ?></span>
        <div class="panel-heading-controls col-sm-4">
            <form action="<?php echo handle_url(array('type' => 'programs'), array('program_keyword')); ?>" method="get" id="program-search" data-toggle="ajaxSubmit" data-target="programs_container" class="pull-right">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="<?php echo lang('Search'); ?>" name="program_keyword" value="<?php echo $program_keyword; ?>">
                    <span class="input-group-btn"><button class="btn" type="submit"><span class="fa fa-search"></span></button></span>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body p-b-0">
        <?php $programs = Orm_Program::get_all($filters, $program_page, $per_page); ?>
        <?php foreach ($programs as $program) {
            $ssr_node = Orm_Node::get_one(array('system_number' => $ssr2018_active_node->get_system_number(), 'class_type' => Orm_Node::PROGRAM_SSR18, 'item_id' => $program->get_id()));
            $program_node = Orm_Node::get_one(array('system_number' => $program2018_active_node->get_system_number(), 'class_type' => Orm_Node::PROGRAM_PROGRAM18, 'item_id' => $program->get_id()));
            ?>
            <div class="box panel p-y-2 p-x-3">
                <div class="box-row">
                    <div class="box-cell col-md-5 col-lg-4 col-xl-3 p-r-4">
                        <div class="font-size-14">
                            <?php echo htmlfilter($program->get_name()); ?>
                        </div>

                        <div class="visible-md visible-lg position-absolute" style="bottom: 0">
                            <?php
                            $assessors = Orm_User::get_user_by_role(Orm_Role::ROLE_PROGRAM_ADMIN, array('program_id' => $program->get_id()));

                            foreach(array_slice($assessors, 0, $number_of_assessors) as $user) {
                                echo $user->draw_compose_link();
                            }

                            if(count($assessors) > $number_of_assessors) {
                                ?>
                                <div>
                                    <button class="btn-link p-a-0" data-toggle="modal" data-target="#program-coordinators-<?php echo intval($program->get_id()) ?>">
                                        <?php echo lang('Show More') ?>
                                    </button>

                                    <?php ob_start(); ?>
                                    <div class="modal fade" tabindex="-1" role="dialog" id="program-coordinators-<?php echo $program->get_id() ?>">
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
                                <div class="col-md-4">
                                    <div class="widget-pricing-item p-b-1 m-b-0">
                                        <?php if(!$ssr_node->get_id()) { ?>
                                            <div class="label label-ribbon right label-danger"><strong><?php echo lang('Not Started')?></strong></div>
                                        <?php } ?>
                                        <div class="widget-pricing-plan font-size-14" style="height: 30px;">
                                            <?php if($ssr_node->get_id()) { ?>
                                                <a data-toggle="ajaxRequest" data-target="program_container" href="<?php echo handle_url(array('program_id' => $program->get_id(), 'type' => 'ssr-p')); ?>" class="font-weight-semibold" >
                                                    <?php echo lang('Self Study Report')?>
                                                </a>
                                            <?php } else { ?>
                                                <?php echo  lang('Self Study Report')?>
                                            <?php } ?>
                                        </div>
                                        <div class="widget-pricing-section p-a-2 bg-white darker m-t-1">
                                            <div class="row">
                                                <div class="col-xs-6 col-md-12 col-lg-12 col-xl-6">
                                                    <div class="font-size-11"><?php echo $ssr_node->get_progress_bar(75) ?></div>
                                                    <div class="font-size-11 text-muted line-height-1 text-md-center"><?php echo lang('Progress'); ?></div>
                                                </div>
                                                <div class="col-xs-6 col-md-12 col-lg-12 col-xl-6 b-l-1">
                                                    <div class="font-size-11"><?php echo $ssr_node->get_review_bar(75) ?></div>
                                                    <div class="font-size-11 text-muted line-height-1 text-md-center"><?php echo lang('Review'); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-pricing-section m-t-1">
                                            <span>
                                                <?php $assessors = $ssr_node->get_assessors(); ?>
                                                <?php if(count($assessors)) { ?>
                                                    <button class="btn-link p-a-0" data-toggle="modal" data-target="#program-ssr-coordinators-<?php echo $program->get_id() ?>">
                                                        <?php echo '</strong>' . count($assessors) . '</strong> ' . lang('Coordinators'); ?>
                                                    </button>

                                                    <?php ob_start(); ?>
                                                    <div class="modal fade" tabindex="-1" role="dialog" id="program-ssr-coordinators-<?php echo $program->get_id() ?>">
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
                                            <span class="font-size-11 text-muted"><?php echo $ssr_node->get_days_remaining(); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="widget-pricing-item p-b-1 m-b-0">
                                        <?php if(!$program_node->get_id()) { ?>
                                            <div class="label label-ribbon right label-danger"><strong><?php echo lang('Not Started')?></strong></div>
                                        <?php } ?>
                                        <div class="widget-pricing-plan font-size-14" style="height: 30px;">
                                            <?php if($program_node->get_id()) { ?>
                                                <a data-toggle="ajaxRequest" data-target="program_container" href="<?php echo handle_url(array('program_id' => $program->get_id(), 'type' => 'ps-pr')); ?>" class="font-weight-semibold" >
                                                    <?php echo lang('Program Specifications and Report')?>
                                                </a>
                                            <?php } else { ?>
                                                <?php echo lang('Program Specification and Report')?>
                                            <?php } ?>
                                        </div>
                                        <div class="widget-pricing-section p-a-2 bg-white darker m-t-1">
                                            <div class="row">
                                                <div class="col-xs-6 col-md-12 col-lg-12 col-xl-6">
                                                    <div class="font-size-11"><?php echo $program_node->get_progress_bar(75) ?></div>
                                                    <div class="font-size-11 text-muted line-height-1"><?php echo lang('Progress'); ?></div>
                                                </div>
                                                <div class="col-xs-6 col-md-12 col-lg-12 col-xl-6 b-l-1">
                                                    <div class="font-size-11"><?php echo $program_node->get_review_bar(75) ?></div>
                                                    <div class="font-size-11 text-muted line-height-1"><?php echo lang('Review'); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-pricing-section m-t-1">
                                            <span>
                                                <?php $assessors = $program_node->get_assessors(); ?>
                                                <?php if(count($assessors)) { ?>
                                                    <button class="btn-link p-a-0" data-toggle="modal" data-target="#program-ps-pr-coordinators-<?php echo $program->get_id() ?>">
                                                        <?php echo '</strong>' . count($assessors) . '</strong> ' . lang('Coordinators'); ?>
                                                    </button>

                                                    <?php ob_start(); ?>
                                                    <div class="modal fade" tabindex="-1" role="dialog" id="program-ps-pr-coordinators-<?php echo $program->get_id() ?>">
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
                                            <span class="font-size-11 text-muted"><?php echo $program_node->get_days_remaining(); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="widget-pricing-item p-b-1 m-b-0">
                                        <?php if(!$course2018_active_node->get_id()) { ?>
                                            <div class="label label-ribbon right label-danger"><strong><?php echo lang('Not Started')?></strong></div>
                                        <?php } ?>
                                        <div class="widget-pricing-plan font-size-14" style="height: 30px;">
                                            <?php if($course2018_active_node->get_id()) { ?>
                                                <a data-toggle="ajaxRequest" data-target="program_container" href="<?php echo handle_url(array('program_id' => $program->get_id(), 'type' => 'plans')); ?>" class="font-weight-semibold">
                                                    <?php echo lang('Course Specifications and Reports')?>
                                                </a>
                                            <?php } else { ?>
                                                <?php echo lang('Course Specifications and Reports')?>
                                            <?php } ?>
                                        </div>
                                        <div class="widget-pricing-section p-a-2 bg-white darker m-t-1">
                                            <div class="row">
                                                <div class="col-xs-6 col-md-12 col-lg-12 col-xl-6">
                                                    <div class="font-size-11"><?php echo $course2018_active_node->get_course_progress_bar(array('program_id' => $program->get_id()), 75) ?></div>
                                                    <div class="font-size-11 text-muted line-height-1"><?php echo lang('Progress'); ?></div>
                                                </div>
                                                <div class="col-xs-6 col-md-12 col-lg-12 col-xl-6 b-l-1">
                                                    <div class="font-size-11"><?php echo $course2018_active_node->get_course_review_bar(array('program_id' => $program->get_id()), 75) ?></div>
                                                    <div class="font-size-11 text-muted line-height-1"><?php echo lang('Review'); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-pricing-section m-t-1">
                                            <span><strong><?php echo Orm_Course::get_count(array('program_plan' => true, 'program_id' => $program->get_id())) ?></strong> <?php echo lang('Courses') ?></span>
                                            <br>
                                            <span class="font-size-11 text-muted"><?php echo $course2018_active_node->get_days_remaining(); ?></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if (empty($programs)) { ?>
            <div class="alert m-a-0 m-b-1">
                <?php echo lang('There are no') . ' ' . lang('Programs'); ?>
            </div>
        <?php } ?>
    </div>
    <?php
    $pager = new Pager(array('url' => handle_url(array('type' => 'programs', 'program_keyword' => $program_keyword)), 'page_label' => 'program_page'));
    $pager->set_page($program_page);
    $pager->set_per_page($per_page);
    $pager->set_total_count($pager_count);
    $pager->set_pager_style('margin: 0px;');
    $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="programs_container"');

    if ($pager->get_total_count() > $pager->get_per_page()) {
        echo '<div class="panel-footer">';
        echo $pager->render();
        echo '</div>';
    }
    ?>
</div>

<?php echo implode("\n", $modals)?>

<div id="program_container"></div>