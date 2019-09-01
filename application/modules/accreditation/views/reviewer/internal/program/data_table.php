<?php

$modals = array();

/** @var $programs Orm_Program[] */
$active_ssr = Orm_Node::get_active_ssr_node();
$active_program = Orm_Node::get_active_program_node();

$active_ssr18 = Orm_Node::get_active_ssr2018_node();
$active_program18 = Orm_Node::get_active_program2018_node();
?>
    <div class="table-responsive m-a-0">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td class="col-md-4"><?php echo lang('Program Name'); ?></td>
                <td class="col-md-6"><?php echo lang('Reviewers'); ?></td>
                <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
            </tr>
            </thead>
            <tbody>
            <?php if ($programs) { ?>
                <?php foreach ($programs as $program) { ?>
                    <tr>
                        <td><?php echo htmlfilter($program->get_name()); ?></td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="well m-a-0 p-a-1">
                                        <?php echo lang('Self Study Reports'); ?>
                                        <hr class="bg-info m-y-1">
                                        <?php
                                        if (!empty($active_ssr)) {
                                            $ssr_node = Orm_Node::get_one(array('system_number' => $active_ssr->get_system_number(), 'class_type' => Orm_Node::PROGRAM_SSR, 'item_id' => $program->get_id()));
                                        }

                                        if (!empty($active_ssr18)) {
                                            $ssr_node = Orm_Node::get_one(array('system_number' => $active_ssr18->get_system_number(), 'class_type' => Orm_Node::PROGRAM_SSR18, 'item_id' => $program->get_id()));
                                        }
                                        $reviewers = $ssr_node->get_reviewers();
                                        ?>
                                        <?php if (count($reviewers)) { ?>
                                            <button class="btn-link p-a-0" data-toggle="modal"
                                                    data-target="#reviewers-ssr-<?php echo $program->get_id() ?>">
                                                <?php echo '</strong>' . count($reviewers) . '</strong> ' . lang('Reviewers'); ?>
                                            </button>

                                            <?php ob_start(); ?>
                                            <div class="modal fade" tabindex="-1" role="dialog"
                                                 id="reviewers-ssr-<?php echo $program->get_id() ?>">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
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
                                                            <button type="button" class="btn"
                                                                    data-dismiss="modal"><?php echo lang('Close') ?></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $modals[] = ob_get_contents();
                                            ob_end_clean();
                                            ?>
                                        <?php } else {
                                            echo '<strong>0</strong> ' . lang('Reviewers');
                                        } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="well m-a-0 p-a-1">
                                        <?php echo lang('Program Specifications and Reports'); ?>
                                        <hr class="bg-info m-y-1">
                                        <?php
                                        if (!empty($active_program)) {
                                            $program_node = Orm_Node::get_one(array('system_number' => $active_program->get_system_number(), 'class_type' => Orm_Node::PROGRAM_PROGRAM, 'item_id' => $program->get_id()));
                                        }

                                        if (!empty($active_program18)) {
                                            $program_node = Orm_Node::get_one(array('system_number' => $active_program18->get_system_number(), 'class_type' => Orm_Node::PROGRAM_PROGRAM18, 'item_id' => $program->get_id()));
                                        }
                                        $reviewers = $program_node->get_reviewers();
                                        ?>
                                        <?php if (count($reviewers)) { ?>
                                            <button class="btn-link p-a-0" data-toggle="modal"
                                                    data-target="#reviewers-pr-<?php echo $program->get_id() ?>">
                                                <?php echo '</strong>' . count($reviewers) . '</strong> ' . lang('Reviewers'); ?>
                                            </button>

                                            <?php ob_start(); ?>
                                            <div class="modal fade" tabindex="-1" role="dialog"
                                                 id="reviewers-pr-<?php echo $program->get_id() ?>">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
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
                                                            <button type="button" class="btn"
                                                                    data-dismiss="modal"><?php echo lang('Close') ?></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $modals[] = ob_get_contents();
                                            ob_end_clean();
                                            ?>
                                        <?php } else {
                                            echo '<strong>0</strong> ' . lang('Reviewers');
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <?php if ($ssr_node->get_id()) { ?>
                                <a href="/accreditation/item/<?php echo intval($ssr_node->get_id()) ?>"
                                   class="btn btn-block"><span class="btn-label-icon left"><i
                                                class="fa fa-eye"></i></span><?php echo lang('View') . ' SSR' ?></a>
                            <?php } else { ?>
                                <span class="btn btn-warning btn-block" disabled="disabled"><span
                                            class="btn-label-icon left"><i
                                                class="fa fa-eye"></i></span><?php echo lang('Not Started') ?></span>
                            <?php } ?>
                            <?php if ($program_node->get_id()) { ?>
                                <a href="/accreditation/item/<?php echo intval($program_node->get_id()) ?>"
                                   class="btn btn-block"><span class="btn-label-icon left"><i
                                                class="fa fa-eye"></i></span><?php echo lang('View') . ' PS / PR' ?></a>
                            <?php } else { ?>
                                <span class="btn btn-warning btn-block" disabled="disabled"><span
                                            class="btn-label-icon left"><i
                                                class="fa fa-eye"></i></span><?php echo lang('Not Started') ?></span>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="10">
                        <div class="well well-sm m-a-0">
                            <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Programs'); ?></h3>
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

<?php echo implode("\n", $modals) ?>