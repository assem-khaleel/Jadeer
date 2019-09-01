<?php /** @var $active string  */ ?>
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-2 ">
    <li <?php if ($active == 'deadline') {echo 'class="active"';} ?>>
        <a href="/faculty_performance/faculty_settings/" class="p-y-1" title="<?php echo lang('Deadline'); ?>"><?php echo lang('Deadline'); ?></a>
    </li>
    <li <?php if ($active == 'type') {echo 'class="active"';} ?>>
        <a href="/faculty_performance/faculty_settings/type/"  class="p-y-1" title="<?php echo lang('Type Settings'); ?>"><?php echo lang('Type Settings'); ?></a>
    </li>
    <li <?php if ($active == 'settings') {echo 'class="active"';} ?>>
        <a href="/faculty_performance/faculty_settings/settings/"  class="p-y-1" title="<?php echo lang('Form Settings'); ?>"><?php echo lang('Form Settings'); ?></a>
    </li>
</ul>