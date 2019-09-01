<?php
/**
 * Created by PhpStorm.
 * User: Mazen Dabet
 * Date: 10/3/15
 * Time: 10:18 PM
 */
/** @var string $type */
?>
<ul class="nav nav-tabs nav-tabs-sm nav-justified m-b-1">
    <li <?php if ($type == 'manager') : ?>class="active"<?php endif; ?>>
        <a href="/strategic_planning/dashboard"
           title="<?php echo lang('Dashboard'); ?>"><?php echo lang('Dashboard'); ?></a>
    </li>
    <li <?php if (in_array($type, array('vision_mission', 'goals', 'objectives', 'action_plan', 'project', 'activity'))) : ?>class="active"<?php endif; ?>>
        <a href="/strategic_planning"
           title="<?php echo lang('Vision & Mission'); ?>"><?php echo lang('Vision & Mission'); ?></a>
    </li>
</ul>