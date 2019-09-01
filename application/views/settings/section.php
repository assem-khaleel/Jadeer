<div class="panel panel-primary panel-dark widget-profile">
    <div class="panel-heading">
        <span class="widget-profile-bg-icon"><i class="fa fa-<?php echo !empty($icon) ? $icon : 'cong'; ?>"></i></span>
        <br>
        <span class="widget-profile-header">
            <?php echo $section_title; ?>
        </span>
    </div> <!-- / .panel-heading -->
    <div class="list-group">
        <?php foreach ($section_actions as $action_title => $action) : ?>
            <?php if ($action['visible']) : ?>
                <a class="list-group-item" href="<?php echo $action['url']; ?>">
                    <i class="fa fa-magic list-group-icon"></i>
                    <?php echo $action_title; ?>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>