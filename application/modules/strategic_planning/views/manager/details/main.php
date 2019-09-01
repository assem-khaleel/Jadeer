<?php
/** @var Orm_Sp_Strategy $strategy */

$this->load->view('/manager/details/header');
?>
<?php if ($strategy->get_id()) { ?>
    <ul class="nav nav-tabs">
        <li class="active">
            <a title="Balanced Scorecard" href="/strategic_planning/details/<?php echo (int) $strategy->get_id(); ?>"><?php echo lang("Balanced Scorecard")?></a>
        </li>
        <li>
            <a title="Goals" href="/strategic_planning/goal/details?strategy_id=<?php echo (int) $strategy->get_id(); ?>"><?php echo lang("Goals")?></a>
        </li>
        <li>
            <a title="Objectives" href="/strategic_planning/objective/details?strategy_id=<?php echo (int) $strategy->get_id(); ?>"><?php echo lang("Objectives")?></a>
        </li>
        <li>
            <a title="Projects" href="/strategic_planning/project/details?strategy_id=<?php echo (int) $strategy->get_id(); ?>"><?php echo lang("Projects")?></a>
        </li>
        <li>
            <a title="Projects" href="/strategic_planning/kpis?strategy_id=<?php echo (int) $strategy->get_id(); ?>"><?php echo lang("KPIs")?></a>
        </li>
    </ul>

    <div class="well well-sm m-a-0 hidden" id="sp-container">
        <script>
            $(document).ready(function () {
                show_strategy();
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
                    show_strategy();
                }
            });
        });

        var active_blocks = {};

        function show_strategy() {

            $('#sp-container').html('<div class="progress progress-striped active m-a-0" >' +
                '   <div class="progress-bar" style="width: 100%;"><span class="btn-label-icon left"><i class="fa fa-spinner fa-spin"></i></span> <?php echo lang('Loading'); ?></div>' +
                '</div>');

            var period_mode = period.getMode();
            var period_value = period.getSelectionValue();
            var period_year = period.getSelectionYear();

            $('#sp-container').load('/strategic_planning/show/<?php echo $strategy->get_id(); ?>?period_mode=' + period_mode + '&period_value=' + period_value + '&period_year=' + period_year);
            $('#sp-container').removeClass('hidden');
        }
    </script>
<?php } else { ?>
    <div class="well well-sm m-a-0">
        <h3 class="m-a-0"><?php echo lang('No Strategy on this semester') ?></h3>
        <br>
        <?php if (Orm_Sp_Strategy::get_active_strategy()->get_id()) { ?>
            <a href="/strategic_planning/regenerate" data-toggle="ajaxModal"><?php echo lang("Generate Strategy")?></a>
        <?php } else { ?>
            <a href="/strategic_planning/generate" data-toggle="ajaxModal"><?php echo lang("Generate Strategy")?></a>
        <?php } ?>
    </div>
<?php } ?>