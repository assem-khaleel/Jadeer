<?php
/** @var $institution Orm_Institution */
$license = License::get_instance();
?>
<div class="col-md-9 col-lg-10">

    <table class="table table-bordered m-b-3">
        <tr>
            <td class="col-md-3 valign-middle">
                <?php echo lang('Expiration') ?>
            </td>
            <td class="col-md-9">
                <?php echo date('Y-m-d', strtotime($license->get_expiration())); ?>
            </td>
        </tr>
        <tr>
            <td class="col-md-3 valign-middle">
                <?php echo lang('Package') ?>
            </td>
            <td class="col-md-9">
                <?php echo License::$packages[$license->get_package()]; ?>
            </td>
        </tr>
        <tr>
            <td class="col-md-3 valign-middle">
                <?php echo lang('Number of Colleges'); ?>
            </td>
            <td class="col-md-9">
                <?php echo($license->get_package() === License::PACKAGE_ULTIMATE ? lang('Unlimited') : count($license->get_colleges())) ?>
            </td>
        </tr>
        <tr>
            <td class="col-md-3 valign-middle">
                <?php echo lang('Number of Programs'); ?>
            </td>
            <td class="col-md-9">
                <?php echo($license->get_package() === License::PACKAGE_ULTIMATE ? lang('Unlimited') : count($license->get_programs())) ?>
            </td>
        </tr>
    </table>

    <?php if ($institution->get_id()) { ?>
        <?php echo $institution->draw_goals(); ?>
        <?php echo $institution->draw_objectives(); ?>
    <?php } ?>

</div>

