<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 23/07/17
 * Time: 03:02 م
 */
/* @var Orm_Policies_Procedures_Files[] $files */
/* @var Orm_Policies_Procedures $policy */
?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Policies & Procedures') ?>
        </div>

        <?php
        $extra_html = form_hidden('policy_id', $policy->get_id());
        echo filter_block('/policies_procedures/filter/' . $policy->get_id(), '/policies_procedures/view_files/' . $policy->get_id(), ['keyword'], 'ajax_block', $extra_html);
        ?>

    </div>
    <?php if (empty($files)) { ?>
        <div class="alert alert-default">
            <div class="m-b-1">
                <?php echo lang('There are no') . ' ' . lang('Files has been attached'); ?>
            </div>
            <a class="btn btn-block" data-toggle="ajaxModal"
               href="/policies_procedures/get_form_file/<?php echo (int)$policy->get_id(); ?>/forms"><span
                    class="btn-label-icon left fa fa-plus"></span> <?php echo lang('Add New'); ?></a>
        </div>
    <?php } else { ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-9"><?php echo lang('File Name'); ?></th>
                <th class="col-lg-3 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($files as $file) { ?>
                <tr>
                    <td>
                        <span><?php echo xssfilter($file->get_title()) ?></span>
                    </td>
                    <td class="td last_column_border text-center">
                        <?php if ($policy->check_if_can_edit()) { ?>
                            <a class="btn btn-block" data-toggle="ajaxModal"
                               href="/policies_procedures/get_form_file/<?php echo (int)$policy->get_id(); ?>/forms/<?php echo (int)$file->get_id(); ?>"><span
                                    class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                        <?php } ?>
                        <?php if ($policy->check_if_can_delete()) { ?>

                            <a class="btn btn-block"  message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction"
                               href="/policies_procedures/remove_file/<?php echo $file->get_id(); ?>"><span
                                    class="btn-label-icon left fa fa-remove"></span> <?php echo lang('Delete'); ?></a>
                        <?php } ?>
                        <?php if (Orm_Policies_Procedures::check_if_can_generate_report() && $file->get_file_path()): ?>
                            <a href="/policies_procedures/download_file/<?php echo (int)$file->get_id() ?>"
                               class="btn btn-block">
                                <span
                                    class="btn-label-icon left fa fa-download"></span><?php echo lang('Download Attachment'); ?>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php echo $pager ?>
    <?php } ?>
</div>
