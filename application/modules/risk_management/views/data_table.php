<?php
/** @var $risk_objs Orm_Rim_Risk_Management[] */
$college_id = isset($fltr['college_id']) ? $fltr['college_id'] : 0;
$program_id = isset($fltr['program_id']) ? $fltr['program_id'] : 0;
?>
<?php  if (empty($risk_objs)) { ?>
    <div class="alert alert-default">
        <div class="m-b-1">
            <?php echo lang('There are no') .' ' . lang('Records have been Entered'); ?>
        </div>
        <a href="/risk_management/add_edit" data-toggle="ajaxModal" class="btn  btn-block" >
            <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add').' '.lang('New'); ?>
        </a>
    </div>
<?php } else { ?>
    <div class="table-responsive m-a-0">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-8"><?php echo lang('Risk'); ?></th>
                <th class="col-lg-2"><?php echo lang('Risk Level'); ?></th>
                <th class="col-lg-2 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($risk_objs as $risk) { ?>
                <tr>
                    <td>
                        <span><b><?php echo $risk->get_type_title(); ?></b></span>
                        <ul>
                            <li>
                                <span><?php echo lang('Level');?>:</span>
                                <span><?php
                                    echo $risk->get_current_level_type();
                                    if($risk->get_current_level_type_id_title()){
                                      ?>
                                        <?php  echo lang($risk->get_current_level_type_id_title()); ?>
                                    <?php } ?>
                                </span>
                            </li>
                            <li>
                                <span><?php echo lang('Type');?>:</span>
                                <span><?php echo lang($risk->get_type()); ?></span>
                            </li>
                        </ul>
                    </td>
                    <td>
                        <?php echo $risk->risk_level()?>
                    </td>
                    <td class="td last_column_border text-center">
                        <a class="btn btn-block" href="/risk_management/risk_treatment/?risk_id=<?php echo $risk->get_id(); ?>"><span class="btn-label-icon left fa fa-eye"></span> <?php echo lang('Manage'); ?></a>
                        <a class="btn btn-block" data-toggle="ajaxModal" href="/risk_management/add_edit/<?php echo $risk->get_id(); ?>"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                        <a class="btn btn-block" data-toggle="deleteAction" href="/risk_management/delete/<?php echo $risk->get_id(); ?>" message="<?php echo lang('Are you sure ?')?>"><span class="btn-label-icon left fa fa-remove"></span> <?php echo lang('Delete'); ?></a>
                    </td>
                </tr>
            <?php  } ?>
            </tbody>
        </table>
    </div>
    <?php if($pager) { ?>
        <div class="table-footer">
            <?php echo $pager ?>
        </div>
    <?php } ?>
<?php } ?>
