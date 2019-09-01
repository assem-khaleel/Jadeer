<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 01/08/18
 * Time: 12:09 م
 */

$filters['id'] = (int)$program_id;
$programs = Orm_Program::get_one($filters);
$pdf =false;

$institution = Orm_Institution::get_one();
$college_id = Orm_Program::get_one($filters)->get_department_obj()->get_college_id();
$college = Orm_College::get_one(['id' => $college_id]);

$data = [
    "copiesArrays" => true,
    "copiesArrayObjects" => true,
];
$dataArray = [];
$dataRelationsArray = [];
$keys = [];


$uni_col_relations = Orm_Pt_Keyword_Uni::get_all();
foreach ($uni_col_relations as $uni_col_relation) {
    $keyUni = 'uni' . $uni_col_relation->get_id();

    if (!in_array($keyUni, $keys)) {
        $dataArray[] = [
            'key' => $keyUni,
            'text' => Orm_Pt_Keyword_Uni::get_one(['id' => $uni_col_relation->get_id()])->get_title(),
            "category" => "DesiredEvents"
        ];
        $keys[] = $keyUni;
    }
    $dataRelationsArray [] = [
        "from" => 0,
        "to" => $keyUni
    ];
}

$uni_col_relations = Orm_Pt_Uni_College_Relation::get_all(['college_id'=>$college_id]);
foreach ($uni_col_relations as $uni_col_relation) {
    $keyUni = 'uni' . $uni_col_relation->get_kuni_id();
    $keyCol = 'col' . $uni_col_relation->get_kcollege_id();

    if (!in_array($keyCol, $keys)) {
        $dataArray[] = [
            'key' => $keyCol,
            'text' => Orm_Pt_Keyword_College::get_one(['id' => $uni_col_relation->get_kcollege_id()])->get_title(),
            "category" => "DesiredEvent"
        ];
        $keys[] = $keyCol;
    }
    $dataRelationsArray [] = [
        "from" => $keyUni,
        "to" => $keyCol
    ];
}


// Institution

$dataArray[] = [
    'key' => 0,
    'text' => $institution->get_name(),
    "category" => "Source"
];


// College
$pro_col_relations = Orm_Pt_College_Program_Relation::get_all(['program_id' => $program_id]);
foreach ($pro_col_relations as $pro_col_relation) {
    $keyCol = 'col' . $pro_col_relation->get_kcollege_id();
    $keyProg = 'prog' . $pro_col_relation->get_kprogram_id();
    if (!in_array($keyProg, $keys)) {
        $dataArray[] = [
            'key' => 'prog' . $pro_col_relation->get_kprogram_id(),
            'text' => Orm_Pt_Keyword_Program::get_one(['id' => $pro_col_relation->get_kprogram_id()])->get_title(),
            "category" => "DesiredEventss"
        ];
        $keys[] = $keyProg;
    }

    $dataRelationsArray [] = [
        "from" => $keyCol,
        "to" => $keyProg
    ];

}


// Objectives
$relationsObjProgTemp = Orm_Pt_Obj_Program_Relation::get_all(['program_id' => $program_id]);
$objectives = [];
foreach ($relationsObjProgTemp as $relationsObjProg) {
    $keyobj = 'obj' . $relationsObjProg->get_obj_id();
    $keyProg = 'prog' . $relationsObjProg->get_kprogram_id();

    if (!in_array($keyobj, $keys)) {
        $objectives[] = Orm_Program_Objective::get_one(['id' => $relationsObjProg->get_obj_id()]);

        $dataArray[] = [
            'key' => $keyobj,
            'text' => 'Objective ' . $relationsObjProg->get_obj_id(),
            "category" => "UndesiredEvent"
        ];
        $keys[] = $keyobj;
    }
    $dataRelationsArray [] = [
        "from" => $keyProg,
        "to" => $keyobj
    ];
}


$objIDs = [];
foreach ($relationsObjProgTemp as $relation) {
    $objIDs[] = $relation->get_obj_id();
}

// PLO
$relationsObjPloTemp = Orm_Pt_Obj_Plo_Relation::get_all(['program_id' => $program_id, 'in_obj_id' => $objIDs]);
$ploIDs = [];
foreach ($relationsObjPloTemp as $relation) {
    $dataRelationsArray [] = [
        "from" => 'obj' . $relation->get_obj_id(),
        "to" => 'plo' . $relation->get_plo_id(),
    ];
    $ploIDs[] = $relation->get_plo_id();
}

if (License::get_instance()->check_module('curriculum_mapping')){
    Modules::load('curriculum_mapping');
    $PLOs = [];
    if (count($ploIDs)) {
        $PLOs = Orm_Cm_Program_Learning_Outcome::get_all(['in_id' => $ploIDs]);
    }

    foreach ($PLOs as $key => $PLO) {
        if (!in_array('plo' . $PLO->get_id(), $keys)) {
            $dataArray[] = [
                'key' => 'plo' . $PLO->get_id(),
                'text' => 'PLO ' . ($key + 1),
                "category" => "Comment"
            ];
            $keys[] = 'plo' . $PLO->get_id();
        }
    }
    $plo = $PLOs;
}
$data['nodeDataArray'] = $dataArray;
$data['linkDataArray'] = $dataRelationsArray;

$chartData = json_encode($data);

//$programs = $programs;
//$program_id = $program_id;
//$chartData = $chartData;
//$objectives= $objectives;
$institution_mission = $institution->get_mission();
$college_mission = $college->get_mission();
$program_mission = $programs->get_mission();
?>
<?php
?>

<script src="<?php echo base_url("/assets/jadeer/js/go.js") ?>"></script>

<div class="form col-lg-12 no-padding">
    <div class="row">
        <div class="panel panel-primary treeview">
            <div class="panel-heading ">
                <span class="panel-title"><?php echo lang('Program Tree Chart') ?></span>
            </div>
            <div class="panel-body p-a-0">
                <div id="myDiagramDiv" style="width: 100%; height: 300px; cursor: auto;">
                    <?php if (!$pdf) { ?>
                        <canvas tabindex="0" width="100%" height="100%">
                            <?php echo lang('This text is displayed if your browser does not support the Canvas HTML element.')?>
                        </canvas>
                    <?php } else { ?>
                        <img src="<?php echo $path ?>" width="100%" height="100%"/>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="panel panel-primary colourable">
                <div class="panel-heading">
                    <span class="panel-title "><?php echo lang('University Mission') ?></span>
                </div>
                <div class="panel-body">
                    <?php if ($institution_mission): ?>
                        <div class="list-group-item" style="overflow: auto;">
                            <div class="well well-md m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo htmlentities($institution_mission) ?></h3>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="list-group-item" style="overflow: auto;">
                            <div class="well well-md m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo lang('There is no').' '.lang('university mission to be displayed.'); ?></h3>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="panel panel-primary colourable">
                <div class="panel-heading">
                    <span class="panel-title "><?php echo lang('College Mission') ?></span>
                </div>
                <div class="panel-body">
                    <?php if ($college_mission) { ?>
                        <div class="list-group-item" style="overflow: auto;">
                            <div class="well well-md m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo htmlentities($college_mission) ?></h3>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="list-group-item" style="overflow: auto;">
                            <div class="well well-md m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo lang('There is no').' '.lang('college mission to be displayed.'); ?></h3>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="panel panel-primary colourable">
                <div class="panel-heading">
                    <span class="panel-title "><?php echo lang('Program Mission'); ?></span>
                </div>
                <div class="panel-body">
                    <?php if ($program_mission) { ?>
                        <div class="list-group-item" style="overflow: auto;">
                            <div class="well well-md m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo htmlentities($program_mission) ?></h3>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="list-group-item" style="overflow: auto;">
                            <div class="well well-md m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo lang('There is no').' '.lang('Program mission to be displayed.'); ?></h3>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="panel panel-primary colourable">
                <div class="panel-heading">
                    <span class="panel-title"><?php echo lang('Legend'); ?></span>
                </div>

                <br>
                <table class="table">
                    <colgroup>
                        <col style="width: 25%;">
                        <col style="width: 75%;">
                    </colgroup>

                    <tbody>
                    <tr>
                        <td><span class="label" style="background-color: #87CEEB;">&nbsp;</span></td>
                        <td><label><?php echo lang('Institution Name') ?></label></td>
                    </tr>
                    <tr>
                        <td><span class="label" style="background-color: rgb(254, 162, 0);">&nbsp;</span></td>
                        <td><label><?php echo lang('University Mission Keywords') ?></label></td>
                    </tr>
                    <tr>
                        <td><span class="label" style="background-color: #9ACD32;">&nbsp;</span></td>
                        <td><label><?php echo lang('College Mission Keywords'); ?></label></td>
                    </tr>
                    <tr>
                        <td><span class="label" style="background-color: rgb(254, 162, 0);">&nbsp;</span></td>
                        <td><label><?php echo lang('Program Mission Keywords') ?></label></td>
                    </tr>
                    <tr>
                        <td><span class="label" style="background-color: #7D180C;">&nbsp;</span></td>
                        <td><label><?php echo lang('Program Objectives'); ?></label></td>
                    </tr>
                    <tr>
                        <td><span class="label" style="background-color: #BFAE96;">&nbsp;</span>
                        </td>
                        <td><label><?php echo lang('Program Learning Outcomes'); ?></label></td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="panel panel-primary colourable">
                <div class="panel-heading">
                    <span class="panel-title"><?php echo lang('Program Objectives'); ?></span>
                </div>

                <?php if (count($objectives)) : ?>
                    <br>
                    <table class="table" id="poTable">
                        <colgroup>
                            <col style="width: 25%;">
                            <col style="width: 75%;">
                        </colgroup>

                        <tbody>
                        <?php
                        /**
                         * @var $keywordObj Orm_Pt_Keyword_Program
                         */

                        foreach ($objectives as $key => $keywordObj) { ?>
                            <tr>
                                <td class="col-lg-2"><?php echo lang('Objective') . intval($keywordObj->get_id()); ?></td>
                                <td class="col-lg-10"><?php echo htmlfilter($keywordObj->get_title()); ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="panel-body">
                        <div class="list-group-item" style="overflow: auto;">
                            <div class="well well-md m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('program objactives to be displayed.'); ?></h3>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
        <?php if (License::get_instance()->check_module('curriculum_mapping')) { ?>
            <div class="col-lg-6 col-md-12">
                <div class="panel panel-primary colourable">
                    <div class="panel-heading">
                        <span class="panel-title"><?php echo lang('Program Learning Outcomes'); ?></span>
                    </div>
                    <?php if (count($plo)): ?>

                        <br>
                        <table class="table" id="sloTable">
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: 75%;">
                            </colgroup>

                            <tbody>
                            <?php
                            /**
                             * @var $keywordObj Orm_Pt_Keyword_Program
                             */
                            foreach ($plo as $key => $ploObj) { ?>
                                <tr>
                                    <td class="col-lg-2"><?php echo lang('PLO ') . ($key + 1); ?></td>
                                    <td class="col-lg-10"><?php echo htmlfilter($ploObj->get_text()); ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="panel-body">
                            <div class="list-group-item" style="overflow: auto;">
                                <div class="well well-md m-a-0">
                                    <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('program learning outcome PLOs to be displayed.'); ?></h3>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        <?php } ?>
    </div>
</div>
<textarea id="json-data" class="hidden"><?php echo htmlentities($chartData) ?></textarea>
<?php if (!$pdf): ?>
    <script>

        function init() {
            if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
            var $ = go.GraphObject.make;  // for conciseness in defining templates

            var yellowgrad = $(go.Brush, "Linear", {0: "rgb(254, 201, 0)", 1: "rgb(254, 162, 0)"});
            var greengrad = $(go.Brush, "Linear", {0: "#98FB98", 1: "#9ACD32"});
            var bluegrad = $(go.Brush, "Linear", {0: "#B0E0E6", 1: "#87CEEB"});
            var redgrad = $(go.Brush, "Linear", {0: "#C45245", 1: "#871E1B"});
            var whitegrad = $(go.Brush, "Linear", {0: "#F0F8FF", 1: "#E6E6FA"});
            var lightgrad = $(go.Brush, "Linear", {0: "#F0F88F", 1: "#E6E68A"});

            var bigfont = "bold 13pt Helvetica, Arial, sans-serif";
            var smallfont = "bold 11pt Helvetica, Arial, sans-serif";

            // Common text styling
            function textStyle() {
                return {
                    margin: 6,
                    wrap: go.TextBlock.WrapFit,
                    textAlign: "center",
                    editable: true,
                    font: bigfont
                }
            }

            myDiagram =
                $(go.Diagram, "myDiagramDiv",
                    {
                        // have mouse wheel events zoom in and out instead of scroll up and down
//                    "toolManager.mouseWheelBehavior": go.ToolManager.WheelZoom,
                        allowDrop: true,  // support drag-and-drop from the Palette
                        initialAutoScale: go.Diagram.Uniform,
                        "linkingTool.direction": go.LinkingTool.ForwardsOnly,
                        initialContentAlignment: go.Spot.Center,
                        layout: $(go.LayeredDigraphLayout, {isInitial: false, isOngoing: false, layerSpacing: 50}),
                        "undoManager.isEnabled": true
                    });

            // when the document is modified, add a "*" to the title and enable the "Save" button
            myDiagram.addDiagramListener("Modified", function (e) {
                var button = document.getElementById("SaveButton");
                if (button) button.disabled = !myDiagram.isModified;
                var idx = document.title.indexOf("*");
                if (myDiagram.isModified) {
                    if (idx < 0) document.title += "*";
                } else {
                    if (idx >= 0) document.title = document.title.substr(0, idx);
                }
            });

            var defaultAdornment =
                $(go.Adornment, "Spot",
                    $(go.Panel, "Auto",
                        $(go.Shape, {fill: null, stroke: "dodgerblue", strokeWidth: 4}),
                        $(go.Placeholder)),
                    // the button to create a "next" node, at the top-right corner
                    $("Button",
                        {
                            alignment: go.Spot.TopRight,
                            click: addNodeAndLink
                        },  // this function is defined below
                        new go.Binding("visible", "", function (a) {
                            return !a.diagram.isReadOnly;
                        }).ofObject(),
                        $(go.Shape, "PlusLine", {desiredSize: new go.Size(6, 6)})
                    )
                );

            // define the Node template
            myDiagram.nodeTemplate =
                $(go.Node, "Auto",
                    {selectionAdornmentTemplate: defaultAdornment},
                    new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
                    // define the node's outer shape, which will surround the TextBlock
                    $(go.Shape, "Rectangle",
                        {
                            fill: yellowgrad, stroke: "black",
                            portId: "", fromLinkable: true, toLinkable: true, cursor: "pointer",
                            toEndSegmentLength: 50, fromEndSegmentLength: 40
                        }),
                    $(go.TextBlock, "Page",
                        {
                            margin: 6,
                            font: bigfont,
                            editable: true
                        },
                        new go.Binding("text", "text").makeTwoWay()));

            myDiagram.nodeTemplateMap.add("Source",
                $(go.Node, "Auto",
                    new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
                    $(go.Shape, "RoundedRectangle",
                        {
                            fill: bluegrad,
                            portId: "", fromLinkable: true, cursor: "pointer", fromEndSegmentLength: 40
                        }),
                    $(go.TextBlock, "Source", textStyle(),
                        new go.Binding("text", "text").makeTwoWay())
                ));

            myDiagram.nodeTemplateMap.add("DesiredEvent",
                $(go.Node, "Auto",
                    new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
                    $(go.Shape, "RoundedRectangle",
                        {fill: greengrad, portId: "", toLinkable: true, toEndSegmentLength: 50}),
                    $(go.TextBlock, "Success!", textStyle(),
                        new go.Binding("text", "text").makeTwoWay())
                ));

            // Undesired events have a special adornment that allows adding additional "reasons"
            var UndesiredEventAdornment =
                $(go.Adornment, "Spot",
                    $(go.Panel, "Auto",
                        $(go.Shape, {fill: null, stroke: "dodgerblue", strokeWidth: 4}),
                        $(go.Placeholder)),
                    // the button to create a "next" node, at the top-right corner
                    $("Button",
                        {
                            alignment: go.Spot.BottomRight,
                            click: addReason
                        },  // this function is defined below
                        new go.Binding("visible", "", function (a) {
                            return !a.diagram.isReadOnly;
                        }).ofObject(),
                        $(go.Shape, "TriangleDown", {desiredSize: new go.Size(10, 10)})
                    )
                );

            var reasonTemplate = $(go.Panel, "Horizontal",
                $(go.TextBlock, "Reason",
                    {
                        margin: new go.Margin(4, 0, 0, 0),
                        maxSize: new go.Size(200, NaN),
                        wrap: go.TextBlock.WrapFit,
                        stroke: "whitesmoke",
                        editable: true,
                        font: smallfont
                    },
                    new go.Binding("text", "text").makeTwoWay())
            );


            myDiagram.nodeTemplateMap.add("UndesiredEvent",
                $(go.Node, "Auto",
                    new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
                    {selectionAdornmentTemplate: UndesiredEventAdornment},
                    $(go.Shape, "RoundedRectangle",
                        {fill: redgrad, portId: "", toLinkable: true, toEndSegmentLength: 50}),
                    $(go.Panel, "Vertical", {defaultAlignment: go.Spot.TopLeft},

                        $(go.TextBlock, "Drop", textStyle(),
                            {
                                stroke: "whitesmoke",
                                minSize: new go.Size(80, NaN)
                            },
                            new go.Binding("text", "text").makeTwoWay()),

                        $(go.Panel, "Vertical",
                            {
                                defaultAlignment: go.Spot.TopLeft,
                                itemTemplate: reasonTemplate
                            },
                            new go.Binding("itemArray", "reasonsList").makeTwoWay()
                        )
                    )
                ));

            myDiagram.nodeTemplateMap.add("Comment",
                $(go.Node, "Auto",
                    new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
                    $(go.Shape, "Rectangle",
                        {portId: "", fill: whitegrad, fromLinkable: true}),
                    $(go.TextBlock, "A comment",
                        {
                            margin: 9,
                            maxSize: new go.Size(200, NaN),
                            wrap: go.TextBlock.WrapFit,
                            editable: true,
                            font: smallfont
                        },
                        new go.Binding("text", "text").makeTwoWay())
                    // no ports, because no links are allowed to connect with a comment
                ));

            // clicking the button on an UndesiredEvent node inserts a new text object into the panel
            function addReason(e, obj) {
                var adorn = obj.part;
                if (adorn === null) return;
                e.handled = true;
                var arr = adorn.adornedPart.data.reasonsList;
                myDiagram.startTransaction("add reason");
                myDiagram.model.addArrayItem(arr, {});
                myDiagram.commitTransaction("add reason");
            }

            // clicking the button of a default node inserts a new node to the right of the selected node,
            // and adds a link to that new node
            function addNodeAndLink(e, obj) {
                var adorn = obj.part;
                if (adorn === null) return;
                e.handled = true;
                var diagram = adorn.diagram;
                diagram.startTransaction("Add State");
                // get the node data for which the user clicked the button
                var fromNode = adorn.adornedPart;
                var fromData = fromNode.data;
                // create a new "State" data object, positioned off to the right of the adorned Node
                var toData = {text: "new"};
                var p = fromNode.location;
                toData.loc = p.x + 200 + " " + p.y;  // the "loc" property is a string, not a Point object
                // add the new node data to the model
                var model = diagram.model;
                model.addNodeData(toData);
                // create a link data from the old node data to the new node data
                var linkdata = {};
                linkdata[model.linkFromKeyProperty] = model.getKeyForNodeData(fromData);
                linkdata[model.linkToKeyProperty] = model.getKeyForNodeData(toData);
                // and add the link data to the model
                model.addLinkData(linkdata);
                // select the new Node
                var newnode = diagram.findNodeForData(toData);
                diagram.select(newnode);
                diagram.commitTransaction("Add State");
            }

            // replace the default Link template in the linkTemplateMap
            myDiagram.linkTemplate =
                $(go.Link,  // the whole link panel
                    new go.Binding("points").makeTwoWay(),
                    {curve: go.Link.Bezier, toShortLength: 15},
                    new go.Binding("curviness", "curviness"),
                    $(go.Shape,  // the link shape
                        {stroke: "#2F4F4F", strokeWidth: 2.5}),
                    $(go.Shape,  // the arrowhead
                        {toArrow: "kite", fill: "#2F4F4F", stroke: null, scale: 2})
                );

            myDiagram.linkTemplateMap.add("Comment",
                $(go.Link, {selectable: false},
                    $(go.Shape, {strokeWidth: 2, stroke: "darkgreen"})));


        }

        setTimeout(function () {
            myDiagram.model = go.Model.fromJson($("#json-data").text());
            myDiagram.layoutDiagram(true);
            var img = $(myDiagram.makeImage());
            $("#myDiagramDiv").append(img);
            $("#myDiagramDiv canvas").remove();
            $.ajax("/program_tree/saveImage/<?php echo $program_id ?>", {
                data: {data: img.attr('src')},
                type: "POST"
            })
        }, 500);


        init();
    </script>
<?php endif; ?>
