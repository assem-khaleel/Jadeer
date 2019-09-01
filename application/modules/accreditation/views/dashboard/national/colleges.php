<?php
/* @var $course_active_node Node\ncacm14\Root */

$modals = array();

$number_of_assessors = 4;

$per_page = $this->config->item('dashboard_per_page');
$college_page = (int)$this->input->get_post('college_page');
$college_keyword = trim($this->input->get_post('college_keyword'));

if (!$college_page) {
    $college_page = 1;
}

$filters = array();

if(!empty($college_id)) {
    $filters['id'] = $college_id;
}
if (!empty($college_keyword)) {
    if ($this->input->post('college_keyword')) {
        $college_page = 1;
    }
    $filters['keyword'] = $college_keyword;
}

$pager_count = Orm_College::get_count($filters);

if (!($college_page > 1 && $college_page <= ceil($pager_count / $per_page))) {
    $college_page = 1;
}
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="panel-title"><?php echo lang('Colleges'); ?></span>
        <div class="panel-heading-controls col-sm-4">
            <form action="<?php echo handle_url(array('type' => 'colleges'), array('college_keyword')); ?>" method="get" id="college-search" data-toggle="ajaxSubmit" data-target="colleges_container" class="pull-right">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="<?php echo lang('Search'); ?>" name="college_keyword" value="<?php echo $college_keyword; ?>">
                    <span class="input-group-btn"><button class="btn" type="submit"><span class="fa fa-search"></span></button></span>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body p-b-0">
        <?php
        $colleges = Orm_College::get_all($filters, $college_page, $per_page);
        foreach ($colleges as $college) {

            $ssr_node = Orm_Node::get_one(array('system_number' => $ssr_active_node->get_system_number(), 'class_type' => Orm_Node::COLLEGE_SSR, 'item_id' => $college->get_id()));
            $program_node = Orm_Node::get_one(array('system_number' => $program_active_node->get_system_number(), 'class_type' => Orm_Node::COLLEGE_PROGRAM, 'item_id' => $college->get_id()));
            //$course_node = Orm_Node::get_one(array('system_number' => $course_active_node->get_system_number(), 'class_type' => Orm_Node::COLLEGE_COURSE, 'item_id' => $college->get_id()));
            ?>
            <div class="box panel p-y-2 p-x-3">
                <div class="box-row">
                    <div class="box-cell col-md-5 col-lg-4 col-xl-3 p-r-4">
                        <div class="font-size-14">
                            <a data-toggle="ajaxRequest" data-target="programs_container" href="<?php echo handle_url(array('college_id' => $college->get_id(), 'type' => 'programs')); ?>" class="font-weight-semibold" ><?php echo htmlfilter($college->get_name()); ?></a>
                        </div>

                        <div class="visible-md visible-lg position-absolute" style="bottom: 0">
                            <?php
                            $assessors = Orm_User::get_user_by_role(Orm_Role::ROLE_COLLEGE_ADMIN, array('college_id' => $college->get_id()));

                            foreach(array_slice($assessors, 0, $number_of_assessors) as $user) {
                                echo $user->draw_compose_link();
                            }

                            if(count($assessors) > $number_of_assessors) {
                            ?>
                            <div>
                                <button class="btn-link p-a-0" data-toggle="modal" data-target="#college-coordinators-<?php echo intval($college->get_id()) ?>">
                                    <?php echo lang('Show More') ?>
                                </button>

                                <?php ob_start(); ?>
                                <div class="modal fade" tabindex="-1" role="dialog" id="college-coordinators-<?php echo $college->get_id() ?>">
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
                                        <div class="widget-pricing-plan font-size-14" style="height: 30px;"><?php echo lang('Self Study Reports')?></div>
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
                                                    <button class="btn-link p-a-0" data-toggle="modal" data-target="#college-ssr-coordinators-<?php echo $college->get_id() ?>">
                                                        <?php echo '</strong>' . count($assessors) . '</strong> ' . lang('Coordinators'); ?>
                                                    </button>

                                                    <?php ob_start(); ?>
                                                    <div class="modal fade" tabindex="-1" role="dialog" id="college-ssr-coordinators-<?php echo $college->get_id() ?>">
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
                                            <?php echo lang('Program Specifications and Reports')?></div>
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
                                                    <button class="btn-link p-a-0" data-toggle="modal" data-target="#college-ps-pr-coordinators-<?php echo $college->get_id() ?>">
                                                        <?php echo '</strong>' . count($assessors) . '</strong> ' . lang('Coordinators'); ?>
                                                    </button>

                                                    <?php ob_start(); ?>
                                                    <div class="modal fade" tabindex="-1" role="dialog" id="college-ps-pr-coordinators-<?php echo $college->get_id() ?>">
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
                                        <?php if(!$course_active_node->get_id()) { ?>
                                            <div class="label label-ribbon right label-danger"><strong><?php echo lang('Not Started')?></strong></div>
                                        <?php } ?>
                                        <div class="widget-pricing-plan font-size-14" style="height: 30px;"><?php echo lang('Course Specifications and Reports')?></div>
                                        <div class="widget-pricing-section p-a-2 bg-white darker m-t-1">
                                            <div class="row">
                                                <div class="col-xs-6 col-md-12 col-lg-12 col-xl-6">
                                                    <div class="font-size-11"><?php echo $course_active_node->get_course_progress_bar(array('college_id' => $college->get_id()), 75) ?></div>
                                                    <div class="font-size-11 text-muted line-height-1"><?php echo lang('Progress'); ?></div>
                                                </div>
                                                <div class="col-xs-6 col-md-12 col-lg-12 col-xl-6 b-l-1">
                                                    <div class="font-size-11"><?php echo $course_active_node->get_course_review_bar(array('college_id' => $college->get_id()), 75) ?></div>
                                                    <div class="font-size-11 text-muted line-height-1"><?php echo lang('Review'); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-pricing-section m-t-1">
                                            <span><strong><?php echo Orm_Course::get_count(array('college_id' => $college->get_id())) ?></strong> <?php echo lang('Courses') ?></span>
                                            <br>
                                            <span class="font-size-11 text-muted"><?php echo $course_active_node->get_days_remaining(); ?></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if (empty($colleges)) { ?>
            <div class="alert m-a-0 m-b-1">
                <?php echo lang('There are no') . ' ' . lang('Colleges'); ?>
            </div>
        <?php } ?>
    </div>
    <?php
    $pager = new Pager(array('url' => handle_url(array('type' => 'colleges', 'college_keyword' => $college_keyword)), 'page_label' => 'college_page'));
    $pager->set_page($college_page);
    $pager->set_per_page($per_page);
    $pager->set_total_count($pager_count);
    $pager->set_pager_style('margin: 0px;');
    $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="colleges_container"');

    if ($pager->get_total_count() > $pager->get_per_page()) {
        echo '<div class="panel-footer">';
        echo $pager->render();
        echo '</div>';
    }
    ?>
</div>

<?php echo implode("\n", $modals)?>

<div id="programs_container"></div>