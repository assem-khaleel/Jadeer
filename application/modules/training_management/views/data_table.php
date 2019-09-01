<?php
/* @var $all_training Orm_Tm_Training[] */

?>
<?php if (empty($all_training)) { ?>
    <div class="alert alert-default">
        <div class="m-b-1">
            <?php echo lang('There are no') . ' ' . lang('Training Management'); ?>
        </div>
        <?php if(Orm_Tm_Training::check_if_can_add()){?>
            <a class="btn btn-block"
               href="/training_management/add"><span
                    class="btn-label-icon left fa fa-plus"></span> <?php echo lang('Add') . ' ' . lang('Training'); ?>
            </a>
        <?php } ?>
      
    </div>
<?php } else { ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-lg-3"><?php echo lang('Name'); ?></th>
            <th class="col-lg-2"><?php echo lang('Type'); ?></th>
            <th class="col-lg-2"><?php echo lang('Organizations'); ?></th>
            <th class="col-lg-2"><?php echo lang('Creator'); ?></th>
            <th class="col-lg-3 text-center"><?php echo lang('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($all_training as $training) { ?>
            <tr>
                <td>
                    <span><?php echo htmlfilter($training->get_name()) ?></span>
                </td>
                <td>
                    <span><?php echo htmlfilter($training->get_type_obj()->get_name()) ?></span>
                </td>
                <td>
                    <span><?php echo htmlfilter($training->get_organization()) ?></span>
                </td>

                <td>
                    <span><?php $user_name = Orm_User::get_instance($training->get_creator_id());
                         echo htmlfilter($user_name->get_full_name())
                        ?>

                    </span>
                </td>


                <td class="td last_column_border text-center">
                    <?php if($training->check_if_can_view()){ ?>
                    <a class="btn btn-block"
                       href="/training_management/view/<?php echo urlencode($training->get_id())?>"><span
                            class="btn-label-icon left fa fa-eye"></span> <?php echo lang('View'); ?></a>
                    <?php }?>
                    <?php if ($training->check_if_can_modify()) { ?>
                        <?php if($training->can_map_with_survey() ){?>

                            <?php if(Orm_Tm_Survey::get_count(array('training_id'=>$training->get_id())) != 0 ){ ?>
                                <a class="btn btn-block"
                                   href="/training_management/survey/<?php echo intval($training->get_id()) ?>"><span
                                        class="btn-label-icon left fa fa-link"></span> <?php echo lang('Survey Mapping'); ?>
                                </a>
                            <?php }else{ ?>
                                <a class="btn btn-block"
                                   href="/training_management/manage_survey/<?php echo intval($training->get_id()) ?>"><span
                                        class="btn-label-icon left fa fa-link"></span> <?php echo lang('Manage Survey'); ?>
                                </a>
                            <?php } ?>
                        <?php }?>

                        <a class="btn btn-block"
                           href="/training_management/member_list/<?php echo intval($training->get_id())?>"><span
                                class="btn-label-icon left fa fa-users"></span> <?php echo lang('Certified Members'); ?>
                        </a>
                        <a class="btn btn-block"
                           href="/training_management/edit/<?php echo intval($training->get_id()) ?>"><span
                                class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?>
                        </a>

                        <?php if ($training->check_if_can_delete()) { ?>
                            <a class="btn btn-block" message="<?php echo lang('Are you sure ?') ?>"
                               data-toggle="deleteAction"
                               href="/training_management/delete/<?php echo intval($training->get_id()) ?>"><span
                                    class="btn-label-icon left fa fa-trash-o"></span> <?php echo lang('Delete'); ?>
                            </a>
                        <?php } ?>
                    <?php } ?>



                </td>
            </tr>
        <?php } ?>
        </tbody>

    </table>
    <?php echo $pager ?>
<?php } ?>
