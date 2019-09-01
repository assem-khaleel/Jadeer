<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 4/2/17
 * Time: 4:58 PM
 */
/** @var $root Orm_Unit */
?>
<style>
    .orgchart .level-1 .title {
        background-color: #006699;
    }

    .orgchart .level-1 .content {
        border-color: #006699;
    }

    .orgchart .level-2 .title {
        background-color: #009933;
    }

    .orgchart .level-2 .content {
        border-color: #009933;
    }

    .orgchart .level-3 .title {
        background-color: #993366;
    }

    .orgchart .level-3 .content {
        border-color: #993366;
    }

    .orgchart .node .edge {
        display: none;
    }

    .orgchart .node {
        width: 160px
    }

    .orgchart .node .title {
        height: auto;
        white-space: normal;

    }
</style>

<div id="org-chart" class="col-md-12" style="direction: ltr"></div>
<script>

    var dataSource = <?php echo json_encode($root->draw_org_chart()); ?>;

    $('#org-chart').orgchart({
        'data': dataSource,
        'verticalDepth': 3, // From the 3th level of orgchart, nodes will be aligned vertically.
        'nodeContent': 'title',
        'depth': 6,
        'pan': true,
        'zoom': false,
        'text': '<?php echo lang('Export') ?>',
        'exportButton': true,
        'exportFilename': 'UniversityOrgChart',
        'parentNodeSymbol': ''
    });
</script>