

<div class="col-md-3 col-lg-3 m-t-1">
    <ul class="nav nav-sm nav-pills nav-stacked m-b-3">
       
        
        <?php foreach (Orm_Fp_Forms_Type::get_all() as $type ) { /* @var $type Orm_Fp_Forms_Type  */?>
            
            <?php $active = (isset($sub_tab) && $sub_tab ==  $type->get_id() ? ' active' : ''); ?>
            <li class="b-a-1 border-default <?php echo $active ?>">
                <a class="btn" href="/faculty_performance/faculty_settings/forms/<?php echo $type->get_id(); ?>" title="<?php echo $type->get_name(); ?>">
                    <?php echo htmlfilter($type->get_name()); ?>
                </a>
            </li>
            
        <?php } ?>
    </ul>
</div>


