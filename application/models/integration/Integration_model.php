<?php

/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 7/4/17
 * Time: 11:35 AM
 */
class Integration_model extends CI_Model {

    private $log_path;
    private $teacher_role_id=6;
    private $staff_role_id=7;

    public function __construct(){
        $this->log_path = FCPATH.'logs/'.date('Y-m-d').'/';

        if(file_exists($this->log_path)===false){
            mkdir($this->log_path);
        }

        $role = Orm_Role::get_one(['name' => 'Teacher']);

        if($role && $role->get_id()) {
            $this->teacher_role_id = $role->get_id();
        }

        $role = Orm_Role::get_one(['name' => 'Employee']);

        if($role && $role->get_id()) {
            $this->staff_role_id = $role->get_id();
        }

    }

    public function semester($integration_id, $start, $end, $year, $name_en, $name_ar) {

        $semester = Orm_Semester::get_one(['integration_id'=>$integration_id]);

        $semester->set_integration_id($integration_id);
        $semester->set_start($start);
        $semester->set_end($end);
        $semester->set_year($year);
        $semester->set_name_en($name_en);
        $semester->set_name_ar($name_ar);

        if(!$semester->save()){
            $this->log('semester', 'save error', "id = {$integration_id}");
        }

    }

    public function support_unit($integration_id, $name_ar, $name_en, $class_type = Orm_Unit_Admin::class) {

        $unit = Orm_Unit::get_one(['integration_id'=>$integration_id]);

        $unit->set_integration_id($integration_id);
        $unit->set_name_en($name_en);
        $unit->set_name_ar($name_ar);
        $unit->set_class_type($class_type);

        if(!$unit->save()){
            $this->log('support_unit', 'save error', "id = {$integration_id}");
        }
    }

    public function campus($integration_id, $name_ar, $name_en) {

        $campus = Orm_Campus::get_one(['integration_id'=>$integration_id]);

        $campus->set_integration_id($integration_id);
        $campus->set_name_en($name_en);
        $campus->set_name_ar($name_ar);

        if(!$campus->save()){
            $this->log('campus', 'save error', "id = {$integration_id}");
        }
    }

    public function college($integration_id, $campus_id, $name_ar, $name_en) {

        $campus = Orm_Campus::get_one(['integration_id'=>$campus_id]);

        if(!($campus && $campus->get_id())){
            $desc = <<<T
this college not added;
college name = {$name_en};
college id = {$integration_id};
campus id = {$campus_id};

T;

            $this->log('college', 'campus not exist', $desc);
            return;
        }


        $college = Orm_College::get_one(['integration_id'=>$integration_id]);

        $college->set_integration_id($integration_id);
        $college->set_name_en($name_en);
        $college->set_name_ar($name_ar);

        if(!($college_id = $college->save())){
            $this->log('college', 'save error', "id = {$integration_id}");
        }

        $campus_college = Orm_Campus_College::get_one(['college_id'=>$college_id, 'campus_id'=>$campus->get_id()]);

        $campus_college->set_college_id($college_id);
        $campus_college->set_campus_id($campus->get_id());

        if(!$campus_college->save()){
            $this->log('college', 'save error in [campus college]', "collage id = {$integration_id}\ncampus id = {$campus_id}");
        }
    }

    public function department($integration_id, $college_id, $name_ar, $name_en) {

        $college = Orm_College::get_one(['integration_id'=>$college_id]);

        if(!($college && $college->get_id())){
            $desc = <<<T
this department not added;
department name = {$name_en};
department id = {$integration_id};
college id = {$college_id};

T;

            $this->log('department', 'college not exist', $desc);
            return;
        }


        $department = Orm_Department::get_one(['integration_id'=>$integration_id]);

        $department->set_integration_id($integration_id);
        $department->set_college_id($college->get_id());
        $department->set_name_en($name_en);
        $department->set_name_ar($name_ar);

        if(!$department->save()){
            $this->log('department', 'save error', "id = {$integration_id}");
        }
    }

    public function degree($integration_id, $name_ar, $name_en) {

        $degree = Orm_Degree::get_one(['integration_id'=>$integration_id]);

        $degree->set_integration_id($integration_id);
        $degree->set_name_en($name_en);
        $degree->set_name_ar($name_ar);

        if(!$degree->save()){
            $this->log('degree', 'save error', "id = {$integration_id}");
        }
    }

    public function program($integration_id, $department_id, $degree_id, $name_ar,  $name_en, $code_en='', $code_ar='', $credit_hours=0) {

        $department = Orm_Department::get_one(['integration_id'=>$department_id]);

        if(!($department && $department->get_id())){
            $desc = <<<T
this program not added;
program name = {$name_en};
program id = {$integration_id};
department id = {$department_id};
degree id = {$degree_id};

T;

            $this->log('program', 'department not exist', $desc);
            return;
        }

        $degree = Orm_Degree::get_one(['integration_id'=>$degree_id]);

        if(!($degree && $degree->get_id())){
            $desc = <<<T
this program not added;
program name = {$name_en};
program id = {$integration_id};
department id = {$department_id};
degree id = {$degree_id};

T;

            $this->log('program', 'degree not exist', $desc);
            return;
        }


        $program = Orm_Program::get_one(['integration_id'=>$integration_id]);

        $program->set_integration_id($integration_id);
        $program->set_department_id($department->get_id());
        $program->set_degree_id($degree->get_id());
        $program->set_name_en($name_en);
        $program->set_name_ar($name_ar);
        $program->set_code_en($code_en?: 'NA');
        $program->set_code_ar($code_ar?: 'NA');
        $program->set_credit_hours($credit_hours);

        if(!$program->save()){
            $this->log('program', 'save error', "id = {$integration_id}");
        }
    }

    public function major($integration_id, $program_id, $name_ar, $name_en) {

        $program = Orm_Program::get_one(['integration_id'=>$program_id]);

        if(!($program && $program->get_id())){
            $desc = <<<T
this program not added;
major name en = {$name_en};
major name ar = {$name_ar};
major id = {$integration_id};
program id = {$program_id};

T;

            $this->log('major', 'program not exist', $desc);
            return;
        }


        $major = Orm_Major::get_one(['integration_id'=>$integration_id]);

        $major->set_integration_id($integration_id);
        $major->set_program_id($program->get_id());
        $major->set_name_en($name_en);
        $major->set_name_ar($name_ar);

        if(!$major->save()){
            $this->log('major', 'save error', "id = {$integration_id}");
        }
    }


    public function course($integration_id, $department_id, $name_ar,$name_en,  $code_ar,$code_en,  $isTraining) {
        $department = Orm_Department::get_one(['integration_id'=>$department_id]);

        if(!($department && $department->get_id())){
            $desc = <<<T
this course not added;
course name = {$name_en};
course code = {$code_en};
course id = {$integration_id};
department id = {$department_id};
faculty id = {$department->get_college_obj()->get_integration_id()};

T;

            $this->log('courses', 'department not exist', $desc);
            return;
        }


        $course = Orm_Course::get_one(['integration_id'=>$integration_id]);

        $course->set_integration_id($integration_id);
        $course->set_department_id($department->get_id());
        $course->set_name_en($name_en);
        $course->set_name_ar($name_ar);
        $course->set_code_en($code_en);
        $course->set_code_ar($code_ar);
        $course->set_type($isTraining? 'practical': 'theoretical');

        if(!$course->save()){
            $this->log('courses', 'save error', "id = {$integration_id}");
        }
    }

    public function program_plan($program_id, $course_id, $level, $credit_hours, $is_required) {

        $program = Orm_Program::get_one(['integration_id'=>$program_id]);

        if(!($program && $program->get_id())){
            $desc = <<<T
this plan not added;
program id = {$program_id};
course id = {$course_id};

T;

            $this->log('program_plan', 'program not exist', $desc);
            return;
        }

        $course = Orm_Course::get_one(['integration_id'=>$course_id]);

        if(!($course && $course->get_id())){
            $desc = <<<T
this plan not added;
program id = {$program_id};
course id = {$course_id};

T;

            $this->log('program_plan', 'course not exist', $desc);
            return;
        }

        $integration_id = "{$program_id}_{$course_id}";

        $program_plan = Orm_Program_Plan::get_one(['integration_id'=>$integration_id]);

        $program_plan->set_integration_id($integration_id);
        $program_plan->set_program_id($program->get_id());
        $program_plan->set_course_id($course->get_id());
        $program_plan->set_level($level);
        $program_plan->set_credit_hours($credit_hours);
        $program_plan->set_is_required($is_required? 1 : 0);


        if(!$program_plan->save()){
            $this->log('program_plan', 'save error', "id = {$integration_id}");
        }
    }

    /**
     * @param mixed  $integration_id
     * @param string $email
     * @param mixed  $login_id
     * @param string $first_name
     * @param string $last_name
     * @param bool   $is_active
     * @param mixed  $dob
     * @param string $nationality
     * @param int    $college_id
     * @param int    $department_id
     * @param int    $program_id
     * @param bool   $male_gender
     * @param string $phone
     * @param string $fax_no
     * @param string $office_no
     * @param string $address
     * @param string $job_position
     * @param int    $academic_rank
     * @param int    $service_time
     * @param string $general_specialty
     * @param string $specific_specialty
     * @param string $graduate_from
     */
    public function faculty(
        $integration_id, $email, $login_id, $first_name, $last_name, $is_active, $dob, $nationality,
        $college_id=0, $department_id=0, $program_id=0, $male_gender=true,
        $phone='',$fax_no='', $office_no='', $address='', $job_position='', $academic_rank=1,
        $service_time=0, $general_specialty='', $specific_specialty='', $graduate_from=''
    ) {



        if($college_id>0) {
            $college = Orm_College::get_one(['integration_id'=>$college_id]);

            if(!($college && $college->get_id())){
                $desc = <<<T
this faculty not added;
integration = {$integration_id};
email = {$email};
login id = {$login_id};
first name = {$first_name};
last name = {$last_name};
college id ={$college_id};
department = {$department_id};
program id = {$program_id};

T;

                $this->log('faculty', 'college not exist', $desc);
                //return;
                $college_id=0;
            }
            else {
                $college_id=$college->get_id();
            }
        }


        if($department_id>0) {
            $department = Orm_Department::get_one(['integration_id'=>$department_id]);

            if(!($department && $department->get_id())){
                $desc = <<<T
this faculty not added;
integration = {$integration_id};
email = {$email};
login id = {$login_id};
first name = {$first_name};
last name = {$last_name};
college id ={$college_id};
department = {$department_id};
program id = {$program_id};

T;

                $this->log('faculty', 'department not exist', $desc);
                //return;
                $department_id=0;
            }
            else {
                $department_id=$department->get_id();
            }
        }


        if($program_id>0) {
            $program = Orm_Program::get_one(['integration_id' => $program_id]);

            if (!($program && $program->get_id())) {
                $desc = <<<T
this faculty not added;
integration = {$integration_id};
email = {$email};
login id = {$login_id};
first name = {$first_name};
last name = {$last_name};
college id ={$college_id};
department = {$department_id};
program id = {$program_id};

T;

                $this->log('faculty', 'program not exist', $desc);
                $program_id = 0;

                //return;
            }
            else {
                $program_id = $program->get_id();
            }
        }

        $faculty = Orm_User_Faculty::get_one(['integration_id' => $integration_id, 'skip_active' => 1]);

        if(!$faculty->get_id()){
            $faculty->set_role_id($this->teacher_role_id);
            $faculty->set_job_position($job_position?: Orm_User_Faculty::JOB_POSITION_MEMBERS);
        }


        $faculty->set_email($email);
        $faculty->set_login_id($login_id);
        $faculty->set_first_name($first_name);
        $faculty->set_last_name($last_name);
        $faculty->set_is_active($is_active? 1 : 0);
        $faculty->set_birth_date($dob);
        $faculty->set_integration_id($integration_id);
        $faculty->set_gender($male_gender? Orm_User::GENDER_MALE : Orm_User::GENDER_FEMALE);
        $faculty->set_nationality($nationality);
        $faculty->set_phone($phone);
        $faculty->set_fax_no($fax_no);
        $faculty->set_office_no($office_no);
        $faculty->set_address($address);
        $faculty->set_college_id($college_id);
        $faculty->set_department_id($department_id);
        $faculty->set_program_id($program_id);
        $faculty->set_academic_rank($academic_rank);
        $faculty->set_service_time($service_time);
        $faculty->set_general_specialty($general_specialty);
        $faculty->set_specific_specialty($specific_specialty);
        $faculty->set_graduate_from($graduate_from);

        if(!$faculty->save()){
            $this->log('faculty', 'save error', "id = {$integration_id}");
        }

        unset($integration_id);
        unset($email);
        unset($login_id);
        unset($first_name);
        unset($last_name);
        unset($is_active);
        unset($dob);
        unset($nationality);
        unset($college_id);
        unset($department_id);
        unset($program_id);
        unset($male_gender);
        unset($phone);
        unset($fax_no);
        unset($office_no);
        unset($address);
        unset($job_position);
        unset($academic_rank);
        unset($service_time);
        unset($general_specialty);
        unset($specific_specialty);
        unset($graduate_from);
        unset($college);
        unset($desc);
        unset($department);
        unset($program);
        unset($faculty);

    }

    /**
     * @param mixed  $integration_id
     * @param string $email
     * @param mixed  $login_id
     * @param string $first_name
     * @param string $last_name
     * @param bool   $is_active
     * @param mixed  $dob
     * @param string $nationality
     * @param int    $college_id
     * @param int    $department_id
     * @param int    $program_id
     * @param int    $unit_id
     * @param bool   $male_gender
     * @param string $phone
     * @param string $fax_no
     * @param string $office_no
     * @param string $address
     * @param string $job_position
     * @param int    $service_time
     */
    public function staff(
        $integration_id, $email, $login_id, $first_name, $last_name, $is_active, $dob, $nationality,
        $college_id=0, $department_id=0, $program_id=0, $unit_id=0, $male_gender=true,
        $phone='',$fax_no='', $office_no='', $address='', $job_position='', $service_time=0
    ) {


        if($college_id>0) {
            $college = Orm_College::get_one(['integration_id'=>$college_id]);

            if(!($college && $college->get_id())){
                $desc = <<<T
this staff not added;
integration = {$integration_id};
email = {$email};
login id = {$login_id};
first name = {$first_name};
last name = {$last_name};
college id ={$college_id};
department = {$department_id};
program id = {$program_id};
unit id = {$unit_id};

T;

                $this->log('staff', 'college not exist', $desc);
                //return;
                $college_id=0;
            }
            else {
                $college_id=$college->get_id();
            }
        }



        if($department_id>0) {
            $department = Orm_Department::get_one(['integration_id'=>$department_id]);

            if(!($department && $department->get_id())){
                $desc = <<<T
this staff not added;
integration = {$integration_id};
email = {$email};
login id = {$login_id};
first name = {$first_name};
last name = {$last_name};
college id ={$college_id};
program id = {$program_id};
unit id = {$unit_id};

T;

                $this->log('staff', 'department not exist', $desc);
                //return;
                $department_id=0;
            }
            else {
                $department_id=$department->get_id();
            }
        }

        if($program_id>0) {
            $program = Orm_Program::get_one(['integration_id' => $program_id]);

            if (!($program && $program->get_id())) {
                $desc = <<<T
this staff not added;
integration = {$integration_id};
email = {$email};
login id = {$login_id};
first name = {$first_name};
last name = {$last_name};
college id ={$college_id};
department = {$department_id};
program id = {$program_id};
unit id = {$unit_id};

T;

                $this->log('staff', 'program not exist', $desc);
                //return;
                $program_id = 0;
            }
            else {
                $program_id = $program->get_id();
            }
        }


        if($unit_id>0) {
            $unit = Orm_Unit::get_one(['integration_id' => $unit_id]);

            if (!($unit && $unit->get_id())) {
                $desc = <<<T
this staff not added;
integration = {$integration_id};
email = {$email};
login id = {$login_id};
first name = {$first_name};
last name = {$last_name};
college id ={$college_id};
department = {$department_id};
program id = {$program_id};
unit id = {$unit_id};

T;

                $this->log('staff', 'unit not exist', $desc);
                //return;
                $unit_id=0;
            }
            else {
                $unit_id = $unit->get_id();
            }
        }

        $staff = Orm_User_Staff::get_one(['integration_id' => $integration_id, 'skip_active' => 1]);

        if(!$staff->get_id()){
            $staff->set_role_id($this->staff_role_id);
            $staff->set_job_position($job_position?: Orm_User_Faculty::JOB_POSITION_MEMBERS);
        }

        $staff->set_email($email);
        $staff->set_login_id($login_id);
        $staff->set_first_name($first_name);
        $staff->set_last_name($last_name);
        $staff->set_is_active($is_active? 1 : 0);
        $staff->set_birth_date($dob);
        $staff->set_integration_id($integration_id);
        $staff->set_gender($male_gender? 0: 1);
        $staff->set_nationality($nationality);
        $staff->set_phone($phone);
        $staff->set_fax_no($fax_no);
        $staff->set_office_no($office_no);
        $staff->set_address($address);
        $staff->set_college_id($college_id);
        $staff->set_department_id($department_id);
        $staff->set_program_id($program_id);
        $staff->set_unit_id($unit_id);
        $staff->set_service_time($service_time);

        if(!$staff->save()){
            $this->log('staff', 'save error', "id = {$integration_id}");
        }


        unset($integration_id);
        unset($email);
        unset($login_id);
        unset($first_name);
        unset($last_name);
        unset($is_active);
        unset($dob);
        unset($nationality);
        unset($college_id);
        unset($department_id);
        unset($program_id);
        unset($unit_id);
        unset($male_gender);
        unset($phone);
        unset($fax_no);
        unset($office_no);
        unset($address);
        unset($job_position);
        unset($service_time);
        unset($college);
        unset($desc);
        unset($department);
        unset($program);
        unset($faculty);
        unset($unit);


    }

    public function status($integration_id, $name_ar, $name_en){

        $status = Orm_Student_Status::get_one(['integration_id'=>$integration_id]);


        $status->set_name_en($name_en);
        $status->set_name_ar($name_ar);
        $status->set_integration_id($integration_id);

        if(!$status->save()){
            $this->log('student_status', 'save error', "id = {$integration_id}");
        }
    }

    /**
     * @param mixed $integration_id
     * @param string $email
     * @param mixed $login_id
     * @param string $first_name
     * @param string $last_name
     * @param bool $is_active
     * @param mixed $dob
     * @param string $nationality
     * @param int $college_id
     * @param int $department_id
     * @param int $program_id
     * @param int $status_id
     * @param bool $male_gender
     * @param string $phone
     * @param string $fax_no
     * @param string $office_no
     * @param string $address
     */
    public function student(
        $integration_id, $email, $login_id, $first_name, $last_name, $is_active, $dob, $nationality, $college_id, $department_id, $program_id,
        $status_id=0, $male_gender=true, $phone='',$fax_no='', $office_no='', $address=''
    ) {


        $college = Orm_College::get_one(['integration_id'=>$college_id]);

        if(!($college && $college->get_id())){
            $desc = <<<T
this student not added;
integration = {$integration_id};
email = {$email};
login id = {$login_id};
first name = {$first_name};
last name = {$last_name};
college id ={$college_id};
department = {$department_id};
program id = {$program_id};
status id = {$status_id};

T;

            $this->log('student', 'college not exist', $desc);
            return;
        }


        $department = Orm_Department::get_one(['integration_id'=>$department_id]);

        if(!($department && $department->get_id())){
            $desc = <<<T
this student not added;
integration = {$integration_id};
email = {$email};
login id = {$login_id};
first name = {$first_name};
last name = {$last_name};
college id ={$college_id};
department = {$department_id};
program id = {$program_id};
status id = {$status_id};

T;

            $this->log('student', 'department not exist', $desc);
            return;
        }


        $program = Orm_Program::get_one(['integration_id' => $program_id]);

        if (!($program && $program->get_id())) {
            $desc = <<<T
this student not added;
integration = {$integration_id};
email = {$email};
login id = {$login_id};
first name = {$first_name};
last name = {$last_name};
college id ={$college_id};
department = {$department_id};
program id = {$program_id};
status id = {$status_id};

T;

            $this->log('student', 'program not exist', $desc);
            return;
        }


        $status = Orm_Student_Status::get_one(['integration_id'=>$status_id]);


        if (!($status && $status->get_id())) {
            $desc = <<<T
this student not added;
integration = {$integration_id};
email = {$email};
login id = {$login_id};
first name = {$first_name};
last name = {$last_name};
college id ={$college_id};
department = {$department_id};
program id = {$program_id};
status id = {$status_id};

T;

            $this->log('student', 'status not exist', $desc);
            return;
        }


        $student = Orm_User_Student::get_one(['integration_id' => $integration_id, 'skip_active' => 1]);

        $student->set_email($email);
        $student->set_login_id($login_id);
        $student->set_first_name($first_name);
        $student->set_last_name($last_name);
        $student->set_is_active($is_active? 1 : 0);
        $student->set_birth_date($dob);
        $student->set_integration_id($integration_id);
        $student->set_gender($male_gender? 0: 1);
        $student->set_nationality($nationality);
        $student->set_phone($phone);
        $student->set_fax_no($fax_no);
        $student->set_office_no($office_no);
        $student->set_address($address);
        $student->set_college_id($college->get_id());
        $student->set_department_id($department->get_id());
        $student->set_program_id($program->get_id());
        $student->set_status_id($status->get_id());

        if(!$student->save()){
            $this->log('student', 'save error', "id = {$integration_id}");
        }

        unset($student);
        unset($program);
        unset($department);
        unset($college);
        unset($integration_id);
        unset($email);
        unset($login_id);
        unset($first_name);
        unset($last_name);
        unset($is_active);
        unset($dob);
        unset($nationality);
        unset($college_id);
        unset($department_id);
        unset($program_id);
        unset($status_id);
        unset($male_gender);
        unset($phone);
        unset($fax_no);
        unset($office_no);
        unset($address);
    }


    /**
     * @param mixed  $integration_id
     * @param string $email
     * @param mixed  $login_id
     * @param string $first_name
     * @param string $last_name
     * @param bool   $is_active
     * @param mixed  $dob
     * @param string $nationality
     * @param int    $college_id
     * @param int    $department_id
     * @param int    $program_id
     * @param bool   $male_gender
     * @param int    $graduated
     * @param string $phone
     * @param string $fax_no
     * @param string $office_no
     * @param string $address
     */
    public function alumni(
        $integration_id, $email, $login_id, $first_name, $last_name, $is_active, $dob, $nationality, $college_id, $department_id, $program_id,
        $male_gender=true, $graduated=0, $phone='',$fax_no='', $office_no='', $address=''
    ) {


        $college = Orm_College::get_one(['integration_id'=>$college_id]);
        $status_id = Orm_Student_Status::get_one(['integration_id'=>7])->get_id();


        if(!($college && $college->get_id())){
            $desc = <<<T
this alumni not added;
integration = {$integration_id};
email = {$email};
login id = {$login_id};
first name = {$first_name};
last name = {$last_name};
college id ={$college_id};
department = {$department_id};
program id = {$program_id};

T;

            $this->log('alumni', 'college not exist', $desc);
            return;
        }


        $department = Orm_Department::get_one(['integration_id'=>$department_id]);

        if(!($department && $department->get_id())){
            $desc = <<<T
this alumni not added;
integration = {$integration_id};
email = {$email};
login id = {$login_id};
first name = {$first_name};
last name = {$last_name};
college id ={$college_id};
department = {$department_id};
program id = {$program_id};

T;

            $this->log('alumni', 'department not exist', $desc);
            return;
        }


        $program = Orm_Program::get_one(['integration_id' => $program_id]);

        if (!($program && $program->get_id())) {
            $desc = <<<T
this alumni not added;
integration = {$integration_id};
email = {$email};
login id = {$login_id};
first name = {$first_name};
last name = {$last_name};
college id ={$college_id};
department = {$department_id};
program id = {$program_id};

T;

            $this->log('alumni', 'program not exist', $desc);
            return;
        }


        $alumni = Orm_User::get_one(['login_id' => $integration_id, 'skip_active' => 1]);

        if ($alumni && $alumni->get_id() && $alumni->get_class_type() != Orm_User_Alumni::class) {

            $alumni->set_class_type(Orm_User_Alumni::class);

            $alumni->save();

            $this->db->query("delete from user_student where user_id = " . $alumni->get_id());

            $this->db->query("insert into user_alumni (user_id, college_id, department_id, program_id, graduated) VALUES ('" . $alumni->get_id() . "', 0, 0, 0, 0)");

            $alumni = Orm_User_Alumni::get_one(['login_id' => $integration_id, 'skip_active' => 1]);
        } elseif (!($alumni && $alumni->get_id())) {
            $alumni = new Orm_User_Alumni();
        }

        $alumni->set_email($email);
        $alumni->set_login_id($login_id);
        $alumni->set_integration_id($integration_id);
        $alumni->set_birth_date($dob);
        $alumni->set_first_name($first_name);
        $alumni->set_last_name($last_name);
        $alumni->set_is_active($is_active? 1 : 0);
        $alumni->set_gender($male_gender? 0: 1);
        $alumni->set_nationality($nationality);
        $alumni->set_phone($phone);
        $alumni->set_fax_no($fax_no);
        $alumni->set_office_no($office_no);
        $alumni->set_address($address);
        $alumni->set_college_id($college->get_integration_id());
        $alumni->set_department_id($department->get_integration_id());
        $alumni->set_program_id($program_id);
        $alumni->set_graduated($graduated);


        if(!$alumni->save()){
            $this->log('alumni', 'save error', "id = {$integration_id}");
        }
    }

    public function course_sections($integration_id, $semester_id, $campus_id, $course_id, $sectionSeq, $instructor_id){


        $course = Orm_Course::get_one(['integration_id'=>$course_id]);

        if(!($course && $course->get_id())){
            $desc = <<<T
this section not added;
section id = {$integration_id};
section name = {$sectionSeq};
semester id = {$semester_id};
campus id = {$campus_id};
course id = {$course_id};

T;

            $this->log('course_sections', 'course not exist', $desc);
            return;
        }

        $semester = Orm_Semester::get_one(['integration_id'=>$semester_id]);

        if(!($semester && $semester->get_id())){
            $desc = <<<T
this section not added;
section id = {$integration_id};
section name = {$sectionSeq};
semester id = {$semester_id};
campus id = {$campus_id};
course id = {$course_id};

T;

            $this->log('course_sections', 'semester not exist', $desc);
            return;
        }

        $campus = Orm_Campus::get_one(['integration_id'=>$campus_id]);

        if(!($campus && $campus->get_id())){
            $desc = <<<T
this section not added;
section id = $integration_id;
section name = {$sectionSeq};
semester id = $semester_id;
campus id = {$campus_id};
course id = {$course_id};

T;

            $this->log('course_sections', 'campus not exist', $desc);
            return;
        }


        $course_section = Orm_Course_Section::get_one(['integration_id' =>$integration_id]);
        $course_section->set_integration_id($integration_id);
        $course_section->set_course_id($course->get_id());
        $course_section->set_semester_id($semester->get_id());
        $course_section->set_is_deleted(0);
        $course_section->set_section_no($sectionSeq);
        $course_section->set_campus_id($campus->get_id());

        if(!$id=$course_section->save()){
            $desc = <<<T
section id = $integration_id;
section name = {$sectionSeq};
semester id = $semester_id;
campus id = {$campus_id};
course id = {$course_id};

T;
            $this->log('courses', 'save error section', "id = $desc");

            return;
        }

        $instructor = Orm_User_Faculty::get_one(['integration_id'=>$instructor_id]);

        if(!($instructor && $instructor->get_id())){
            $desc = <<<T
this section instructor not added;
section id = $integration_id;
section name = {$sectionSeq};
semester id = $semester_id;
campus id = {$campus_id};
course id = {$course_id};
instructor id = {$instructor_id};

T;

            $this->log('course_sections', 'instructor not exist', $desc);
            return;
        }

        $course_section_teacher = Orm_Course_Section_Teacher::get_one(['section_id' => $id, 'user_id' => $instructor->get_id()]);

        $course_section_teacher->set_section_id($id);
        $course_section_teacher->set_user_id($instructor->get_id());

        if(!$course_section_teacher->save()){
            $desc = <<<T
this section instructor not added;
section id = $integration_id;
section name = {$sectionSeq};
semester id = $semester_id;
campus id = {$campus_id};
course id = {$course_id};
instructor id = {$instructor_id};

T;
            $this->log('course_sections', 'save error sign instructor to section', $desc);
        }

    }

    public function course_student($integration_id, $student_id){


        $section = Orm_Course_Section::get_one(['integration_id'=>$integration_id]);

        if(!($section && $section->get_id())) {
            $desc = <<<T
this student not signed to section not added;
section id = $integration_id;
student id = {$student_id};

T;

            $this->log('course_student', 'section not exist', $desc);
            return;
        }


        $student = Orm_User_Student::get_one(['integration_id'=>$student_id]);

        if(!($student && $student->get_id())){
            $desc = <<<T
this student not signed to section  not added;
section id = $integration_id;
student id = {$student_id};

T;

            $this->log('course_student', 'student not exist', $desc);
            return;
        }

        $course_section_student = Orm_Course_Section_Student::get_one(['section_id' => $section->get_id(), 'user_id' => $student->get_id()]);

        $course_section_student->set_section_id($section->get_id());
        $course_section_student->set_user_id($student->get_id());

        if(!$course_section_student->save()){
            $desc = <<<T
this student not signed to section  not added;
section id = $integration_id;
student id = {$student_id};

T;
            $this->log('course_student', 'save error sign student to section', $desc);
        }
    }

    private function log($function_name, $subject, $description=''){
        $log = " \n".date('Y-m-d')." | {$function_name}: {$subject}";
        if(trim($description)!=''){
            $log .= " \n{$description}";
        }

        echo $log;
        $log = escapeshellcmd($log);
        `echo "{$log}" >> {$this->log_path}{$function_name}`;
    }
}