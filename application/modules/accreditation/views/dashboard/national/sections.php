<?php

$modals = array();

$number_of_assessors = 4;

$per_page = $this->config->item('dashboard_per_page');;
$section_page = (int)$this->input->get_post('section_page');

if (!$section_page) {
    $section_page = 1;
}

if(!empty($teacher_id)) {
    $filters = array('teacher_id' => $teacher_id, 'semester_id' => Orm_Semester::get_active_semester()->get_id());
} else {
    $filters = array('course_id' => Orm_Program_Plan::get_instance($plan_id)->get_course_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id());
}

?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="panel-title">
            <?php
            if(isset($plan_id) && $plan_id) {
                echo lang('Course') . ' : ' . htmlfilter(Orm_Program_Plan::get_instance($plan_id)->get_course_obj()->get_name());
            } else {
                echo lang('Course Sections');
            }
            ?>
        </span>
    </div>
    <div class="panel-body">
        <?php
        $course_section_count = Orm_Course_Section::get_count($filters);

        if ($course_section_count) { ?>

            <?php foreach (Orm_Course_Section::get_all($filters, $section_page, $per_page) as $section) { ?>

                <?php

                $children_types = array();
                if ($section->get_course_obj()->get_type() == 'theoretical') {
                    $children_types[Orm_Node::FORM_CS] = 'Course Specification';
                    $children_types[Orm_Node::FORM_CR] = 'Course Report';
                } elseif ($section->get_course_obj()->get_type() == 'practical') {
                    $children_types[Orm_Node::FORM_FS] = 'Field Experience Specification';
                    $children_types[Orm_Node::FORM_FR] = 'Field Report';
                }

                $index = 0;
                $node_section = Orm_Node::get_one(array('system_number' => $course_active_node->get_system_number(), 'class_type' => Orm_Node::COURSE_SECTION, 'item_id' => $section->get_id()));
                ?>
                <div class="box panel p-y-2 p-x-3">
                    <div class="box-row">
                        <div class="box-cell col-md-5 col-lg-4 col-xl-3 p-r-4">
                            <div class="font-size-14">
                                <p style="margin: 0;">
                                    <b><?php echo lang('Section Number'); ?> : </b><?php echo htmlfilter($section->get_name()); ?>
                                </p>
                                <p style="margin: 0;">
                                    <b><?php echo lang('Course Number'); ?> : </b><?php echo $section->get_course_obj()->get_number(); ?>
                                </p>
                                <p style="margin: 0;">
                                    <b><?php echo lang('Course Name'); ?> : </b><?php echo htmlfilter($section->get_course_obj()->get_name()); ?>
                                </p>
                            </div>

                            <div class="visible-md visible-lg position-absolute" style="bottom: 0">
                                <?php
                                $assessors = $node_section->get_parent_assessors();

                                foreach(array_slice($assessors, 0, $number_of_assessors) as $user) {
                                    echo $user->draw_compose_link();
                                }

                                if(count($assessors) > $number_of_assessors) {
                                    ?>
                                    <div>
                                        <button class="btn-link p-a-0" data-toggle="modal" data-target="#section-coordinators-<?php echo intval($section->get_id()) ?>">
                                            <?php echo lang('Show More') ?>
                                        </button>

                                        <?php ob_start(); ?>
                                        <div class="modal fade" tabindex="-1" role="dialog" id="section-coordinators-<?php echo $section->get_id() ?>">
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
                                        <div class="col-md-6">
                                            <div class="widget-pricing-item p-b-1 m-b-0">
                                                <?php if(!$node_section->get_id()) { ?>
                                                    <div class="label label-ribbon right label-danger"><strong><?php echo lang('Not Started')?></strong></div>
                                                <?php } ?>
                                                <div class="widget-pricing-plan font-size-14" style="height: 30px;"><?php echo lang($child_type)?></div>
                                                <div class="widget-pricing-section p-a-2 bg-white darker m-t-1">
                                                    <div class="row">
                                                        <div class="col-xs-6 col-md-12 col-lg-12 col-xl-6">
                                                            <div class="font-size-11"><?php echo $node_section->get_progress_bar(75) ?></div>
                                                            <div class="font-size-11 text-muted line-height-1 text-md-center"><?php echo lang('Progress'); ?></div>
                                                        </div>
                                                        <div class="col-xs-6 col-md-12 col-lg-12 col-xl-6 b-l-1">
                                                            <div class="font-size-11"><?php echo $node_section->get_review_bar(75) ?></div>
                                                            <div class="font-size-11 text-muted line-height-1 text-md-center"><?php echo lang('Review'); ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-pricing-section m-t-1">
                                                    <span>
                                                        <?php $assessors = $node_section->get_assessors(); ?>
                                                            <?php if(count($assessors)) { ?>
                                                                <button class="btn-link p-a-0" data-toggle="modal" data-target="#section-<?php echo md5($child_type) ?>-<?php echo $section->get_id() ?>">
                                                            <?php echo '</strong>' . count($assessors) . '</strong> ' . lang('Coordinators'); ?>
                                                        </button>

                                                        <?php ob_start(); ?>
                                                        <div class="modal fade" tabindex="-1" role="dialog" id="section-<?php echo md5($child_type) ?>-<?php echo $section->get_id() ?>">
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
                                                    <span class="font-size-11 text-muted"><?php echo $node_section->get_days_remaining(); ?></span>
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
        <?php } ?>
    </div>
    <?php
    if ($course_section_count) {
        $pager = new Pager(array('url' => handle_url(array('type' => 'sections')), 'page_label' => 'section_page'));
        $pager->set_page($section_page);
        $pager->set_per_page($per_page);
        $pager->set_total_count($course_section_count);
        $pager->set_pager_style('margin: 0px;');
        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="sections_container"');

        if ($pager->get_total_count() > $pager->get_per_page()) {
            echo '<div class="panel-footer">';
            echo $pager->render();
            echo '</div>';
        }
    }
    ?>
</div>

<?php echo implode("\n", $modals)?>