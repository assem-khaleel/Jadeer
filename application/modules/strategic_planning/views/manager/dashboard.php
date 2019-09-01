<?php
/**
 * Created by PhpStorm.
 * User: Mazen Dabet
 * Date: 10/1/15
 * Time: 1:58 PM
 */
/** @var Orm_Sp_Vision $vision */
/** @var Orm_Sp_Mission $mission */
/** @var Orm_Sp_Strategy $strategy */
/** @var array $fltr */
$goal_counter = 0;
$value_counter = 0;
?>
<div class="panel panel-primary panel-dark">
    <div class="panel-heading">
        <form method="GET">
            <div class="row">
                <div style="margin-bottom: 10px;" class="col-md-3">
                    <a type="reset" href="/strategic_planning/"
                       class="btn btn-md btn-block"><?php echo lang('Institution'); ?></a>
                </div>
                <div style="margin-bottom: 10px;" class="col-md-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><?php echo lang('College'); ?>:</span>
                        <select name="fltr[college_id]" class="form-control">
                            <option value="0"><?php echo lang('All College'); ?></option>
                            <?php foreach (Orm_College::get_all() as $college) { ?>
                                <?php $selected = $college->get_id() == $fltr['college_id'] ? 'selected="selected"' : ''; ?>
                                <option
                                    value="<?php echo $college->get_id(); ?>" <?php echo $selected; ?>><?php echo htmlfilter($college->get_name()); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div style="margin-bottom: 10px;" class="col-md-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><?php echo lang('Unit'); ?>:</span>
                        <select id="program_block" name="fltr[unit_id]" class="form-control">
                            <option value="0"><?php echo lang('All Units'); ?></option>
                            <?php foreach (Orm_Unit::get_all() as $unit) { ?>
                                <?php $selected = $unit->get_id() == $fltr['unit_id'] ? 'selected="selected"' : ''; ?>
                                <option
                                    value="<?php echo $unit->get_id(); ?>" <?php echo $selected; ?>><?php echo htmlfilter($unit->get_name()); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div style="margin-bottom: 10px;" class="col-md-3">
                    <input type="hidden" value="1" name="id">
                    <button type="submit"
                            class="btn btn-md btn-block"><?php echo lang('Search'); ?></button>
                </div>
            </div>
        </form>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <span class="panel-title"><i class="fa fa-eye"></i> <?php echo lang('Vision'); ?></span>

                        <div class="panel-heading-controls col-sm-4">
                            <a href="/strategic_planning/vision/add_edit?id=<?php echo (int) $vision->get_id(); ?>"
                               data-toggle="ajaxModal" class="btn "><span class="btn-label-icon left"><i class="fa fa-edit"></i></span><?php echo lang('Edit'); ?></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php echo htmlfilter($vision->get_title()); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <span class="panel-title"><i class="fa fa-bullseye"></i> <?php echo lang('Mission'); ?></span>

                        <div class="panel-heading-controls col-sm-4">
                            <a href="/strategic_planning/mission/add_edit?vision_id=<?php echo (int) $vision->get_id(); ?>"
                               data-toggle="ajaxModal" class="btn "><span class="btn-label-icon left"><i class="fa fa-edit"></i></span><?php echo lang('Edit'); ?></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php echo htmlfilter($mission->get_title()); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="table-primary">
                    <div class="table-header">
						<span class="table-caption">
							<?php echo lang('Goals'); ?>
						</span>

                        <div class="panel-heading-controls col-sm-4">
                            <a href="/strategic_planning/goal/add_edit?mission_id=<?php echo $mission->get_id(); ?>"
                               data-toggle="ajaxModal" class="btn "><span class="btn-label-icon left"><i class="fa fa-plus"></i></span><?php echo lang('Add').' '.lang('New'); ?></a>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo lang('Title'); ?></th>
                            <th class="text-center"><?php echo lang('Actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach (Orm_Sp_Goal::get_all(array('mission_id' => $mission->get_id())) as $goal) { ?>
                            <tr>
                                <td><?php echo ++$goal_counter; ?></td>
                                <td><?php echo htmlfilter($goal->get_title()); ?></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-block"
                                       href="/strategic_planning/goal/add_edit?id=<?php echo $goal->get_id(); ?>"
                                       data-toggle="ajaxModal"><span class="btn-label-icon left"><i
                                                class="fa fa-edit"></i></span><?php echo lang('Edit'); ?></a> |
                                    <a class="btn btn-sm btn-block"
                                       href="/kpi/remove?id=<?php echo $goal->get_id(); ?>"
                                       message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left"><i
                                                class="fa fa-trash-o"></i></span><?php echo lang('Delete'); ?></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="table-primary">
                    <div class="table-header">
						<span class="table-caption">
							<?php echo lang('Values'); ?>
						</span>

                        <div class="panel-heading-controls col-sm-4">
                            <a href="/strategic_planning/value/add_edit/" data-toggle="ajaxModal"
                               class="btn "><span class="btn-label-icon left"><i class="fa fa-plus"></i></span><?php echo lang('Add').' '.lang('New'); ?></a>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo lang('Title'); ?></th>
                            <th class="text-center"><?php echo lang('Actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach (Orm_Sp_Values::get_all(array('strategy_id' => $strategy->get_id())) as $value) { ?>
                            <tr>
                                <td><?php echo ++$value_counter; ?></td>
                                <td><?php echo htmlfilter($value->get_title()); ?></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-block"
                                       href="/strategic_planning/value/add_edit?id=<?php echo $value->get_id(); ?>"
                                       data-toggle="ajaxModal"><span class="btn-label-icon left"><i
                                                class="fa fa-edit"></i></span><?php echo lang('Edit'); ?></a> |
                                    <a class="btn btn-sm btn-block"
                                       href="/strategic_planning/value/remove?id=<?php echo $value->get_id(); ?>"
                                       message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left"><i
                                                class="fa fa-trash-o"></i></span><?php echo lang('Delete'); ?></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php $this->load->view('objective/perspective', array()); ?>
    </div>
</div>