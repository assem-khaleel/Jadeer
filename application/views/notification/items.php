<?php
/**
 * Created by PhpStorm.
 * User: MAZEN
 * Date: 8/19/15
 * Time: 8:19 PM
 */
/** @var Orm_Notification[] $items */
?>
<ul class="list-group m-a-0">
    <?php foreach (Orm_Notification::get_all(array('receiver_id' => Orm_User::get_logged_user()->get_id()), 1, 15, array('n.id DESC')) as $item) { ?>
        <li class="list-group-item no-border-hr padding-xs-hr no-bg no-border-radius clearfix">
            <strong class="text-<?php echo $item->get_type_color(); ?>"><?php echo $item->get_type(true); ?></strong><br>
            <small><?php echo $item->get_subject(); ?> - <?php echo $item->get_sender_obj()->get_first_name(); ?>
                :: <?php echo $item->get_date_added(); ?></small>
            <span class="label bg-<?php echo $item->get_type_color(); ?> pull-right" style="line-height: 20px;">
				<a href="/notification/view_notification/<?php echo $item->get_id(); ?>" data-toggle="ajaxModal"><i
                            class="fa <?php echo $item->get_type_icon(); ?>"></i></a>
			</span>
        </li>
    <?php } ?>
    <?php if (!count($items)) { ?>
        <li class="alert alert-default">
            <strong><?php echo lang('No Notification'); ?>
                !</strong> <?php echo lang("You Don't have any notifications"); ?>
        </li>
    <?php } ?>
</ul>