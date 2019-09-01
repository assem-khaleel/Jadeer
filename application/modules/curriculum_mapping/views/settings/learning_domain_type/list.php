<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Learning Domains Types'); ?></span>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="col-md-7"><?php echo lang('Type Name'); ?></th>
            <th class="col-md-3"><?php echo lang('Static Forms'); ?></th>
<!--            <th class="col-md-7">--><?php //echo lang('Outcome'); ?><!--</th>-->
            <th class="col-md-2"><?php echo lang('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach (Orm_Learning_Domain_Type::get_all() as $key => $type) { ?>
            <tr>
                <td>
                    <?php echo htmlfilter($type->get_name_en()); ?>
                </td>
                <td>
                    <?php echo $type->get_is_statics() == 1 ? lang('Yes') : lang('No'); ?>
                </td>
                <td>
                <?php if( $type->get_is_statics() != 1){ ?>
                    <a class="btn btn-block" href="/curriculum_mapping/settings/learning_domain_type_add_edit/<?php echo intval($type->get_id()); ?>" data-toggle="ajaxModal">
                        <span class="btn-label-icon left fa fa-edit"></span><?php echo lang('Edit'); ?>
                    </a>
                    <a class="btn btn-block" href="/curriculum_mapping/settings/learning_domain_type_delete/<?php echo intval($type->get_id()); ?>" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction">
                        <span class="btn-label-icon left fa fa-trash-o"></span><?php echo lang('Delete'); ?>
                    </a>
                <?php } ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>