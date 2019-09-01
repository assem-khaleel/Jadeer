<?php
/**
 * Created by PhpStorm.
 * User: Mazen Dabet
 * Date: 10/3/15
 * Time: 9:33 PM
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="panel-title"><?php echo lang('Objectives'); ?></span>

                <div class="panel-heading-controls col-sm-4">
                    <a class="btn btn-sm " href="/strategic_planning/objective/add_edit"
                       data-toggle="ajaxModal"><span class="btn-label-icon left"><i class="fa fa-plus"></i></span><?php echo lang('Add'); ?></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-sm-6">
                    <div class="stat-panel">
						<span
                            class="stat-cell col-xs-5 bg-success bordered no-border-vr no-border-l no-padding valign-middle text-center text-lg">
							<?php echo lang(Orm_Sp_Objective::PERSPECTIVE_CUSTOMER_STR); ?>
						</span>

                        <div class="stat-cell col-xs-7 no-padding valign-middle">
                            <div class="stat-rows">
                                <?php foreach (Orm_Sp_Objective::get_all(array('perspective_id' => Orm_Sp_Objective::PERSPECTIVE_CUSTOMER)) as $objective) { ?>
                                    <div class="stat-row">
										<span class="stat-cell bg-success padding-sm valign-middle">
											<?php echo htmlfilter( $objective->get_title()); ?>
                                            <i class="fa fa-envelope-o pull-right"></i>
										</span>
                                    </div>
                                <?php } ?>
                                <div class="stat-row">
                                    <span class="stat-cell bg-success padding-sm valign-middle">&nbsp</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="stat-panel">
						<span
                            class="stat-cell col-xs-5 bg-primary bordered no-border-vr no-border-l no-padding valign-middle text-center text-lg">
							<?php echo lang(Orm_Sp_Objective::PERSPECTIVE_LEARNING_GROWTH_STR); ?>
						</span>

                        <div class="stat-cell col-xs-7 no-padding valign-middle">
                            <div class="stat-rows">
                                <div class="stat-row">
                                    <span class="stat-cell bg-primary padding-sm valign-middle">&nbsp</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="stat-panel">
						<span
                            class="stat-cell col-xs-5 bg-warning bordered no-border-vr no-border-l no-padding valign-middle text-center text-lg">
							<?php echo lang(Orm_Sp_Objective::PERSPECTIVE_INTERNAL_PROCESS_STR); ?>
						</span>

                        <div class="stat-cell col-xs-7 no-padding valign-middle">
                            <div class="stat-rows">
                                <div class="stat-row">
                                    <span class="stat-cell bg-warning padding-sm valign-middle">&nbsp</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="stat-panel">
						<span
                            class="stat-cell col-xs-5 bg-danger bordered no-border-vr no-border-l no-padding valign-middle text-center text-lg">
							<?php echo lang(Orm_Sp_Objective::PERSPECTIVE_FINANCE_STR); ?>
						</span>

                        <div class="stat-cell col-xs-7 no-padding valign-middle">
                            <div class="stat-rows">
                                <span class="stat-cell bg-danger padding-sm valign-middle">&nbsp</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>