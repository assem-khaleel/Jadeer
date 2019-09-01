<?php

$modals = array();

/** @var $programs Orm_Program[] */
?>
<div class="table-responsive m-a-0">
    <table class="table table-bordered">
        <thead>
        <tr>
            <td class="col-md-7"><?php echo lang('Program Name'); ?></td>
            <td class="col-md-3"><?php echo lang('Reviewers'); ?></td>
            <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
        </tr>
        </thead>
        <tbody>
        <?php if ($programs) { ?>
            <?php foreach ($programs as $program) { ?>
                <tr>
                    <td><?php echo htmlfilter($program->get_name()); ?></td>
                    <td>
                        <div class="well m-a-0 p-a-1">
                            <?php echo lang('Independent Reviewers'); ?>
                            <hr class="bg-info m-y-1">
                            <?php
                            $reviewers = array_column(Orm_Acc_Independent_Reviewer::get_model()->get_all(['type' => Orm_Acc_Independent_Reviewer::TYPE_PROGRAM, 'type_id' => $program->get_id()], 0,0,[],Orm::FETCH_ARRAY), 'reviewer_id');
                            ?>
                            <?php if(count($reviewers)) { ?>
                                <button class="btn-link p-a-0" data-toggle="modal" data-target="#reviewers-<?php echo $program->get_id() ?>">
                                    <?php echo '</strong>' . count($reviewers) . '</strong> ' . lang('Reviewers'); ?>
                                </button>

                                <?php ob_start(); ?>
                                <div class="modal fade" tabindex="-1" role="dialog" id="reviewers-<?php echo $program->get_id() ?>">
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
                        <?php
                        if(!empty(Orm_Node::get_active_ssr_node())){
                            $active_ssr = Orm_Node::get_active_ssr_node();
                            $ssr_node = Orm_Node::get_one(array('system_number' => $active_ssr->get_system_number(), 'class_type' => Orm_Node::PROGRAM_SSR, 'item_id' => $program->get_id()));

                        }

                        if(!empty(Orm_Node::get_active_ssr2018_node())){
                            $active_ssr = Orm_Node::get_active_ssr2018_node();
                            $ssr_node = Orm_Node::get_one(array('system_number' => $active_ssr->get_system_number(), 'class_type' => Orm_Node::PROGRAM_SSR18, 'item_id' => $program->get_id()));

                        }

                        ?>
                        <?php if($ssr_node->get_id()) { ?>
                            <?php if($is_admin) { ?>
                                <a href="/accreditation/reviewer_independent/reviewer_list/program/<?php echo urlencode($program->get_id()); ?>" class="btn btn-sm btn-block" ><span class="btn-label-icon left"><i class="fa fa-list"></i></span><?php echo lang('Reviewers'); ?></a>
                            <?php } else { ?>
                                <a href="/accreditation/reviewer_independent/report_add_edit/<?php echo urlencode(Orm_Acc_Independent_Reviewer::get_one(['reviewer_id' => Orm_User::get_logged_user_id(),'type' => Orm_Acc_Independent_Reviewer::TYPE_PROGRAM, 'type_id' => $program->get_id()])->get_id()); ?>" class="btn btn-sm btn-block" data-toggle="ajaxModal"><span class="btn-label-icon left"><i class="fa fa-list"></i></span><?php echo lang('Reviewer Info'); ?></a>
                            <?php } ?>
                            <a href="/accreditation/item/<?php echo intval($ssr_node->get_id()) ?>" class="btn btn-sm btn-block"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View') . ' SSR' ?></a>
                        <?php } else { ?>
                            <span class="btn btn-sm btn-warning btn-block" disabled="disabled"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('Not Started') ?></span>
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

<?php echo implode("\n", $modals)?>
