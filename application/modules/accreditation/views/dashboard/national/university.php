<?php

$modals = array();

$institutional_active_node = Orm_Node::get_active_institutional_node();
$institutional2018_active_node = Orm_Node::get_active_institutional2018_node();

$nodes = array();
if ($institutional_active_node->get_id()) {
    $nodes[$institutional_active_node->get_id()] = array(
        'node' => $institutional_active_node,
        'target' => 'ssr-i'
    );
}

if ($institutional2018_active_node->get_id()) {
    $nodes[$institutional2018_active_node->get_id()] = array(
        'node' => $institutional2018_active_node,
        'target' => 'ssr-i'
    );
}

if ($ssr_active_node->get_id()) {
    $nodes[$ssr_active_node->get_id()] = array(
        'node' => $ssr_active_node,
        'target' => 'colleges'
    );
}

if ($ssr2018_active_node->get_id()) {
    $nodes[$ssr2018_active_node->get_id()] = array(
        'node' => $ssr2018_active_node,
        'target' => 'colleges'
    );
}

if ($program_active_node->get_id()) {
    $nodes[$program_active_node->get_id()] = array(
        'node' => $program_active_node,
        'target' => 'colleges'
    );
}

if ($program2018_active_node->get_id()) {
    $nodes[$program2018_active_node->get_id()] = array(
        'node' => $program2018_active_node,
        'target' => 'colleges'
    );
}

if ($course_active_node->get_id()) {
    $nodes[$course_active_node->get_id()] = array(
        'node' => $course_active_node,
        'target' => 'colleges'
    );
}

if ($course2018_active_node->get_id()) {
    $nodes[$course2018_active_node->get_id()] = array(
        'node' => $course2018_active_node,
        'target' => 'colleges'
    );
}
?>
<div>
    <h6 class="font-weight-semibold m-y-3"><?php echo lang('Overall'); ?></h6>
    <?php if ($nodes) { ?>
        <?php foreach ($nodes as $result) { ?>
            <?php
            $node = $result['node']; /** @var $node Orm_Node */
            ?>
            <div class="page-forum-topics-item box panel p-y-2 p-x-3">
                <div class="box-row">
                    <div class="page-forums-list-title box-cell col-md-7 col-lg-8 col-xl-9 p-r-4">
                        <div class="page-forum-topics-title font-size-14">
                            <a data-toggle="ajaxRequest" data-target="colleges_container" href="<?php echo handle_url(array('node_id' => $node->get_id(), 'type' => $result['target'])); ?>" class="font-weight-semibold" ><?php echo htmlfilter($node->get_name()); ?></a>
                        </div>
                        <div class="font-size-11 text-muted"><?php echo $node->get_days_remaining(); ?></div>

                        <?php $assessors = ($result['target'] === 'ssr-i') ? $node->get_assessors() : array(); ?>
                        <?php if(count($assessors)) { ?>
                            <br>
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
                        <?php } ?>
                    </div>

                    <!-- Spacer -->
                    <hr class="visible-xs visible-sm m-y-2">

                    <div class="box-cell col-md-5 col-lg-4 col-xl-3 valign-middle text-md-center">
                        <!-- Reset container's height by wrapping in a div -->
                        <div class="pull-md-right">
                            <div class="box-container width-md-auto valign-middle">
                                <div class="box-cell p-l-1 p-r-3">
                                    <div class="font-size-11"><?php echo $node->get_progress_bar(75) ?></div>
                                    <div class="font-size-11 text-muted line-height-1"><?php echo lang('Progress'); ?></div>
                                </div>
                                <div class="box-cell p-x-3 b-l-1">
                                    <div class="font-size-11"><?php echo $node->get_review_bar(75) ?></div>
                                    <div class="font-size-11 text-muted line-height-1"><?php echo lang('Review'); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <div class="well well-sm">
            <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Accreditations'); ?></h3>
        </div>
    <?php } ?>
</div>

<?php echo implode("\n", $modals)?>

<div id="colleges_container" class="m-b-1"></div>