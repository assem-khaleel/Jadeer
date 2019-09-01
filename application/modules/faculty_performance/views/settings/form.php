<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 10/04/17
 * Time: 12:15 م
 */
/* @var  $forms Orm_Fp_Forms  */
/* @var  $type Orm_Fp_Forms_Type  */

$this->load->view('faculty_performance/settings/left_nav');
?>
<div class="col-md-9 col-lg-9">
    <div class="table-primary">
        <div class="table-header">
            <div class="table-caption m-b-1">
                <?php echo $type->get_name() ?>
                <span class="pull-right">
                <a class="btn btn-sm slecture"  data-toggle="ajaxModal" id="add_form"  href="/faculty_performance/faculty_settings/add_edit_form/<?php echo $type->get_id()?>/0">
                    <span class="btn-label-icon left">
                        <i class="fa fa-plus"></i>
                    </span>
                   <?php echo lang('add')?>
                </a>
            </span>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td class="col-md-4"><?php echo lang('Form Name'); ?> (<?php echo lang('English') ?>)</td>
                <td class="col-md-4"><?php echo lang('Form Name'); ?> (<?php echo lang('Arabic') ?>)</td>
                <td class="col-md-2"><?php echo lang('Can Edit'); ?></td>
                <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
            </tr>
            </thead>
            <tbody>
            <?php if ($forms): ?>
                <?php foreach ($forms as $form) : /** @var $form Orm_Fp_Forms */ ?>
                    <tr>
                        <td><?php echo htmlfilter($form->get_form_name_en()); ?></td>
                        <td><?php echo htmlfilter($form->get_form_name_ar()); ?></td>
                        <td><?php echo ($form->get_is_editable() ? lang('Yes') : lang('No')); ?></td>
                        <td class="text-center">
                            <?php if($form->get_is_editable() == true):?>
                                <a href="/faculty_performance/faculty_settings/add_edit_form/<?php echo $type->get_id()?>/<?php echo $form->get_id()?>"
                                   class="btn btn-sm btn-block "  data-toggle="ajaxModal" id="edit_form"  title="<?php echo lang('Edit') ?>">
                                    <span class="btn-label-icon left fa fa-edit" aria-hidden="true">
                                    </span>
                                    <?php echo lang('Edit') ?>
                                </a>
                                <a href="/faculty_performance/faculty_settings/remove_form/<?php echo (int)$form->get_id(); ?>" class="btn btn-sm btn-block" title="<?php echo lang('Delete') ?>" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction">
                                    <span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span>
                                    <?php echo lang('Delete') ?>
                                </a>

                            <?php endif;?>
                            <?php if($form->get_is_hidden() == true):?>
                                <button type="button" class="btn btn-sm btn-block hide_form" data-id="<?php echo $form->get_id()?>"  title="<?php echo lang('Show') ?>">
                                    <span class="btn-label-icon left fa fa-eye" aria-hidden="true">
                                    </span>
                                    <?php echo lang('Show') ?>
                                </button>
                            <?php else:?>
                                <button type="button" class="btn btn-sm btn-block hide_form" data-id="<?php echo $form->get_id()?>"  title="<?php echo lang('Hide') ?>">
                                    <span class="btn-label-icon left fa fa-eye-slash" aria-hidden="true">
                                    </span>
                                    <?php echo lang('Hide') ?>
                                </button>
                            <?php endif;?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"> <?php echo lang('There are no').' '.lang('Forms for This type') ?></h3>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <?php if (!empty($pager)): ?>
            <div class="table-footer">
                <?php echo $pager; ?>
            </div>
        <?php endif; ?>
    </div>

</div>
<script>
    init_data_toggle();

    $('.hide_form').off().on('click', function () {
        var id =$(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: '/faculty_performance/faculty_settings/hidden_form/'+id,
            data: $(this).serialize(),
            dataType: "json"
        }).done(function () {

            window.location.reload();
        })
        return false;
    });
</script>

