<?php
/**
 * Created by PhpStorm.
 * User: Mazen Dabet
 * Date: 10/11/15
 * Time: 7:59 PM
 */
/** @var Orm_Sp_Strategy $strategy */
$value_counter = 0;
?>
<div class="row p-a-2">
    <div class="col-md-6 ">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="panel-title"><i class="fa fa-bullseye"></i> <?php echo lang('Mission'); ?></span>

                <div class="panel-heading-controls col-sm-4">
                    <a class="btn btn-sm pull-right" href="/strategic_planning/edit_mission?id=<?php echo (int)$strategy->get_id(); ?>"data-toggle="ajaxModal">
                        <span class="btn-label-icon left"><i class="fa fa-edit"></i></span>
                        <?php echo lang('Edit'); ?>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <?php echo htmlfilter($strategy->get_mission()); ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="panel-title"><i class="fa fa-eye"></i> <?php echo lang('Vision'); ?></span>

                <div class="panel-heading-controls col-sm-4">
                    <a class="btn btn-sm pull-right" href="/strategic_planning/edit_vision?id=<?php echo (int)$strategy->get_id(); ?>"data-toggle="ajaxModal">
                        <span class="btn-label-icon left"><i class="fa fa-edit"></i></span>
                        <?php echo lang('Edit'); ?>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <?php echo htmlfilter($strategy->get_vision()); ?>
            </div>
        </div>
    </div>
</div>

<div class="row p-a-2">
    <div class="col-md-12">
        <div class="table-primary">
            <div class="table-header">
                <span class="table-caption">
                    <?php echo lang('Values'); ?>
                </span>

                <div class="panel-heading-controls col-sm-4">
                    <a class="btn  btn-xs pull-right" href="/strategic_planning/value/add_edit?strategy_id=<?php echo (int)$strategy->get_id(); ?>" data-toggle="ajaxModal">
                        <span class="btn-label-icon left"><i class="fa fa-plus"></i></span>
                        <?php echo lang('Add').' '.lang('New'); ?></a>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-md-1">#</th>
                    <th class="col-md-8"><?php echo lang('Title'); ?></th>
                    <th class="col-md-3 text-center"><?php echo lang('Actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $values = Orm_Sp_Values::get_all(array('strategy_id' => $strategy->get_id()));
                foreach ($values as $value) { ?>
                    <tr>
                        <td><?php echo ++$value_counter; ?></td>
                        <td><?php echo htmlfilter($value->get_title()); ?></td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-block"
                               href="/strategic_planning/value/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($value->get_id()); ?>"
                               data-toggle="ajaxModal"><span class="btn-label-icon left"><i
                                        class="fa fa-edit"></i></span><?php echo lang('Edit'); ?></a>
                            <a class="btn btn-sm btn-block"
                               href="/strategic_planning/value/delete?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($value->get_id()); ?>"
                               message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left"><i
                                        class="fa fa-trash-o"></i></span><?php echo lang('Delete'); ?></a>
                        </td>
                    </tr>
                <?php } ?>
                <?php if (empty($values)) { ?>
                    <tr>
                        <td colspan="3">
                            <div class="alert alert-default">
                                <div class="m-b-1"><?php echo lang('No values to be displayed') ?>.</div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>