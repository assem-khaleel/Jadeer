<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Learning Domains'); ?></span>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="col-md-2"><?php echo lang('Domain'); ?></th>
            <th class="col-md-2"><?php echo lang('Domain Type'); ?></th>
            <th class="col-md-7"><?php echo lang('Outcome'); ?></th>
            <th class="col-md-1"><?php echo lang('Actions'); ?></th>
        </tr>
        </thead>
        <?php if(Orm_Learning_Domain_Type::get_count() != 0){ ?>
            <?php foreach (Orm_Learning_Domain_Type::get_all()  as $type): ?>
                <thead>
                <tr>
                    <th colspan="4" class="text-center">
                        <h3 class="m-a-1">
                            <?php echo htmlfilter($type->get_name()); ?>
                        </h3>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php if(Orm_Cm_Learning_Domain::get_count(array('type'=>$type->get_id())) != 0){ ?>
                    <?php foreach (Orm_Cm_Learning_Domain::get_all(array('type'=>$type->get_id())) as $key => $domain) { ?>
                        <tr>
                            <td>
                                <span class="label label-primary"><?php echo($key + 1); ?></span>
                                <?php echo htmlfilter($domain->get_title()); ?>
                            </td>
                            <td>
                                <?php echo htmlfilter(Orm_Learning_Domain_Type::get_instance($domain->get_type())->get_name()); ?>
                            </td>
                            <td>
                                <?php if ($domain->get_learning_outcomes()) { ?>
                                    <ul class="list-group m-a-0 bg-primary">
                                        <?php foreach ($domain->get_learning_outcomes() as $outcome_key => $outcome) { ?>
                                            <li class="list-group-item no-border-hr padding-xs-hr">
                                                <span class="label label-pa-purple"><?php echo($key + 1); ?>.<?php echo $outcome_key + 1; ?></span>
                                                <?php echo htmlfilter($outcome->get_title()); ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } else { ?>
                                    <div class="alert m-a-0">
                                        <?php echo lang('There are no') . ' ' . lang('Outcomes'); ?>
                                    </div>
                                <?php } ?>
                            </td>
                            <td>
                                <a class="btn btn-block" href="/curriculum_mapping/settings/learning_domain_add_edit/<?php echo intval($domain->get_id()); ?>" data-toggle="ajaxModal">
                                    <span class="btn-label-icon left fa fa-edit"></span><?php echo lang('Edit'); ?>
                                </a>
                                <a class="btn btn-block" href="/curriculum_mapping/settings/learning_domain_delete/<?php echo intval($domain->get_id()); ?>" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction">
                                    <span class="btn-label-icon left fa fa-trash-o"></span><?php echo lang('Delete'); ?>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php }else{ ?>
                    <tr>
                        <td colspan="4">
                            <div class="alert alert-dafualt">
                                <div class="m-b-12">
                                    <?php echo lang('There are no') . ' ' . lang('Learning Domains'); ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            <?php endforeach;?>
        <?php }else{ ?>
            <tr>
                <td colspan="4">
                    <div class="alert alert-dafualt">
                        <div class="m-b-12">
                            <?php echo lang('There are no') . ' ' . lang('Learning Domain Types'); ?>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>


    </table>
</div>