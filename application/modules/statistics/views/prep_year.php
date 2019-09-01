<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/19/16
 * Time: 4:50 PM
 */
/** @var string $pager */
/** @var Orm_Data_Preparatory_Year[] $items */
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
            <a href="/statistics/prep_year/1/<?php echo $query_string; ?>" class="btn btn-sm text_default"><span class="btn-label-icon left icon fa fa-file-pdf-o"></span> <?php echo lang('PDF') ?></a>
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
                            if(isset($fltr['academic_year'])){?>
                                <?php $selected = $year['year'] == $fltr['academic_year'] ? 'selected="selected"' : ''; }?>
                                <option value="<?php echo $year['year']; ?>" <?php echo $selected; ?>><?php echo $year['year']; ?></option>
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
<?php } ?>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption"><?php echo lang('Preparatory Year'); ?></div>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th><?php echo lang('Academic Year') ?></th>
            <th><?php echo lang('Stream') ?></th>
            <th><?php echo lang('Gender') ?></th>
            <th><?php echo lang('Nationality') ?></th>
            <th><?php echo lang('Student Count') ?></th>
            <th><?php echo lang('Teaching Staff Count') ?></th>
            <th><?php echo lang('Completion Count') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item) { ?>
            <tr>
                <td><?php echo htmlfilter($item->get_academic_year()); ?></td>
                <td><?php echo htmlfilter($item->get_stream()); ?></td>
                <td><?php echo Orm_User::$gender_list[$item->get_gender()]; ?></td>
                <td><?php echo $item->get_nationality() == 's' ? 'Saudi' : 'Non-Saudi'; ?></td>
                <td><?php echo $item->get_student_count(); ?></td>
                <td><?php echo $item->get_teaching_staff_count(); ?></td>
                <td><?php echo $item->get_completion_count(); ?></td>
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