<?php
/** @var $reviewers Orm_Acc_Independent_Reviewer[] */
/** @var $pager string */
/** @var $type_id int */

if ($type == Orm_Acc_Independent_Reviewer::TYPE_INSTITUTION) {

    if(!empty(Orm_Node::get_active_institutional_node())){
        $node = Orm_Node::get_active_institutional_node();
    }

    if(!empty(Orm_Node::get_active_institutional2018_node())){
        $node = Orm_Node::get_active_institutional2018_node();
    }

} else {
    $filter = array('system_number' => Orm_Node::get_active_ssr_node()->get_system_number(), 'class_type' => Orm_Node::PROGRAM_SSR, 'item_id' => $type_id);

    if( Orm_Node::get_count($filter) != 0){
        $node = Orm_Node::get_one($filter);
    }
    $filter_18 = array('system_number' => Orm_Node::get_active_ssr2018_node()->get_system_number(), 'class_type' => Orm_Node::PROGRAM_SSR18, 'item_id' => $type_id);
    if( Orm_Node::get_count($filter_18) != 0){
        $node = Orm_Node::get_one($filter_18);
    }

}


?>
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">
            <?php echo lang('Reviewers') . ':'.  ($type == Orm_Acc_Independent_Reviewer::TYPE_PROGRAM ? htmlfilter(Orm_Program::get_instance($type_id)->get_name()) : lang($type)); ?>
            <?php if($node->get_id()) { ?>
                <a href="/accreditation/item/<?php echo intval($node->get_id()) ?>" class="btn btn-link p-a-0"><?php echo lang('View'); ?></a>
            <?php } ?>
        </span>
        <div class="panel-heading-controls">
            <a class="btn btn-xs btn-success btn-outline btn-outline-colorless" href="/accreditation/reviewer_independent/reviewer_add_edit/<?php echo urlencode($type); ?>/<?php echo intval($type_id); ?>" data-toggle="ajaxModal" >
                <span class="btn-label-icon left"><i class="fa fa-plus"></i></span> <?php echo lang('Add').' '.lang('Reviewer'); ?>
            </a>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
            <tr class="bg-primary" >
                <td class="col-md-7"><?php echo lang('Reviewer Name'); ?></td>
                <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
            </tr>
            </thead>
            <tbody>
            <?php if ($reviewers) { ?>
                <?php foreach ($reviewers as $reviewer) { ?>
                    <tr>
                        <td><?php echo $reviewer->get_reviewer_obj()->draw_compose_link(); ?></td>
                        <td class="text-center">
                            <a href="/accreditation/reviewer_independent/reviewer_add_edit/<?php echo urlencode($type); ?>/<?php echo intval($type_id); ?>/<?php echo urlencode($reviewer->get_id()); ?>" data-toggle="ajaxModal" class="btn btn-sm btn-block" ><span class="btn-label-icon left"><i class="fa fa-edit"></i></span><?php echo lang('Edit'); ?></a>
                            <a href="/accreditation/reviewer_independent/report_add_edit/<?php echo urlencode($reviewer->get_id()); ?>" data-toggle="ajaxModal" class="btn btn-sm btn-block" ><span class="btn-label-icon left"><i class="fa fa-file"></i></span><?php echo lang('CV & Report'); ?></a>
                            <a href="/accreditation/reviewer_independent/reviewer_delete/<?php echo urlencode($reviewer->get_id()); ?>" data-toggle="deleteAction" message="<?php echo lang('Are you sure ?')?>" class="btn btn-sm btn-block" ><span class="btn-label-icon left"><i class="fa fa-trash-o"></i></span><?php echo lang('Delete'); ?></a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="10">
                        <div class="well well-sm m-a-0">
                            <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Reviewers'); ?></h3>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php if (!empty($pager)) { ?>
    <div class="table-footer">
        <?php echo $pager; ?>
    </div>
<?php } ?>