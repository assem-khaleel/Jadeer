<?php /** @var $active string  */ ?>
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-2 ">
    <li <?php if ($active == 'general') {echo 'class="active"';} ?>>
        <a href="/faculty_portfolio/view/<?php echo $user_id ?>" class="p-y-1" title="<?php echo lang('General'); ?>"><?php echo lang('General'); ?></a>
    </li>
    <li <?php if ($active == 'personal') {echo 'class="active"';} ?>>
        <a href="/faculty_portfolio/general_info/<?php echo $user_id ?>"  class="p-y-1" title="<?php echo lang('Personal Info'); ?>"><?php echo lang('Personal Info'); ?></a>
    </li>
    <li <?php if ($active == 'publication') {echo 'class="active"';} ?>>
        <a href="/faculty_portfolio/publication/info/<?php echo $user_id ?>"  class="p-y-1" title="<?php echo lang('Publication'); ?>"><?php echo lang('Publication'); ?></a>
    </li>
    <li <?php if ($active == 'academic') {echo 'class="active"';} ?>>
        <a href="/faculty_portfolio/academic/info/<?php echo $user_id ?>"  class="p-y-1" title="<?php echo lang('Academic'); ?>"><?php echo lang('Academic'); ?></a>
    </li>
    <li <?php if ($active == 'work') {echo 'class="active"';} ?>>
        <a href="/faculty_portfolio/work/info/<?php echo $user_id ?>"  class="p-y-1" title="<?php echo lang('Work'); ?>"><?php echo lang('Work'); ?></a>
    </li>
    <li <?php if ($active == 'evaluation') {echo 'class="active"';} ?>>
        <a href="/faculty_portfolio/evaluation/info/<?php echo $user_id ?>"  class="p-y-1" title="<?php echo lang('Evaluation'); ?>"><?php echo lang('Evaluation'); ?></a>
    </li>
</ul>