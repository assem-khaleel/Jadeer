<?php /** @var int $type */ ?>
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-0">
    <?php if($is_admin){ ?>
        <li <?php if ($tab == 'internal') : ?>class="active"<?php endif; ?>>
            <a class="p-y-1" href="/accreditation/reviewer_internal" title="<?php echo lang('Internal Reviewer'); ?>"><?php echo lang('Internal Reviewer'); ?></a>
        </li>
    <?php } ?>
    <?php if($is_admin || Orm_Acc_Independent_Reviewer::can_manege(Orm_Acc_Independent_Reviewer::TYPE_PROGRAM) || Orm_Acc_Independent_Reviewer::can_manege(Orm_Acc_Independent_Reviewer::TYPE_INSTITUTION)){ ?>
        <li <?php if ($tab == 'independent') : ?>class="active"<?php endif; ?>>
            <a class="p-y-1" href="/accreditation/reviewer_independent" title="<?php echo lang('Independent Reviewer'); ?>"><?php echo lang('Independent Reviewer'); ?></a>
        </li>
    <?php } ?>
    <?php if($is_admin || Orm_Acc_Pre_Visit_Reviewer::can_manege(Orm_Acc_Pre_Visit_Reviewer::TYPE_INSTITUTION) || Orm_Acc_Pre_Visit_Reviewer::can_manege(Orm_Acc_Pre_Visit_Reviewer::TYPE_PROGRAM)){ ?>
        <li <?php if ($tab == 'pre_visit') : ?>class="active"<?php endif; ?>>
            <a class="p-y-1" href="/accreditation/reviewer_pre_visit" title="<?php echo lang('Pre-Visit Reviewer'); ?>"><?php echo lang('Pre-Visit Reviewer'); ?></a>
        </li>
    <?php } ?>
    <?php if($is_admin || Orm_Acc_Visit_Reviewer::can_manege(Orm_Acc_Visit_Reviewer::TYPE_INSTITUTION) || Orm_Acc_Visit_Reviewer::can_manege(Orm_Acc_Visit_Reviewer::TYPE_PROGRAM)){ ?>
        <li <?php if ($tab == 'visit') : ?>class="active"<?php endif; ?>>
            <a class="p-y-1" href="/accreditation/reviewer_visit" title="<?php echo lang('Visit Reviewer'); ?>"><?php echo lang('Visit Reviewer'); ?></a>
    </li>
    <?php } ?>
</ul>

