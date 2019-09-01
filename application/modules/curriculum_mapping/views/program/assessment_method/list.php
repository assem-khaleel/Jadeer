<?php $this->load->view('program/links', array('program_id', $program_id)); ?>

    <div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Program Assessment Method'); ?></span>
    </div>
<?php
$merhods = Orm_Cm_Program_Assessment_Method::get_assessment_methods($program_id);
if ($merhods) {
    ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="col-md-3"><?php echo lang('Assessment Method'); ?></th>
            <th class="col-md-7"><?php echo lang('Assessment Component'); ?></th>
            <th class="col-md-2"><?php echo lang('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($merhods as $key => $method) { ?>
            <tr>
                <td>
                    <span class="label label-primary"><?php echo($key + 1); ?></span>
                    <?php echo htmlfilter($method->get_assessment_method_obj()->get_title()); ?>
                </td>
                <td>
                    <?php if ($method->get_assessment_components()) { ?>
                        <ul class="list-group m-a-0 bg-primary">
                            <?php foreach ($method->get_assessment_components() as $component_key => $component) { ?>
                                <li class="list-group-item no-border-hr padding-xs-hr">
                                    <span class="label label-pa-purple"><?php echo($key + 1); ?>
                                        .<?php echo $component_key + 1; ?></span>
                                    <?php echo htmlfilter($component->get_text()); ?>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <div class="alert m-a-0">
                            <?php echo lang('There are no') . ' ' . lang('Program Assessment Component'); ?>
                        </div>
                    <?php } ?>
                </td>
                <td>
                    <a href="/curriculum_mapping/program/assessment_method_add_edit_component/<?php echo intval($method->get_id()); ?>"
                       data-toggle="ajaxModal" class="btn  btn-block">
                        <span class="btn-label-icon left icon fa fa-plus"></span><?php echo lang('Manage'); ?>
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    </div>
<?php } else { ?>
    <div class="alert alert-dafualt">
        <div class="m-b-12">
            <?php echo lang('There are no') . ' ' . lang('Program Assessment Method'); ?>
        </div>
    </div>
<?php } ?>