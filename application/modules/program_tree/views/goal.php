<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <?php
    $this->load->view("program_tree/edit");
    $col_array = $program_objective;
    $row_array = $program_goal;
    ?>
</div>
<div class=" col-lg-9 col-md-9 col-sm-12 col-xs-12 no-border-vr no-border-r form">
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <span class="panel-title pull-left" style="padding-top: 7.5px;"><?php echo  lang("Program Mission") ?></span>
        </div>
        <div class="panel-body">
            <div class="form-control col-xs-12"
                 style="height: 160px; overflow: auto; overflow-wrap: break-word; resize:none; background: transparent; border: none; margin-top: 10px;">
                <?php echo  $program_mission ?>
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <span class="panel-title pull-left"
                  style="padding-top: 7.5px;"><?php echo  lang("List the Program Goals (eg. long term, broad based initiatives for the program, if any)") ?></span>
        </div>
        <div class="panel-body">
            <div class="row">
                <?php foreach ($row_array as $raw) {
                    echo htmlfilter($row->get_title());
                } ?>
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <span class="panel-title pull-left" style="padding-top: 7.5px;"><?php echo  lang("Program Objectives") ?></span>
        </div>
        <div class="panel-body">
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>
                <?php echo lang('Enter the major objectives of the program that help achieve the program\'s mission.
                    Then For each measurable objective appropriately define the key performance indicators
                    and the major strategies taken to achieve that objective.')?>
                </strong>
            </div>
            <div class="m-b-2">
                <select class="form-control select2-example select2-hidden-accessible" style="width: 100%"
                        data-allow-clear="true" aria-hidden="true">
                    <option></option>
                    <?php foreach ($col_array as $col) { ?>
                        <option value="AK"><?php echo  htmlfilter($col->get_title()); ?></option><?php } ?>
                </select>
            </div>
            <hr>
            <div class="table-light">
                <div class="table-header">
                    <div class="table-caption padding-sm-hr">
                        <div class="row">
                            <div class="panel-heading-controls col-sm-4">
                                <button type="button" onclick="return false;"
                                        class="kpi btn cg-code"><?php echo  lang('Add').' '.lang('New Measure') ?>
                                </button>
                            </div>
                            <br>
                        </div>
                        <div class="row">
                          <?php echo lang('  Be employed in industry, government, or entrepreneurial endeavors
                            to demonstrate professional advancement through significant technical
                            achievements and expanded leadership responsibility')?>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered ">
                    <colgroup>
                        <col width="2%">
                        <col width="49%">
                        <col width="49%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th class="valign-middle text-center">#</th>
                        <th class="valign-middle text-center"><?php echo lang("Key Performance Indicators") ?></th>
                        <th class="valign-middle text-center"><?php echo lang("Major Strategies") ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($row_array as $row) { ?>
                        <tr>
                            <td><a class="goal" href="#" onclick="return false;" data-title-en="<?php echo  $row ?>"><i
                                            class="fa fa-pencil"></i></a></td>
                            <td><?php echo  $row ?></td>
                            <td><?php echo  htmlfilter($col->get_title()); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="editMode" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-sx animated fadeIn">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?php echo  lang('Edit').' '.lang("Measurable Objective") ?> </h4>
            </div>
            <div class="padding-sm-hr">
                <div class="modal-body">
                    <div class="row form-group">
                        <label class="control-label"><?php echo  lang("Key Performance Indicator") ?></label>
                        <input type="text" id="kpi" class="form5 form-control select2-input">
                        <p class="help-block hidden">
                            <?php echo  lang("Please enter the key performance indicator or this is a duplicate KPI and strategy entry.") ?>
                           </p>
                    </div>

                    <div class="row form-group">
                        <label class="control-label"><?php echo  lang("Major Strategy") ?></label>
                        <div class="select2-container form5" id="s2id_mMethods">
                            <a href="javascript:void(0)" onclick="return false;" class="select2-choice" tabindex="-1">
                                <span class="select2-chosen"><?php echo  lang("Writing") ?></span>
                                <abbr class="select2-search-choice-close"></abbr>
                                <span class="select2-arrow"><b></b></span>
                            </a>
                            <input class="select2-focusser select2-offscreen" type="text" id="s2id_autogen2">
                        </div>
                        <select id="mMethods" class="form5 select2-offscreen" tabindex="-1">
                            <option></option>
                            <option value="6"><?php echo  lang("Writing") ?></option>
                            <option value="7"><?php echo  lang("Practical") ?></option>
                            <option value="8"><?php echo  lang("Oral") ?></option>
                            <option value="9"><?php echo  lang("test") ?></option>
                            <option value="10"><?php echo  lang("observation") ?></option>
                        </select>
                        <p class="help-block hidden">
                            <?php echo  lang("Please select the major strategy or this is a duplicate KPI and strategy entry.") ?>
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class=" text-right">
                        <div id="entryExist_measure" class="alert alert-danger m-a-0 no-padding-vr"
                             style="display:none;">
                            <?php echo  lang("This is a duplicate KPI and strategy entry.") ?>
                            
                        </div>
                        <button type="button" class="btn editbtn no-print"><?php echo  lang("Save") ?></button>
                        <button type="button" class="btn delbtn no-print"><?php echo  lang("Delete") ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="addNewMeasure" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-sx animated fadeIn">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?php echo  lang('Edit').' '.lang("Measurable Objective") ?></h4>
            </div>
            <div class="padding-sm-hr">
                <div class="modal-body">
                    <div class="row form-group">
                        <label class="control-label"><?php echo  lang("Key Performance Indicator") ?></label>
                        <div class="select2-container form5" id="s2id_mMethods">
                            <a href="javascript:void(0)" onclick="return false;" class="select2-choice" tabindex="-1">
                                <span class="select2-chosen"></span>
                                <abbr class="select2-search-choice-close"></abbr>
                                <span class="select2-arrow"><b></b></span>
                            </a>
                        </div>
                        <select id="mMethods" class="form5 select2-offscreen" tabindex="-1">
                            <option></option>
                            <option value="6"><?php echo  lang("Writing") ?></option>
                            <option value="7"><?php echo  lang("Practical") ?></option>
                            <option value="8"><?php echo  lang("Oral") ?></option>
                            <option value="9"><?php echo  lang("test") ?></option>
                            <option value="10"><?php echo  lang("observation") ?></option>
                        </select>
                        <p class="help-block hidden">
                            <?php echo  lang("Please select the major strategy or this is a duplicate KPI and strategy entry.") ?>
                            </p>
                    </div>

                    <div class="row form-group">
                        <label class="control-label"><?php echo  lang("Major Strategy") ?></label>
                        <div class="select2-container form5" id="s2id_mMethods">
                            <a href="javascript:void(0)" onclick="return false;" class="select2-choice" tabindex="-1">
                                <span class="select2-chosen"><?php echo  lang("Writing") ?></span>
                                <abbr class="select2-search-choice-close"></abbr>
                                <span class="select2-arrow"><b></b></span>
                            </a>
                            <input class="select2-focusser select2-offscreen" type="text" id="s2id_autogen2">
                        </div>
                        <select id="mMethods" class="form5 select2-offscreen" tabindex="-1">
                            <option></option>
                            <option value="6"><?php echo  lang("Writing") ?></option>
                            <option value="7"><?php echo  lang("Practical") ?></option>
                            <option value="8"><?php echo  lang("Oral") ?></option>
                            <option value="9"><?php echo  lang("test") ?></option>
                            <option value="10"><?php echo  lang("observation") ?></option>
                        </select>
                        <p class="help-block hidden">
                            <?php echo  lang("Please select the major strategy or this is a duplicate KPI and strategy entry.") ?>
                            </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class=" text-right">
                        <div id="entryExist_measure" class="alert alert-danger m-a-0 no-padding-vr"
                             style="display:none;">
                            <?php echo  lang("This is a duplicate KPI and strategy entry.") ?>
                        </div>
                        <button type="button" class="btn editbtn no-print"><?php echo  lang("Save") ?></button>
                        <button type="button" class="btn delbtn no-print"><?php echo  lang("Delete") ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).click(function () {
        $(".goal").click(function () {
            var title_en = $(this).attr('data-title-en');
            $("#kpi").val(title_en);
            $("#editMode").modal('show');
        })
    })
    $(document).click(function () {
        $(".kpi").click(function () {
            var title_en = $(this).attr('data-title-en');
            $("#kpi").val(title_en);
            $("#addNewMeasure").modal('show');
        })
    })
</script>