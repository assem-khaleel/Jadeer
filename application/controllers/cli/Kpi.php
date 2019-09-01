<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('memory_limit', '-1');
class Kpi extends MX_Controller
{
    private $csv_dir = '';

    private $time = 0;
    private $count = 0;

    public function __construct()
    {
        parent::__construct();

        if (!is_cli()) {
            exit('No direct script access allowed');
        }

        $this->csv_dir = FCPATH.'demo';
    }

    public function index() {

        $rs = $this->db->query("select id from kpi_legend");

        $legends = array_column($rs->result_array(), 'id');

        $rs = $this->db->query("select id from semester");

        $semesters = array_column($rs->result_array(), 'id');

        $rs = $this->db->query("select id from college");

        $colleges = array_column($rs->result_array(), 'id');

        $rs = $this->db->query("select id from program");

        $programs = array_column($rs->result_array(), 'id');


        foreach($semesters as  $semester) {
            foreach($legends as $legend) {

                $a = $this->db->query("select id from kpi_detail where legend_id = {$legend} and semester_id = {$semester} limit 1");

                if($a->num_rows()){
                    continue;
                }


                $this->db->insert('kpi_detail', ['legend_id' => $legend, 'semester_id'=> $semester]);

                $details_id = $this->db->insert_id();

                $this->db->insert('kpi_institution_value', [
                    'detail_id' => $details_id,
                    'actual_benchmark' => rand(100, 10100) /100 -1,
                    'internal_college_benchmark' =>  rand(100, 10100) /100 -1,
                    'internal_institution_benchmark' =>  rand(100, 10100) /100 -1,
                    'target_benchmark' =>  rand(100, 10100) /100 -1,
                    'new_benchmark' =>  rand(100, 10100) /100 -1
                ]);


                $data = [];

                foreach($colleges as $college) {

                    $v = [rand(100, 10100) /100 -1, rand(100, 10100) /100 -1, rand(100, 10100) /100 -1, rand(100, 10100) /100 -1, rand(100, 10100) /100 -1];

                    $data[] = "($details_id, $college, ".implode(',', $v).")";

//                    $this->db->insert('kpi_college_value', [
//                        'detail_id' => $details_id,
//                        'college_id' => $college,
//                        'actual_benchmark' => rand(100, 10100) /100 -1,
//                        'internal_college_benchmark' =>  rand(100, 10100) /100 -1,
//                        'internal_institution_benchmark' =>  rand(100, 10100) /100 -1,
//                        'target_benchmark' =>  rand(100, 10100) /100 -1,
//                        'new_benchmark' =>  rand(100, 10100) /100 -1
//                    ]);
                }

                $this->db->query("
insert into kpi_college_value
(detail_id, college_id, actual_benchmark, internal_college_benchmark, internal_institution_benchmark, target_benchmark, new_benchmark)
VALUES ".implode(', ', $data));


                $data = [];

                foreach($programs as $program) {
                    $v = [rand(100, 10100) /100 -1, rand(100, 10100) /100 -1, rand(100, 10100) /100 -1, rand(100, 10100) /100 -1, rand(100, 10100) /100 -1];

                    $data[] = "($details_id, $program, ".implode(',', $v).")";


//                    $this->db->insert('kpi_program_value', [
//                        'detail_id' => $details_id,
//                        'program_id' => $program,
//                        'actual_benchmark' => rand(100, 10100) /100 -1,
//                        'internal_college_benchmark' =>  rand(100, 10100) /100 -1,
//                        'internal_institution_benchmark' =>  rand(100, 10100) /100 -1,
//                        'target_benchmark' =>  rand(100, 10100) /100 -1,
//                        'new_benchmark' =>  rand(100, 10100) /100 -1
//                    ]);
                }

                $this->db->query("
insert into kpi_program_value
(detail_id, program_id, actual_benchmark, internal_college_benchmark, internal_institution_benchmark, target_benchmark, new_benchmark)
VALUES ".implode(', ', $data));


                echo '.';
            }
        }


        echo "\n";
    }

    private function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            return false;
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                $this->deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);

        return true;
    }

    private function read_csv($csv_file, $delimiter=',', $enclosure='"') {

        if(!file_exists($csv_file)) {
            false;
        }

        $file = fopen($csv_file, "r");

        $csv_data=[];

        if ($keys = fgetcsv($file, 0, $delimiter, $enclosure)) {
            while ($row = fgetcsv($file, 0, $delimiter, $enclosure)) {
                $csv_data[] = array_combine($keys, $row);
            }
        }

        fclose($file);

        return $csv_data;
    }

    private function flush_db() {

        $tabels = Orm::get_ci()->db->list_tables();

        foreach($tabels as $tabel) {
            Orm::get_ci()->db->query("TRUNCATE `$tabel`");
        }

        $role_sql = <<<SQL
INSERT INTO role (id, name, credential, admin_level) VALUES
 (
 1,
 'Super Administrator',
 '["settings-semester","settings-standard","settings-criteria","settings-item","settings-unit","settings-campus","settings-institution","settings-college","settings-department","settings-degree","settings-program","settings-major","settings-program_plan","settings-course","settings-course_section","settings-user","settings-role","settings-login_as","settings-notification","settings-translation","settings-jobs","settings-accreditation_status","setup-mission","setup-vision","setup-goal","setup-objective","dashboard-national_accreditation","dashboard-international_accreditation","dashboard-status","dashboard-kpi","dashboard-strategic_planning","curriculum_mapping-list","curriculum_mapping-manage","curriculum_mapping-report","curriculum_mapping-settings","assessment_loop-list","assessment_loop-manage","accreditation-list","accreditation-manage","accreditation-read","accreditation-report","kpi-list","kpi-manage","kpi-report","kpi-values","kpi-settings","performance_scoring-list","performance_scoring-manage","performance_scoring-report","performance_scoring-institution","strategic_planning-list","strategic_planning-manage","strategic_planning-report","doc_repo-manage","survey_students-list","survey_students-manage","survey_students-report","survey_students-evaluation","survey_faculty-list","survey_faculty-manage","survey_faculty-report","survey_faculty-evaluation","survey_staff-list","survey_staff-manage","survey_staff-report","survey_staff-evaluation","survey_alumni-list","survey_alumni-manage","survey_alumni-report","survey_alumni-evaluation","survey_employer-list","survey_employer-manage","survey_employer-report","survey_employer-evaluation","alumni-list","alumni-manage","alumni-report","internal_assessment-list","internal_assessment-manage","internal_assessment-settings","survey_boa-list","survey_boa-manage","survey_boa-report","survey_boa-evaluation","portfolio_course-list","portfolio_course-manage","portfolio_course-report","faculty_portfolio-list","faculty_portfolio-manage","faculty_portfolio-report","student_portfolio-list","student_portfolio-manage","student_portfolio-report","validation-list","validation-manage","validation-report","program_tree-manage","program_tree-edit","program_tree-list","settings-manage"]',
  5
 );
SQL;

        $user_sql = <<<SQL
INSERT INTO user
  (id, class_type, integration_id, login_id, email, password,
   birth_date, last_login, is_active, avatar, first_name, last_name, gender,
   nationality, phone, fax_no, office_no, address, token, theme, theme_fixed_navbar,
   theme_fixed_menu, theme_flip_menu, about_me) VALUES
   (1, 'Orm_User_Staff', 1, '', 'admin@eaa.com.sa', '7c4a8d09ca3762af61e59520943dc26494f8941b',
   '1985-03-24', '2017-02-01 12:44:52', 1, '', 'Mazen', 'Dabet', 0, 'Jordanian', '-', '-', '-', '-',
   'e5819375a5599566c60b12dbf3d74c6c', 'dust', 0, 0, 0, 'عالم');
SQL;

        $user_staff_sql = <<<SQL
INSERT INTO user_staff (user_id, role_id, unit_id, college_id, department_id, program_id, service_time, job_position) VALUES
(1, 1, 0, 0, 0, 0, 0, 0);
SQL;

        Orm::get_ci()->db->query($role_sql);
        Orm::get_ci()->db->query($user_sql);
        Orm::get_ci()->db->query($user_staff_sql);


        /* delete file */

        foreach(scandir(FCPATH.'files') as $dir) {
            if(is_dir(FCPATH.'files'.DIRECTORY_SEPARATOR.$dir) && $dir!='.' && $dir!='..') {
                echo $dir."\n";
            }
        }
    }

}
