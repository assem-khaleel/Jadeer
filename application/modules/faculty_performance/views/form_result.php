<?php
/* @var  Orm_Fp_Forms $form */
/* @var Orm_Fp_Forms_Inputs[] $inputs */
/* @var Orm_Fp_Forms_Result[] $result */

$rows = Orm_Fp_Forms_Result::get_result($inputs, $result);
?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <?php if ($inputs) { ?>
                    <?php foreach ($inputs as $input) { ?>
                        <th data-input="<?php echo (int)$input->get_id(); ?>"><?php echo htmlfilter($input->get_label()); ?></th>
                    <?php } ?>
                <?php } ?>
                
                <?php if ($actions) { ?>
                    <td><?php echo lang('Actions'); ?></td>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php if ($rows) { ?>
                <?php foreach ($rows as $row) { ?>
                    <tr>
                        <?php $ids = ''; ?>
                        <?php if ($inputs) { ?>
                            <?php foreach ($inputs as $input) { ?>
                                <?php
                                $result_id = isset($row[$input->get_id()]['id']) ? intval($row[$input->get_id()]['id']) : 0;
                                $ids .= "&ids[{$input->get_id()}]={$result_id}";
                                ?>
                                <td><?php echo isset($row[$input->get_id()]['value']) ? htmlfilter($row[$input->get_id()]['value']) : ''; ?></td>
                            <?php } ?>
                        <?php } ?>
                        
                        <?php if ($actions) { ?>
                            <td class="text-center">
                                <a href="/faculty_performance/edit/<?php echo intval($type_id) ?>?form_id=<?php echo $form->get_id() . $ids ?>" data-toggle="ajaxModal" class="btn btn-sm btn-block" title="<?php echo lang('Edit') ?>">
                                    <span class="btn-label-icon left fa fa-edit" aria-hidden="true"></span>
                                    <?php echo lang('Edit') ?>
                                </a>
                                <a href="/faculty_performance/delete/<?php echo intval($type_id) ?>?form_id=<?php echo $form->get_id() . $ids ?>" data-toggle="deleteAction" message="<?php echo lang('Are you sure ?') ?>" class="btn btn-sm btn-block" title="<?php echo lang('Delete') ?>">
                                    <span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span>
                                    <?php echo lang('Delete') ?>
                                </a>
                            </td>
                        <?php } ?>
                    <tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="<?php echo count($inputs) + intval($actions);?>">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Data'); ?></h3>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

<?php if (!empty($pager)) { ?>
    <div class="table-footer">
        <?php echo $pager;  ?>
    </div>
<?php } ?>