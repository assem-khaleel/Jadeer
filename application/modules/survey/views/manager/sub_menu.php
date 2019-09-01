<?php /** @var int $type */ ?>
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-0">
    <?php foreach (Orm_Survey::$survey_types as $type_id => $type_name) { ?>
        <?php $survey_type = strtolower($type_name); ?>
        <?php if (Orm_User::check_credential(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY),false,"survey_{$survey_type}-list")) { ?>
            <li <?php if ($type == $type_id) : ?>class="active"<?php endif; ?>>
                <a class="p-y-1" href="/survey?type=<?php echo $type_id; ?>"
                   title="<?php echo lang($type_name); ?>"><?php echo lang($type_name); ?></a>
            </li>
        <?php } ?>
    <?php } ?>
</ul>