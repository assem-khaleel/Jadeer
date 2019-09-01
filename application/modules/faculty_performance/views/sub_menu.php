<?php
$type_id = isset($type_id) ? $type_id : Orm_Fp_Forms_Type::TYPE_TEACHING;
?>
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-0">
    <?php foreach (Orm_Fp_Forms_Type::get_all() as $type) { ?>
    <li <?php if($type_id == $type->get_id()):?>class="active"<?php endif; ?>>
        <a class="p-y-1" href="/faculty_performance?type_id=<?php echo $type->get_id(); ?>" title="<?php echo htmlfilter($type->get_name()); ?>"><?php echo htmlfilter($type->get_name()); ?></a>
    </li>
    <?php } ?>
</ul>


