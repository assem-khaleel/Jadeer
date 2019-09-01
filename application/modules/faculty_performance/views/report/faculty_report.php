<?php
/* @var $facilities Orm_User_Faculty*/
/* @var $form_types Orm_Fp_Forms_Type*/
/* @var $deadline string*/
?>
<?php if( Orm_Fp_Forms_Deadline::get_current_deadline()!=0){?>

<div class="col-md-12 col-lg-12 m-t-4">

    <div class="box p-a-1">
        <button class="btn btn-sm <?php echo($this->input->get_post('fltr') ? 'collapsed' : '') ?>"
                type="button" data-toggle="collapse" data-target="#filters" aria-expanded="false"
                aria-controls="filters">
            <span class="fa fa-filter"></span>
        </button>
        <?php echo lang('User List') ?>
    </div>

    <form class="form-horizontal">
        <div class="collapse <?php echo($this->input->get_post('fltr') ? 'in' : '') ?>" id="filters">
            <div class="well">
                <?php echo Orm_User::draw_common_filters();
                echo Orm_User_Faculty::draw_filters(true); ?>
                <div class="clearfix">
                    <a class="btn pull-left " href="/faculty_performance/faculty_report?type_id=0"><span
                            class="btn-label-icon left"><i
                                class="fa fa-recycle"></i></span><?php echo lang('Reset'); ?>
                    </a>
                    <button class="btn pull-right " type="submit" <?php echo data_loading_text() ?>>
                            <span class="btn-label-icon left"><i class="fa fa-filter"></i>
                            </span>
                        <?php echo lang('Filters'); ?>
                    </button>
                </div>
            </div>
        </div>
    </form>


    <div class="table-primary">
        <div class="table-header">
            <div class="row form-group">
                <span class="table-caption"><?php echo lang('Faculty Report'); ?></span>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th><?php echo lang('Faculty'); ?></th>
                <?php foreach ($form_types as $type) { /* @var $type Orm_Fp_Forms_Type*/?>
                    <th data-input="<?php echo $type->get_id(); ?>"><?php echo htmlfilter($type->get_name()); ?> (<?php echo htmlfilter($type->get_rate(Orm_Fp_Forms_Deadline::get_current_deadline())); ?>)</th>
                <?php } ?>
                <th class="col-md-2 col-lg-2 text-center"><?php echo lang('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            /** @var Orm_Fp_Forms_Type $forms */
            if ($facilities): ?>
            <?php foreach ($facilities as $faculty) : /* @var $faculty Orm_User_Faculty */ ?>
            <tr>
                <td>
                    <?php echo htmlfilter($faculty->get_full_name());
                    $rec = Orm_Fp_Forms_Recommendation::get_one(['category_id' => $faculty->get_id()]);
                    ?>

                </td>
                <?php
                foreach ($form_types as $type) { /* @var $type Orm_Fp_Forms_Type*/
                $evaluation = Orm_Fp_Forms_Evaluations::get_one(['type_id'=>$type->get_id(),'user_id' => $faculty->get_id() ,'deadline_id'=>$deadline]);
                ?>
                <?php if($evaluation->get_type_id() != 0){ ?>
                    <td data-type="<?php echo $evaluation->get_type_id()?>"
                        data-id="<?php echo $evaluation->get_id() ?>"
                        data-value="<?php echo $evaluation->get_value() ? htmlfilter($evaluation->get_value()) :0 ?>">
                        <?php echo $evaluation->get_value() ? htmlfilter($evaluation->get_value()) :0 ?></td>
                      <?php } else {
                        ?>
                        <td data-type="0" data-id="0" data-value="0">0</td>
                        <?php }}
                $hh = $rec::get_recmmedation_by_values($faculty->get_id(),$rec->get_type_id(),$deadline);
                ?>

                <td>
                    <a class="btn btn-sm btn-block edit" title="<?php echo lang('Edit') ?>">
                        <span class="btn-label-icon left fa fa-edit" aria-hidden="true"></span>
                        <?php echo lang('Edit') ?>
                    </a>
                    <a href="/faculty_performance/faculty_report/getReport/<?php echo $faculty->get_id() ?>" class="btn btn-sm btn-block"
                       title="<?php echo lang('HTML Report') ?>">
                        <span class="btn-label-icon left fa fa-fire" aria-hidden="true"></span>
                        <?php echo lang('HTML Report') ?>
                    </a>
                    <a href="/faculty_performance/faculty_report?type_id=5&&user_id=<?php echo $faculty->get_id() ?>" class="btn btn-sm btn-block"
                       title="<?php echo lang('Get Summary') ?>">
                        <span class="btn-label-icon left fa fa-eyedropper " aria-hidden="true"></span>
                        <?php echo lang('Get Summary') ?>
                    </a>
                </td>
                <input type="hidden" value="<?php echo htmlfilter($hh->get_recommendation_en())?>" class="recommendation_en">
                <input type="hidden" value="<?php echo htmlfilter($hh->get_recommendation_ar())?>" class="recommendation_ar">
                <input type="hidden" value="<?php echo htmlfilter($hh->get_action_en())?>" class="action_en">
                <input type="hidden" value="<?php echo htmlfilter($hh->get_action_ar())?>" class="action_ar">
                <input type="hidden" class="user_id" value="<?php echo intval( $faculty->get_id())?>">
                <input type="hidden" class="rec_id" value="<?php echo intval($rec->get_id())?>">
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="<?php echo count($form_types)+2?>">
                    <div class="well well-sm m-a-0">
                        <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Data'); ?></h3>
                    </div>
                </td>
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <?php if (!empty($pager)) { ?>
            <div class="table-footer">
                <?php echo $pager; ?>
            </div>
        <?php } ?>
    </div>
</div>

<div id="edit_modal" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false">

    <div class="modal-dialog modal-sx animated fadeIn">
        <div class="modal-content">
            <?php echo form_open("/faculty_performance/faculty_report/save", array('id' => 'formRate')); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?php echo lang('View').' '.lang('Faculty Forms') ?></h4>
            </div>

            <div class="padding-sm-hr">
                <div class="modal-body">
                    <?php foreach ($form_types as $type) { /* @var Orm_Fp_Forms_Type $type */?>
                        <div class="row form-group">
                            <label class="control-label"><?php echo $type->get_name(); ?>
                                (<?php echo $type->get_rate($deadline); ?>)</label>
                            <input type="text"
                                   data-type-value="<?php echo $type->get_id(); ?>"
                                   value=""
                                   data-max="<?php echo $type->get_rate($deadline); ?>"
                                   name="rate[<?php echo $type->get_id(); ?>][value]"
                                   class="form-control rateNum">
                            <input type="hidden" value="" name="rate[<?php echo $type->get_id(); ?>][id]" data-type-id="<?php echo $type->get_id(); ?>">
                        </div>

                    <?php  }

                    ?>
                    <div class="row form-group">
                        <label for="recommendation_ar"><?php echo lang('Recommendation'); ?> (<?php echo lang('Arabic') ?>)</label>
                        <textarea id="recommendation_ar" class="form-control" name="recommendation_ar"></textarea>
                    </div>
                    <div class="row form-group">
                        <label for="recommendation_en"><?php echo lang('Recommendation'); ?> (<?php echo lang('English') ?>)</label>
                        <textarea id="recommendation_en" class="form-control" name="recommendation_en"></textarea>
                    </div>
                    <div class="row form-group">
                        <label for="action_ar"><?php echo lang('Actions'); ?> (<?php echo lang('Arabic') ?>)</label>
                        <textarea id="action_ar" class="form-control" name="action_ar"></textarea>
                    </div>
                    <div class="row form-group">
                        <label for="action_en"><?php echo lang('Actions'); ?> (<?php echo lang('English') ?>)</label>
                        <textarea id="action_en" class="form-control" name="action_en"></textarea>
                    </div>
                    <input type="hidden" name="re_id" id="re_id" value="">
                </div>
            </div>
            <div class="modal-footer">
                <div class="row form-group">
                    <div class="hidden alert alert-danger text-left"  id="error_message">

                    </div>
                    <div class=" text-right">
                        <input type="hidden" id="userId" value="" name="user_id">
                        <input  type="submit" id="input-submit" class="btn editbtn" value="<?php echo lang('Save') ?>"/>
                        <button type="button" class="btn delbtn" data-dismiss="modal"
                                aria-hidden="true"><?php echo lang('Cancel') ?></button>
                    </div>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<?php }else{ ?>
    <div class="well">
        <div class="alert alert-default">
            <h3 class="m-a-0 text-center"><?php echo lang('There is no') . ' ' . lang('Current Deadline'); ?></h3>
        </div>
    </div>
<?php } ?>
<script>


    $(".edit").off().click(function () {
        $('#formRate').find("input[type=text], textarea").val("");
        var countTd=  $(this).parent().parent().find('td').length;
        var numForms=countTd-2;
        for (i = 0; i <= numForms; i++) {
            var td = $(this).parent().parent().find('td').eq(i);
            var type = td.attr('data-type');
            var val = td.attr('data-value');
            var id = td.attr('data-id');
            var tr = $(this).parent().parent();

            $('input[data-type-value=' + type + ']').val(val);
            $('input[data-type-id=' + type + ']').val(id);

            var recEn = tr.find($('.recommendation_en')).val();
            var recAr = tr.find($('.recommendation_ar')).val();

            var actionEn = tr.find($('.action_en')).val();
            var actionAr = tr.find($('.action_ar')).val();


            $('#userId').val(tr.find($('.user_id')).val());
            $('#re_id').val(tr.find($('.rec_id')).val());
            $('#recommendation_en').val(recEn);
            $('#recommendation_ar').val(recAr);
            $('#action_en').val(actionEn);
            $('#action_ar').val(actionAr);
        }
        $("#edit_modal").modal('show');
    });
    $('#formRate').on('submit', function (e) {
        e.preventDefault();

        var $ajaxProp = {
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        };

        $.ajax($ajaxProp).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#error_message').html(msg.html).removeClass('hidden');
            }
        });
    });

    $('.rateNum').TouchSpin({
        min: 0,
        max: 100,
        boostat: 5,
        maxboostedstep: 10
    });
</script>


