<?php
/** @var Orm_Sp_Strategy $strategy */

$level = intval($this->input->get_post('level'));
$objective_id = $this->input->get_post('objective_id');
if($objective_id) {
    $objectives = Orm_Sp_Objective::get_instance($objective_id)->get_children();
} else {
    $objectives = Orm_Sp_Objective::get_all(array('strategy_id' => $strategy->get_id()));
}
$this->load->view('/manager/details/header');
?>
<ul class="nav nav-tabs">
    <li>
        <a title="Balanced Scorecard" href="/strategic_planning/details/<?php echo (int)$strategy->get_id(); ?>"><?php echo lang("Balanced Scorecard")?></a>
    </li>
    <li>
        <a title="Goals" href="/strategic_planning/goal/details?strategy_id=<?php echo (int)$strategy->get_id(); ?>"><?php echo lang("Goals")?></a>
    </li>
    <li class="active">
        <a title="Objectives" href="/strategic_planning/objective/details?strategy_id=<?php echo (int)$strategy->get_id(); ?>"><?php echo lang("Objectives")?></a>
    </li>
    <li>
        <a title="Projects" href="/strategic_planning/project/details?strategy_id=<?php echo (int)$strategy->get_id(); ?>"><?php echo lang("Projects")?></a>
    </li>
    <li>
        <a title="Projects" href="/strategic_planning/kpis?strategy_id=<?php echo (int)$strategy->get_id(); ?>"><?php echo lang("KPIs")?></a>
    </li>
</ul>

<div class="well well-sm m-a-0 hidden" id="details-container">
    <script>
        $(document).ready(function () {
            show_objectives();
        });
    </script>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        period.init({
            FilterControl: $('#filter-mode'),
            LabelControl: $('#currentDate'),
            PrevBtn: $('#datePrev'),
            NextBtn: $('#dateNext'),
            Selector: $('#table-period tbody'),
            AfterClick: function () {
                show_objectives();
            }
        });
    });

    function show_objectives() {
        $('#details-container').html('<div class="progress progress-striped active m-a-0" >' +
            '   <div class="progress-bar" style="width: 100%;"><span class="btn-label-icon left"><i class="fa fa-spinner fa-spin"></i></span> <?php echo lang('Loading'); ?></div>' +
            '</div>');

        var period_mode = period.getMode();
        var period_value = period.getSelectionValue();
        var period_year = period.getSelectionYear();
        var strategy_id = <?php echo $strategy->get_id() ?>;

        $('#details-container').load('/strategic_planning/objective/details/?strategy_id=' + strategy_id + '&period_mode=' + period_mode + '&period_value=' + period_value + '&period_year=' + period_year, function () {
            init_data_toggle();
        });

        $('#details-container').removeClass('hidden');
    }
</script>