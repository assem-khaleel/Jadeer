<?php
/* @var $node Orm_Node */
$id_perfix = 'node_';
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php $parent_node = Orm_Node::get_instance($node->get_parent_id()); ?>
            <h4 class="modal-title"><?php echo($parent_node->get_id() ? htmlfilter($parent_node->get_name()) : ''); ?></h4>
            <br>
            <h5 class="modal-title"><?php echo htmlfilter($node->get_name()); ?></h5>

            <div class="clearfix"></div>
        </div>
        <div class="modal-body no-arabic">
            <?php echo $node->draw_report(); ?>

            <?php if ($node->check_if_can_review_node()) { ?>
                <?php echo form_open('', 'id="node_review_form"'); ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="m-a-0"><?php echo lang('Reviewer Area'); ?></h4>
                    </div>
                    <div class="panel-body">
                        <div class="panel panel-primary">
                            <div class="panel-body p-a-0">
                                <?php if ($node->get_reviews()) { ?>
                                    <?php foreach ($node->get_reviews() as $review) { ?>
                                        <div class="widget-tree-comments-item">
                                            <img src="<?php echo $review->get_reviewer_obj()->get_avatar() ?>" alt="" class="widget-tree-comments-avatar">
                                            <div class="widget-tree-comments-header">
                                                <?php echo $review->get_reviewer_obj()->get_full_name() ?><span>&nbsp;&nbsp;<?php echo $review->get_date_added() ?></span>
                                            </div>
                                            <div class="widget-tree-comments-text">
                                                <span class="text-info"><?php echo lang($review->get_status()) ?></span>
                                                <ul>

                                                <?php foreach (Orm_Node_Review_Comments::get_all(['review_id'=>$review->get_id()]) as $comment){ ?>
                                                <li>
                                                    <?php echo htmlfilter($comment->get_comment())?>
                                                </li>
                                                <?php } ?>

                                                </ul>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <h3 class="m-a-1"><?php echo lang('No Reviews') ?></h3>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?php echo lang('The component review is: '); ?></label>

                            <div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="review_status"
                                               value="compliant" <?php echo($node->get_review_status() == 'compliant' ? 'checked="checked"' : ''); ?> />
                                        <?php echo lang('Compliant') ?>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="review_status"
                                               value="not_compliant" <?php echo($node->get_review_status() == 'not_compliant' ? 'checked="checked"' : ''); ?> />
                                        <?php echo lang('Not Compliant') ?>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="review_status"
                                               value="partly_compliant" <?php echo($node->get_review_status() == 'partly_compliant' ? 'checked="checked"' : ''); ?> />
                                        <?php echo lang('Partly Compliant') ?>
                                    </label>
                                </div>
                            </div>
                            <?php echo Validator::get_html_error_message('review_status'); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?php echo lang('Comment') ?></label>
                            <div id="more_comment" class="more_items">
                                <div class="item m-y-1">
                                    <div class="form-group m-a-0">
                                        <input id="comments[0]"  name="comments[]" type="text" class="form-control" value="" />
                                        </div>
                                    </div>
                            </div>

                            <div class="more_link">
                                <button type="button" class="btn" aria-label="Left Align" onclick="add_comment();">
                                    <span class="fa fa-plus" aria-hidden="true"></span> <?php echo lang('Add').' '.lang('More'); ?>
                                </button>
                            </div>
                            <script type="text/javascript">
                                function add_comment() {

                                    var count = $('#more_comment .item').length;
                                    $('#more_comment').append('<div class="item m-y-1">' +
                                        '<div class="form-group m-a-0">' +
                                        '<input id="comments['+count+']"  name="comments[]" type="text" class="form-control"/>' +
                                        '</div>' +
                                        '<button type="button" class="btn" aria-label="Left Align" onclick="remove_point(this);" style="margin-top: 5px;" >' +
                                        '<span class="fa fa-trash-o" aria-hidden="true"></span> Remove' +
                                        '</button>' +
                                        '</div>');
                                }

                                function remove_point(elemnt) {

                                    $(elemnt).parent('.item').remove();
                                    $('#more_comment .item').each(function (index) {
                                        $(this).find('input, select, textarea').each(function () {
                                            $(this).attr('name', String($(this).attr('name')).replace(/\[\d+\]/g, '[' + index + ']'));
                                        });
                                    });
                                }
                            </script>
                        </div>


<!--                        <div class="form-group">-->
<!--                            <label class="control-label">--><?php //echo lang('Comment') ?><!--</label>-->
<!--                            <textarea class="form-control" id="review_comment" name="review_comment"></textarea>-->
<!--                            <script>-->
<!--                                tinymce.remove("#review_comment");-->
<!--                                tinymce.init({-->
<!--                                    selector: "#review_comment",-->
<!--                                    height: 200,-->
<!--                                    theme: "modern",-->
<!--                                    menubar: false,-->
<!--                                    statusbar: false,-->
<!--                                    file_browser_callback: elFinderBrowser,-->
<!--                                    font_size_style_values: "12px,13px,14px,16px,18px,20px",-->
<!--                                    relative_urls: false,-->
<!--                                    remove_script_host: false,-->
<!--                                    convert_urls: true,-->
<!--                                    plugins: [-->
<!--                                        "advlist lists link image print preview hr anchor pagebreak",-->
<!--                                        "nonbreaking table directionality",-->
<!--                                        "paste textcolor"-->
<!--                                    ],-->
<!--                                    toolbar1: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | ltr rtl",-->
<!--                                    toolbar2: "fontselect | fontsizeselect | forecolor backcolor | link image | print preview"-->
<!--                                });-->
<!--                            </script>-->
<!--                        </div>-->

                        <div>
                            <button type="submit" id="save" name="save" class="btn pull-right"
                                <?php echo data_loading_text() ?>><span class="btn-label-icon left fa fa-floppy-o"></span><?php echo lang('Save'); ?></button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            <input type="hidden" name="node_id" value="<?php echo (int)$node->get_id(); ?>"/>
            <?php echo form_close(); ?>
                <script type="text/javascript">

                    $("#node_review_form").submit(function () {
                        $.ajax({
                            type: "POST",
                            url: "/accreditation/save_review",
                            data: $(this).serialize(),
                            dataType: "json"
                        }).done(function (msg) {
                            if (msg.status) {

                                $('#item_<?php echo $id_perfix . $node->get_id(); ?>').replaceWith(msg.html_node);

                                if ($('#children_<?php echo $id_perfix . $node->get_id(); ?>').length) {
                                    if ($('#children_<?php echo $id_perfix . $node->get_id(); ?>').is(':visible')) {
                                        $('#item_<?php echo $id_perfix . $node->get_id(); ?>').children('.tree-leaf').attr('class', 'tree-branch tree-collapse');
                                    } else {
                                        $('#item_<?php echo $id_perfix . $node->get_id(); ?>').children('.tree-leaf').attr('class', 'tree-branch tree-expand');
                                    }
                                }

                                init_tree_actions();
                                $('#ajaxModal').modal('toggle');
                            } else {
                                $('#ajaxModalDialog').html(msg.html);
                            }
                        }).fail(function () {
//                            window.location.reload();
                        });

                        return false;
                    });
                </script>
            <?php } elseif($node->get_review_status() != 'none') { ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="m-a-0"><?php echo lang('Reviewer Area'); ?></h4>
                    </div>
                    <div class="panel-body p-a-0">
                        <?php if ($node->get_reviews()) { ?>
                            <?php foreach ($node->get_reviews() as $review) { ?>
                                <div class="widget-tree-comments-item">
                                    <img src="<?php echo $review->get_reviewer_obj()->get_avatar() ?>" alt="" class="widget-tree-comments-avatar">
                                    <div class="widget-tree-comments-header">
                                        <?php echo $review->get_reviewer_obj()->get_full_name() ?><span>&nbsp;&nbsp;<?php echo $review->get_date_added() ?></span>
                                    </div>
                                    <div class="widget-tree-comments-text">
                                        <span class="text-info"><?php echo lang($review->get_status()) ?></span>
<!--                                        --><?php //echo xssfilter($review->get_comment()) ?>
                                        <ul>

                                            <?php foreach (Orm_Node_Review_Comments::get_all(['review_id'=>$review->get_id()]) as $comment){ ?>
                                                <li>
                                                    <?php echo htmlfilter($comment->get_comment())?>
                                                </li>
                                            <?php } ?>

                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <h3 class="m-a-1"><?php echo lang('No Reviews') ?></h3>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
