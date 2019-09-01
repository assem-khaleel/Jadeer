<div class="row">
    <div class="col-md-12">
        <div class="table-light">
            <div class="table-header">
                <div class="table-caption">
                    <button class="btn btn-rounded btn-sm" type="button" data-toggle="collapse" data-target="#legends" aria-expanded="false" aria-controls="legends">
                        <i class="fa fa-question"></i>
                    </button>

                    <span class="padding-sm-hr"><?php echo lang('Legends'); ?></span>
                </div>
            </div>
            <div class="collapse" id="legends">
                <table class="table table-bordered">
                    <?php foreach(Orm_As_Status::$types as $type) { ?>
                        <tr>
                            <td class="col-md-1 text-center valign-middle">
								<span style="color: <?php echo $type['color'] ?>;">
									<i class="fa fa-certificate fa-2x"></i>
								</span>
                            </td>
                            <td class="col-md-2 valign-middle">
                                <?php echo lang($type['name']) ?>
                            </td>
                            <td class="col-md-9 valign-middle"><?php echo lang($type['disc']) ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>