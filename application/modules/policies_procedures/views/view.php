<?php /* @var $policy Orm_Policies_Procedures */ ?>

<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="text-center text-capitalize ">
        <div class="col-lg-6 col-md-6 col-sm-6 pull-left">
            <h4 class="m-t-2 text-left"><?php echo htmlfilter($policy->get_title()) ?></h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 pull-right">
            <h4 class="m-t-2 font-weight-semibold text-muted text-right">
                    <?php
                    echo lang('Level') . ' : ' . htmlfilter($policy->get_current_unit_type());
                    if ($policy->get_current_unit_type_title()) {
                        echo " ({$policy->get_current_unit_type_title()})";
                    }
                    ?>
            </h4>
        </div>
        <div class="clearfix"></div>
    </div>

        <?php if (Orm_Policies_Procedures_Managers::get_count(['policy_id' => $policy->get_id()]) != 0) { ?>
           <div class="col-lg-12 col-md-12 col-sm-12">
               <div class="panel panel-primary panel-dark">
                   <div class="box-row">
                       <div class="box-container">
                           <div class="box-cell p-a-3 valign-middle bg-primary">
                               <i class="box-bg-icon middle right font-size-29 ion-person"></i>
                               <div class="font-size-14 font-weight-bold"><?php echo lang('Managers') ?></div>
                           </div>
                       </div>
                       <div class="row m-a-1">
                           <?php foreach (Orm_Policies_Procedures_Managers::get_all(array('policy_id' => $policy->get_id())) as $manager) { ?>
                               <div class="col-md-2 m-y-3">
                                   <i class="fa fa-user text-muted"></i>
                                   &nbsp;&nbsp;
                                   <a>
                                       <strong class="text-default">
                                           <?php echo Orm_User::get_instance($manager->get_manager_id())->get_full_name(); ?>
                                       </strong>
                                   </a>
                               </div>

                           <?php } ?>
                       </div>
                   </div>
               </div>
           </div>
        <?php } ?>
        <?php if ($policy->get_desc()) { ?>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="panel panel-primary panel-dark">
                    <div class="panel-heading font-weight-bold">
                        <?php echo lang('Description of this Document') ?>
                    </div>
                    <div class="panel-body">
                        <?php echo xssfilter($policy->get_desc()) ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($policy->get_statement()) { ?>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="panel panel-primary panel-dark">
                    <div class="panel-heading font-weight-bold">
                        <?php echo lang('Document Statements') ?>
                    </div>
                    <div class="panel-body">
                        <?php echo xssfilter($policy->get_statement()) ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($policy->get_definitions()) { ?>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="panel panel-primary panel-dark">
                    <div class="panel-heading font-weight-bold">
                        <?php echo lang('Definitions') ?>
                    </div>
                    <div class="panel-body">
                        <?php echo xssfilter($policy->get_definitions()) ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($policy->get_audience()) { ?>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="panel panel-primary panel-dark">
                    <div class="panel-heading font-weight-bold">
                        <?php echo lang('Audience') ?>
                    </div>
                    <div class="panel-body">
                        <?php echo xssfilter($policy->get_audience()); ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($policy->get_reason()) { ?>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="panel panel-primary panel-dark">
                    <div class="panel-heading font-weight-bold">
                        <?php echo lang('Reason for policy') ?>
                    </div>
                    <div class="panel-body">
                        <?php echo xssfilter($policy->get_reason()) ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($policy->get_compliance()) { ?>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="panel panel-primary panel-dark">
                    <div class="panel-heading font-weight-bold">
                        <?php echo lang('Compliance') ?>
                    </div>
                    <div class="panel-body">
                        <?php echo xssfilter($policy->get_compliance()) ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if (Orm_Policies_Procedures_Responsible::get_count(['policies_id' => $policy->get_id()]) != 0) {
            ?>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="panel panel-primary panel-dark">
                    <div class="panel-heading font-weight-bold">
                        <?php echo lang('Roles & Responsibilities') ?>
                    </div>
                    <div class="panel-body table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="col-lg-6 col-md-6 col-sm-12"><?php echo lang('Role'); ?></th>
                                <th class="col-lg-6 col-md-6 col-sm-12"><?php echo lang('Responsibilities'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach (Orm_Policies_Procedures_Responsible::get_all(['policies_id' => $policy->get_id()]) as $responsible) { ?>
                                <tr>
                                    <td>
                                             <span>
                                                <?php echo xssfilter($responsible->get_role()) ?>
                                            </span>
                                    </td>
                                    <td>
                                            <span>
                                                <?php echo xssfilter($responsible->get_responsibilities()) ?>
                                            </span>
                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($policy->get_regulations()) { ?>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="panel panel-primary panel-dark">
                    <div class="panel-heading font-weight-bold">
                        <?php echo lang('Related regulations statutes and related policies') ?>
                    </div>
                    <div class="panel-body">
                        <?php echo xssfilter($policy->get_regulations()) ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($policy->get_contact_def()) { ?>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="panel panel-primary panel-dark">
                    <div class="panel-heading font-weight-bold">
                        <?php echo lang('Contacts') ?>
                    </div>
                    <div class="panel-body">
                        <p><?php echo xssfilter($policy->get_contact_def()) ?></p>
                        <?php if (Orm_Policies_Procedures_Contacts::get_count(['policies_id' => $policy->get_id()]) != 0) { ?>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="col-lg-3 col-md-3 col-sm-6"><?php echo lang('Subject') ?></th>
                                    <th class="col-lg-3 col-md-3 col-sm-6"><?php echo lang('Contact Name') ?></th>
                                    <th class="col-lg-3 col-md-3 col-sm-6"><?php echo lang('Phone') ?></th>
                                    <th class="col-lg-3 col-md-3 col-sm-6"><?php echo lang('email') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach (Orm_Policies_Procedures_Contacts::get_all(['policies_id' => $policy->get_id()]) as $contact) { ?>
                                    <tr>
                                        <th scope="row"><?php echo htmlfilter($contact->get_title()) ?></th>
                                        <td><?php echo htmlfilter($contact->get_contact_name()) ?></td>
                                        <td><?php echo htmlfilter($contact->get_phone()) ?></td>
                                        <td><?php echo htmlfilter($contact->get_mail()) ?></td>
                                    </tr>
                                <?php } ?>


                                </tbody>
                            </table>

                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($policy->get_history()) { ?>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="panel panel-primary panel-dark">
                    <div class="panel-heading font-weight-bold">
                        <?php echo lang('Document history') ?>
                    </div>
                    <div class="panel-body">
                        <?php echo xssfilter($policy->get_history()) ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($policy->get_procedures()) { ?>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="panel panel-primary panel-dark">
                    <div class="panel-heading font-weight-bold">
                        <?php echo lang('Procedures') ?>
                    </div>
                    <div class="panel-body">
                        <?php echo xssfilter($policy->get_procedures()) ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($policy->get_standard()) { ?>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="panel panel-primary panel-dark">
                    <div class="panel-heading font-weight-bold">
                        <?php echo lang('Standards') ?>
                    </div>
                    <div class="panel-body">
                        <?php echo xssfilter($policy->get_standard()) ?>
                    </div>
                </div>
            </div>
        <?php } ?>


        <?php if (Orm_Policies_Procedures_Files::get_count(['policy_id' => $policy->get_id()]) != 0) { ?>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="panel panel-primary panel-dark">
                    <div class="panel-heading font-weight-bold">
                        <?php echo lang('Forms & Other Related Documents') ?>
                    </div>
                    <div class="panel-body">
                        <?php foreach (Orm_Policies_Procedures_Files::get_all(['policy_id' => $policy->get_id()]) as $file) { ?>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="list-group">
                                    <?php if ($file->get_file_path()) { ?>
                                        <a href="<?php echo base_url($file->get_file_path()) ?>"
                                           class="list-group-item">
                                            <i class="fa fa-download list-group-icon"></i>
                                            <?php echo xssfilter($file->get_title()) ?>
                                        </a>
                                    <?php } else { ?>
                                        <a class="list-group-item">
                                            <i class="fa fa-file-o list-group-icon"></i>
                                            <?php echo xssfilter($file->get_title()) ?>
                                        </a>
                                    <?php } ?>

                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
