<?php $authinticated= $can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester();?>
<div class="panel panel-primary p-a-0">
    <div class="panel-heading">
        <span class="panel-title"><?php echo lang('Custom Items'); ?></span>
        <?php if ($can_manage) { ?>
        <a class="btn btn-sm  pull-right topic" href="/portfolio_course/forms/add_edit_custom_menu/<?php echo $menu_params['type']?>?id=<?php echo $course_id; ?>" data-toggle="ajaxModal" title="<?php echo lang('Add') ?>">
                     <span class="left icon fa fa-plus" aria-hidden="true"> </span>
        </a>
        <?php } ?>
    </div>
    <div class="panel-body remove-spaces p-a-0">

        <ul id="left-nav" class="nav nav-tabs nav-stacked ">
            <?php foreach ($custom_menus as $custom_menu) :?>
                <li id="catalog_info clearfix" <?php echo $authinticated ? " ":'style="width: 162%;" ';?> class="<?php echo ($active==$custom_menu->get_id()) ?'active':''; ?>" >

                    <a href="/portfolio_course/forms?id=<?php echo $course_id ?>&level=<?php echo $menu_params['type']?>&catid=<?php echo $custom_menu->get_id()?>" class="<?php echo $can_manage ? 'col-md-7 col-lg-7  m-r-1 m-b-1' : 'col-md-12 col-lg-12 m-b-1'; ?>"><?php echo  htmlfilter($custom_menu->get_title())?></a>
                    <?php if ($authinticated){ ?>
                        <a href="/portfolio_course/forms/add_edit_custom_menu/<?php echo $menu_params['type']?>/<?php echo intval($custom_menu->get_id()) ?>?id=<?php echo $course_id; ?>&cat=<?php echo $custom_menu->get_id();?>" data-toggle="ajaxModal" class="btn btn-sm col-md-2 m-b-1" title="<?php echo lang('Edit') ?>">
                            <span class="left icon fa fa-pencil-square-o" aria-hidden="true"></span>
                        </a>
                    <a href="/portfolio_course/forms/delete/<?php echo $menu_params['type']?>/<?php echo intval($custom_menu->get_id()) ?>?id=<?php echo $course_id; ?>&cat=<?php echo $custom_menu->get_id();?>" class="btn btn-sm col-md-2 m-b-1 pull-right" title="<?php echo lang('Delete') ?>" data-toggle="deleteRedirectAction">
                            <span class="left fa fa-trash-o" aria-hidden="true"></span>
                        </a>
                    <?php } ?>
                </li>
            <?php endforeach; ?>
            <?php if (empty($custom_menu)) { ?>
                <li style="width: 100%;">
                    <div class="well">
                        <div class="alert alert-default">
                            <?php echo lang('No Custom Items') ?>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>

    </div>
</div>

