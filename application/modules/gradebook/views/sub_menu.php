<?php

/** @var string $type */
$type = isset($type) ? $type : '';
?>
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-0">
    <?php if (License::get_instance()->check_module('curriculum_mapping', true)): ?>
    <li <?php echo ($type == 'curriculum' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="/gradebook/view_students/curriculum/<?php echo $section_id ?>" title="<?php echo lang('Curriculum'); ?>">
            <?php echo lang('Curriculum'); ?>
        </a>
    </li>
    <?php endif; ?>

    <?php if (License::get_instance()->check_module('examination', true)): ?>
    <li <?php echo ($type == 'examination' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="/gradebook/view_students/examination/<?php echo $section_id ?>" title="<?php echo lang('Examination'); ?>">
            <?php echo lang('Examination'); ?>
        </a>
    </li>
    <?php endif; ?>
</ul>