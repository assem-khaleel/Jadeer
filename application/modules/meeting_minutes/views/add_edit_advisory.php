<?php
/** @var $meeting Orm_Mm_Meeting */

$college = $meeting->get_level_id() ? Orm_Program::get_instance($meeting->get_level_id())->get_department_obj()->get_college_obj()->get_name() : $user_login->get_college_obj()->get_name();
$department = $meeting->get_level_id() ? Orm_Program::get_instance($meeting->get_level_id())->get_department_obj()->get_name() : $user_login->get_department_obj()->get_name();
$program = $meeting->get_level_id() ? Orm_Program::get_instance($meeting->get_level_id())->get_name() : $user_login->get_program_obj()->get_name();
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <?php echo lang('Meeting Minutes Information')?>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th><?php echo lang('Level')?></th>
                <th><?php echo lang('Program')?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo lang('College')?></td>
                <td><?php echo htmlfilter($college)?></td>
            </tr>
            <tr>
                <td><?php echo lang('Department')?></td>
                <td><?php echo htmlfilter($program)?></td>
            </tr>
            <tr>
                <td><?php echo lang('Program')?></td>
                <td><?php echo htmlfilter($department)?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>