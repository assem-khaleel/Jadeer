<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/17/16
 * Time: 2:24 PM
 */
/** @var string $pager */
/** @var Orm_Data_Level_Enrolled[] $items */
/** @var array $fltr */
?>
<?php if (!isset($pdf) || !$pdf) { ?>
    <div class="box bg-primary p-a-2">
        <div class="pull-left">
            <button aria-controls="filters" aria-expanded="false" data-target="#filters" data-toggle="collapse" type="button" class="btn btn-sm ">
                <span class="fa fa-filter"></span>
            </button>
            <?php echo lang('Filters') ?>
        </div>
        <?php
        $url = $this->input->server('REQUEST_URI');
        $explode_url = explode('?', $url);
        $query_string = empty($explode_url[1]) ? '' : ('?' . $explode_url[1]);
        ?>
        <div class="pull-right">
            <a href="/statistics/level_enrolled/1/<?php echo $query_string; ?>" class="btn btn-sm text-default"><span class="btn-label-icon left icon fa fa-file-pdf-o"></span> <?php echo lang('PDF') ?></a>
        </div>
    </div>
    <form method="GET" class="form-horizontal">
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
                                <?php $selected = $year['year'] == $fltr['academic_year'] ? 'selected="selected"' : '';} ?>
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
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('Gender'); ?></label>
                    <div class="col-sm-9">
                        <select name="fltr[gender]" class="form-control">
                            <option value=""><?php echo lang('Both'); ?></option>
                            <option value="<?php echo Orm_User::GENDER_MALE; ?>" <?php echo ( isset($fltr['gender']) && $fltr['gender'] == Orm_User::GENDER_MALE ) ? 'selected="selected"' : ''; ?>><?php echo Orm_User::$gender_list[Orm_User::GENDER_MALE]; ?></option>
                            <option value="<?php echo Orm_User::GENDER_FEMALE; ?>" <?php echo ( isset($fltr['gender']) && $fltr['gender'] == Orm_User::GENDER_FEMALE ) ? 'selected="selected"' : ''; ?>><?php echo Orm_User::$gender_list[Orm_User::GENDER_FEMALE]; ?></option>
                        </select>
                    </div>
                </div>
                <div class="clearfix">
                    <button type="submit" class="btn pull-right "><span class="btn-label-icon left"><i class="fa fa-filter"></i></span><?php echo lang('Search'); ?></button>
                </div>
            </div>
        </div>
    </form>
<?php } ?>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption"><?php echo lang('Completion Rate'); ?></div>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th><?php echo lang('Academic Year') ?></th>
            <th><?php echo lang('College') ?></th>
            <th><?php echo lang('Program') ?></th>
            <th><?php echo lang('Gender') ?></th>
            <th><?php echo lang('Nationality') ?></th>
            <th><?php echo lang('Level') ?></th>
            <th><?php echo lang('Enrolled Count') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item) { ?>
            <tr>
                <td><?php echo htmlfilter($item->get_academic_year()); ?></td>
                <td><?php echo htmlfilter($item->get_program_obj()->get_department_obj()->get_college_obj()->get_name()); ?></td>
                <td><?php echo htmlfilter($item->get_program_obj()->get_name()); ?></td>
                <td><?php echo Orm_User::$gender_list[$item->get_gender()]; ?></td>
                <td><?php echo $item->get_nationality() == 's' ? 'Saudi' : 'Non-Saudi'; ?></td>
                <td><?php echo htmlfilter($item->get_level()); ?></td>
                <td><?php echo $item->get_enrolled_count(); ?></td>
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
