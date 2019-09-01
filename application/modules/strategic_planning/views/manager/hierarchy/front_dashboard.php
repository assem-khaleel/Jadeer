<?php
/** @var Orm_Sp_Strategy $strategy */
$fltr = $this->input->get_post('fltr');

?>
    <div class="box p-a-1">

        <div class="pull-left">
            <button aria-controls="filters" aria-expanded="false" data-target="#filters" data-toggle="collapse"
                    type="button" class="btn btn-sm">
                <span class="fa fa-filter"></span>
            </button>

            <?php echo lang('Find Strategic Planning') ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div id="filters" class="collapse <?php echo empty($fltr) ? '' : 'in'; ?>" style="height: auto;">
        <div class="well">
            <?php echo form_open('/dashboard/strategic_planning') ?>
            <div class="row m-b-1">
                <div class="col-md-6">
                    <a type="reset" href="/strategic_planning"
                       class="btn btn-md btn-block"><?php echo lang('Institution'); ?></a>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><?php echo lang('Unit'); ?>:</span>
                        <select name="fltr[unit_id]" class="form-control">
                            <option value="0"><?php echo lang('All Units'); ?></option>
                            <?php foreach (Orm_Unit::get_all() as $unit) { ?>
                                <?php $selected = $unit->get_id() == $fltr['unit_id'] ? 'selected="selected"' : ''; ?>
                                <option
                                    value="<?php echo $unit->get_id(); ?>" <?php echo $selected; ?>><?php echo htmlfilter( $unit->get_name()); ?></option>
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
        </div>
    </div>

<?php if ($strategy->get_id()) { ?>
    <script>
        google.load('visualization', '1', {'packages':['corechart', 'gauge']});
    </script>

    <style>
        #table-period td {
            text-align: center !important;
            vertical-align: middle !important;
            cursor: pointer;
        }

        #table-period td.active {
            color: #000 !important;
        }
    </style>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="panel-title text-bg"><?php echo htmlfilter($strategy->get_title()); ?>
                (<?php echo $strategy->get_year(); ?>)</span>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-md-9">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel text-xs-center">
                                <div class="panel-body">
                                    <p class="p-y-1"><i class="fa fa-bullseye font-size-46 line-height-1 text-primary"></i></p>
                                    <p><strong><?php echo lang('Mission'); ?></strong></p>
                                    <p class="m-b-4"><?php echo htmlfilter($strategy->get_mission()); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="panel text-xs-center">
                                <div class="panel-body">
                                    <p class="p-y-1"><i class="fa fa-eye font-size-46 line-height-1 text-primary"></i></p>
                                    <p><strong><?php echo lang('Vision'); ?></strong></p>
                                    <p class="m-b-4"><?php echo htmlfilter($strategy->get_vision()); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-primary">
                                <div class="table-header">
                                    <div class="table-caption">
                                        <?php echo lang('Values') ?>
                                    </div>
                                </div>
                                <?php if ($strategy->get_values()) { ?>
                                    <table class="table table-bordered">
                                        <tbody>
                                       <?php 
                                       foreach ($strategy->get_values() as $value) {
                                           $col_span = $value->get_description() ? 1 : 2; 
                                           ?>
                                           <tr>
                                               <td class='col-md-2' colspan='<?php echo $col_span?>'>
                                                   <?php echo htmlfilter($value->get_title())?>
                                               </td>
                                               <?php   if ($value->get_description()) {?>
                                                   <td class='col-md-10'>
                                                       <?php echo htmlfilter($value->get_description())?>
                                                   </td>
                                               <?php    }?>
                                           </tr>
                                       <?php } ?>
<!--                                        --><?php //foreach ($strategy->get_values() as $value) {
//                                            $col_span = $value->get_description() ? 1 : 2;
//                                            echo "<tr>";
//                                            echo "<td  class='col-md-2' colspan='{$col_span}'>{$value->get_title()}</td>";
//                                            if ($value->get_description()) {
//                                                echo "<td class='col-md-10'>{$value->get_description()}</td>";
//                                            }
//                                            echo "</tr>";
//                                        }
//                                        ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <div class="well well-sm m-a-0">
                                        <h4 class="m-a-0">
                                            <?php echo lang('No Values'); ?>
                                        </h4>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="table-period" class="table table-bordered" style="background: #FFF;">
                                <thead class="bg-primary">
                                <tr>
                                    <td id="datePrev" class="prev col-md-2"><i class="fa fa-backward"></i></td>
                                    <td colspan="2" class="col-md-8">
                                        <select name="mode" id="filter-mode" class="form-control col-md-4"
                                                autocomplete="off">
                                            <option value="Month"><?php echo lang('Month') ?></option>
                                            <option value="Quarter"><?php echo lang('Quarter') ?></option>
                                            <option value="Year" selected="selected"><?php echo lang('Year') ?></option>
                                        </select>
                                    </td>
                                    <td id="dateNext" class="next col-md-2"><i class="fa fa-forward"></i></td>
                                </tr>
                                <tr>
                                    <td colspan="4" id="currentDate"></td>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
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