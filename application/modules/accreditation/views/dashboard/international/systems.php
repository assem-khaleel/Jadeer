<?php

$modals = array();

$per_page = $this->config->item('dashboard_per_page');
$system_page = (int) $this->input->get_post('system_page');

if (!$system_page) {
    $system_page = 1;
}

$filters = array();
$filters['year'] = $year;
$filters['parent_id'] = 0;
$filters['class_type_in'] = Orm_Node::get_international_systems(false);

$user = Orm_User::get_logged_user();
switch ($user->get_institution_role()) {
    case Orm_Role::ROLE_INSTITUTION_ADMIN:
        break;

    default:
        $system_number = array();
        $system_number += Orm_Node_Assessor::get_assessor_systems($user->get_id());
        $system_number += Orm_Node_Reviewer::get_reviewer_systems($user->get_id());
        $filters['system_number_in'] = $system_number;
        break;
}

$nodes = Orm_Node::get_all($filters, $system_page, $per_page);
?>


<?php if ($nodes): ?>
    <?php foreach ($nodes as $node) { ?>
        <div class="page-forum-topics-item box panel p-y-2 p-x-3">
            <div class="box-row">
                <div class="page-forums-list-title box-cell col-md-7 col-lg-8 col-xl-9 p-r-4">
                    <div class="page-forum-topics-title font-size-14">
                        <a data-toggle="ajaxRequest" data-target="system_container" href="<?php echo handle_url(array('node_id' => $node->get_id(), 'type' => 'system')); ?>"><?php echo $node->get_name(); ?></a>
                    </div>
                    <?php if (!is_null($node->get_item_obj())) : ?>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label class="control-label"><?php echo lang('College') ?>:</label>
                            <?php echo $node->get_item_obj()->get_department_obj()->get_college_obj()->get_name(); ?>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label class="control-label"><?php echo lang('Program') ?>:</label>
                            <?php echo $node->get_item_obj()->get_name(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="font-size-11 text-muted"><?php echo $node->get_days_remaining() ?></div>

                    <br>
                    <?php $assessors = $node->get_assessors(); ?>
                    <?php if(count($assessors)) { ?>
                        <button class="btn-link p-a-0" data-toggle="modal" data-target="#coordinators-<?php echo $node->get_id() ?>">
                            <?php echo '</strong>' . count($assessors) . '</strong> ' . lang('Coordinators'); ?>
                        </button>

                        <?php ob_start(); ?>
                        <div class="modal fade" tabindex="-1" role="dialog" id="coordinators-<?php echo $node->get_id() ?>">
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
                </div>

                <!-- Spacer -->
                <hr class="visible-xs visible-sm m-y-2">

                <div class="box-cell col-md-5 col-lg-4 col-xl-3 valign-middle text-md-center">
                    <!-- Reset container's height by wrapping in a div -->
                    <div class="pull-md-right">
                        <div class="box-container width-md-auto valign-middle">
                            <div class="box-cell p-l-1 p-r-3">
                                <div class="font-size-11">
                                    <?php echo $node->get_progress_bar(75) ?>
                                </div>
                                <div class="font-size-11 text-muted line-height-1"><?php echo lang('Progress'); ?></div>
                            </div>
                            <div class="box-cell p-x-3 b-l-1">
                                <div class="font-size-11">
                                    <?php echo $node->get_review_bar(75) ?>
                                </div>
                                <div class="font-size-11 text-muted line-height-1"><?php echo lang('Review'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php else: ?>
    <div class="page-forum-topics-item box panel p-y-2 p-x-3">
        <div class="box-row">
            <div class="page-forums-list-title box-cell col-md-7 col-lg-8 col-xl-9 p-r-4">
                <div class="page-forum-topics-title font-size-14">
                    <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Accreditations'); ?></h3>
                </div>
            </div>
            <hr class="visible-xs visible-sm m-y-2">
        </div>
    </div>
<?php endif; ?>

<?php
$pager = new Pager(array('url' => handle_url(array('type' => 'systems')), 'page_label' => 'system_page'));
$pager->set_page($system_page);
$pager->set_per_page($per_page);
$pager->set_total_count(Orm_Node::get_count($filters));
$pager->set_pager_style('margin: 0px;');
$pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="systems_container"');

if ($pager->get_total_count() > $pager->get_per_page()) {
    echo $pager->render();
}
?>

<?php echo implode("\n", $modals)?>

<div id="system_container"></div>