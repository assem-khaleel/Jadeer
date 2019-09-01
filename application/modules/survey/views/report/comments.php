<div class="box p-a-1">
    <button class="btn btn-sm <?php echo($this->input->get_post('fltr') ? 'collapsed' : '') ?>" type="button"
            data-toggle="collapse" data-target="#filters" aria-expanded="false" aria-controls="filters">
        <span class="fa fa-filter"></span>
    </button>

    <?php echo lang($survey->get_type(true)) ?>
</div>

<?php echo form_open('', array('class' => 'form-horizontal')) ?>
    <div class="collapse <?php echo($this->input->get_post('fltr') ? 'in' : '') ?>" id="filters">
        <div class="well">
            <?php
            switch ($survey->get_type()) {
                case Orm_Survey::TYPE_ALUMNI :
                    echo Orm_User_Alumni::draw_filters();
                    break;

                case Orm_Survey::TYPE_EMPLOYER :
                    echo Orm_User_Employer::draw_filters();
                    break;

                case Orm_Survey::TYPE_FACULTY :
                    echo Orm_User_Faculty::draw_filters();
                    break;

                case Orm_Survey::TYPE_STAFF :
                    echo Orm_User_Staff::draw_filters();
                    break;

                case Orm_Survey::TYPE_STUDENTS :
                    echo Orm_User_Student::draw_filters();
                    break;
            }
            ?>
            <input type="hidden" name="survey_id" value="<?php echo htmlfilter($survey->get_id()); ?>"/>

            <div class="clearfix">
                <a class="btn pull-left "
                   href="<?php echo preg_replace('/(.*)\?(.*)/', '$1?survey_id=' . intval($survey->get_id()), $this->input->server('REQUEST_URI')) ?>"><span class="btn-label-icon left"><i class="fa fa-recycle"></i></span><?php echo lang('Reset'); ?></a>
                <button class="btn pull-right " type="submit"><span class="btn-label-icon left"><i class="fa fa-filter"></i></span><?php echo lang('Filters'); ?></button>
            </div>
        </div>
    </div>
<?php echo form_close() ?>

<div class="table-light">
    <div class="table-header">
        <div class="table-caption">
            <?php echo lang('Comment/Essay Box'); ?>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-md-1 text-center">#</th>
                <th class="col-md-11"><?php echo lang('Response'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if ($items): ?>
                <?php
                $index = 0;
                foreach ($items as $item) {
                    /* @var $item Orm_Survey_User_Response_Text */
                    $index++;
                    ?>
                    <tr>
                        <td class="col-md-1 text-center"><?php echo $index; ?></td>
                        <td class="col-md-11"><?php echo nl2br(htmlfilter($item->get_value())); ?></td>
                    </tr>
                <?php } ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if (!empty($pager)): ?>
        <div class="table-footer">
            <?php echo $pager; ?>
        </div>
    <?php endif; ?>
</div>