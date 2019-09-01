<?php /* @var $question Orm_Survey_Question_Type_Factors_And_Statements */ ?>
<div class="form-group dark m-a-0">
    <div class="table-light ">
        <div class="table-header">
            <div class="table-caption">
                <?php echo lang('Factors And Statements'); ?>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-md-1"><?php echo lang('Abbreviation'); ?></th>
                    <th class="col-md-9"><?php echo lang('Factor And Statement'); ?></th>
                    <th class="col-md-1 text-center"><?php echo lang('Average'); ?></th>
                    <th class="col-md-1 text-center"><?php echo lang('Response'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($question->get_factors() as $factor) {
                    $factor_response = $factor->get_user_response($filters);
                    ?>
                    <tr class="bg-default">
                        <td class="col-md-1"><b><?php echo htmlfilter($factor->get_abbreviation()); ?></b></td>
                        <td class="col-md-9"><b><?php echo htmlfilter($factor->get_title()) ?></b></td>
                        <td class="col-md-1 text-center"><?php echo isset($factor_response['average']) ? round($factor_response['average'], 2) : 0 ?>
                            : 5
                        </td>
                        <td class="col-md-1 text-center"><?php echo isset($factor_response['count']) ? $factor_response['count'] : 0 ?></td>
                    </tr>
                    <?php
                    $index = 0;
                    foreach ($factor->get_statements() as $statement) {
                        $index++;
                        $response = $statement->get_user_response($filters);
                        ?>
                        <tr <?php echo($index % 2 ? '' : 'class="active"') ?> >
                            <td class="col-md-1"><?php echo htmlfilter($statement->get_abbreviation() ? $statement->get_abbreviation() : $factor->get_abbreviation() . '-' . $index); ?></td>
                            <td class="col-md-9"><?php echo htmlfilter($statement->get_title()) ?></td>
                            <td class="col-md-1 text-center"><?php echo isset($response['average']) ? round($response['average'], 2) : 0 ?>
                                : 5
                            </td>
                            <td class="col-md-1 text-center"><?php echo isset($response['count']) ? $response['count'] : 0 ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>