<?php
function draw_language($languages, $language_id)
{
    ob_start();
    ?>
    <div class="col-md-12 m-b-2">
        <div class="input-group">
            <span class="input-group-addon"><?php echo lang('Language') ?></span>
            <select name="language_id" class="form-control">
                <option value=""><?php echo lang('All Languages'); ?></option>
                <?php foreach ($languages as $lang_key => $lang_value) { ?>
                    <option value="<?php echo $lang_value; ?>" <?php echo isset($language_id) && $language_id == $lang_value ? 'selected="selected"' : ''; ?> ><?php echo lang($lang_key); ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

?>

<div class="col-md-9 col-lg-10">
    <div class="table-primary">
        <div class="table-header">
            <?php echo filter_block('/language/filter', '/language', ['keyword'], '', draw_language($languages, $language_id)); ?>
        </div>
        <?php echo form_open('/language/save', 'id="language-form"'); ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-4"><?php echo lang('String'); ?></th>
                <th class="col-lg-1"><?php echo lang('Language'); ?></th>
                <th class="col-lg-4"><?php echo lang('Translation'); ?></th>
                <?php if (ENVIRONMENT == 'development') { ?>
                    <th class="col-lg-2 text-center"><?php echo lang('Actions'); ?></th>
                    <?php
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            /* @var Orm_Translation $translation */
            if ($translations):
                foreach ($translations as $translation) {
                    ?>
                    <tr>
                        <td><?php echo htmlfilter(str_replace('_', ' ', $translation->get_string())); ?></td>
                        <td><?php echo lang(array_search($translation->get_language_id(), $languages)); ?></td>
                        <td>
                        <textarea class="form-control"
                                  name="translations[<?php echo (int)$translation->get_id(); ?>]"><?php echo htmlfilter(isset($translations[$translation->get_string()]) ? $translations[$translation->get_string()] : $translation->get_translation()); ?></textarea>
                        </td>
                        <?php if (ENVIRONMENT == 'development') { ?>
                            <td class="text-center">
                                <a href="/language/remove/<?php echo $translation->get_id(); ?>"
                                   class="btn btn-block btn-sm " data-toggle="deleteAction" message="<?php echo lang('Are you sure ?') ?>"
                                   style="margin-bottom: 3px;">
                                    <span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span>
                                    <?php echo lang('Delete') ?>
                                </a>

                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                }
                ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Translations'); ?></h3>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <?php echo form_close(); ?>
        <div class="table-footer clearfix">
            <?php echo(isset($pager) ? $pager : ""); ?>
            <button onclick="$('#language-form').submit();" class="btn pull-right" <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left fa fa-save"></span><?php echo lang('Save'); ?>
            </button>
        </div>
    </div>
</div>
