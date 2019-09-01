<div class="page-header <?php echo empty($menu_view) ? '' : 'p-b-0'; ?>">
    <div class="row">
        <div class="col-md-9 text-xs-center text-md-left">
            <h1><i class="<?php echo $icon ?> page-header-icon"></i>&nbsp;&nbsp;<?php echo $title ?></h1>
            <?php if(isset($sub_title)): ?>
                <ul>
                    <li><?php echo $sub_title; ?></li>
                </ul>
            <?php endif; ?>
        </div>

        <?php if (!(empty($link_attr) || empty($link_title))) { ?>
            <hr class="page-wide-block visible-xs visible-sm">

            <div class="col-xs-12 col-md-3 pull-md-right">
                <a <?php echo $link_attr ?> class="btn btn-primary btn-block" <?php echo isset($data_toggle) ? 'data-toggle="'.$data_toggle.'"' : ''; ?> >
                    <span class="btn-label-icon left fa fa-<?php echo isset($link_icon) ? $link_icon : 'download'; ?>"></span>
                    <?php echo $link_title ?>
                </a>
            </div>
        <?php } ?>

        <!-- Spacer -->
        <div class="m-b-2 visible-xs visible-sm clearfix"></div>
    </div>
    <?php
    if (!empty($menu_view)) {
        echo '<hr class="page-wide-block m-b-0">';
        $menu_params = empty($menu_params) ? array() : $menu_params;
        $this->load->view($menu_view, $menu_params);
    }
    ?>
</div>