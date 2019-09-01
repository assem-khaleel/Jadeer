<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/19/16
 * Time: 4:52 PM
 */
/** @var string $pager */
/** @var Orm_Data_Research_Budget[] $items */
/** @var array $fltr */
?>
<div class="box p-a-1 clearfix">
    <div class="pull-left">
        <button aria-controls="filters" aria-expanded="false" data-target="#filters" data-toggle="collapse" type="button" class="btn btn-sm ">
            <span class="fa fa-filter"></span>
        </button>
        <?php echo lang('Filters') ?>
    </div>

    <div class="pull-right">
        <a href="" class="btn btn-sm text_default"><span class="btn-label-icon left icon fa fa-file-pdf-o"></span> <?php echo lang('PDF') ?></a>
    </div>
</div>
<form method="GET">
    <div id="filters" class="collapse in" aria-expanded="true" style="">
        <div class="well">
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('Academic Year'); ?></label>
                <div class="col-sm-9">
                    <select name="fltr[academic_year]" class="form-control">
                        <option value=""><?php echo lang('All Years'); ?></option>
                        <?php foreach (Orm_Semester::get_last_five_years() as $year) {
                        $selected='';
                        if(isset($fltr['academic_year'])){ ?>
                            <?php $selected = $year['year'] == $fltr['academic_year'] ? 'selected="selected"' : ''; }?>
                            <option value="<?php echo $year['year']; ?>" <?php echo $selected; ?>><?php echo $year['year']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('College'); ?></label>
                <div class="col-sm-9">
                    <select name="fltr[college_id]" class="form-control" onchange="get_programs_by_college(this, 0, 1);">
                        <option value=""><?php echo lang('All Colleges'); ?></option>
                        <?php foreach (Orm_College::get_all() as $college) {
                        $selected='';
                        if(isset($fltr['college_id'])){ ?>
                            <?php $selected = $college->get_id() == $fltr['college_id'] ? 'selected="selected"' : ''; }?>
                            <option value="<?php echo $college->get_id(); ?>" <?php echo $selected; ?>><?php echo htmlfilter($college->get_name()); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('Program'); ?></label>
                <div class="col-sm-9">
                    <select name="fltr[program_id]" class="form-control" id="program_block">
                        <option value=""><?php echo lang('All Programs'); ?></option>
                        <?php if (isset($fltr['college_id'])) { ?>
                            <?php foreach (Orm_Program::get_all(array('college_id' => $fltr['college_id'])) as $program) { ?>
                                <?php $selected = $program->get_id() == $fltr['program_id'] ? 'selected="selected"' : ''; ?>
                                <option value="<?php echo $program->get_id(); ?>" <?php echo $selected; ?>><?php echo htmlfilter($program->get_name()); ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="clearfix">
                <button type="submit" class="btn pull-right "><span class="btn-label-icon left"><i class="fa fa-filter"></i></span><?php echo lang('Search'); ?></button>
            </div>
        </div>
    </div>
</form>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption"><?php echo lang('Research Statistics'); ?></div>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th><?php echo lang('Academic Year') ?></th>
            <th><?php echo lang('College') ?></th>
            <th><?php echo lang('Program') ?></th>
            <th><?php echo lang('Research Budget Total Amount') ?></th>
            <th><?php echo lang('Research Budget Actual Expenditure') ?></th>
            <th><?php echo lang('Publication Count') ?></th>
            <th><?php echo lang('Conference Count') ?></th>
            <th><?php echo lang('Male Faculty Members') ?></th>
            <th><?php echo lang('Female Faculty Members') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item) { ?>
            <tr>
                <td><?php echo htmlfilter($item->get_academic_year()); ?></td>
                <td><?php echo htmlfilter($item->get_program_obj()->get_department_obj()->get_college_obj()->get_name()); ?></td>
                <td><?php echo htmlfilter($item->get_program_obj()->get_name()); ?></td>
                <td><?php echo $item->get_research_budget_total_amount(); ?></td>
                <td><?php echo $item->get_research_budget_actual_expenditure(); ?></td>
                <td><?php echo $item->get_publications_count(); ?></td>
                <td><?php echo $item->get_conferece_presentation_count(); ?></td>
                <td><?php echo $item->get_male_faculty_member_count(); ?></td>
                <td><?php echo $item->get_female_faculty_member_count(); ?></td>
            </tr>
        <?php } ?>
        <?php if(empty($items)) { ?>
            <tr>
                <td colspan="12">
                    <div class="alert m-a-0">
                        <?php echo  lang("There is no").' '.lang('Data to be displayed.')?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php if ($pager) { ?>
        <div class="table-footer">
            <?php echo $pager; ?>
        </div>
    <?php } ?>
</div>