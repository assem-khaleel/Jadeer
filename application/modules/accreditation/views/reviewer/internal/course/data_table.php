<?php

$modals = array();

/** @var $courses Orm_Course[] */
$active_course = Orm_Node::get_active_course_node();
$active_course18 = Orm_Node::get_active_course2018_node();
?>
<div class="table-responsive m-a-0">
    <table class="table table-bordered">
        <thead>
        <tr>
            <td class="col-md-4"><?php echo lang('Course Name'); ?></td>
            <td class="col-md-2"><?php echo lang('Course No'); ?></td>
            <td class="col-md-4"><?php echo lang('Reviewers'); ?></td>
            <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
        </tr>
        </thead>
        <tbody>
        <?php if ($courses) { ?>
            <?php foreach ($courses as $course) { ?>
                <tr>
                    <td><?php echo htmlfilter($course->get_name()); ?></td>
                    <td><?php echo htmlfilter($course->get_code()); ?></td>
                    <td>
                        <div class="well m-a-0 p-a-1">
                            <?php echo lang('Course Specifications and Reports'); ?>
                            <hr class="bg-info m-y-1">
                            <?php
                            if(!empty($active_course)){
                                $course_node = Orm_Node::get_one(array('system_number' => $active_course->get_system_number(), 'class_type' => Orm_Node::COURSE_COURSE, 'item_id' => $course->get_id()));

                            }

                            if(!empty($active_course18)){
                                $course_node = Orm_Node::get_one(array('system_number' => $active_course18->get_system_number(), 'class_type' => Orm_Node::COURSE_COURSE18, 'item_id' => $course->get_id()));

                            }
                            $reviewers = $course_node->get_reviewers();
                            ?>
                            <?php if(count($reviewers)) { ?>
                                <button class="btn-link p-a-0" data-toggle="modal" data-target="#reviewers-course-<?php echo $course->get_id() ?>">
                                    <?php echo '</strong>' . count($reviewers) . '</strong> ' . lang('Reviewers'); ?>
                                </button>

                                <?php ob_start(); ?>
                                <div class="modal fade" tabindex="-1" role="dialog" id="reviewers-course-<?php echo $course->get_id() ?>">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><?php echo lang('Reviewers') ?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <?php
                                                    foreach (Orm_User::get_all(['in_id' => empty($reviewers) ? [0] : $reviewers]) as $user) {
                                                        echo "<div class='col-sm-4'>" . $user->draw_compose_link() . "</div>";
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
                            <?php } else { echo '<strong>0</strong> '. lang('Reviewers'); } ?>
                        </div>
                    </td>
                    <td class="text-center">
                        <?php if($course_node->get_id()) { ?>
                            <a href="/accreditation/item/<?php echo intval($course_node->get_id()) ?>" class="btn btn-block"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View') . ' CS / SR' ?></a>
                        <?php } else { ?>
                            <span class="btn btn-warning btn-block" disabled="disabled"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('Not Started') ?></span>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="10">
                    <div class="well well-sm m-a-0">
                        <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Courses'); ?></h3>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php if (!empty($pager)) { ?>
    <div class="table-footer">
        <?php echo $pager; ?>
    </div>
<?php } ?>

<?php echo implode("\n", $modals)?>