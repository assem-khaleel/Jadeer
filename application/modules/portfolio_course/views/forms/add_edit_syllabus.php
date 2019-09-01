<?php
/** @var $assignment_obj Orm_Pc_Assignment */
$category = Orm_Pc_Category::get_instance($cat);

?>
<script src='/assets/jadeer/js/tinymce/tinymce.min.js'></script>
 
<div class="modal-dialog modal-sx animated fadeIn">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title"><?php echo $syllabus_field_obj->get_id()?lang('Edit').' '.$category->get_title():lang('Add').' '.$category->get_title() ?></h4>
        </div>
        <?php echo form_open("/portfolio_course/forms/edit/{$level}/{$syllabus_field_obj->get_id()}?id={$course_id}&cat={$cat}" , ['method' => 'post',"class"=>'inline-form',"name" => "addEditAssignment","id" => "addEditAssignment", 'enctype' => "multipart/form-data"]) ?>
        <div class="padding-sm-hr">
            <div class="modal-body">
                <?php foreach ($fields as $key => $value):
                      switch ($value->get_field_type()) :
                      case 'text' :?>
     
                <div class="row form-group">
                    <label for="desc_ar" class="control-label"><?php echo $value->get_title(); if($value->get_required() == 1) echo ' *';?>:</label>
                    <textarea type="text" name="<?php echo 'field'.$value->get_id() ?>" id="<?php echo 'field'.$value->get_id() ?>" class=" form-control"
                              placeholder="<?php echo $value->get_title(); ?>"><?php echo isset(unserialize($syllabus_field_obj->get_value())['field'.$value->get_id()]) ? unserialize($syllabus_field_obj->get_value())['field'.$value->get_id()]:''  ?></textarea>
                    <?php echo Validator::get_html_error_message('field'.$value->get_id()); ?>
                </div>
                
              <?php break; case 'richtext':?>
                <script>
                    tinymce.init({
                        selector: "#<?php echo 'field'.$value->get_id() ?>",
                        height: 200,
                        theme: "modern",
                        menubar: false,
                        file_browser_callback: elFinderBrowser,
                        font_size_style_values: "12px,13px,14px,16px,18px,20px",
                        plugins: [
                            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                            "searchreplace wordcount visualblocks visualchars code fullscreen",
                            "insertdatetime nonbreaking save table contextmenu directionality",
                            "emoticons template paste textcolor"
                        ],
                        toolbar1: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | fontselect | fontsizeselect",
                        toolbar2: "forecolor backcolor emoticons | link image | ltr rtl | print preview "
                    });
                </script>
                
                
                   <div class="form-group">
                <label class="control-label"> <?php echo $value->get_title(); if($value->get_required() == '1') echo ' *';?></label>
                <textarea name="<?php echo 'field'.$value->get_id() ?>" type="text" id="<?php echo 'field'.$value->get_id() ?>"
                          class="form-control"><?php echo isset(unserialize($syllabus_field_obj->get_value())['field'.$value->get_id()]) ? unserialize($syllabus_field_obj->get_value())['field'.$value->get_id()]:''  ?></textarea>

                <?php echo Validator::get_html_error_message('field'.$value->get_id()); ?>
            </div>

                <?php break; case 'date':?>
         
                <div class="row form-group">
                    <label for="start" class="control-label"><?php echo $value->get_title(); if($value->get_required() == '1') echo ' *';?>:</label>
                    <input type="text" name="<?php echo 'field'.$value->get_id() ?>" class="form-control" id="<?php echo 'field'.$value->get_id() ?>"
                           placeholder="<?php echo $value->get_title(); ?>"
                           value="<?php echo isset(unserialize($syllabus_field_obj->get_value())['field'.$value->get_id()]) ? unserialize($syllabus_field_obj->get_value())['field'.$value->get_id()]:''  ?>"/>
                    <?php echo Validator::get_html_error_message('field'.$value->get_id()); ?>
                </div>
      
                <script>
                $('#<?php echo 'field'.$value->get_id() ?>').datepicker({
                calendarWeeks: true,
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayBtn: 'linked',
                clearBtn: true,
                todayHighlight: true,
                daysOfWeekHighlighted: '1',
                orientation: 'auto',
                beforeShowMonth: function (date) {
                if (date.getMonth() === 8) {
                return false;
              }
              },
              beforeShowYear: function (date) {
            if (date.getFullYear() === 2014) {
                return false;
               }
             }
            });
                </script>
                <?php break; case 'radio':?>
                
                  <div class="row form-group">
                        <label class="col-sm-4 control-label"><?php echo $value->get_title(); if($value->get_required() == '1') echo ' *';?>:</label>
                        <div class="col-sm-8">
                            <label class="checkbox-inline">
                                <input type="radio" class="px" value="yes" name="<?php echo 'field'.$value->get_id() ?>" <?php echo $value->get_required() == '1' || (isset(unserialize($syllabus_field_obj->get_value())['field'.$value->get_id()]) && unserialize($syllabus_field_obj->get_value())['field'.$value->get_id()] == 'yes')? 'checked="checked"' : ''; ?>> <span class="lbl"><?php echo lang('Yes'); ?></span>
                            </label>
                            <label class="checkbox-inline">
                                <input type="radio" class="px" value="no" name="<?php echo 'field'.$value->get_id() ?>" <?php echo isset(unserialize($syllabus_field_obj->get_value())['field'.$value->get_id()]) && unserialize($syllabus_field_obj->get_value())['field'.$value->get_id()] == 'no'? 'checked="checked"' : ''; ?>> <span class="lbl"><?php echo lang('No'); ?></span>
                            </label>
                            <?php echo Validator::get_html_error_message('field'.$value->get_id()); ?>
                        </div>
                    </div>
    

        <?php break; case 'file':?>

                    <div class="row form-group">
                        <label class="control-label"><?php echo $value->get_title(); if($value->get_required() == '1') echo ' *';?>:</label>
                            <label class="custom-file px-file" id="<?php echo 'field'.$value->get_id() ?>">
                                <input type="file" name="<?php echo 'field'.$value->get_id() ?>" class="custom-file-input">
                                <span class="custom-file-control form-control"> <?php echo isset(unserialize($syllabus_field_obj->get_value())['field'.$value->get_id()]) && !is_array(unserialize($syllabus_field_obj->get_value())['field'.$value->get_id()]) && !empty(unserialize($syllabus_field_obj->get_value())['field'.$value->get_id()])? unserialize($syllabus_field_obj->get_value())['field'.$value->get_id()] : 'Attachment'; ?></span>
                                <div class="px-file-buttons">
                                    <button type="button" class="btn px-file-clear"><?php echo lang('Clear') ?></button>
                                    <button type="button" class="btn btn-primary px-file-browse"><?php echo lang('Browse') ?></button>
                                </div>
                            </label>
                            <?php echo Validator::get_html_error_message('field'.$value->get_id()); ?>
                    </div>
           
                <?php break; case 'checkbox':?>
          <div class="row form-group">
                    <label for="component" class="control-label"><?php echo $value->get_title(); if($value->get_required() == '1') echo ' *';?>:</label>
                    <?php echo Validator::get_html_error_message('field'.$value->get_id()); ?>
                    <div class="row">
                        <?php $components = explode(',',trim($value->get_value()));?>
                        <?php foreach ($components as $key1 => $component) { ?>
                            <div class="col-md-6">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="<?php echo 'field'.$value->get_id().'['.$key1.']' ?>" value="<?php echo $component; ?>" <?php echo (isset(unserialize($syllabus_field_obj->get_value())['field'.$value->get_id()][$key1]) && in_array(unserialize($syllabus_field_obj->get_value())['field'.$value->get_id()][$key1],$components))? 'checked="checked"' : ''; ?>>
                                    <span class="custom-control-indicator"></span>
                                    <?php echo lang($component); ?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                    
                </div>
                
        <?php break; default: break;    
              endswitch; endforeach;?>
                                  
            </div>
        </div>
        <div class="modal-footer">
            <div class=" text-right">
                <button type="button" class="btn pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i
                            class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn pull-right " <?php echo data_loading_text() ?>><span
                        class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
                </button>
            </div>
        </div>
  <?php echo form_close(); ?>      
        
    </div>
</div>

<script>

    $('.custom-file').pxFile();

    $('#addEditAssignment').on('submit', function (e) {
        e.preventDefault();
        var files = $(":file:enabled", this);
        if (files.length) {
            $.ajax($(this).attr('action'), {
                data: $(this).serializeArray(),
                files: $(":file:enabled", this),
                iframe: true,
                dataType: 'JSON'
            }).complete(function (data) {
                handle_response(data.responseJSON);
            });
        } else {
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'JSON'
            }).done(function (msg) {
                handle_response(msg);
            });
        }

        function handle_response(msg) {
            if (msg.status == true) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }
    });

</script>
