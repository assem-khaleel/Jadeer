<style>
    .gantt_grid{
        width: 313px !important;
    }
    .gantt_grid_scale{
        width: 313px !important;
    }
</style>
<div class="box p-a-1 " style="margin-bottom: 0 !important;">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Project')." ".$project->get_title(); ?>
        </div>
    </div>

</div>


<div id="gantt_here" style=' width : 100%; height : 400px;'"></div>

<script type="text/javascript">
   $( document ).ready(function() {
       <?php if(isset($data)): ?>
       var tasks = <?php echo $data; ?>;
       gantt.config.readonly = true;
       <?php if($days > 30): ?>
       gantt.config.scale_unit = "month";
       gantt.config.step = 1;
       gantt.config.date_scale = "%M, %Y";
       <?php elseif($days > 4):?>
       gantt.config.scale_unit = "week";
       gantt.config.step = 1;
       gantt.config.date_scale = "%M, %Y";
       <?php else:?>
       gantt.config.scale_unit = "day";
       gantt.config.step = 1;
       gantt.config.date_scale = "%d, %M";
       <?php endif; ?>
       gantt.config.columns=[
           {name:"text",       label:"Phase name",  tree:true, width:'*' },
           {name:"duration",   label:"Duration/Days",   align: "center" },
           {name:"add",        label:"" }
       ];
       gantt.init("gantt_here");
       gantt.parse (tasks);
       <?php endif; ?>
   });
</script>
