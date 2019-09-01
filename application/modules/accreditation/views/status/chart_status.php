<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="panel-title">
            <?php
            echo lang(Orm_As_Status::get_type($status, 'name')) . ' ';
            echo ($agency_id ? '('. Orm_As_Agency::get_instance($agency_id)->get_name().') ' : '');
            echo lang('programs in') . ' ';
            echo ($college_id ? '('. Orm_College::get_instance($college_id)->get_name().')' : lang('Institution'));
            ?>
        </span>
    </div>
    <div class="panel-body" >

        <?php
        $per_page = $this->config->item('dashboard_per_page');
        $program_page = (int)$this->input->get_post('program_page');

        if (!$program_page) {
            $program_page = 1;
        }

        $filters = array('chart' => true);
        $filters['status'] = $status;
        $filters['agency'] = $agency_id;
        if($college_id) {
            $filters['college_id'] = $college_id;
        }
        ?>
        <div class="table-primary">
            <div class="table-header">
                <span class="table-caption"><?php echo lang('Programs'); ?></span>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td class="col-md-9">
                        <?php echo lang('Name'); ?>
                    </td>
                    <td class="col-md-1 text-center"><?php echo lang('Status'); ?></td>
                    <td class="col-md-2">
                        <?php echo lang('Coordinators'); ?>
                    </td>
                </tr>
                </thead>
                <tbody>
                <?php
                $statuses = Orm_As_Status::get_all($filters, $program_page, $per_page);
                foreach ($statuses as $status_obj) { ?>
                    <tr>
                        <td>
                            <a href="/accreditation/status/agency_preview/<?php echo intval($status_obj->get_id()); ?>/<?php echo intval($status_obj->get_program_id()); ?>/<?php echo intval($agency_id); ?>" data-toggle="ajaxModal" >
                                <?php echo htmlfilter($status_obj->get_program_obj()->get_name()); ?>
                            </a>
                        </td>
                        <td class="text-center">
                            <div style="color: <?php echo $status_obj->get_status('color'); ?>;">
                                <i class="fa fa-certificate fa-2x"></i>
                            </div>
                            <?php echo $status_obj->get_status('name'); ?>
                        </td>
                        <td>
                            <?php

                            $assessors = array();
                            foreach(Orm_User::get_user_by_role(Orm_Role::ROLE_PROGRAM_ADMIN, array('program_id' => $status_obj->get_program_id())) as $user) {
                                $assessors[$user->get_id()] = $user->draw_compose_link(Orm_Notification_Template::REMIND_USER_TO_FILL);
                            }

                            echo implode("\n", $assessors);

                            ?>
                        </td>
                    </tr>
                <?php } ?>
                <?php if (empty($statuses)) { ?>
                    <tr>
                        <td colspan="3">
                            <div class="well well-sm m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Programs'); ?></h3>
                            </div>
                        </td>
                    </tr>
                <?php }  ?>
                </tbody>
            </table>
            <?php
            $pager = new Pager(array('url' => handle_url(), 'page_label' => 'program_page'));
            $pager->set_page($program_page);
            $pager->set_per_page($per_page);
            $pager->set_total_count(Orm_As_Status::get_count($filters));
            $pager->set_pager_style('margin: 0px;');
            $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="status_container"');

            if ($pager->get_total_count() > $pager->get_per_page()) {
                echo '<div class="table-footer">';
                echo $pager->render();
                echo '</div>';
            }
            ?>
        </div>
        
    </div>
</div>