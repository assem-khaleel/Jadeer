<li class="m-a-1" style="position: relative;" onclick="$(this).children('input').prop('checked', true); url = '<?php echo htmlfilter($node->get_system_url()); ?>';">
    <span class="fa fa-certificate fa-2x"></span>
    <span class="glyphicon-class">
        <?php echo htmlfilter($node->get_name()); ?>
    </span>
    <input type="radio" name="system" value="<?php echo get_class($node); ?>"/>

    <?php if (isset($abbreviation) && $abbreviation) { ?>
        <div style="position: absolute; left: 0; top: 0; width: 0; height: 0; border-top: 50px solid gray; border-right: 50px solid transparent;">
            <p style="position: relative; left: 12px; top: -43px; color: white; font-family: serif; font-size: 16px;"><?php echo $abbreviation; ?></p>
        </div>
    <?php } ?>
</li>