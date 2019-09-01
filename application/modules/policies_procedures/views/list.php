<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 22/03/17
 * Time: 01:16 م
 */
/** @var $item Orm_Policies_Procedures */
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Policies & Procedures') ?>
        </div>
    </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-9"><?php echo lang('Name'); ?></th>
                <th class="col-lg-3 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                   <?php echo lang('Statements'); ?>
                </td>
                <td class="td last_column_border text-center">
                    <a class="btn btn-block" data-toggle="ajaxModal" href="/policies_procedures/update_information/<?php echo (int) $item->get_id(); ?>/statement"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                </td>
            </tr>
            <tr>
                <td>
                   <?php echo lang('Definitions'); ?>
                </td>
                <td class="td last_column_border text-center">
                    <a class="btn btn-block" data-toggle="ajaxModal" href="/policies_procedures/update_information/<?php echo (int) $item->get_id(); ?>/definition"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                </td>
            </tr>
            <tr>
                <td>
                   <?php echo lang('Audience'); ?>
                </td>
                <td class="td last_column_border text-center">
                    <a class="btn btn-block" data-toggle="ajaxModal" href="/policies_procedures/update_information/<?php echo (int) $item->get_id(); ?>/audience"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo lang('Reason for policy'); ?>
                </td>
                <td class="td last_column_border text-center">
                    <a class="btn btn-block" data-toggle="ajaxModal" href="/policies_procedures/update_information/<?php echo (int) $item->get_id(); ?>/reason"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo lang('Compliance'); ?>
                </td>
                <td class="td last_column_border text-center">
                    <a class="btn btn-block" data-toggle="ajaxModal" href="/policies_procedures/update_information/<?php echo (int) $item->get_id(); ?>/compliance"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo lang('Roles & Responsibilities'); ?>
                </td>
                <td class="td last_column_border text-center">
                    <a class="btn btn-block" data-toggle="ajaxModal" href="/policies_procedures/add_edit_response/<?php echo (int) $item->get_id(); ?>/responsible"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo lang('Related regulations statutes and related policies'); ?>
                </td>
                <td class="td last_column_border text-center">
                    <a class="btn btn-block" data-toggle="ajaxModal" href="/policies_procedures/update_information/<?php echo (int) $item->get_id(); ?>/regulations"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo lang('Contacts'); ?>
                </td>
                <td class="td last_column_border text-center">
                    <a class="btn btn-block" data-toggle="ajaxModal" href="/policies_procedures/add_edit_contact/<?php echo (int) $item->get_id(); ?>/contact"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo lang('Document history'); ?>
                </td>
                <td class="td last_column_border text-center">
                    <a class="btn btn-block" data-toggle="ajaxModal" href="/policies_procedures/update_information/<?php echo (int) $item->get_id(); ?>/history"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                </td>
            </tr>
                <tr>
                <td>
                    <?php echo lang('Procedures'); ?>
                </td>
                <td class="td last_column_border text-center">
                    <a class="btn btn-block" data-toggle="ajaxModal" href="/policies_procedures/update_information/<?php echo (int) $item->get_id(); ?>/procedures"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo lang('Standards'); ?>
                </td>
                <td class="td last_column_border text-center">
                    <a class="btn btn-block" data-toggle="ajaxModal" href="/policies_procedures/update_information/<?php echo (int) $item->get_id(); ?>/standards"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo lang('Forms & Upload Files'); ?>
                </td>
                <td class="td last_column_border text-center">
                    <a class="btn btn-block"  href="/policies_procedures/view_files/<?php echo (int) $item->get_id(); ?>"><span class="btn-label-icon left fa fa-eye"></span> <?php echo lang('View'); ?></a>
                </td>
            </tr>
            </tbody>
        </table>
</div>
