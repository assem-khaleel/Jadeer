<?php

$modals = array();

$ssr_node = Orm_Node::get_one(array('system_number' => $ssr_active_node->get_system_number(), 'class_type' => Orm_Node::PROGRAM_SSR, 'item_id' => $program_id));
?>
<div class="panel panel-primary">
    <div class="panel-heading"><?php echo lang('Program') . ' : ' . Orm_Program::get_instance($program_id)->get_name() ?></div>
    <div class="panel-body p-b-0">
        <?php foreach ($ssr_node->get_children() as $child) { ?>
            <div class="page-forum-topics-item box panel p-y-2 p-x-3">
                <div class="box-row">
                    <div class="page-forums-list-title box-cell col-md-7 col-lg-8 col-xl-9 p-r-4">
                        <div class="page-forum-topics-title font-size-14">
                            <?php echo htmlfilter($child->get_name()); ?>
                        </div>
                        <div class="font-size-11 text-muted"><?php echo $child->get_days_remaining(); ?></div>
                        <br>
                        <?php $assessors = $child->get_assessors(); ?>
                        <?php if(count($assessors)) { ?>
                            <button class="btn-link p-a-0" data-toggle="modal" data-target="#coordinators-<?php echo $child->get_id() ?>">
                                <?php echo '</strong>' . count($assessors) . '</strong> ' . lang('Coordinators'); ?>
                            </button>

                            <?php ob_start(); ?>
                            <div class="modal fade" tabindex="-1" role="dialog" id="coordinators-<?php echo $child->get_id() ?>">
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
                                    <div class="font-size-11"><?php echo $child->get_progress_bar(75) ?></div>
                                    <div class="font-size-11 text-muted line-height-1"><?php echo lang('Progress'); ?></div>
                                </div>
                                <div class="box-cell p-x-3 b-l-1">
                                    <div class="font-size-11"><?php echo $child->get_review_bar(75) ?></div>
                                    <div class="font-size-11 text-muted line-height-1"><?php echo lang('Review'); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php echo implode("\n", $modals)?>