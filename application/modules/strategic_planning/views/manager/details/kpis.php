<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 4/25/16
 * Time: 2:51 PM
 */
$this->load->view('/manager/details/header');

?>

<ul class="nav nav-tabs">
    <li>
        <a title="Balanced Scorecard" href="/strategic_planning/details/<?php echo (int)$strategy->get_id(); ?>"><?php echo lang("Balanced Scorecard")?></a>
    </li>
    <li>
        <a title="Goals" href="/strategic_planning/goal/details?strategy_id=<?php echo (int)$strategy->get_id(); ?>"><?php echo lang("Goals")?></a>
    </li>
    <li>
        <a title="Objectives" href="/strategic_planning/objective/details?strategy_id=<?php echo (int)$strategy->get_id(); ?>"><?php echo lang("Objectives")?></a>
    </li>
    <li>
        <a title="Projects" href="/strategic_planning/project/details?strategy_id=<?php echo (int)$strategy->get_id(); ?>"><?php echo lang("Projects")?></a>
    </li>
    <li class="active">
        <a title="Projects" href="/strategic_planning/kpis?strategy_id=<?php echo (int)$strategy->get_id(); ?>"><?php echo lang("KPIs")?></a>
    </li>
</ul>
<?php if ($strategy->get_id()) { ?>
    <div class="well well-sm text-bold"><?php echo htmlfilter(Orm_Institution::get_instance()->get_name()); ?> (<?php echo $strategy->get_year()?>)</div>

    <div class="input-group">
        <span class="input-group-addon"><?php echo lang('Objective with Aligned to Institutional Objective')?></span>
        <select class="form-control" id="objective" onchange="get_objective(this);">
            <option value="0"><?php echo lang('Select One'); ?></option>
            <?php foreach ($strategy->get_objectives() as $objective) { ?>
                <option value="<?php echo $objective->get_id() ?>"><?php echo htmlfilter($objective->get_title()); ?></option>
            <?php } ?>
        </select>
    </div>

    <hr>

    <div id="objective_container">
        <script>
            $(document).ready(function() {
                period.init({
                    FilterControl: $('#filter-mode'),
                    LabelControl: $('#currentDate'),
                    PrevBtn: $('#datePrev'),
                    NextBtn: $('#dateNext'),
                    Selector: $('#table-period tbody'),
                    AfterClick: function () {
                        show_strategy();
                    }
                });
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
