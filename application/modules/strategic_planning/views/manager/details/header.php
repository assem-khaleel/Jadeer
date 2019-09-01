<?php
/** @var Orm_Sp_Strategy $strategy */

$fltr = $this->input->get_post('fltr');
Orm_User::get_logged_user()->get_filters($fltr);
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
        <?php echo form_open('/strategic_planning/details/'.$strategy->get_id(),['method' => 'get']) ?>
        <?php $this->load->view('/sp_filters',array($strategy->get_id())) ?>
        <?php echo form_open('/strategic_planning/details') ?>
        <?php $this->load->view('/sp_filters') ?>
        <?php echo form_close() ?>
    </div>
</div>

<?php if ($strategy->get_id()) { ?>

    <script>
        google.load('visualization', '1', {'packages':['corechart', 'bar', 'table', 'gauge']});
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

            <div class="panel-heading-controls col-sm-4">
                <a class="btn btn-sm pull-right"
                   href="/strategic_planning/basic_info/<?php echo (int) $strategy->get_id(); ?>">
                    <span class="btn-label-icon left"><i class="fa fa-edit"></i></span>
                    <?php echo lang('Data Capture'); ?>
                </a>
            </div>
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
                                                <td   class='col-md-2' colspan='<?php echo $col_span ?>'>
                                                    <?php echo  htmlfilter($value->get_title())?>
                                                </td>
                                                <?php if($value->get_description()){?>
                                                    <td class='col-md-10'>
                                                        <?php echo htmlfilter($value->get_description())?>
                                                    </td>

                                                <?php } ?>
                                            </tr>

                                        <?php } ?>
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
                            <table id="table-period" class="table table-bordered">
                                <thead class="bg-primary">
                                <tr>
                                    <td id="datePrev" class="prev col-md-4"><i class="fa fa-backward"></i></td>
                                    <td colspan="2" class="col-md-4">
                                        <select name="mode" id="filter-mode" class="form-control col-md-4"
                                                autocomplete="off">
                                            <option value="Month"><?php echo lang('Month') ?></option>
                                            <option value="Quarter"><?php echo lang('Quarter') ?></option>
                                            <option value="Year" selected="selected"><?php echo lang('Year') ?></option>
                                        </select>
                                    </td>
                                    <td id="dateNext" class="next col-md-4"><i class="fa fa-forward"></i></td>
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
<?php } ?>

<?php $this->load->view('/manager/details/legend'); ?>
