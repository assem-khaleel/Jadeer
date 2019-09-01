<?php
/* @var $node Orm_Node */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open('', 'id="node_form"'); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('The responsible users of this branch:'); ?></h4>
        </div>
        <div class="modal-body">
            <div class="<?php echo(!Orm_User::has_role_type(Orm_Role::ROLE_NOT_ADMIN) ? 'col-md-6' : 'col-md-12') ?>">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th class="col-md-8">
                            <span><?php echo lang('Assessor') ?></span>
                        </th>
                        <th class="col-md-4">
                            <button type="button" user-type="assessor"
                                    class="add_user btn btn-block btn-sm"
                                    <?php echo data_loading_text() ?>>
                                <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Assessor'); ?>
                            </button>
                        </th>
                    </tr>
                    <?php
                    $is_assessors = false;
                    foreach ($node->get_parent_assessors() as $assessor) :
                        if (!$is_assessors) {
                            $is_assessors = true;
                        }
                        ?>
                        <tr>
                            <td><?php echo htmlfilter($assessor->get_user_obj()->get_full_name()); ?>   </td>
                            <td>-</td>
                        </tr>
                    <?php endforeach; ?>
                    <?php foreach ($node->get_assessors() as $assessor) :
                        if (!$is_assessors) {
                            $is_assessors = true;
                        }
                        ?>
                        <tr>
                            <td><?php echo htmlfilter($assessor->get_user_obj()->get_full_name()); ?></td>
                            <td class="text-right">
                                <?php if ($node->check_if_can_assign_user()) : ?>
                                    <a href="/accreditation/delete_user/assessor/<?php echo (int)$node->get_id(); ?>/<?php echo (int)$assessor->get_assessor_id() ?>"
                                       data-toggle="deleteAction" class="btn btn-block btn-sm" message="<?php echo lang('Are you sure ?')?>">
                                        <span aria-hidden="true" class="btn-label-icon left fa fa-trash-o"></span>
                                        <?php echo lang('Delete'); ?>
                                    </a>
                                <?php else : ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach;
                    if (!$is_assessors) : ?>
                        <tr>
                            <td colspan="10" >
                                <div class="well well-sm m-a-0">
                                    <h3 style="font-size: 17px" class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Assessor'); ?></h3>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>

            <?php if (!Orm_User::has_role_type(Orm_Role::ROLE_NOT_ADMIN)) : ?>
                <div class="col-md-6">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th class="col-md-8">
                                <span><?php echo lang('Reviewer') ?></span>
                            </th>
                            <th class="col-md-4">
                                <button type="button" user-type="reviewer"
                                        class="add_user btn btn-block btn-sm"
                                        <?php echo data_loading_text() ?>>
                                    <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Reviewer'); ?>
                                </button>
                            </th>
                        </tr>
                        <?php
                        $reviewers = array();
                        Orm_Node_Reviewer::get_parent_reviewers($node->get_id(), $reviewers);

                        $is_reviewers = false;
                        foreach ($reviewers as $reviewer) :
                            if (!$is_reviewers) {
                                $is_reviewers = true;
                            }
                            ?>
                            <tr>
                                <td><?php echo htmlfilter($reviewer->get_user_obj()->get_full_name()); ?>   </td>
                                <td>-</td>
                            </tr>
                        <?php endforeach; ?>
                        <?php foreach (Orm_Node_Reviewer::get_all(array('node_id' => $node->get_id())) as $reviewer) :
                            if (!$is_reviewers) {
                                $is_reviewers = true;
                            }
                            ?>
                            <tr>
                                <td><?php echo htmlfilter($reviewer->get_user_obj()->get_full_name()); ?></td>
                                <td class="text-right">
                                    <a href="/accreditation/delete_user/reviewer/<?php echo (int)$node->get_id(); ?>/<?php echo (int)$reviewer->get_reviewer_id() ?>"
                                       data-toggle="deleteAction" class="btn btn-block btn-sm" message="<?php echo lang('Are you sure ?')?>">
                                        <span aria-hidden="true" class="btn-label-icon left fa fa-trash-o"></span>
                                        <?php echo lang('Delete'); ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach;
                        if (!$is_reviewers) : ?>
                            <tr>
                                <td colspan="10" >
                                    <div class="well well-sm m-a-0">
                                        <h3 style="font-size: 17px" class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Reviewer'); ?></h3>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            <?php endif; ?>
            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left"
                    data-dismiss="modal"><span class="btn-label-icon left fa fa-times"></span><?php echo lang('Close'); ?></button>
            <div class="clearfix"></div>
        </div>
        <input type="hidden" name="node_id" value="<?php echo (int)$node->get_id(); ?>"/>
        <?php echo form_close(); ?>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
<script type="text/javascript">

    init_data_toggle();

    $(".add_user").click(function () {
        $.ajax({
            type: "POST",
            url: "/accreditation/add_user",
            data: {
                node_id: <?php echo (int) $node->get_id(); ?>,
                role: $(this).attr('user-type')
            },
            dataType: "json"
        }).done(function (msg) {
            $('#ajaxModalDialog').html(msg.html);
        }).fail(function () {
            window.location.reload();
        });
    });

    function after_delete_action(element, msg) {
        if (msg.status) {
            $('#ajaxModalDialog').html(msg.html);
        } else {
            window.location.reload();
        }
    }
</script>
