<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Assessment Methods'); ?></span>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-md-1">#</th>
            <th class="col-md-9"><?php echo lang('title'); ?></th>
            <th class="col-md-2 text-center"><?php echo lang('actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach (Orm_Cm_Assessment_Method::get_all() as $key => $method) { ?>
            <tr>
                <td><?php echo ($key + 1); ?></td>
                <td>
                    <b><?php echo htmlfilter($method->get_title()); ?></b>

                    <?php $components = Orm_Cm_Assessment_Component::get_all(array('assessment_method_id' => $method->get_id())); ?>
                    <?php if($components) { ?>
                        <ul>
                            <?php foreach($components as $component) { ?>
                                <li>
                                    <?php echo $component->get_title(); ?>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </td>
                <td class="text-center">
                    <a class="btn btn-block" href="/curriculum_mapping/settings/assessment_method_add_edit/<?php echo intval($method->get_id()); ?>" data-toggle="ajaxModal">
                        <span class="btn-label-icon left fa fa-edit"></span><?php echo lang('Edit'); ?>
                    </a>
                    <a class="btn btn-block" href="/curriculum_mapping/settings/assessment_method_delete/<?php echo intval($method->get_id()); ?>" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction">
                        <span class="btn-label-icon left fa fa-trash-o"></span><?php echo lang('Delete'); ?>
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>