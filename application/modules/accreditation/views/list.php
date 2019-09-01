<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-globe fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div
                            class="huge"><?php echo lang('Count') ?> : <?php echo Orm_Node::get_count(array('class_type_in' => Orm_Node::get_international_systems(false))) ?></div>
                        <div><b><?php echo lang('International') ?></b></div>
                    </div>
                </div>
            </div>
            <a href="/accreditation/international">
                <div class="panel-footer">
                    <span class="pull-left"><?php echo lang('View').' '.lang('Details') ?></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-home fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo lang('Count') ?> : <?php echo Orm_Node::get_count(array('class_type_in' => Orm_Node::get_national_systems(false))) ?></div>
                        <div><b><?php echo lang('National') ?></b></div>
                    </div>
                </div>
            </div>
            <a href="/accreditation/national">
                <div class="panel-footer">
                    <span class="pull-left"><?php echo lang('View').' '.lang('Details') ?></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>