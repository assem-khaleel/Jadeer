<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <?php
    $this->load->view("program_tree/edit");
    $col_array = ["col1", "col2", "col3"];
    $row_array = ["row1", "row2", "row3"];
    ?>
</div>
<div class=" col-lg-9 col-md-9 col-sm-12 col-xs-12 no-border-vr no-border-r form">

    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <span class="panel-title pull-left" style="padding-top: 7.5px;"><?php echo  lang("PLO to NCAAA") ?></span>
            <div class=" pull-right ">
                <button class="btn"><?php echo  lang("Save") ?></button>
            </div>
        </div>
        <div class="panel-body">
            <div class="row text-right"><h4><?php echo lang('NCAAA Outcomes')?></h4></div>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td colspan="2" class="no-border"></td>
                    <?php foreach ($col_array as $col) { ?>
                        <td><?php echo  $col ?></td><?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($row_array as $row) { ?>
                    <tr>
                        <td><?php echo  $row ?></td>
                        <td><?php echo  $row ?></td>
                        <?php foreach ($col_array as $col) { ?>

                            <td>
                                <label class="px-single" for="form-inline-input">
                                    <input type="checkbox" id="form-inline-input" class="px">
                                    <span class="lbl"></span>
                                </label>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <span class="panel-title pull-left"
                  style="padding-top: 7.5px;"><?php echo  lang("Program Learning Outcomes") ?></span>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <?php foreach ($col_array as $col) { ?>
                        <td><?php echo  $col ?></td><?php } ?>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php foreach ($row_array as $row) { ?>
                        <td><?php echo  $row ?></td><?php } ?>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <span class="panel-title pull-left" style="padding-top: 7.5px;"><?php echo  lang("NCAAA Student Outcomes") ?></span>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <?php foreach ($col_array as $col) { ?>
                        <td><?php echo  $col ?></td><?php } ?>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php foreach ($row_array as $row) { ?>
                        <td><?php echo  $row ?></td><?php } ?>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>