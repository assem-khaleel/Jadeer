<?php
/** @var $package int */
/** @var $expiration int */
/** @var $available_modules array */

function get_config_setting(&$setting) {

    $required = $setting['required'];
    $how = placeholder($setting['how']);

    $status = false;
    eval ("\$status = {$how} {$required};");
    $setting['status'] = $status;

    $actual = false;
    eval ("\$actual = is_bool({$how}) ? ({$how} ? 'Yes' : 'No') : {$how};");
    $setting['actual'] = $actual;

    preg_match_all('~(["\'])([^"\']+)\1~', $how, $matches);
    $setting['path'] = isset($matches[2][0]) ? $matches[2][0] : '';
}

function placeholder($subject){
    $search = array(
        '{project_path}'
    );
    $replace = array(
        rtrim(FCPATH, '/')
    );

    return str_replace($search, $replace, $subject);
}

?>
<a href="/eaa/logout" class="btn btn-primary"><?php echo lang('Log Out')?></a>

<?php echo form_open(); ?>
<table class="table table-bordered m-y-2">
    <tr>
        <td class="col-md-3 valign-middle"><?php echo lang('Expiration')?></td>
        <td class="col-md-9">
            <div class="form-group m-a-0">
                <input name="expiration" id="expiration" value="<?php echo date('Y-m-d', strtotime($expiration)); ?>"
                       class="form-control"/>
                <?php echo Validator::get_html_error_message('expiration'); ?>
            </div>
        </td>
    </tr>
    <tr>
        <td class="col-md-3 valign-middle"><?php echo lang('Package')?></td>
        <td class="col-md-9">
            <div class="form-group m-a-0">
                <select class="form-control" name="package" id="package">
                    <?php foreach (License::$packages as $package_key => $package_value) { ?>
                        <?php $selected = $package == $package_key ? 'selected="selected"' : ''; ?>
                        <option value="<?php echo $package_key ?>" <?php echo $selected; ?>><?php echo $package_value; ?></option>
                    <?php } ?>
                </select>
                <?php echo Validator::get_html_error_message('package'); ?>
            </div>
        </td>
    </tr>
    <tr>
        <td class="col-md-3 valign-middle"><?php echo lang('Colleges / Programs')?></td>
        <td class="col-md-9">
            <div class="form-group m-a-0">
                <div>
                    <?php
                    $this->db->select('c.id, c.name_en');
                    $this->db->distinct();
                    $this->db->from(Orm_College::get_table_name() . ' AS c');
                    $this->db->where('c.is_deleted', 0);
                    $all_colleges = $this->db->get()->result_array();
                    ?>
                    <?php foreach ($all_colleges as $college) { ?>
                        <label class="custom-control custom-checkbox">
                            <input name="colleges[<?php echo $college['id'] ?>]" value="<?php echo $college['id'] ?>"
                                   id="college-checkbox-<?php echo $college['id'] ?>" <?php echo(in_array($college['id'], $colleges) ? 'checked="checked"' : '') ?>
                                   class="custom-control-input college-checkbox" type="checkbox">
                            <span class="custom-control-indicator"></span>
                            <?php echo htmlfilter($college['name_en']) ?>
                        </label>
                        <div class="m-x-4">
                            <?php
                            $this->db->select('p.id, p.name_en');
                            $this->db->distinct();
                            $this->db->from(Orm_Program::get_table_name() . ' AS p');
                            $this->db->join(Orm_Department::get_table_name() . ' AS d', 'd.id = p.department_id AND d.is_deleted = 0', 'INNER');
                            $this->db->join(Orm_College::get_table_name() . ' AS c', 'c.id = d.college_id AND c.is_deleted = 0', 'INNER');
                            $this->db->where('p.is_deleted', 0);
                            $this->db->where('c.id', $college['id']);
                            $all_programs = $this->db->get()->result_array();
                            ?>
                            <?php foreach ($all_programs as $program) { ?>
                                <label class="custom-control custom-checkbox">
                                    <input name="programs[<?php echo $program['id'] ?>]"
                                           value="<?php echo $program['id'] ?>" <?php echo(in_array($program['id'], $programs) ? 'checked="checked"' : '') ?>
                                           class="custom-control-input college-checkbox-<?php echo $college['id'] ?> program-checkbox"
                                           type="checkbox">
                                    <span class="custom-control-indicator"></span>
                                    <?php echo htmlfilter($program['name_en']) ?>
                                </label>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <?php echo Validator::get_html_error_message_no_arrow('colleges_programs'); ?>
            </div>
        </td>
    </tr>
    <tr>
        <td class="col-md-3 valign-middle"><?php echo lang('Modules')?></td>
        <td class="col-md-9">
            <div class="form-group m-a-0">
                <div>
                    <?php foreach (array_keys($available_modules) as $module) { ?>
                        <label class="custom-control custom-checkbox">
                            <input name="modules[<?php echo htmlfilter($module) ?>]"
                                   value="true" <?php echo(empty($modules[$module]) ? '' : 'checked="checked"') ?>
                                   class="custom-control-input modules" type="checkbox">
                            <span class="custom-control-indicator"></span>
                            <?php echo htmlfilter(ucwords(str_replace('_', ' ', $module))) ?>
                        </label>
                    <?php } ?>
                </div>
                <?php echo Validator::get_html_error_message_no_arrow('modules'); ?>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2">

            <div class="well" style="background-color: white; color: #0d0d10;">
                <h4 class="m-a-0 m-b-2">Cron Job</h4>
                <code class="p-a-1">
                    env EDITOR=vi crontab -e
                </code>
                <br><br>
                <code class="p-a-1">
                    0 20 * * * php <?php echo FCPATH ?>index.php cli checker >> <?php echo FCPATH ?>logs/cron.log
                </code>
            </div>

            <div class="well m-a-0" style="background-color: white; color: #0d0d10;">
                <?php foreach ($server_requirements as $category => $config) { ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <td width="35%"><b><?php echo $category; ?></b></td>
                            <td width="25%"><b>Current Settings</b></td>
                            <td width="25%"><b>Required Settings</b></td>
                            <td width="15%" class="text-center"><b>Status</b></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($config as $name => $value) { ?>
                            <?php get_config_setting($value); ?>
                            <tr>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $value['actual']; ?></td>
                                <td><?php echo $value['required_settings']; ?></td>
                                <td class="text-center">
                                    <?php if ($value['status']) { ?>
                                        <span class="text-success"><i class="fa fa-check-circle"></i></span>
                                    <?php } else { ?>
                                        <span class="text-danger"><i class="fa fa-warning"></i></span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php if(is_dir($value['path']) || is_file($value['path'])) { ?>
                                <tr class="bg-warning">
                                    <td colspan="4"><?php echo $value['path']; ?></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>

        </td>
    </tr>
</table>
<?php echo form_submit('save', 'Save', 'class="btn btn-primary btn-block"') ?>
<?php echo form_close(); ?>

<script>

    $('#package').change(function () {

        if ($(this).val() != <?php echo License::PACKAGE_STANDARD ?>) {
            $('.college-checkbox').prop("checked", true);
            $('.program-checkbox').prop("checked", true);
        } else {
            $('.college-checkbox').prop("checked", false);
            $('.program-checkbox').prop("checked", false);
        }

        if ($(this).val() == <?php echo License::PACKAGE_ULTIMATE ?>) {
            $('.modules').prop("checked", true);
        } else {
            $('.modules').prop("checked", false);
        }
    });

    $('.college-checkbox').change(function () {
        var id_str = $(this).attr('id');

        if ($(this).is(':checked')) {
            $('.' + id_str).prop("checked", true);
        } else {
            $('.' + id_str).prop("checked", false);
        }
    });

    $('.program-checkbox').change(function () {
        var class_str = $(this).attr('class');

        var found = class_str.match(/college-checkbox-(\d+)/);

        if (found) {
            var selector = found[0];

            if ($(this).is(':checked')) {
                $('#' + selector).prop("checked", true);
            } else {
                if ($('.' + selector + ':checked').length == 0) {
                    $('#' + selector).prop("checked", false);
                }
            }
        }
    });

    $(function () {
        $('#expiration').datepicker({format: 'yyyy-mm-dd', autoclose: true});
    });

</script>