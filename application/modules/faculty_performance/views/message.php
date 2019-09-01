<div class="well">
    <div class="alert alert-<?php echo htmlfilter($html_class) ?> m-a-0">
        <strong><?php echo htmlfilter($title) ?></strong>
        <?php
        if($message) {
            echo htmlfilter($message);
        }
        ?>
    </div>
</div>
