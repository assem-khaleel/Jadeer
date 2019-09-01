
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <span class="panel-title"></span>
        </div>
        <div class="modal-body">
            <?php
            foreach ($clubs as $club) { ?>
                <div class="widget-products-item col-lg-2 col-md-2 col-sm-4 col-xs-12" style="float: none; margin: 0 auto;" >
                    <a href="#" class="widget-products-image" style="border-radius: 50%;">
                        <img style=" min-height: 146.8px; border-radius: 50%;"  src="<?php echo $club->get_logo() ?: '/assets/jadeer/img/club/user_logo.png' ?>">
                    </a>
                    <a href="#" class="widget-products-title text-default font-size-20 text-center">
                        <i title=" <?php echo htmlfilter($club->get_name()); ?>">
                            <?php echo $club->get_name();?>
                        </i>
                    </a>
                    <input type="checkbox" id = "club_id" style="display: none;" value="<?php echo $club->get_id();?>" checked="checked"/>
                </div>
                <?php } ?>
            <div class="panel-body">
                <div class="form-group">
                    <div class = "item m-y-1">
                        <div class = "form-group m-a-0">
                            <div style="background: #272e35;"  id="add_user">

                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="modal-footer">
                <button type="button" id = "close_btn" class="btn btn-sm pull-left" data-dismiss="modal">
                    <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
                </button>

            </div>


        </div>
    </div>
</div>

<?php

    $allowedTypes = [];
    if(Orm_User::get_logged_user()->get_class_type() == Orm_User::USER_STUDENT)
    {
        array_push($allowedTypes,Orm_User::USER_STUDENT);
    }

?>
<script type="text/javascript">
    $(document).ready(function(){
        var allowedTypes = <?php echo json_encode($allowedTypes); ?>;
        var club_id = $('#club_id').val();
        find_users_to_invite('#add_user',club_id,'user_id_0','invite_member','',allowedTypes,'<?php echo lang('Invite Members'); ?>');
    });

</script>
