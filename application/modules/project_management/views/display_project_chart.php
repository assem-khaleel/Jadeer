<?php
/** @var $project Orm_Pm_Project */
?>
<style>
    .gantt_grid{
        width: 313px !important;
    }
</style>
<div class="pull-right" style="margin-bottom: 10px;">
    <?php if(Orm_User::check_credential([Orm_User::USER_STAFF , Orm_User::USER_FACULTY] , false , 'project_management-report')): ?>
    <a class="btn btn-sm " href="/project_management/export_as_pdf/<?php echo $project->get_id(); ?>/<?php echo $type; ?>">
        <span class="btn-label-icon left icon fa fa-file-pdf-o"></span> <?php echo lang('pdf'); ?>
    </a>
    <?php endif; ?>
</div>
<div class="box p-a-1 " style="margin-bottom: 0 !important;">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Project')." ".$project->get_title(); ?>
        </div>
    </div>

</div>


<div id="gantt_here" style='width:100%; height:400px;'></div>
<script type="text/javascript">
   <?php if(isset($data)): ?>
    var tasks = <?php echo $data; ?>;
    gantt.config.readonly = true;
    <?php if($days > 30): ?>
    gantt.config.scale_unit = "month";
    gantt.config.step = 1;
    gantt.config.date_scale = "%F, %Y";
    <?php elseif($days > 4):?>
    gantt.config.scale_unit = "week";
    gantt.config.step = 1;
    gantt.config.date_scale = "%F, %Y";
    <?php else:?>
    gantt.config.scale_unit = "day";
    gantt.config.step = 1;
    gantt.config.date_scale = "%d, %M";
    <?php endif; ?>
    gantt.config.columns=[
        {name:"text",       label:"<?php echo lang('Phase name')?>",  tree:true, width:'*' },
        {name:"duration",   label:"<?php echo lang('Duration')?> / <?php echo lang('Days')?>",   align: "center" },
        {name:"add",        label:"" }
    ];
    gantt.init("gantt_here");
    gantt.parse (tasks);
    <?php endif; ?>

</script>