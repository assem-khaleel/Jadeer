<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 4/19/17
 * Time: 1:41 PM
 */
/** @var string $type */
/** @var int $type_id */

$reviewer = Orm_Acc_Independent_Reviewer::get_one(['reviewer_id' => Orm_User::get_logged_user_id(), 'type' => $type, 'type_id' => $type_id]);

if ($reviewer->get_type() == Orm_Acc_Independent_Reviewer::TYPE_INSTITUTION) {
    if(!empty(Orm_Node::get_active_institutional_node())){
        $root_node = Orm_Node::get_active_institutional_node();
    }

    if(!empty(Orm_Node::get_active_institutional2018_node())){
        $root_node = Orm_Node::get_active_institutional_node();
    }

} else {


    if(!empty(Orm_Node::get_active_ssr_node())){
        $root_node = Orm_Node::get_active_ssr_node();
        $root_node = Orm_Node::get_one(['system_number' => $root_node->get_system_number(), 'class_type' => Orm_Node::PROGRAM_SSR]);
    }

    if( Orm_Node::get_active_ssr2018_node()){
        $root_node = Orm_Node::get_active_ssr2018_node();
        $root_node = Orm_Node::get_one(['system_number' => $root_node->get_system_number(), 'class_type' => Orm_Node::PROGRAM_SSR18]);
    }

}

?>
<div class="table-primary">
    <div class="table-header">
        <span class="panel-title"><?php echo lang('Reviewer Information') ?></span>
        <span class="panel-heading-controls">
            <a href="/accreditation/reviewer_independent/report_add_edit/<?php echo urlencode($reviewer->get_id()); ?>" data-toggle="ajaxModal" class="btn btn-sm pull-right" ><span class="btn-label-icon left"><i class="fa fa-file"></i></span><?php echo lang('Update Info'); ?></a>
        </span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-light">
            <tbody>
            <tr>
                <td><?php echo lang('Reviewer Name') ?></td>
                <td class="text-xs-right"><?php echo $reviewer->get_reviewer_obj()->get_full_name(true); ?></td>
            </tr>
            <tr>
                <td><?php echo lang('Reviewer CV') ?></td>
                <td class="text-xs-right"><a href="<?php echo $reviewer->get_cv_attachment(); ?>" class="btn btn-sm btn-primary"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
            </tr>
            <tr>
                <td><?php echo lang('Reviewer Report') ?></td>
                <td class="text-xs-right"><a href="<?php echo $reviewer->get_report_attachment(); ?>" class="btn btn-sm btn-primary"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
            </tr>
            <tr>
                <td><?php echo lang('Documents to Review') ?></td>
                <td class="text-xs-right"><a href="/accreditation/item/<?php echo intval($root_node->get_id()) ?>" class="btn btn-sm btn-primary"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View') ?></a></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>