<?php
$uniqid = uniqid('-');

$user_filter = array();
Orm_User::get_logged_user()->get_filters($user_filter);
$fltr = array_merge($user_filter,(array)Orm::get_ci()->input->get_post('fltr'));

switch (Orm_User::get_logged_user()->get_institution_role()) {
    case Orm_Role::ROLE_INSTITUTION_ADMIN:
        $campus_read_only = '';
        $college_read_only = '';
        $department_read_only = '';
        $program_read_only = '';
        break;
    case Orm_Role::ROLE_COLLEGE_ADMIN:
        $campus_read_only = 'disabled="disabled"';
        $college_read_only = 'disabled="disabled"';
        $department_read_only = '';
        $program_read_only = '';
        break;
    case Orm_Role::ROLE_DEPARTMENT_ADMIN:
        $campus_read_only = 'disabled="disabled"';
        $college_read_only = 'disabled="disabled"';
        $department_read_only = 'disabled="disabled"';
        $program_read_only = '';
        break;
    case Orm_Role::ROLE_PROGRAM_ADMIN:
        $campus_read_only = 'disabled="disabled"';
        $college_read_only = 'disabled="disabled"';
        $department_read_only = 'disabled="disabled"';
        $program_read_only = 'disabled="disabled"';
        break;
    default:
        $campus_read_only = 'disabled="disabled"';
        $college_read_only = 'disabled="disabled"';
        $department_read_only = 'disabled="disabled"';
        $program_read_only = 'disabled="disabled"';
        break;
}
?>
<div class="well m-a-0">
    <form method="get" id="form<?php echo $uniqid ?>" class="form-horizontal">

        <?php
        $ajax_filter = intval(in_array(Orm_Campus::class, $filters));
        $ajax_filter += intval(in_array(Orm_College::class, $filters));
        $ajax_filter += intval(in_array(Orm_Department::class, $filters));
        $ajax_filter += intval(in_array(Orm_Program::class, $filters));
        ?>

        <?php if ($ajax_filter) { ?>

            <div class="row">
                <?php if (in_array(Orm_Campus::class, $filters)) { ?>
                    <div class="col-md-<?php echo(12 / $ajax_filter) ?>">
                        <div class="input-group">
                            <span class="input-group-addon"><?php echo lang('Campus') ?></span>

                            <?php
                            if($campus_read_only){
                                $campus_ids = implode(",",(array)$fltr['campus_in']);
                            }
                            $placeholder = lang('All campus');

                            echo '<select id="campus_block" '.$campus_read_only.' name="fltr[campus_in][]" class="form-control" onchange="get_colleges_by_campus(this, 1, 1,\''.$uniqid.'\'); $(\'#college_block'.$uniqid.'\').html(\'<option value>' . lang('All College') . '</option>\'); $(\'#department_block'.$uniqid.'\').html(\'<option value>' . lang('All Department') . '</option>\'); $(\'#program_block'.$uniqid.'\').html(\'<option value>' . lang('All Program') . '</option>\');"  multiple="multiple">';
                                  echo '<script> $(document).ready(function() {
                                         $("select[multiple=multiple]").select2({
                                         placeholder: "'.$placeholder.'",
                                         data:['.$campus_ids.']
                                         });
                                    }); </script>';
                            ?>

<!--                            <select id="campus_block--><?php //echo $uniqid ?><!--" --><?php //echo $campus_read_only ?><!-- name="fltr[campus_id]" class="form-control" onchange="filter_campus(this)">-->
<!--                                <option value="" --><?php //if(empty($fltr['campus_in'][0])) echo 'selected="selected"' ?><!-->--><?php //echo lang('All Campus') ?><!--</option>-->
                                <?php
                                $list = Orm_Campus::get_all();
                                ?>
                                <?php foreach ($list as $option) { ?>
<!--                                    --><?php //$selected = (isset($fltr['campus_id']) && $option->get_id() == $fltr['campus_id'] ? 'selected="selected"' : ''); ?>
                                   <?php $selected = (isset($fltr['campus_in']) &&  in_array($option->get_id(),(array)$fltr['campus_in'])  ? 'selected="selected"' : ''); ?>
                                    <option value="<?php echo $option->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($option->get_name()) ?></option>
                                <?php } ?>
                            </select>

                            <?php if($campus_read_only) { ?>
                                <input type="hidden" name="fltr[campus_in]" value="<?php echo (isset($fltr['campus_in']) ? $fltr['campus_in'] : '') ?>">
                            <?php } ?>


                            <script>
                                function filter_campus(element) {
                                    <?php if(in_array(Orm_College::class, $filters)) { ?>
                                    //set colleges
                                    get_colleges_by_campus(element, 0, 1, '<?php echo $uniqid ?>');
                                    <?php } elseif(in_array(Orm_Department::class, $filters)) { ?>
                                    //set departments
                                    get_departments_by_campus(element, 0, 1, '<?php echo $uniqid ?>');
                                    <?php } elseif(in_array(Orm_Program::class, $filters)) { ?>
                                    //set programs
                                    get_programs_by_campus(element, 0, 1, '<?php echo $uniqid ?>');
                                    <?php } ?>
                                    submit_filter();
                                }
                            </script>
                        </div>
                    </div>
                <?php } ?>

                <?php if (in_array(Orm_College::class, $filters)) {
                ?>
                    <div class="col-md-<?php echo(12 / $ajax_filter) ?>">
                        <div class="input-group">
                            <span class="input-group-addon"><?php echo lang('College') ?></span>
                            <select id="college_block<?php echo $uniqid ?>" <?php echo $college_read_only ?> name="fltr[college_id]" class="form-control" onchange="filter_college(this)">
                                <option value=""><?php echo lang('All College') ?></option>
                                <?php
                                $list = array();

                                if (0 === count(array_diff([Orm_Campus::class], $filters))) {
                                    if (!empty($fltr['campus_in'])) {
//                                        $list = Orm_College::get_all(array('campus_id' => $fltr['campus_id']));
                                        $list = Orm_College::get_all(array('campus_in' => $fltr['campus_id']));
                                    }
                                } else {
                                    $list = Orm_College::get_all();
                                }
                                ?>
                                <?php foreach ($list as $option) { ?>
                                    <?php $selected = (isset($fltr['college_id']) && $option->get_id() == $fltr['college_id'] ? 'selected="selected"' : ''); ?>
                                    <option value="<?php echo $option->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($option->get_name()) ?></option>
                                <?php } ?>
                            </select>
                            <?php if($college_read_only) { ?>
                                <input type="hidden" name="fltr[college_id]" value="<?php echo (isset($fltr['college_id']) ? $fltr['college_id'] : '') ?>">
                            <?php } ?>
                            <script>
                                function filter_college(element) {
                                    <?php if(in_array(Orm_Department::class, $filters)) { ?>
                                    //set departments
                                    get_departments_by_college(element, 0, 1, '<?php echo $uniqid ?>');
                                    <?php } elseif(in_array(Orm_Program::class, $filters)) { ?>
                                    //set programs
                                    get_programs_by_college(element, 0, 1, '<?php echo $uniqid ?>');
                                    <?php } ?>
                                    submit_filter();
                                }
                            </script>
                        </div>
                    </div>
                <?php } ?>

                <?php if (in_array(Orm_Department::class, $filters)) { ?>
                    <div class="col-md-<?php echo(12 / $ajax_filter) ?>">
                        <div class="input-group">
                            <span class="input-group-addon"><?php echo lang('Department') ?></span>
                            <select id="department_block<?php echo $uniqid ?>" <?php echo $department_read_only ?> name="fltr[department_id]" class="form-control" onchange="filter_department(this)">
                                <option value=""><?php echo lang('All Department') ?></option>
                                <?php
                                $list = array();

                                if (0 === count(array_diff([Orm_Campus::class, Orm_College::class], $filters))) {
                                    if (!empty($fltr['college_id'])) {
                                        $list = Orm_Department::get_all(array('college_id' => $fltr['college_id']));
                                    }
                                } elseif (0 === count(array_diff([Orm_Campus::class], $filters))) {
                                    if (!empty($fltr['campus_id'])) {
                                        $list = Orm_Department::get_all(array('campus_id' => $fltr['campus_id']));
                                    }
                                } else {
                                    $list = Orm_Department::get_all();
                                }
                                ?>
                                <?php foreach ($list as $option) { ?>
                                    <?php $selected = (isset($fltr['department_id']) && $option->get_id() == $fltr['department_id'] ? 'selected="selected"' : ''); ?>
                                    <option value="<?php echo $option->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($option->get_name()) ?></option>
                                <?php } ?>
                            </select>
                            <?php if($department_read_only) { ?>
                                <input type="hidden" name="fltr[department_id]" value="<?php echo (isset($fltr['department_id']) ? $fltr['department_id'] : '') ?>">
                            <?php } ?>
                            <script>
                                function filter_department(element) {
                                    <?php if(in_array(Orm_Program::class, $filters)) { ?>
                                    //reset options
                                    $('#program_block<?php echo $uniqid ?>').html('<option value=""><?php echo lang('All Program') ?></option>');
                                    //set programs
                                    get_programs_by_department(element, 0, 1, '<?php echo $uniqid ?>');
                                    <?php } ?>
                                    submit_filter();
                                }
                            </script>
                        </div>
                    </div>
                <?php } ?>

                <?php if (in_array(Orm_Program::class, $filters)) { ?>
                    <div class="col-md-<?php echo(12 / $ajax_filter) ?>">
                        <div class="input-group">
                            <span class="input-group-addon"><?php echo lang('Program') ?></span>
                            <select id="program_block<?php echo $uniqid ?>" <?php echo $program_read_only ?> name="fltr[program_id]" class="form-control" onchange="filter_program(this)">
                                <option value=""><?php echo lang('All Program') ?></option>
                                <?php
                                $list = array();

                                if (0 === count(array_diff([Orm_Campus::class, Orm_College::class, Orm_Department::class], $filters))) {
                                    if (!empty($fltr['department_id'])) {
                                        $list = Orm_Program::get_all(array('department_id' => $fltr['department_id']));
                                    }
                                } elseif (0 === count(array_diff([Orm_Campus::class, Orm_College::class], $filters))) {
                                    if (!empty($fltr['college_id'])) {
                                        $list = Orm_Program::get_all(array('college_id' => $fltr['college_id']));
                                    }
                                } elseif (0 === count(array_diff([Orm_Campus::class], $filters))) {
                                    if (!empty($fltr['campus_id'])) {
                                        $list = Orm_Program::get_all(array('campus_id' => $fltr['campus_id']));
                                    }
                                } else {
                                    $list = Orm_Program::get_all();
                                }
                                ?>
                                <?php foreach ($list as $option) { ?>
                                    <?php $selected = (isset($fltr['program_id']) && $option->get_id() == $fltr['program_id'] ? 'selected="selected"' : ''); ?>
                                    <option value="<?php echo $option->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($option->get_name()) ?></option>
                                <?php } ?>
                            </select>
                            <?php if($program_read_only) { ?>
                                <input type="hidden" name="fltr[program_id]" value="<?php echo (isset($fltr['program_id']) ? $fltr['program_id'] : '') ?>">
                            <?php } ?>
                            <script>
                                function filter_program(element) {
                                    submit_filter();
                                }
                            </script>
                        </div>
                    </div>
                <?php } ?>

            </div>

            <hr>
        <?php } ?>

        <?php if ($extra_html || in_array('keyword', $filters)) { ?>
            <div class="row">

                <?php if ($extra_html) { ?>
                    <?php echo $extra_html ?>
                <?php } ?>

                <?php if (in_array('keyword', $filters)) { ?>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="fltr[keyword]"
                               placeholder="<?php echo lang('Keyword') ?>"
                               value="<?php echo htmlfilter(isset($fltr['keyword']) ? $fltr['keyword'] : '') ?>">
                    </div>
                <?php } ?>

            </div>

            <hr>
        <?php } ?>

        <div class="row">
            <div class="col-md-offset-6 col-md-3">
                <button class="btn btn-block" type="submit">
                    <span class="btn-label-icon left"><i class="fa fa-filter"></i></span>
                    <?php echo lang('Filters'); ?>
                </button>
            </div>
            <div class="col-md-3">
                <a class="btn btn-block" href="<?php echo $reset_url ?>">
                    <span class="btn-label-icon left"><i class="fa fa-recycle"></i></span>
                    <?php echo lang('Reset'); ?>
                </a>
            </div>
        </div>
    </form>
</div>

<script>
    function submit_filter() {
        $('#<?php echo $ajax_block ?>').html('<div class="progress progress-striped active"><div class="progress-bar" style="width: 100%;"></div></div>');
        // debugger;
        $.ajax({
            url: '<?php echo $ajax_url ?>',
            data: $('#form<?php echo $uniqid ?>').serialize()
        }).done(function (msg) {
            $('#<?php echo $ajax_block ?>').html(msg);
            init_data_toggle();
        }).fail(function () {
            console.log("error in submitting the filter by ajax");
            //window.location.reload();
        });

    }
</script>