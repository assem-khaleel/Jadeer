<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Migration_Initial
*
* @property CI_DB_forge $dbforge
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Migration_Data_Roles extends CI_Migration {

    private function acl(){

        $config = array();

        $acl_file = APPPATH . "config/acl.php";

        if(file_exists($acl_file)) {
            include $acl_file;
        }

        foreach (scandir(APPPATH . 'modules') as $module) {

            $acl_file = APPPATH . "modules/{$module}/config/acl.php";

            if(file_exists($acl_file)) {
                include $acl_file;
            }
        }

        return $config['map'];
    }
    
    public function up() {

        $acl_map = $this->acl();

        $credentials = array();
        foreach ($acl_map as $module => $permission) {
            foreach ($permission as $key => $credential) {
                $credentials[] = $credential;
            }
        }

        $this->db->set('name', 'Super Admin');
        $this->db->set('admin_level', Orm_Role::ROLE_INSTITUTION_ADMIN);
        $this->db->set('credential', json_encode($credentials));
        $this->db->insert('role');

        $super_admin_role_id = $this->db->insert_id();

        $admin = new Orm_User_Staff();
        $admin->set_email('admin@eaa.com.sa');
        $admin->set_password(sha1(123456));
        $admin->set_first_name('Admin');
        $admin->set_last_name('Eaa');
//        $admin->set_login_id('ux90308');
//        $admin->set_integration_id('ux90308');
        $admin->set_role_id($super_admin_role_id);
        $admin->save();

        $credentials = array();
        foreach ($acl_map as $module => $permission) {
            if ($module != 'settings') {
                foreach ($permission as $key => $credential) {
                    $credentials[] = $credential;
                }
            }
        }

        $this->db->set('name', 'College Coordinator');
        $this->db->set('admin_level', Orm_Role::ROLE_COLLEGE_ADMIN);
        $this->db->set('credential', json_encode($credentials));
        $this->db->insert('role');

        $this->db->set('name', 'Program Coordinator');
        $this->db->set('admin_level', Orm_Role::ROLE_PROGRAM_ADMIN);
        $this->db->set('credential', json_encode($credentials));
        $this->db->insert('role');

        $credentials = array();
        foreach ($acl_map as $module => $permission) {
            if (in_array($module,['curriculum_mapping', 'accreditation', 'survey_Students', 'portfolio_course', 'faculty_portfolio', 'student_portfolio', 'faculty_performance'])) {
                foreach ($permission as $key => $credential) {
                    $credentials[] = $credential;
                }
            }
        }

        $this->db->set('name', 'Teacher');
        $this->db->set('admin_level', Orm_Role::ROLE_NOT_ADMIN);
        $this->db->set('credential', json_encode($credentials));
        $this->db->insert('role');

        $this->db->set('name', 'Employee');
        $this->db->set('admin_level', Orm_Role::ROLE_NOT_ADMIN);
        $this->db->set('credential', json_encode([]));
        $this->db->insert('role');

        $credentials = array();
        foreach ($acl_map as $module => $permission) {
            if (in_array($module, ['accreditation'])) {
                foreach ($permission as $key => $credential) {
                    $credentials[] = $credential;
                }
            }
        }

        $this->db->set('name', 'Reviewer');
        $this->db->set('admin_level', Orm_Role::ROLE_NOT_ADMIN);
        $this->db->set('credential', json_encode($credentials));
        $this->db->insert('role');

    }
    
    public function down() {

        $this->db->truncate('ci_sessions');
        $this->db->truncate('role');
        $this->db->truncate('user');
        $this->db->truncate('user_staff');

    }
    
}
