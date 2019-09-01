<?php
/* @var $node Orm_Node */
?>

<?php if($node->check_if_independent_reviewer()) { ?>
    <div class="alert alert-warning"><?php echo lang('You are Independent Reviewer.'); ?></div>
<?php } ?>

<div class="row">
    <div class="col-md-12">
        <div class="table-primary">
            <div class="table-header">
                <div class="table-caption">
                    <button class="btn btn-rounded btn-sm" type="button" data-toggle="collapse" data-target="#legends" aria-expanded="false" aria-controls="legends">
                        <i class="fa fa-question"></i>
                    </button>

                    <span class="padding-sm-hr"><?php echo lang('Legends'); ?></span>
                </div>
            </div>
            <div class="collapse" id="legends">
                <table class="table table-bordered bg-theme">
                    <tr>
                        <td class="col-md-1 text-center">
                            <span class="ion-android-close font-size-20"></span>
                        </td>
                        <td class="col-md-11 valign-middle"><?php echo lang('Form Ongoing or Saved') ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-1 text-center">
                            <span class="ion-android-done font-size-20"></span>
                        </td>
                        <td class="col-md-11 valign-middle"><?php echo lang('Form Saved and Finish') ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-1 text-center">
                            <span class="ion-android-done-all font-size-20"></span>
                        </td>
                        <td class="col-md-11 valign-middle"><?php echo lang('Form Compliant') ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-1 text-center">
                            <span class="ion-android-warning font-size-20"></span>
                        </td>
                        <td class="col-md-11 valign-middle"><?php echo lang('Form Partly Compliant') ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div id="loading_bar" class="progress progress-striped active m-a-0">
            <div class="progress-bar" style="width: 100%;">
                <i class='fa fa-spinner fa-spin'></i> <?php echo lang('Loading'); ?>
            </div>
        </div>
        <div id="tree_content" style="display: none; direction: ltr;">
            <?php echo $node->draw_tree(); ?>
        </div>
    </div>
</div>

<script>
    init_tree();
    init_tree_actions();

    function init_tree() {
        $('.tree-children').hide().each(function () {
            if ($.cookie($(this).attr('id')) == 'true') {
                $(this).show();
                $(this).prev('.tree-node').children('.tree-branch').addClass('tree-collapse');
            } else {
                $(this).prev('.tree-node').children('.tree-branch').addClass('tree-expand');
            }
        });

        $('#loading_bar').remove();
        $('#tree_content').show();
    }

    function init_tree_actions() {
        $('.tree-branch').unbind().click(function () {
            treeChildrenToggle(this);
        });
        $('.tree-node').unbind().dblclick(function () {
            var branch = $(this).children('.tree-branch');
            if (branch) {
                treeChildrenToggle(branch);
            }
        });
        init_data_toggle();
    }

    function treeChildrenToggle(branch) {
        var node = $(branch).parent();
        $(node).next('.tree-children').toggle(0, function () {
            $.cookie($(this).attr('id'), $(this).is(':visible'), {
                expires: 1,
                path: '/accreditation/item/<?php echo (int)$node->get_id(); ?>/'
            });

            if ($(this).is(':visible')) {
                $(branch).removeClass('tree-expand').addClass('tree-collapse');
            } else {
                $(branch).removeClass('tree-collapse').addClass('tree-expand');
            }
        });
    }

    function after_delete_action(element, msg) {
        if (msg.status) {
            $(element).parents('.tree-node').next('.tree-children').remove();
            $(element).parents('.tree-node').remove();
        } else {
            alert("error");
        }
    }
</script>