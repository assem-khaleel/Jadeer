<?php /** @var $active string  */ ?>

<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-2">
    <li <?php if ($active == 'general') {echo 'class="active"';} ?>>
        <a href="/student_portfolio/general_info/<?php echo $user_id ?>" title="<?php echo lang('General Information'); ?>"><?php echo lang('General Information'); ?></a>
    </li>
    <li <?php if ($active == 'academic') {echo 'class="active"';} ?>>
        <a href="/student_portfolio/academic_info/<?php echo $user_id ?>" title="<?php echo lang('Academic Information'); ?>"><?php echo lang('Academic Information'); ?></a>
    </li>
    <li <?php if ($active == 'personal') {echo 'class="active"';} ?>>
        <a href="/student_portfolio/personal_info/<?php echo $user_id; ?>" title="<?php echo lang('Personal Information'); ?>"><?php echo lang('Personal Information'); ?></a>
    </li>
     <?php /*
    <li <?php if ($active == 'recommendation') {echo 'class="active"';} ?>>
        <a href="/student_portfolio/recommendation_complaint/<?php echo $user_id; ?>" title="<?php echo lang('Recommendations & Complaint'); ?>"><?php echo lang('Recommendations & Complaint'); ?></a>
    </li>
     */ ?>
    <?php /*
    <li <?php if ($active == 'career') {echo 'class="active"';} ?><!
        <a href="/student_portfolio/career/<?php echo $user_id; ?>" title="<?php echo lang('Career Opening'); ?>"><?php echo lang('Career Opening'); ?></a>
    </li>
    */ ?>
</ul>
