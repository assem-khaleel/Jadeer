<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 7/10/17
 * Time: 9:22 AM
 */
?>
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-2">
    <li <?php if($type == 'club'):?>class="active"<?php endif; ?>>
        <a class="p-y-1" href="/team_formation" title="<?php echo lang('Clubs'); ?>"><?php echo lang('Clubs'); ?></a>
    </li>
    <li <?php if($type == 'discover'):?>class="active"<?php endif; ?>>
        <a class="p-y-1" href="/team_formation/discover" title="<?php echo lang('Discover'); ?>"><?php echo lang('Discover'); ?></a>
    </li>
    <li <?php if($type == 'manage'):?>class="active"<?php endif; ?>>
        <a class="p-y-1" href="/team_formation/manage" title="<?php echo lang('Manage'); ?>"><?php echo lang('Manage'); ?></a>
    </li>
</ul>


