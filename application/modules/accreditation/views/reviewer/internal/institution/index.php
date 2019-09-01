<?php
$active_institutional = Orm_Node::get_active_institutional_node();
$active_institutional18 = Orm_Node::get_active_institutional2018_node();


$reviewers = $active_institutional->get_reviewers();
$reviewers = array_merge($reviewers, $active_institutional18->get_reviewers());

?>

<div class="table-primary">
    <table class="table table-striped table-bordered" id="datatables">
        <thead>
        <tr>
            <th>#</th>
            <th><?php echo lang('Full Name') ?></th>
            <th><?php echo lang('Accreditation') ?></th>
            <th><?php echo lang('email') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php $odd_even = 0; ?>
        <?php foreach (Orm_User::get_all(['in_id' => empty($reviewers) ? [0] : $reviewers]) as $user) { ?>
            <?php $odd_even++; ?>
            <tr class="<?php echo($odd_even % 2 ? 'odd' : 'even') ?>">
                <td><?php echo htmlfilter($odd_even) ?></td>
                <td><?php echo $user->draw_compose_link() ?></td>
                <td>
                    <?php
                    $nodes_view = Orm_Node_Reviewer::get_all(array('reviewer_id' => $user->get_id()));
                    ?>
                    <ul>
                        <?php
                        foreach ($nodes_view as $review) :
                            ?>
                        <?php if(Orm_Node::get_instance( $review->get_node_id())->get_class_type() == Orm_Node::SYSTEM_INSTITUTIONAL || Orm_Node::get_instance( $review->get_node_id())->get_class_type() == Orm_Node::SYSTEM_INSTITUTIONAL2018){ ?>
                            <li>
                                <a href="/accreditation/item/<?php echo $review->get_node_id() ?>"><?php echo $review->get_node_obj()->get_name() ?></a>
                            </li>
                        <?php } ?>

                        <?php endforeach; ?>

                    </ul>

                </td>
                <td><?php echo htmlfilter($user->get_email()) ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<script>
    $(function () {
        $('#datatables').dataTable({
            <?php echo(UI_LANG == 'arabic' ? '"language": { "url": "/assets/jadeer/js/datatables/Arabic.json" },' : ''); ?>
            "initComplete": function (settings, json) {
                $('#datatables_wrapper .table-caption').html('<?php echo lang('Reviewers') ?> <a href="/accreditation/item/<?php echo intval($active_institutional->get_id()) ?: intval($active_institutional18->get_id()) ?>"><?php echo lang('View') ?></a> ');
                $('#datatables_wrapper .dataTables_filter input').attr('placeholder', '<?php echo lang('Search') ?>...');
            }
        });
    });
</script>