<?php
/**
 * @var $objective Orm_Sp_Objective
 */

$college_id = $this->input->get_post('college_id');
$program_id = $this->input->get_post('program_id');

$strategy = $objective->get_strategy_obj();

$filters = array('academic_year' => Orm_Semester::get_active_semester()->get_year());

if($college_id || ($college_id && $program_id)) {
    if($college_id) {
        if($program_id) {
            $kpi_type = Orm_Kpi_Detail::TYPE_PROGRAM;
            $filters['program_id'] = $program_id;
        } else {
            $kpi_type = Orm_Kpi_Detail::TYPE_COLLEGE;
            $filters['college_id'] = $college_id;
        }
    }
} else {
    switch ($strategy->get_item_class()) {
        case 'Orm_Sp_Strategy_Institution':
            $kpi_type = Orm_Kpi_Detail::TYPE_INSTITUTION;
            break;
        case 'Orm_Sp_Strategy_College':
            $kpi_type = Orm_Kpi_Detail::TYPE_COLLEGE;
            $filters['college_id'] = $strategy->get_item_id();
            break;
        case 'Orm_Sp_Strategy_Program':
            $kpi_type = Orm_Kpi_Detail::TYPE_PROGRAM;
            $filters['program_id'] = $strategy->get_item_id();
            break;
        default:
            $kpi_type = Orm_Kpi_Detail::TYPE_INSTITUTION;
            break;
    }
}
?>

<div class="row m-b-1">
    <div class="col-md-6">
        <div class="input-group">
            <span class="input-group-addon"><?php echo lang('College'); ?>:</span>
            <select id="college_id" class="form-control" onchange="kpi_type_filters()">
                <option value="0"><?php echo lang('Institution'); ?></option>
                <?php foreach (Orm_College::get_all() as $college) { ?>
                    <?php $selected = $college->get_id() == $college_id ? 'selected="selected"' : ''; ?>
                    <option value="<?php echo $college->get_id(); ?>" <?php echo $selected; ?>><?php echo htmlfilter($college->get_name()); ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-group">
            <span class="input-group-addon"><?php echo lang('Program'); ?>:</span>
            <select id="program_id" class="form-control" onchange="kpi_type_filters()">
                <option value="0"><?php echo lang('All Programs'); ?></option>
                <?php if (!empty($college_id)) { ?>
                    <?php foreach (Orm_Program::get_all(array('college_id' => $college_id)) as $program) { ?>
                        <?php $selected = $program->get_id() == $program_id ? 'selected="selected"' : ''; ?>
                        <option value="<?php echo $program->get_id(); ?>" <?php echo $selected; ?>><?php echo htmlfilter($program->get_name()); ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
    </div>
</div>

<div class="note bg-default padding-sm text-bold">
    <?php echo lang('Objective KPIs') ?>
</div>

<div class="row">
<?php foreach($objective->get_kpis() as $kpi) { ?>
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="panel-title"><?php echo nl2br(htmlfilter($kpi->get_kpi_obj()->get_title())); ?></span>
            </div>
            <div class="panel-body">
                <?php echo $kpi->get_kpi_obj()->draw_trend_analysis($kpi_type, $filters); ?>
            </div>
        </div>
    </div>
<?php } ?>
    <?php if (!$objective->get_kpis()) { ?>
        <div class="col-md-12">
            <div class="alert m-b-2">
                <?php echo lang('There are no') . ' ' . lang('KPIs'); ?>
            </div>
        </div>
    <?php } ?>
</div>

<div class="note bg-default padding-sm text-bold"><?php echo lang('Projects') ?></div>

<div class="row">
    <?php $projects = Orm_Sp_Project::get_all(array('objective_id' => $objective->get_id())); ?>
    <?php foreach($projects as $key => $project) { ?>
        <div class="col-md-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="panel-title"><?php echo htmlfilter($project->get_title()); ?></span>
                </div>
                <div class="panel-body">
                    <?php echo $project->draw_gauge_lead(); ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if (!$projects) { ?>
        <div class="col-md-12">
            <div class="alert m-b-2">
                <?php echo lang('There are no') . ' ' . lang('Projects'); ?>
            </div>
        </div>
    <?php } ?>
</div>

<script>

    function kpi_type_filters() {

        var college_id = $('#college_id').val();
        var program_id = $('#program_id').val();

        $('#objective_container').html('<div class="progress progress-striped active m-a-0" >' +
            '   <div class="progress-bar" style="width: 100%;"><span class="btn-label-icon left"><i class="fa fa-spinner fa-spin"></i></span> <?php echo lang('Loading'); ?></div>' +
            '</div>');

        $('#objective_container').load('/strategic_planning/strategic_planning_dashboard/view_objective/<?php echo $objective->get_id() ?>?college_id='+college_id+'&program_id='+program_id, function () {
            init_data_toggle();
        });
    }

    $(document).ready(function() {
        <?php foreach($objective->get_kpis() as $kpi) { ?>
        <?php foreach (Orm_Kpi_Level::get_all(array('kpi_id' => $kpi->get_kpi_id())) as $level) {?>
        if (typeof google.visualization === 'undefined') {
            google.setOnLoadCallback(drawTrendChart_<?php echo $level->get_id(); ?>);
        } else {
            drawTrendChart_<?php echo $level->get_id(); ?>();
        }
        <?php } ?>
        <?php } ?>
    });
</script>