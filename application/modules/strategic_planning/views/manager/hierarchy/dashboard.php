<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 10/13/15
 * Time: 10:04 PM
 */
/** @var string $type */
/** @var Orm_Sp_Strategy $strategy */
/** @var string $sp_view_content */

$fltr = $this->input->get_post('fltr');

?>

<script>
    google.load('visualization', '1', {'packages':['corechart', 'bar', 'table', 'gauge']});
</script>

<div class="box p-a-1">

    <button aria-controls="filters" aria-expanded="false" data-target="#filters" data-toggle="collapse" type="button"
            class="btn btn-sm ">
        <span class="fa fa-filter"></span>
    </button>
    <?php echo lang('Find Strategic Planning for Academic & Administrative Units (Specific to Unit)');?>
</div>

<div id="filters" class="collapse <?php echo empty($fltr) ? '' : 'in'; ?>" style="height: auto;">
    <div class="well">
        <!-- Search form -->
        <?php echo form_open('/dashboard/strategic_planning', array('method' => 'get')) ?>
        <div class="row m-b-1">
            <div class="col-md-6">
                <a type="reset" href="/dashboard/strategic_planning" class="btn btn-md btn-block"><?php echo lang('Institution'); ?></a>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon"><?php echo lang('Unit'); ?>:</span>
                    <select name="fltr[unit_id]" class="form-control">
                        <option value="0"><?php echo lang('All Units'); ?></option>
                        <?php foreach (Orm_Unit::get_all() as $unit) { ?>
                            <?php $selected = $unit->get_id() == $fltr['unit_id'] ? 'selected="selected"' : ''; ?>
                            <option
                                value="<?php echo $unit->get_id(); ?>" <?php echo $selected; ?>><?php echo htmlfilter($unit->get_name()); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row m-b-1">
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon"><?php echo lang('College'); ?>:</span>
                    <select id="college_block" name="fltr[college_id]" class="form-control"
                            onchange="get_programs_by_college(this, 0, 1);">
                        <option value="0"><?php echo lang('All College'); ?></option>
                        <?php foreach (Orm_College::get_all() as $college) { ?>
                            <?php $selected = $college->get_id() == $fltr['college_id'] ? 'selected="selected"' : ''; ?>
                            <option
                                value="<?php echo $college->get_id(); ?>" <?php echo $selected; ?>><?php echo htmlfilter($college->get_name()); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon"><?php echo lang('Program'); ?>:</span>
                    <select id="program_block" name="fltr[program_id]" class="form-control">
                        <option value="0"><?php echo lang('All Programs'); ?></option>
                        <?php if (!empty($fltr['college_id'])) { ?>
                            <?php foreach (Orm_Program::get_all(array('college_id' => $fltr['college_id'])) as $program) { ?>
                                <?php $selected = $program->get_id() == $fltr['program_id'] ? 'selected="selected"' : ''; ?>
                                <option
                                    value="<?php echo $program->get_id(); ?>" <?php echo $selected; ?>><?php echo htmlfilter($program->get_name()); ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-10 col-md-2">
                <button type="submit"
                        class="btn btn-md btn-block "><i class="btn-label-icon left fa fa-search"></i><?php echo lang('Search'); ?></button>
            </div>
        </div>
        <?php echo form_close() ?>
        <!-- / Search form -->
    </div>
</div>

<?php if ($strategy->get_id()) { ?>
<div class="well well-sm text-bold"><?php echo htmlfilter(Orm_Institution::get_instance()->get_name()); ?> (<?php echo $strategy->get_year()?>)</div>

    <div class="input-group">
        <span class="input-group-addon"><?php echo lang('Objective with Aligned to Institutional Objective')?></span>
        <select class="form-control" id="objective" onchange="get_objective(this);">
            <?php foreach ($strategy->get_objectives() as $objective) { ?>
                <option value="<?php echo $objective->get_id() ?>"><?php echo htmlfilter($objective->get_title()); ?></option>
            <?php } ?>
        </select>
    </div>

    <hr>

    <div id="objective_container">
        <script>
            $(document).ready(function() {
                get_objective($('#objective'));
            });
        </script>
    </div>

    <script>
        function get_objective(element) {
            $('#objective_container').html('<div class="progress progress-striped active m-a-0" >' +
                '   <div class="progress-bar" style="width: 100%;"><span class="btn-label-icon left"><i class="fa fa-spinner fa-spin"></i></span> <?php echo lang('Loading'); ?></div>' +
                '</div>');

            $('#objective_container').load('/strategic_planning/strategic_planning_dashboard/view_objective/' + $(element).val(), function () {
                init_data_toggle();
            });
        }
    </script>

<?php } else { ?>
    <div class="alert alert-primary">
        <strong><?php echo lang('Notice'); ?>! </strong><?php echo lang('No Strategy Found, Please build a strategy'); ?>
    </div>
<?php } ?>