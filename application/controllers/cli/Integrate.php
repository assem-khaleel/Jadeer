<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Kku
 */
class Integrate extends MX_Controller
{

//    private $_soapSIS = "http://10.201.61.205:7003/KKU_AcademicSystemWS/KKU_AcademicSystemWS?WSDL";
    private $_soapSIS = "https://app-isv.kku.edu.sa:7503/KKU_AcademicSystemWS/KKU_AcademicSystemWS?WSDL";
    private $_soapHR = "http://10.201.61.205:7003/KKU_HrWS/KKU_HrWS?WSDL";
    public $retry = 0;

    private $time = 0;
    private $count = 0;

    public function __construct()
    {
        parent::__construct();

        if (!is_cli()) {
            exit('No direct script access allowed');
        }

        set_time_limit(0);
        ini_set("soap.wsdl_cache_enabled", 0);


        ini_set('display_errors', 1);
        error_reporting(E_ALL);

    }

    public function index()
    {

        error_log("Integrate : Start (Semesters)");
        $this->semesters();

        error_log("Integrate : Start (Campus)");
        $this->campuses();

        error_log("Integrate : Start (College)");
        $this->colleges();

        error_log("Integrate : Start (Department)");
        $this->departments();

        error_log("Integrate : Start (Degrees)");
        $this->degrees();

        error_log("Integrate : Start (Programs)");
        $this->programs();

        error_log("Integrate : Start (Majors)");
//        $this->majors();

        error_log("Integrate : Start (Courses)");
//        $this->courses();

        error_log("Integrate : Start (Program_plan)");
//        $this->program_plan();

        error_log("Integrate : Start (Faculty)");
//        $this->faculty_members();

        error_log("Integrate : Start (Units)");
//        $this->support_unit();

        error_log("Integrate : Start (Staff)");
//        $this->staff_members();

        error_log("Integrate : Start (Students)");
//        $this->student_members();

        error_log("Integrate : Start (Course Sections)");
//        $this->course_sections();
        echo 'The end';
    }

    private function load_modules()
    {
//        Modules::load('kpi');
//        Modules::load('survey');
//        Modules::load('edugate');
    }

    public function semesters()
    {
        $result = $this->getSOUP('Semesters');

        $semesters = $this->check_data($result, 'semesterList');

        foreach($semesters as $semester) {

            $semester = array_merge([
                'semester'      => '',
                'semesterEnd'   => '',
                'semesterName'  => '',
                'semesterNameE' => '',
                'semesterStart' => '',
                'semesterYear'  => ''
            ], (array) $semester);

            $params = array(
                'id'             => $semester['semester'],
                'integration_id' => $semester['semester'],
                'is_deleted'     => 0,
                'start'          => $semester['semesterStart']?:'1970-1-1',
                'end'            => $semester['semesterEnd']?:'1970-1-1',
                'year'           => $semester['semesterYear']?:0,
                'name_en'        => $semester['semesterNameE']?: $semester['semesterName'],
                'name_ar'        => $semester['semesterName']?: $semester['semesterNameE']
            );

            $this->db->replace('semester', $params);

            error_log("{$this->count} - Semester : Replace ({$semester['semester']}) Time:" . (time() - $this->time));
            unset($semester);

        }
    }

    public function campuses()
    {
        $result = $this->getSOUP('Campuses');

        $campuses = $this->check_data($result, 'campusesList');

        foreach($campuses as $row) {

            $row = array_merge([
                'campusName'      => '',
                'campusNameE'   => '',
                'campusNo'  => '',
            ], (array) $row);



            $params = array(
                'id'             => $row['campusNo'],
                'is_deleted'     => 0,
                'integration_id' => $row['campusNo'],
                'name_ar'        => $row['campusName']?: $row['campusNameE'],
                'name_en'        => $row['campusNameE']?: $row['campusName']
            );

            $this->db->replace('campus', $params);
            $mode = 'Replace';


//            $campus = Orm_Campus::get_one(array('integration_id' => $row['campusNo']));
//            $mode = ($campus->get_id() ? 'Modify' : 'Add');
//            $this->count++;
//            $campus->set_is_deleted(0);
//            $campus->set_integration_id($row['campusNo']);
//            $campus->set_name_ar($row['campusName']);
//            $campus->set_name_en($row['campusNameE']);
//            $campus->save();

            error_log("{$this->count} - Semester : {$mode} ({$row['campusNo']}) Time:" . (time() - $this->time));
        }
    }

    public function colleges()
    {
        $result = $this->getSOUP('Colleges');

        $colleges = $this->check_data($result, 'collegesList');

        foreach($colleges as $row) {

            $row = array_merge([
                'campusNo'      => '',
                'collegeId'     => '',
                'collegeName'   => '',
                'collegeNameE'  => '',
            ], (array) $row);

            $params = array(
                'id'             => $row['collegeId'],
                'is_deleted'     => 0,
                'campus_id'      => $row['campusNo'],
                'integration_id' => $row['collegeId'],
                'name_ar'        => $row['collegeName']?: $row['collegeNameE'],
                'name_en'        => $row['collegeNameE']?: $row['collegeName']
            );

            $this->db->replace('college', $params);

//            $college = Orm_College::get_one(array('integration_id' => $row['COLLEGE_ID']));
//            $mode = ($college->get_id() ? 'Modify' : 'Add');
//            $this->count++;
//            $college->set_is_deleted(0);
//            $college->set_campus_id(1);
//            $college->set_integration_id($row['COLLEGE_ID']);
//            $college->set_name_ar($row['COLLEGE_NAME_ARABIC'] ? $row['COLLEGE_NAME_ARABIC'] : $row['COLLEGE_NAME_ENGLISH']);
//            $college->set_name_en($row['COLLEGE_NAME_ENGLISH'] ? $row['COLLEGE_NAME_ENGLISH'] : $row['COLLEGE_NAME_ARABIC']);
//            $college->save();

            error_log("{$this->count} - College : Replace ({$row['collegeId']}) Time:" . (time() - $this->time));
        }
    }

    public function departments()
    {
        $colleges = Orm_College::get_all();

        foreach ($colleges as $college) {
            $result = $this->getSOUP('Departments', ['college' => $college->get_id()]);

            $colleges = $this->check_data($result, 'departmentsList');

            foreach ($colleges as $row) {

                $row = array_merge([
                    'departmentId' => '',
                    'departmentName' => '',
                    'departmentNameE' => '',
                ], (array)$row);

                $params = array(
                    'id' => $row['departmentId'],
                    'is_deleted' => 0,
                    'college_id' => $college->get_id(),
                    'integration_id' => $row['departmentId'],
                    'name_ar' => $row['departmentName'] ?: $row['departmentNameE'],
                    'name_en' => $row['departmentNameE'] ?: $row['departmentName']
                );

                $this->db->replace('department', $params);


                error_log("{$this->count} - Department : Replace ({$row['departmentId']}) Time:" . (time() - $this->time));
                unset($department);
            }
        }
    }

    public function degrees()
    {
        $result = $this->getSOUP('StudentDegree');

        $colleges = $this->check_data($result, 'studentDegreeList');

        foreach ($colleges as $row) {

            $row = array_merge([
                'degreeId' => '',
                'degreeDesc' => '',
                'degreeDescE' => '',
            ], (array)$row);

            $params = array(
                'id' => $row['degreeId'],
                'is_deleted' => 0,
                'integration_id'=> $row['degreeId'],
                'name_ar' => $row['degreeDesc'] ? : $row['degreeDescE'],
                'name_en' => $row['degreeDescE'] ? : $row['degreeDesc']
            );


            $this->db->replace('degree', $params);

            error_log("{$this->count} - Degree : Replace ({$row['degreeId']}) Time:" . (time() - $this->time));
            unset($degree);
        }
    }

    public function programs()
    {

        $departments = Orm_Department::get_all();

        foreach ($departments as $department) {

            $result = $this->getSOUP('Majors', ['college'=> $department->get_college_id(), 'department'=> $department->get_id()]);

            $programs = $this->check_data($result, 'majorsList');

            foreach ($programs as $row) {

                $row = array_merge([
                    'majorId'    => '',
                    'majorLevel' => '',
                    'majorName'  => '',
                    'majorNameE' => '',
                ], (array)$row);

                $params = array(
                    'id'             => $row['majorId'],
                    'is_deleted'     => 0,
                    'integration_id' => $row['majorId'],
                    'department_id'  => $department->get_id(),
                    'degree_id'      => '',       // need to provide later
                    'name_ar'        => $row['majorName'] ? : $row['majorNameE'],
                    'name_en'        => $row['majorNameE'] ? : $row['majorName']
                );

                $this->db->replace('program', $params);

                error_log("{$this->count} - Program : Replace ({$row['majorId']}) Time:" . (time() - $this->time));
                unset($program);
            }
        }
    }

    public function majors()
    {
        $cs = netezza_odbc_cs();
        $query = "SELECT * from T3_EQMS_MAJOR_PROGRAM";
        $result = odbc_exec($cs, $query);
        while ($row = odbc_fetch_array($result)) {

            $params = array(
                'id' => $row['MAJOR_ID'],
                'is_deleted' => 0,
                'integration_id'=> $row['MAJOR_ID'],
                'program_id'=> $row['PROGRAM_ID'],
                'name_ar' => $row['ARABIC_NAME'] ? $row['CODE'] .' - '. $row['ARABIC_NAME'] : $row['CODE'] .' - '. $row['ENGLISH_NAME'],
                'name_en' => $row['ENGLISH_NAME'] ? $row['CODE'] .' - '. $row['ENGLISH_NAME'] : $row['CODE'] .' - '. $row['ARABIC_NAME']
            );

            $this->db->replace('program', $params);


//            $major = Orm_Major::get_one(array('integration_id' => $row['MAJOR_ID']));
//            $mode = ($major->get_id() ? 'Modify' : 'Add');
//            $this->count++;
//
//            $major->set_is_deleted(0);
//            $major->set_integration_id($row['MAJOR_ID']);
//            $major->set_program_id(Orm_Program::get_one(array('integration_id' => $row['PROGRAM_ID']))->get_id());
//            $major->set_name_ar($row['ARABIC_NAME'] ? $row['CODE'] .' - '. $row['ARABIC_NAME'] : $row['CODE'] .' - '. $row['ENGLISH_NAME']);
//            $major->set_name_en($row['ENGLISH_NAME'] ? $row['CODE'] .' - '. $row['ENGLISH_NAME'] : $row['CODE'] .' - '. $row['ARABIC_NAME']);
//            $major->save();

            error_log("{$this->count} - Major : Replace ({$row['MAJOR_ID']}) Time:" . (time() - $this->time));
            unset($major);
        }
    }


    public function courses()
    {

        $cs = netezza_odbc_cs();
        $query = "SELECT * FROM T3_EQMS_COURSE_DIM";
        $result = odbc_exec($cs, $query);
        while ($row = odbc_fetch_array($result)) {

            $params = array(
                'id' => $row['COURSE_ID'],
                'is_deleted' => 0,
                'integration_id'=> $row['COURSE_ID'],
                'department_id'=> $row['COLLEGE_ID'] . '0' . $row['DEPARTMENT_ID'],
                'name_ar' => $row['COURSE_TITLE_ARABIC'] ? $row['COURSE_TITLE_ARABIC'] : $row['COURSE_TITLE_ARABIC'],
                'name_en' => $row['COURSE_TITLE_ENGLISH'] ? $row['COURSE_TITLE_ENGLISH'] : $row['COURSE_TITLE_ARABIC'],
                'code_ar' => $row['COURSE_CODE_ARABIC'],
                'code_en' => $row['COURSE_CODE_ENGLISH'],
            );

            $this->db->replace('course', $params);

//
//            $course = Orm_Course::get_one(array('integration_id' => $row['COURSE_ID']));
//            $mode = ($course->get_id() ? 'Modify' : 'Add');
//            $this->count++;
//            if ($mode == 'Add') {
//                print_r($row);
//                print_r($course);
//
//                die;
//            }
//            $course->set_is_deleted(0);
//            $course->set_integration_id($row['COURSE_ID']);
//            $course->set_department_id(Orm_Department::get_one(array('integration_id' => $row['COLLEGE_ID'] . '-' . $row['DEPARTMENT_ID']))->get_id());
//            $course->set_name_ar($row['COURSE_TITLE_ARABIC'] ? $row['COURSE_TITLE_ARABIC'] : $row['COURSE_TITLE_ARABIC']);
//            $course->set_name_en($row['COURSE_TITLE_ENGLISH'] ? $row['COURSE_TITLE_ENGLISH'] : $row['COURSE_TITLE_ARABIC']);
//            $course->set_code_ar($row['COURSE_CODE_ARABIC']);
//            $course->set_code_en($row['COURSE_CODE_ENGLISH']);
//            $course->save();

            error_log("{$this->count} - Course : Replace ({$row['COURSE_ID']}) Time:" . (time() - $this->time));
            unset($course);
        }
    }

    public function program_plan()
    {
        $cs = netezza_odbc_cs();
        $query = "SELECT T3_EQMS_PROGRAM_COURSES.PROGRAM_ID,T3_EQMS_PROGRAM_COURSES.COURSE_ID,T3_EQMS_PROGRAM_COURSES.LEVEL,T3_EQMS_PROGRAM_COURSES.CREDIT_HOURS,T3_EQMS_PROGRAM_COURSES.ELECTIVE_REQUIRED FROM T3_EQMS_PROGRAM_COURSES LEFT JOIN T3_EQMS_PROGRAM ON T3_EQMS_PROGRAM_COURSES.PROGRAM_ID = T3_EQMS_PROGRAM.ID WHERE T3_EQMS_PROGRAM_COURSES.PROGRAM_ID != 0 AND T3_EQMS_PROGRAM.IS_DELETED = 0 AND T3_EQMS_PROGRAM_COURSES.IS_DELETED = 0";
        $result = odbc_exec($cs, $query);
        while ($row = odbc_fetch_array($result)) {


            $params = array(
                'id' => $row['PROGRAM_ID'] . '0' . $row['COURSE_ID'],
                'program_id'=> $row['PROGRAM_ID'],
                'course_id'=> $row['COURSE_ID'],
                'level' => $row['LEVEL'],
                'credit_hours' => $row['CREDIT_HOURS'],
                'is_required' => $row['ELECTIVE_REQUIRED']
            );

            $this->db->replace('program_plan', $params);


//            $program_id = Orm_Program::get_one(array('integration_id' => $row['PROGRAM_ID']))->get_id();
//            $course_id = Orm_Course::get_one(array('integration_id' => $row['COURSE_ID']))->get_id();
//            if ($program_id && $course_id) {
//                $program_plan = Orm_Program_Plan::get_one(array('program_id' => $program_id, 'course_id' => $course_id));
//                $mode = ($program_plan->get_id() ? 'Modify' : 'Add');
//                $this->count++;
//                $program_plan->set_program_id($program_id);
//                $program_plan->set_course_id($course_id);
//                $program_plan->set_level($row['LEVEL']);
//                $program_plan->set_credit_hours($row['CREDIT_HOURS']);
//                $program_plan->set_is_required($row['ELECTIVE_REQUIRED']);
//                $program_plan->save();
//
//
//            }

            $id = $row['PROGRAM_ID'] . '0' . $row['COURSE_ID'];
            error_log("{$this->count} - Program plan : Replace ({$id}) Time:" . (time() - $this->time));
            unset($program_plan);

        }
    }


    public function faculty_members()
    {
        $cs = netezza_odbc_cs();
        $query = "SELECT * FROM T3_EQMS_FACULTY where IS_ACTIVE = 1";
        $result = odbc_exec($cs, $query);
        while ($row = odbc_fetch_array($result)) {
            $login_id = strstr($row['EMAIL'], '@', true);

            $faculty = Orm_User_Faculty::get_instance($row['LOGIN_ID']);
            if ($faculty->get_id()) {
                $faculty->set_email($row['EMAIL']);
                $faculty->set_login_id($login_id);
                $faculty->set_birth_date($row['BIRTH_DATE']);
                $faculty->set_integration_id($row['LOGIN_ID']);
                $faculty->set_gender($row['GENDER'] > 0 ? $row['GENDER'] - 1 : $row['GENDER']);
                $faculty->set_nationality($row['NATIONALITY']);
                $faculty->set_phone($row['PHONE']);
                $faculty->set_fax_no($row['FAX_NO']);
                $faculty->set_office_no($row['OFFICE_NO']);
                $faculty->set_address($row['ADDRESS']);

                $faculty->set_college_id($row['COLLEGE_ID']);
                $faculty->set_department_id($row['COLLEGE_ID'] . '0' . $row['DEPARTMENT_ID']);
                $faculty->set_program_id($row['PROGRAM_ID']);
                $faculty->set_job_position($this->get_faculty_job_position($row['JOB_POSITION']));
                $faculty->set_academic_rank($this->get_academic_rank($row['ACADMIC_RANK']));
                $faculty->set_service_time((int)$row['SERVICE_TIME']);
                $faculty->set_general_specialty($row['GENERAL_SPECIALTY']);
                $faculty->set_specific_specialty($row['SPECIFIC_SPECIALTY']);
                $faculty->set_degree(Orm_Degree::get_one(array('name_en' => $row['DEGREE']))->get_id());
                $faculty->save();
            } else {

                $params = array(
                    'id' => $row['LOGIN_ID'],
                    'login_id' => $login_id,
                    'integration_id' => $row['LOGIN_ID'],
                    'class_type'=> 'Orm_User_Faculty',
                    'email'=> $row['EMAIL'],
                    'password' => sha1('123456'),
                    'birth_date' => $row['BIRTH_DATE'],
                    'first_name' => $row['FIRST_NAME'],
                    'last_name' => $row['LAST_NAME'],
                    'is_active' => $row['IS_ACTIVE'],
                    'gender' => $row['GENDER'] > 0 ? $row['GENDER'] - 1 : $row['GENDER'],
                    'nationality' => $row['NATIONALITY'],
                    'fax_no' => $row['FAX_NO'],
                    'phone' => $row['PHONE'],
                    'office_no' => $row['OFFICE_NO'],
                    'address' => $row['ADDRESS'],
                    'token' => '',
                    'theme' => '',
                    'theme_fixed_navbar' => '0',
                    'theme_fixed_menu' => '0',
                    'theme_flip_menu' => '0',
                    'about_me' => '-',

                );

                $this->db->replace('user', $params);

                $params_faculty = array(
                    'user_id' => $row['LOGIN_ID'],
                    'role_id' => 7,
                    'college_id' => $row['COLLEGE_ID'],
                    'department_id' => $row['COLLEGE_ID'] . '0' . $row['DEPARTMENT_ID'],
                    'program_id' => $row['PROGRAM_ID'],
                    'service_time'=> (int)$row['SERVICE_TIME'],
                    'job_position'=> $this->get_faculty_job_position($row['JOB_POSITION']),
                    'academic_rank' => $this->get_academic_rank($row['ACADMIC_RANK']),
                    'general_specialty' => $row['GENERAL_SPECIALTY'],
                    'specific_specialty' => $row['SPECIFIC_SPECIALTY'],
                    'graduate_from' => $row['GRADUATE_FROM'],
                    'degree' => Orm_Degree::get_one(array('name_en' => $row['DEGREE']))->get_id(),

                );

                $this->db->replace('user_faculty', $params_faculty);
            }




//            $faculty = Orm_User_Faculty::get_one(array('login_id' => $login_id));
//            $mode = ($faculty->get_id() ? 'Modify' : 'Add');
//            $this->count++;
//            $faculty->set_login_id($login_id);
//            $faculty->set_integration_id($row['LOGIN_ID']);
//            $faculty->set_class_type('Orm_User_Faculty');
//            $faculty->set_email($row['EMAIL']);
//            $faculty->set_password(sha1('123456'));
//            $faculty->set_birth_date($row['BIRTH_DATE']);
//            $faculty->set_first_name($row['FIRST_NAME']);
//            $faculty->set_last_name($row['LAST_NAME']);
//            $faculty->set_is_active($row['IS_ACTIVE']);
//            $faculty->set_gender($row['GENDER'] - 1);
//            $faculty->set_nationality((string)$row['NATIONALITY']);
//            $faculty->set_fax_no((string)$row['FAX_NO']);
//            $faculty->set_phone((string)$row['PHONE']);
//            $faculty->set_office_no((string)$row['OFFICE_NO']);
//            $faculty->set_address((string)$row['ADDRESS']);
//
//            $faculty->set_role_id(3);
//            $faculty->set_college_id(Orm_College::get_one(array('integration_id' => $row['COLLEGE_ID']))->get_id());
//            $faculty->set_department_id(Orm_Department::get_one(array('integration_id' => $row['COLLEGE_ID'] . '-' . $row['DEPARTMENT_ID']))->get_id());
//            $faculty->set_program_id(Orm_Program::get_one(array('integration_id' => $row['PROGRAM_ID']))->get_id());
//            $faculty->set_service_time((int)$row['SERVICE_TIME']);
//            $faculty->set_job_position(Orm_User_Faculty::JOB_POSITION_MEMBERS);
//            $faculty->set_academic_rank($this->get_academic_rank($row['ACADMIC_RANK']));
//            $faculty->set_general_specialty((string)$row['GENERAL_SPECIALTY']);
//            $faculty->set_specific_specialty((string)$row['SPECIFIC_SPECIALTY']);
//            $faculty->set_graduate_from((string)$row['GRADUATE_FROM']);
//            $faculty->set_degree(Orm_Degree::get_one(array('name_en' => $row['DEGREE']))->get_id());
//            $faculty->save();


            error_log("{$this->count} - Faculty Member : Replace ({$row['LOGIN_ID']}) Time:" . (time() - $this->time));
            unset($params);
            unset($params_faculty);
        }
    }

    public function get_faculty_job_position($position) {
        switch ($position) {
            case 'أعضاء هيئة التدريس' :
                return Orm_User_Faculty::JOB_POSITION_MEMBERS;
            case 'المحاضرون والمعيدون' :
                return Orm_User_Faculty::JOB_POSITION_LECTURER;
            default:
                return -1;
        }
    }

    public function get_academic_rank($rank)
    {
        switch ($rank) {
            case 'مدرس':
                return Orm_User_Faculty::ACADEMIC_RANK_TUTOR;
            case 'معيد':
                return Orm_User_Faculty::ACADEMIC_RANK_TEACHING_ASSISTANT;
            case 'أستاذ':
                return Orm_User_Faculty::ACADEMIC_RANK_PROFESSOR;
            case 'أستاذ مساعد':
                return Orm_User_Faculty::ACADEMIC_RANK_ASSISTANT_PROF;
            case 'محاضر':
                return Orm_User_Faculty::ACADEMIC_RANK_LECTURER;
            case 'أستاذ مشارك':
            case 'استاذ مشارك':
                return Orm_User_Faculty::ACADEMIC_RANK_ASSOCIATE_PROF;
            default:
                return Orm_User_Faculty::ACADEMIC_RANK_TUTOR;
        }
    }

    public function support_unit()
    {
        $cs = netezza_odbc_cs();
        $query = "SELECT * from T3_EQMS_SUPPORT_UNITS_DIM";
        $result = odbc_exec($cs, $query);
        while ($row = odbc_fetch_array($result)) {

            $params = array(
                'id' => $row['UNIT_ID'],
                'name_ar'=> $row['UNIT_NAME_ARABIC'] ? (string)$row['UNIT_NAME_ARABIC'] : (string)$row['UNIT_NAME_ENGLISH'],
                'name_en'=> $row['UNIT_NAME_ENGLISH'] ? (string)$row['UNIT_NAME_ENGLISH'] : (string)$row['UNIT_NAME_ARABIC'],
                'integration_id' => $row['UNIT_ID']
            );

            $this->db->replace('unit', $params);

//            $unit = Orm_Unit::get_one(array('integration_id' => $row['UNIT_ID']));
//            $mode = ($unit->get_id() ? 'Modify' : 'Add');
//            $this->count++;
//            $unit->set_name_ar($row['UNIT_NAME_ARABIC'] ? (string)$row['UNIT_NAME_ARABIC'] : (string)$row['UNIT_NAME_ENGLISH']);
//            $unit->set_name_en($row['UNIT_NAME_ENGLISH'] ? (string)$row['UNIT_NAME_ENGLISH'] : (string)$row['UNIT_NAME_ARABIC']);
//            $unit->set_integration_id($row['UNIT_ID']);
//            $unit->save();

            error_log("{$this->count} - Unit : Replace ({$row['UNIT_NAME_ARABIC']}) Time:" . (time() - $this->time));
            unset($params);
        }
    }

    public function staff_members()
    {
        $cs = netezza_odbc_cs();
        $query = "SELECT * from T3_EQMS_STAFF WHERE EMAIL IS NOT NULL AND EMAIL <> '' AND IS_ACTIVE = 1";
        $result = odbc_exec($cs, $query);
        while ($row = odbc_fetch_array($result)) {
            $login_id = strstr($row['EMAIL'], '@', true);

            $staff = Orm_User_Staff::get_instance($row['LOGIN_ID']);

            if ($staff->get_id()) {
                $staff->set_email($row['EMAIL']);
                $staff->set_login_id($login_id);
                $staff->set_birth_date($row['BIRTH_DATE']);
                $staff->set_integration_id($row['LOGIN_ID']);
                $staff->set_gender($row['GENDER'] > 0 ? $row['GENDER'] - 1 : $row['GENDER']);
                $staff->set_nationality($row['NATIONALITY']);
                $staff->set_phone($row['PHONE']);
                $staff->set_fax_no($row['FAX_NO']);
                $staff->set_office_no($row['OFFICE_NO']);
                $staff->set_address($row['ADDRESS']);

                $staff->set_college_id($row['COLLEGE_ID']);
                $staff->set_department_id($row['COLLEGE_ID'] . '0' . $row['DEPARTMENT_ID']);
                $staff->set_program_id($row['PROGRAM_ID']);
                $staff->set_unit_id($row['UNIT_ID']);
                $staff->set_job_position($this->get_faculty_job_position($row['JOB_POSITION']));
                $staff->set_service_time((int)$row['SERVICE_TIME']);
                $staff->save();
            } else {
                $params = array(
                    'id' => $row['LOGIN_ID'],
                    'login_id' => $login_id,
                    'integration_id' => $row['LOGIN_ID'],
                    'class_type'=> 'Orm_User_Staff',
                    'email'=> $row['EMAIL'],
                    'password' => sha1('123456'),
                    'birth_date' => $row['BIRTH_DATE'],
                    'first_name' => $row['FIRST_NAME'],
                    'last_name' => $row['LAST_NAME'],
                    'is_active' => $row['IS_ACTIVE'],
                    'gender' => $row['GENDER'] > 0 ? $row['GENDER'] - 1 : $row['GENDER'],
                    'nationality' => $row['NATIONALITY'],
                    'fax_no' => $row['FAX_NO'],
                    'phone' => $row['PHONE'],
                    'office_no' => $row['OFFICE_NO'],
                    'address' => $row['ADDRESS'],
                    'token' => '',
                    'theme' => '',
                    'theme_fixed_navbar' => '0',
                    'theme_fixed_menu' => '0',
                    'theme_flip_menu' => '0',
                    'about_me' => '-',

                );

                $this->db->replace('user', $params);

                $params_staff = array(
                    'user_id' => $row['LOGIN_ID'],
                    'role_id' => 7,
                    'college_id' => $row['COLLEGE_ID'],
                    'department_id' => $row['COLLEGE_ID'] . '0' . $row['DEPARTMENT_ID'],
                    'program_id' => $row['PROGRAM_ID'],
                    'unit_id' => $row['UNIT_ID'],
                    'service_time'=> (int)$row['SERVICE_TIME'],
                    'job_position'=> Orm_User_Staff::JOB_POSITION_MEMBERS

                );
                $this->db->replace('user_staff', $params_staff);
            }




//            $staff = Orm_User_Staff::get_one(array('login_id' => $login_id));
//            $mode = ($staff->get_id() ? 'Modify' : 'Add');
//            $this->count++;
//            $staff->set_login_id($login_id);
//            $staff->set_integration_id($row['LOGIN_ID']);
//            $staff->set_class_type('Orm_User_Staff');
//            $staff->set_email($row['EMAIL']);
//            $staff->set_birth_date($row['BIRTH_DATE']);
//            $staff->set_first_name($row['FIRST_NAME']);
//            $staff->set_last_name($row['LAST_NAME']);
//            $staff->set_is_active($row['IS_ACTIVE']);
//            $staff->set_gender($row['GENDER'] - 1);
//            $staff->set_nationality((string)$row['NATIONALITY']);
//            $staff->set_fax_no((string)$row['FAX_NO']);
//            $staff->set_phone((string)$row['PHONE']);
//            $staff->set_office_no((string)$row['OFFICE_NO']);
//            $staff->set_address((string)$row['ADDRESS']);
//            $staff->set_role_id(1);
//            $staff->set_unit_id(Orm_Unit::get_one(array('integration_id' => (int)$row['UNITID']))->get_id());
//            $staff->set_college_id(Orm_College::get_one(array('integration_id' => (int)$row['COLLEGE_ID']))->get_id());
//            $staff->set_department_id(Orm_Department::get_one(array('integration_id' => (int)$row['COLLEGE_ID'] . '-' . (int)$row['DEPARTMENT_ID']))->get_id());
//            $staff->set_program_id(Orm_Program::get_one(array('integration_id' => (int)$row['PROGRAM_ID']))->get_id());
//            $staff->set_service_time((int)$row['SERVICE_TIME']);
//            $staff->set_job_position(Orm_User_Staff::JOB_POSITION_MEMBERS);
//            $staff->save();

            error_log("{$this->count} - Staff : Replace ({$row['LOGIN_ID']}) Time:" . (time() - $this->time));
            unset($params_staff);
            unset($params);

        }
    }

    public function student_members()
    {
        $cs = netezza_odbc_cs();
        $query = "SELECT DISTINCT STUDENT_ID, EMAIL, FIRSTNAME, GENDER FROM V1_LMS_COURSE_STUDENT";
        $result = odbc_exec($cs, $query);
        while ($row = odbc_fetch_array($result)) {

            $student = Orm_User_Student::get_instance($row['STUDENT_ID']);

            if ($student->get_id()) {
                $student->set_login_id($row['STUDENT_ID']);
                $student->set_integration_id($row['STUDENT_ID']);
                $student->set_class_type('Orm_User_Student');
                $student->set_email($row['LOGIN_ID'] . '@student.ksu.edu.sa');
                $student->set_birth_date((int)$row['BIRTH_DATE']);
                $student->set_first_name($row['FIRSTNAME']);
                $student->set_last_name($this->count);
                $student->set_is_active(1);
                $student->set_gender($row['GENDER'] == 'M' ? 0 : ($row['GENDER'] == 'F' ? 1 : -1));
                $student->set_nationality('');
                $student->set_fax_no('');
                $student->set_phone('');
                $student->set_office_no('');
                $student->set_address('');
                $student->set_college_id(0);
                $student->set_department_id(0);
                $student->set_program_id(0);
                $student->set_level_of_study(0);
                $student->save();
            } else {
                $params = array(
                    'id' => $row['STUDENT_ID'],
                    'login_id' => $row['STUDENT_ID'],
                    'integration_id' => $row['STUDENT_ID'],
                    'class_type'=> 'Orm_User_Student',
                    'email'=> $row['EMAIL'],
                    'password' => sha1('123456'),
                    'birth_date' => '0000-00-00',
                    'first_name' => $row['FIRSTNAME'],
                    'last_name' => '',
                    'is_active' => 1,
                    'gender' => $row['GENDER'] == 'M' ? 0 : ($row['GENDER'] == 'F' ? 1 : -1),
                    'nationality' => '',
                    'fax_no' => '',
                    'phone' => '',
                    'office_no' => '',
                    'address' => '',
                    'token' => '',
                    'theme' => '',
                    'theme_fixed_navbar' => '0',
                    'theme_fixed_menu' => '0',
                    'theme_flip_menu' => '0',
                    'about_me' => '-',

                );

                $this->db->replace('user', $params);

                $params_student = array(
                    'user_id' => $row['LOGIN_ID'],
                    'level_of_study' => 0,
                    'college_id' => 0,
                    'department_id' => 0,
                    'program_id' => 0

                );

                $this->db->replace('user_student', $params_student);
            }

//            $student = Orm_User_Student::get_one(array('login_id' => $row['LOGIN_ID']));
//            $mode = ($student->get_id() ? 'Modify' : 'Add');
//            $this->count++;
//            $student->set_login_id($row['LOGIN_ID']);
//            $student->set_class_type('Orm_User_Student');
//            $student->set_email($row['LOGIN_ID'] . '@student.ksu.edu.sa');
//            $student->set_birth_date((int)$row['BIRTH_DATE']);
//            $student->set_first_name('Student');
//            $student->set_last_name($this->count);
//            $student->set_is_active($row['IS_ACTIVE']);
//            $student->set_gender($row['GENDER'] - 1);
//            $student->set_nationality((string)$row['NATIONALITY']);
//            $student->set_fax_no((string)$row['FAX_NO']);
//            $student->set_phone((string)$row['PHONE']);
//            $student->set_office_no((string)$row['OFFICE_NO']);
//            $student->set_address((string)$row['ADDRESS']);
//            $student->set_college_id(Orm_College::get_one(array('integration_id' => (int)$row['COLLEGE_ID']))->get_id());
//            $student->set_department_id(Orm_Department::get_one(array('integration_id' => (int)$row['COLLEGE_ID'] . '-' . (int)$row['DEPARTMENT_ID']))->get_id());
//            $student->set_program_id(Orm_Program::get_one(array('integration_id' => (int)$row['PROGRAM_ID']))->get_id());
//            $student->set_level_of_study((int)$row['LEVEL_OF_STUDY']);
//            $student->save();

            error_log("{$this->count} - Student : Replace ({$row['LOGIN_ID']}) Time:" . (time() - $this->time));
            unset($student);

        }
    }



    public function course_sections($semester_id)
    {
        if (!$semester_id) {
            die('No Semester Selected');
        }
        $cs = netezza_odbc_cs();
        $query = "SELECT CS.* FROM T3_EQMS_COURSE_SECTION CS WHERE SEMESTER_ID = {$semester_id}";
        $result = odbc_exec($cs, $query);
        while ($row = odbc_fetch_array($result)) {

            $course_section = array(
                'id' => $row['COURSE_SECTION_ID'],
                'integration_id'=> $row['COURSE_SECTION_ID'],
                'course_id'=> $row['COURSE_ID'],
                'semester_id'=> $row['SEMESTER_ID'],
                'is_deleted' => 0,
                'name_en'=> $row['SECTION_NO'],
                'name_ar' => $row['SECTION_NO'],
                'section_no' => $row['SECTION_NO']
            );

            $this->db->replace('course_section', $course_section);

            if ($row['INSTRUCTOR_ID']) {

                $course_section_teacher = array(
                    'id'=> $row['INSTRUCTOR_ID'] . $row['SECTION_NO'] . $row['SEMESTER_ID'],
                    'section_id'=> $row['COURSE_SECTION_ID'],
                    'user_id'=> $row['INSTRUCTOR_ID']
                );

                $this->db->replace('course_section_teacher', $course_section_teacher);

            }


//            $login_id = strstr($row['EMAIL'], '@', true);
//
//            $user_id = Orm_User_Faculty::get_one(array('login_id' => $login_id))->get_id();
//            if ($user_id) {
//
//                $course_section = Orm_Course_Section::get_one(array('integration_id' => $row['COURSE_SECTION_ID']));
//                $mode = ($course_section->get_id() ? 'Modify' : 'Add');
//                $this->count++;
//
//                $course_section->set_is_deleted(0);
//                $course_section->set_integration_id($row['COURSE_SECTION_ID']);
//                $course_section->set_course_id(Orm_Course::get_one(array('integration_id' => $row['COURSE_ID']))->get_id());
//                $course_section->set_semester_id(Orm_Semester::get_one(array('integration_id' => $row['SEMESTER_ID']))->get_id());
//                $course_section->set_name_ar($row['SECTION_NO']);
//                $course_section->set_name_en($row['SECTION_NO']);
//                $course_section->set_section_no($row['SECTION_NO']);
//                $course_section_id = $course_section->save();
//
//                $course_section_teacher = Orm_Course_Section_Teacher::get_one(array('user_id' => $user_id, 'section_id'=> $course_section_id));
//                $course_section_teacher->set_section_id($course_section_id);
//                $course_section_teacher->set_user_id($user_id);
//                $course_section_teacher->save();
//            }

            error_log("{$this->count} - Course sections : Replace ({$row['COURSE_SECTION_ID']}) Faculty: {$row['INSTRUCTOR_ID']} Time:" . (time() - $this->time));
            unset($course_section);
            unset($course_section_teacher);
        }
    }

    public function course_students($semester)
    {
        $cs = netezza_odbc_cs();
        $query = "select SECTION||STUDENT_ID||SEMESTER as ID ,SEMESTER||COURSE_NO||SECTION as COURSE_SECTION_ID, STUDENT_ID from V1_LMS_COURSE_STUDENT where STUDENT_ID is not null and STUDENT_ID <> '' AND SEMESTER = {$semester}";
        $result = odbc_exec($cs, $query);
        while ($row = odbc_fetch_array($result)) {

            $course_section_student = array(
                'id'=> $row['ID'],
                'section_id'=> $row['COURSE_SECTION_ID'],
                'user_id'=> $row['STUDENT_ID']
            );

            $this->db->replace('course_section_student', $course_section_student);

//            $course_section = Orm_Course_Section::get_one(array('integration_id' => $row['COURSE_SECTION_ID']));
//            $student = Orm_User::get_one(array('integration_id' => $row['STUDENT_ID']));
//
//            $course_student = Orm_Course_Section_Student::get_one(array('section_id' => $course_section->get_id(), 'user_id' => $student->get_id()));
//            $course_student->set_section_id($course_section->get_id());
//            $course_student->set_user_id($student->get_id());
//            $course_student->save();

            unset($course_student);

        }
    }

    public function data_research_budget($academic_year)
    {
        if (!$academic_year) {
            die('No Academic Year Selected');
        }

        Modules::load('accreditation');
        $cs = netezza_odbc_cs();
        $query = "SELECT * from T3_EQMS_RESEARCH";
        $result = odbc_exec($cs, $query);

        $this->db->delete('data_research_budget',array('academic_year' => $academic_year));

        while ($row = odbc_fetch_array($result)) {

            $data_research_budget = array(
                'program_id'=> $row['PROGRAM_ID'],
                'academic_year'=> $row['academic_year'],
                'research_budget_total_amount' => $row['research_budget_total_amount'],
                'research_budget_actual_expenditure' => $row['research_budget_actual_expenditure'],
                'publications_count' => $row['publications_count'],
                'conferece_presentation_count' => $row['conferece_presentation_count'],
                'male_faculty_member_count' => $row['male_faculty_member_count'],
                'female_faculty_member_count' => $row['female_faculty_member_count'],
                ''
            );

            $this->db->insert('data_research_budget', $data_research_budget);

//
//            $data_research_budget = Orm_Data_Research_Budget::get_one(array('program_id' => $row['program_id']));
//            $data_research_budget->set_program_id(Orm_Program::get_one(array('integration_id' => $row['PROGRAM_ID']))->get_id());
//            $data_research_budget->set_academic_year($row['academic_year']);
//            $data_research_budget->set_research_budget_total_amount($row['research_budget_total_amount']);
//            $data_research_budget->set_research_budget_actual_expenditure($row['research_budget_actual_expenditure']);
//            $data_research_budget->set_publications_count($row['publications_count(']);
//            $data_research_budget->set_conferece_presentation_count($row['conferece_presentation_count']);
//            $data_research_budget->set_male_faculty_member_count($row['male_faculty_member_count']);
//            $data_research_budget->set_female_faculty_member_count($row['female_faculty_member_count']);
//            $data_research_budget->save();
            unset($data_research_budget);

        }
    }

    public function data_graduate($from_year ,$to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$academic_year) {
            die('No Academic Year Selected');
        }

        Modules::load('accreditation');
        $cs = netezza_odbc_cs();

        $query = "SELECT * FROM T3_EQMS_GRADUATE WHERE ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        $academic_year = $this->get_academic_year($academic_year);

        $this->db->delete('data_graduate',array('academic_year' => $academic_year));

        while ($row = odbc_fetch_array($result)) {

            $nationality = ($row['NATIONALITY'] == 'Saudi') ? 's' : 'o';
            $gender = $row['GENDER'] - 1;

            $data_graduate = array(
                'program_id'=> $row['PROGRAM_ID'],
                'academic_year'=> $academic_year,
                'gender' => $gender,
                'nationality' => $nationality,
                'major' => $row['MAJOR'],
                'graduate_count' => $row['GRADUATE_COUNT'],
                'enrolled_count' => $row['ENROLLED_COUNT']
            );

            $this->db->insert('data_graduate', $data_graduate);


//            $program = Orm_Program::get_one(array('integration_id' => $row['PROGRAM_ID']));
//            if ($program->get_id()) {
//                $major = Orm_Major::get_one(array('integration_id' => $row['MAJOR']));
//                $data_graduate = new Orm_Data_Graduate();
//
//                $mode = ($data_graduate->get_id() ? 'Modify' : 'Add');
//                $this->count++;
//
//                $data_graduate->set_program_id($program->get_id());
//                $data_graduate->set_academic_year($academic_year);
//                $data_graduate->set_gender($gender);
//                $data_graduate->set_nationality($nationality);
//                $data_graduate->set_major($major->get_id());
//                $data_graduate->set_enrolled_count($row['ENROLLED_COUNT']);
//                $data_graduate->set_graduate_count($row['GRADUATE_COUNT']);
//                $data_graduate->save();
//
//            }

            error_log("{$this->count} - T3_EQMS_GRADUATE : Replace ({$row['PROGRAM_ID']}), Time:" . (time() - $this->time));

            unset($data_graduate);
        }
    }

    public function level_enrolled($from_year ,$to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$academic_year) {
            die('No Academic Year Selected');
        }

        Modules::load('accreditation');
        $cs = netezza_odbc_cs();
        $query = "SELECT * from T3_EQMS_ENROLLED WHERE ACADEMIC_YEAR = '{$academic_year}'";
        $result = odbc_exec($cs, $query);

        $academic_year = $this->get_academic_year($academic_year);

        $this->db->delete('data_level_enrolled',array('academic_year' => $academic_year));

        while ($row = odbc_fetch_array($result)) {

            $nationality = ($row['NATIONALITY'] == 'Saudi') ? 's' : 'o';
            $gender = $row['GENDER'] - 1;

            $data_graduate = array(
                'program_id'=> $row['PROGRAM_ID'],
                'academic_year'=> $academic_year,
                'level' => $row['LEVEL'],
                'gender' => $gender,
                'enrolled_count' => $row['ENROLLED_COUNT'],
                'nationality' => $nationality,
            );

            $this->db->insert('data_level_enrolled', $data_graduate);

//            $program = Orm_Program::get_one(array('integration_id' => $row['PROGRAM_ID']));
//            if ($program->get_id()) {
//                $gender = $row['GENDER'] - 1;
//                $academic_year = $this->get_academic_year($row['ACADEMIC_YEAR']);
//                $nationality = ($row['NATIONALITY'] == 'Saudi') ? 's' : 'o';
//                $level_enrolled = new Orm_Data_Level_Enrolled();
//
//                $mode = ($level_enrolled->get_id() ? 'Modify' : 'Add');
//                $this->count++;
//
//                $level_enrolled->set_program_id($program->get_id());
//                $level_enrolled->set_academic_year($academic_year);
//                $level_enrolled->set_gender($gender);
//                $level_enrolled->set_level($row['LEVEL']);
//                $level_enrolled->set_enrolled_count($row['ENROLLED_COUNT']);
//                $level_enrolled->set_nationality($nationality);
//                $level_enrolled->save();
//
//            }

            error_log("{$this->count} - T3_EQMS_LEVEL_ENROLLED : Insert ({$row['PROGRAM_ID']}), Time:" . (time() - $this->time));
            unset($level_enrolled);
        }
    }


    public function course_student($semester)
    {

        if (!$semester) {
            die('No Semester Selected');
        }

        Modules::load('accreditation');
        $cs = netezza_odbc_cs();

        $query = "SELECT * from T3_EQMS_ACC_COURSE_STUDENT WHERE SEMESTER_ID = {$semester}";

        $result = odbc_exec($cs, $query);

        $this->db->delete('data_course_students',array('semester_id' => $semester));

        while ($row = odbc_fetch_array($result)) {

            $data_course_students = array(
                'program_id'=> $row['PROGRAM_ID'],
                'course_id'=> $row['COURSE_ID'],
                'section_id' => $row['SECTION_ID'],
                'semester_id' => $row['SEMESTER_ID'],
                'student_start_count' => $row['STUDENT_START_COUNT'],
                'student_complete_count' => $row['STUDENT_COMPLETE_COUNT']
            );

            $this->db->insert('data_course_students', $data_course_students);


//            $course_student = new Orm_Data_Course_Students();
//
//            $mode = ($course_student->get_id() ? 'Modify' : 'Add');
//            $this->count++;
//
//            $course_student->set_program_id($row['PROGRAM_ID']);
//            $course_student->set_semester_id($row['SEMESTER_ID']);
//            $course_student->set_course_id($row['COURSE_ID']);
//            $course_student->set_section_id($row['SECTION_ID']);
//            $course_student->set_student_start_count($row['STUDENT_START_COUNT']);
//            $course_student->set_student_complete_count($row['STUDENT_COMPLETE_COUNT']);
//            $course_student->save();

            error_log("{$this->count} - T3_EQMS_ACC_COURSE_STUDENT : Insert ({$row['COURSE_ID']}), Time:" . (time() - $this->time));

            unset($data_course_students);

        }
    }


    public function course_statuses()
    {
        Modules::load('accreditation');
        $cs = netezza_odbc_cs();
        $query = "SELECT DESCRIPTION,STATUS_ID from T3_EQMS_COURSE_STATUS_DESC";
        $result = odbc_exec($cs, $query);
        while ($row = odbc_fetch_array($result)) {

            $data_course_statuses = array(
                'id' => $row['STATUS_ID'],
                'description' => $row['DESCRIPTION'],
                'status_id' => $row['STATUS_ID']
            );

            $this->db->replace('data_course_statuses', $data_course_statuses);

//            $course_statuses = Orm_Data_Course_Statuses::get_one(array('status_id' => $row['STATUS_ID']));
//            $course_statuses->set_status_id($row['STATUS_ID']);
//            $course_statuses->set_description($row['DESCRIPTION']);
//            $course_statuses->save();

            unset($data_course_statuses);

        }
    }

    public function course_status($semester)
    {

        if (!$semester) {
            die('No Semester Selected');
        }

        Modules::load('accreditation');
        $cs = netezza_odbc_cs();

        $query = "SELECT COUNT(*) as num from T3_EQMS_COURSE_STATUS WHERE SEMESTER_ID = {$semester}";

        $result = odbc_exec($cs, $query);

        $row_count = 0;

        while ($row = odbc_fetch_array($result)) {
            $row_count = $row['NUM'];
        }

        if ($row_count > 0) {

            $this->db->delete('data_course_status',array('semester_id' => $semester));

            $limit = ceil($row_count / 200);
            for ($i = 0; $i <= $limit; $i++) {
                $offset = $i * 200;
                $query = "SELECT * from T3_EQMS_COURSE_STATUS WHERE SEMESTER_ID = {$semester} ORDER BY PROGRAM_ID,COURSE_ID,SECTION_ID,STATUS_ID  Limit 200 OFFSET {$offset}";

                $result = odbc_exec($cs, $query);

                while ($row = odbc_fetch_array($result)) {

                    $data_course_status = array(
                        'program_id'=> $row['PROGRAM_ID'],
                        'course_id'=> $row['COURSE_ID'],
                        'section_id' => $row['SECTION_ID'],
                        'semester_id' => $row['SEMESTER_ID'],
                        'status_id' => $row['STATUS_ID'],
                        'student_count' => $row['STUDENT_COUNT']
                    );

                    $this->db->replace('data_course_status', $data_course_status);

                    error_log("{$this->count} - T3_EQMS_COURSE_STATUS : Insert ({$row['COURSE_ID']}), Time:" . (time() - $this->time));

                    unset($data_course_status);

                }
            }
        }
    }

    public function course_grade($semester)
    {

        if (!$semester) {
            die('No Semester Selected');
        }


        Modules::load('accreditation');
        $cs = netezza_odbc_cs();
        $query =
            "
            SELECT SUM(STUDENT_COUNT) STUDENT_COUNT,Substring(GRADE FROM 1 FOR 1) GRADE,COURSE_ID,SEMESTER_ID,SECTION_ID
            FROM DW_UAT.DSUAT.T3_EQMS_COURSE_GRADE
            WHERE GRADE IS NOT NULL AND SEMESTER_ID = {$semester}
            GROUP BY Substring(GRADE FROM 1 FOR 1),COURSE_ID,SEMESTER_ID,SECTION_ID
            ";

        $this->db->delete('data_course_grade',array('semester_id' => $semester));

        $result = odbc_exec($cs, $query);
        while ($row = odbc_fetch_array($result)) {

            $data_course_grade = array(
                'program_id'=> $row['PROGRAM_ID'],
                'course_id'=> $row['COURSE_ID'],
                'section_id' => $row['SECTION_ID'],
                'semester_id' => $row['SEMESTER_ID'],
                'grade' => $row['GRADE'],
                'student_count' => $row['STUDENT_COUNT']
            );

            $this->db->insert('data_course_grade', $data_course_grade);

//            $semester = Orm_Semester::get_one(array('integration_id' => $row['SEMESTER_ID']))->get_id();
//            $course = Orm_Course::get_one(array('integration_id' => $row['COURSE_ID']))->get_id();
//            $section = Orm_Course_Section::get_one(array('integration_id' => $row['SECTION_ID']))->get_id();
//            $course_grade = Orm_Data_Course_Grade::get_one(array('course_id' => $course, 'section_id' => $section, 'semester_id' => $semester));
//
//            $mode = ($course_grade->get_id() ? 'Modify' : 'Add');
//            $this->count++;
//
//            $course_grade->set_program_id(0);
//            $course_grade->set_semester_id($semester);
//            $course_grade->set_course_id($course);
//            $course_grade->set_section_id($section);
//            $course_grade->set_grade($row['GRADE']);
//            $course_grade->set_student_count($row['STUDENT_COUNT']);
//            $course_grade->save();

            error_log("{$this->count} - T3_EQMS_COURSE_GRADE : Insert ({$row['COURSE_ID']} . '-' . {$row['SECTION_ID']}) Time:" . (time() - $this->time));
            unset($course_grade);

        }
    }


    public function course_pre()
    {
        die();
//        $cs = netezza_odbc_cs();
//        $query = "SELECT * FROM T3_EQMS_PRE_COURSE WHERE PRE_COURSE_ID IS NOT NULL";
//
//        $result = odbc_exec($cs, $query);
//
//        while ($row = odbc_fetch_array($result)) {
//
//            $data_course_grade = array(
//                'id' => $row['COURSE_ID'].$row['PRE_COURSE_ID'],
//                'program_id'=> $row['PROGRAM_ID'],
//                'course_id'=> $row['COURSE_ID'],
//                'pre_course_id' => $row['PRE_COURSE_ID']
//            );
//
//            $this->db->replace('data_course_grade', $data_course_grade);
//
//            $program = Orm_Program::get_one(array('integration_id' => $row['PROGRAM_ID']));
//            $course = Orm_Course::get_one(array('integration_id' => $row['COURSE_ID']));
//            $pre_course = Orm_Course::get_one(array('integration_id' => $row['PRE_COURSE_ID']));
//            $course_pre = Orm_Data_Course_Pre::get_one(array('program_id' => $program->get_id(), 'course_id' => $course->get_id(), 'pre_course_id' => $pre_course->get_id()));
//
//            $mode = ($course_pre->get_id() ? 'Modify' : 'Add');
//            $this->count++;
//
//            $course_pre->set_program_id(Orm_Program::get_one(array('integration_id' => $row['PROGRAM_ID']))->get_id());
//            $course_pre->set_course_id(Orm_Course::get_one(array('integration_id' => $row['COURSE_ID']))->get_id());
//            $course_pre->set_pre_course_id(Orm_Course::get_one(array('integration_id' => $row['PRE_COURSE_ID']))->get_id());
//
//            $course_pre->save();
//
//            error_log("{$this->count} - T3_EQMS_PRE_COURSE : Replace ({$row['COURSE_ID']} . '-' . {$row['PRE_COURSE_ID']}) Time:" . (time() - $this->time));
//            unset($course_pre);
//
//        }
    }

    public function cohort()
    {
        Modules::load('accreditation');
        $cs = netezza_odbc_cs();
        $query = "SELECT * from T0_MAZEN_COHORT";
        $result = odbc_exec($cs, $query);
        while ($row = odbc_fetch_array($result)) {

            $program = Orm_Program::get_one(array('integration_id' => $row['PROGRAM_ID']));
            if ($program->get_id()) {
                $report_year = $this->get_academic_year($row['REPORT_YEAR']);
                $start_year = $this->get_academic_year($row['START_YEAR']);

                $cohort = Orm_Data_Cohort_Table::get_one(array('program_id' => $program->get_id(),'report_year' => $report_year,'start_year' => $start_year,'level_year' => $row['LEVEL_YEAR']));

                $mode = ($cohort->get_id() ? 'Modify' : 'Add');
                $this->count++;

                $cohort->set_program_id($program->get_id());
                $cohort->set_report_year($report_year);
                $cohort->set_start_year($start_year);
                $cohort->set_level_year($row['LEVEL_YEAR']);
                $cohort->set_cohort_enroll($row['COHORT_ENROLL']);
                $cohort->set_retain_till_year($row['RETAIN_TILL_YEAR']);
                $cohort->set_withdrawn_enrolled($row['WITHDRAWN_ENROLLED']);
                $cohort->set_withdrawn_good($row['WITHDRAWN_GOOD']);
                $cohort->set_graduated($row['GRADUATED']);

                $cohort->save();
                error_log("{$this->count} - COHORT : {$mode} ({$program->get_name('english')} Time:" . (time() - $this->time));
                unset($cohort);
            }
        }
    }

    public function cohort_students()
    {
        Modules::load('accreditation');
        $cs = netezza_odbc_cs();
        $query = "SELECT * from T0_COHORT_EQMS_STUD";
        $result = odbc_exec($cs, $query);
        while ($row = odbc_fetch_array($result)) {

            $program = Orm_Program::get_one(array('integration_id' => $row['PROGRAM_ID']));
            if ($program->get_id()) {
                $report_year = $this->get_academic_year($row['ACADEMIC_YEAR']);
                $start_year = $this->get_academic_year($row['START_ACADEMIC_YEAR']);

                $cohort = new Orm_Data_Cohort_Std();

                $this->count++;

                $cohort->set_program_id($program->get_id());
                $cohort->set_academic_year($report_year);
                $cohort->set_start_year($start_year);
                $cohort->set_level($row['LEVEL']);
                $cohort->set_enrolled($row['ENROLLED']);
                $cohort->set_completion_status($row['COMPLETION_STATUS']);
                $cohort->set_withdrawn_enrolled($row['WITHDRAWN_ENROLLED']);
                $cohort->set_withdrawn_good($row['WITHDRAWN_GOOD']);
                $cohort->set_graduated($row['GRADUATED']);
                $cohort->save();

                echo ('.');
                unset($cohort);
            }
            unset($row);
        }
    }

    public function institution()
    {
        $cs = netezza_odbc_cs();
        $query = "SELECT * from T3_EQMS_INSTITUTION_INFO";
        $result = odbc_exec($cs, $query);
        while ($row = odbc_fetch_array($result)) {
            $institution = Orm_Data_Institution::get_instance(1);
            $institution->set_id(1);
            $institution->set_academic_year($row['ACADEMIC_YEAR']);
            $institution->set_full_name($row['FULL_NAME']);
            $institution->set_address($row['ADDRESS']);
            $institution->set_telephone($row['TELEPHONE']);
            $institution->set_email($row['EMAIL']);
            $institution->set_position($row['POSITION']);
            $institution->save();
            unset($institution);

        }
    }

    public function periodic_program($from_year ,$to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$academic_year) {
            die('No Academic Year Selected');
        }

        Modules::load('accreditation');
        $cs = netezza_odbc_cs();
        $query = "SELECT * from T3_EQMS_PERIODIC_PROGRAM WHERE ACADEMIC_YEAR = '{$academic_year}'";
        $result = odbc_exec($cs, $query);

        $academic_year = $this->get_academic_year($academic_year);

        $this->db->delete('data_periodic_program',array('academic_year' => $academic_year));

        while ($row = odbc_fetch_array($result)) {

            $gender = $row['GENDER'] - 1;
            $nationality = ($row['NATIONALITY'] == 'Saudi') ? 's' : 'o';

            $data_periodic_program = array(
                'program_id'=> $row['PROGRAM_ID'],
                'academic_year'=> $academic_year,
                'gender' => $gender,
                'nationality' => $nationality,
                'phd_holder_count' => $row['PHD_HOLDER_COUNT'],
                'teaching_staff_count' => $row['TEACHING_STAFF_COUNT'],
            );

            $this->db->insert('data_periodic_program', $data_periodic_program);


//            $periodic_program = new Orm_Data_Periodic_Program();
//
//            $mode = ($periodic_program->get_id() ? 'Modify' : 'Add');
//            $this->count++;
//
//            $periodic_program->set_program_id($row['PROGRAM_ID']);
//            $periodic_program->set_academic_year($this->get_academic_year($row['ACADEMIC_YEAR']));
//            $periodic_program->set_gender($gender);
//            $periodic_program->set_nationality($nationality);
//            $periodic_program->set_phd_holder_count($row['PHD_HOLDER_COUNT']);
//            $periodic_program->set_teaching_staff_count($row['TEACHING_STAFF_COUNT']);
//            $periodic_program->save();

            error_log("{$this->count} - T3_EQMS_PERIODIC_PROGRAM : Insert ({$row['PROGRAM_ID']} Time:" . (time() - $this->time));

            unset($data_periodic_program);
        }
    }

    public function periodic_program_ext()
    {
        die();
//        if (!$academic_year) {
//            die('No Academic Year Selected');
//        }
//
//        Modules::load('accreditation');
//        $cs = netezza_odbc_cs();
//        $query = "SELECT * from T3_EQMS_PERIODIC_PROGRAM_EXT WHERE academic_year = {$academic_year}";
//        $result = odbc_exec($cs, $query);
//
//        $this->db->delete('data_periodic_program_ext', array('academic_year' => $academic_year));
//
//        while ($row = odbc_fetch_array($result)) {
//            $gender = $row['GENDER'] - 1;
//
//            $data_periodic_program_ext = array(
//                'program_id'=> $row['PROGRAM_ID'],
//                'gender' => $gender,
//                'academic_year'=> $academic_year,
//                'work_load' => $row['WORK_LOAD'],
//                'class_size' => $row['CLASS_SIZE'],
//            );
//
//            $this->db->insert('data_periodic_program_ext', $data_periodic_program_ext);
//

//            $program = Orm_Program::get_one(array('integration_id' => $row['PROGRAM_ID']));
//            if ($program->get_id()) {
//
//
//                $periodic_program = new Orm_Data_Periodic_Program_Ext();
//
//                $mode = ($periodic_program->get_id() ? 'Modify' : 'Add');
//                $this->count++;
//
//                $periodic_program->set_program_id($program->get_id());
//                $periodic_program->set_academic_year($row['ACADEMIC_YEAR']);
//                $periodic_program->set_gender($gender);
//                $periodic_program->set_work_load($row['WORK_LOAD']);
//                $periodic_program->set_class_size($row['CLASS_SIZE']);
//                $periodic_program->save();
//
//            }
//
//            error_log("{$this->count} - T3_EQMS_PERIODIC_PROGRAM_EXT : Insert ({$row['PROGRAM_ID']} Time:" . (time() - $this->time));
//
//            unset($data_periodic_program_ext);
//
//        }
    }

    public function preparatory_year($from_year ,$to_year)
    {

        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$academic_year) {
            die('No Academic Year Selected');
        }

        Modules::load('accreditation');
        $cs = netezza_odbc_cs();

        $query = "SELECT * FROM T3_EQMS_PREP WHERE ACADEMIC_YEAR = '{$academic_year}'";
        $result = odbc_exec($cs, $query);

        $academic_year = $this->get_academic_year($academic_year);

        $this->db->delete('data_preparatory_year',array('academic_year' => $academic_year));

        while ($row = odbc_fetch_array($result)) {
            $nationality = ($row['NATIONALITY'] == 'Saudi') ? 's' : 'o';

            $gender = $row['GENDER'] - 1;

            $data_periodic_program_ext = array(
                'stream'=> $row['TRACK'],
                'academic_year'=> $academic_year,
                'gender' => $gender,
                'nationality' => $nationality,
                'student_count' => $row['STUDENT_COUNT'],
                'teaching_staff_count' => $row['TEACHING_STAFF_COUNT'],
                'completion_count' => $row['STUDENT_COMPLETION_COUNT'],
            );

            $this->db->insert('data_preparatory_year', $data_periodic_program_ext);


//            $preparatory_year = new Orm_Data_Preparatory_Year();
//            $preparatory_year->set_academic_year($this->get_academic_year($row['ACADEMIC_YEAR']));
//            $preparatory_year->set_stream($row['TRACK']);
//            $preparatory_year->set_gender($gender);
//            $preparatory_year->set_nationality($nationality);
//            $preparatory_year->set_teaching_staff_count($row['TEACHING_STAFF_COUNT']);
//            $preparatory_year->set_student_count($row['STUDENT_COUNT']);
//            $preparatory_year->set_completion_count($row['STUDENT_COMPLETION_COUNT']);
//            $preparatory_year->save();

            error_log("{$this->count} - T3_EQMS_PREP : ADD ({$row['TRACK']} Time:" . (time() - $this->time));
            unset($preparatory_year);
        }
    }

    public function completion_rate($from_year ,$to_year)
    {

        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$academic_year) {
            die('No Academic Year Selected');
        }

        Modules::load('accreditation');
        $cs = netezza_odbc_cs();
        $query = "SELECT * from T3_EQMS_COMPLETION_RATE WHERE ACADEMIC_YEAR = '{$academic_year}'";
        $result = odbc_exec($cs, $query);

        $academic_year = $this->get_academic_year($academic_year);

        $this->db->delete('data_competion_rate',array('academic_year' => $academic_year));

        while ($row = odbc_fetch_array($result)) {

            $gender = $row['GENDER'] - 1;

            $data_competion_rate = array(
                'program_id'=> $row['PROGRAM_ID'],
                'academic_year'=> $academic_year,
                'gender' => $gender,
                'number_of_years' => $row['NUMBER_OF_YEARS'],
                'graduate_count' => $row['GRADUATE_COUNT']
            );

            $this->db->insert('data_competion_rate', $data_competion_rate);


//            $completion_rate = new Orm_Data_Competion_Rate();
//
//            $mode = ($completion_rate->get_id() ? 'Modify' : 'Add');
//            $this->count++;
//
//            $completion_rate->set_program_id($row['PROGRAM_ID']);
//            $completion_rate->set_academic_year($academic_year);
//            $completion_rate->set_gender($gender);
//            $completion_rate->set_number_of_years($row['NUMBER_OF_YEARS']);
//            $completion_rate->set_graduate_count($row['GRADUATE_COUNT']);
//            $completion_rate->save();

            error_log("{$this->count} - T3_EQMS_COMPLETION_RATE : Insert ({$row['PROGRAM_ID']} Time:" . (time() - $this->time));

            unset($data_competion_rate);
        }
    }

    public function faculty_count($from_year ,$to_year)
    {

        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$academic_year) {
            die('No Academic Year Selected');
        }

        Modules::load('accreditation');
        $cs = netezza_odbc_cs();
        $query = "SELECT * from T3_EQMS_FACULTY_COUNT WHERE ACADEMIC_YEAR = '{$academic_year}'";
        $result = odbc_exec($cs, $query);

        $academic_year = $this->get_academic_year($academic_year);

        $this->db->delete('data_faculty',array('academic_year' => $academic_year));

        while ($row = odbc_fetch_array($result)) {

            $data_faculty = array(
                'program_id'=> $row['PROGRAM_ID'],
                'academic_year'=> $academic_year,
                'teaching_assistant_male' => $row['TEACHING_ASSISTANT_MALE'],
                'teaching_assistant_female' => $row['TEACHING_ASSISTANT_FEMALE'],
                'instructor_male' => $row['INSTRUCTOR_MALE'],
                'instructor_female' => $row['INSTRUCTOR_FEMALE'],
                'assistant_prof_male' => $row['ASSISTANT_PROFESSOR_MALE'],
                'assistant_prof_female' => $row['ASSISTANT_PROFESSOR_FEMALE'],
                'associate_prof_male' => $row['ASSOCIATE_PROFESSOR_MALE'],
                'associate_prof_female' => $row['ASSOCIATE_PROFESSOR_FEMALE'],
                'prof_male' => $row['PROFESSOR_MALE'],
                'prof_female' => $row['PROFESSOR_FEMALE'],
            );

            $this->db->insert('data_faculty', $data_faculty);


            error_log("{$this->count} - T3_EQMS_FACULTY_COUNT : Insert ({$row['PROGRAM_ID']} Time:" . (time() - $this->time));

            unset($data_faculty);
        }
    }

    public function workload($from_year ,$to_year)
    {

        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$academic_year) {
            die('No Academic Year Selected');
        }

        Modules::load('accreditation');
        $cs = netezza_odbc_cs();
        $query = "SELECT * from T3_EQMS_CLASS_SIZE WHERE ACADEMIC_YEAR = '{$academic_year}'";
        $result = odbc_exec($cs, $query);

        $academic_year = $this->get_academic_year($academic_year);

        $this->db->delete('data_workload',array('academic_year' => $academic_year));

        while ($row = odbc_fetch_array($result)) {

            $gender = $row['GENDER'] - 1;

            $data_workload = array(
                'program_id'=> $row['PROGRAM_ID'],
                'gender'=> $gender,
                'academic_year'=> $academic_year,
                'semester' => $row['SEMESTER'],
                'work_load' => $row['WORK_LOAD'],
                'class_size' => $row['CLASS_SIZE']
            );

            $this->db->insert('data_workload', $data_workload);


            error_log("{$this->count} - T3_EQMS_CLASS_SIZE : Insert ({$row['PROGRAM_ID']} Time:" . (time() - $this->time));

            unset($data_workload);
        }
    }

    public function get_academic_year($academic_year)
    {
        $semester = Orm_Semester::get_one(array('name_like' => $academic_year));
        return $semester->get_year();
    }

    public function compute_qualitative_kpi($semester_id)
    {
        $this->load_modules();
        $year = Orm_Semester::get_one(array('id' => $semester_id))->get_year();

        foreach (Orm_Survey::$survey_types as $level_id => $type) {
            if ($level_id != Orm_Survey::TYPE_STUDENTS) {
                $colleges = Orm_College::get_all();
                foreach ($colleges as $college) {
                    $programs = Orm_Program::get_all(array('college_id' => $college->get_id()));
                    foreach ($programs as $program) {
                        $scores = Orm_Kpi_Survey::get_model()->get_scores($level_id, $semester_id, $college->get_id(), $program->get_id());

                        foreach ($scores as $score) {
                            $kpi = Orm_Kpi::get_instance($score['kpi_id']);
                            if ($kpi->get_college_id() == 0 || $kpi->get_college_id() == $college->get_id()) {
                                $level = Orm_Kpi_Level::get_one(array('kpi_id' => $kpi->get_id(), 'level' => $type));
                                $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => Orm_Survey_Question_Factor::get_instance($score['id'])->get_report_title()));
                                $details = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(), 'academic_year' => $year));
                                if (!$details->get_id()) {
                                    $details->set_semester_id($semester_id);
                                    $details->set_legend_id($legend->get_id());
                                    $details->save();
                                }
                                $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $details->get_id(), 'program_id' => $program->get_id()));
                                if (!$program_value->get_id()) {
                                    $program_value->set_program_id($program->get_id());
                                    $program_value->set_detail_id($details->get_id());
                                }
                                $program_value->set_actual_benchmark(empty($score['score']) ? 0 : $score['score']);
                                $program_value->save();
                            }
                        }
                    }
                    $scores = Orm_Kpi_Survey::get_model()->get_scores($level_id, $semester_id, $college->get_id());

                    foreach ($scores as $score) {
                        $kpi = Orm_Kpi::get_instance($score['kpi_id']);
                        if ($kpi->get_college_id() == 0 || $kpi->get_college_id() == $college->get_id()) {
                            $level = Orm_Kpi_Level::get_one(array('kpi_id' => $kpi->get_id(), 'level' => $type));
                            $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => Orm_Survey_Question_Factor::get_instance($score['id'])->get_report_title()));
                            $details = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(), 'academic_year' => $year));
                            if (!$details->get_id()) {
                                $details->set_semester_id($semester_id);
                                $details->set_legend_id($legend->get_id());
                                $details->save();
                            }
                            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $details->get_id(), 'college_id' => $college->get_id()));
                            if (!$college_value->get_id()) {
                                $college_value->set_college_id($college->get_id());
                                $college_value->set_detail_id($details->get_id());
                            }
                            $college_value->set_actual_benchmark(empty($score['score']) ? 0 : $score['score']);
                            $college_value->save();
                        }
                    }
                }

                $scores = Orm_Kpi_Survey::get_model()->get_scores($level_id, $semester_id);
                foreach ($scores as $score) {
                    $kpi = Orm_Kpi::get_instance($score['kpi_id']);
                    if ($kpi->get_college_id() == 0) {
                        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $kpi->get_id(), 'level' => $type));
                        $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => Orm_Survey_Question_Factor::get_instance($score['id'])->get_report_title()));
                        $details = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(), 'academic_year' => $year));
                        if (!$details->get_id()) {
                            $details->set_semester_id($semester_id);
                            $details->set_legend_id($legend->get_id());
                            $details->save();
                        }
                        $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $details->get_id()));
                        if (!$institution_value->get_id()) {
                            $institution_value->set_detail_id($details->get_id());
                        }
                        $institution_value->set_actual_benchmark(empty($score['score']) ? 0 : $score['score']);
                        $institution_value->save();
                    }
                }
            }
        }
    }


    public function compute_student_qualitative_kpi($semester_id)
    {
        $this->load_modules();
        $year = Orm_Semester::get_one(array('id' => $semester_id))->get_year();

        foreach (Orm_Survey::$survey_types as $level_id => $type) {
            if ($level_id == Orm_Survey::TYPE_STUDENTS) {
                $colleges = Orm_College::get_all();
                foreach ($colleges as $college) {
                    $programs = Orm_Program::get_all(array('college_id' => $college->get_id()));
                    foreach ($programs as $program) {

                        $courses_ids = array_column(Orm_Program_Plan::get_model()->get_all(array('program_id' => $program->get_id()), 0, 0, array(), Orm::FETCH_ARRAY),'course_id');

                        $course_evaluations = array_column(Orm_Edugate_Survey_Evaluation::get_model()->get_all(array('semester' => $semester_id, 'survey_id' => 1,'course_in' => $courses_ids), 0, 0, array(), Orm::FETCH_ARRAY),'evaluation_serial');

                        $program_majors = array_column(Orm_Major::get_model()->get_all(array('program_id' => $program->get_id()),0,0,array(),Orm::FETCH_ARRAY),'integration_id');
                        $program_evaluations = array_column(Orm_Edugate_Survey_Evaluation::get_model()->get_all(array('survey_in' => array(50,51),'course_in' => $program_majors), 0, 0, array(), Orm::FETCH_ARRAY),'evaluation_serial');
                        if (!empty($course_evaluations) || !empty($program_evaluations)) {
                            $scores = Orm_Kpi_Survey::get_model()->get_student_score($semester_id,$program_evaluations,$course_evaluations);

                            foreach ($scores as $score) {
                                $kpi = Orm_Kpi::get_instance($score['kpi_id']);
                                if ($kpi->get_college_id() == 0 || $kpi->get_college_id() == $college->get_id()) {
                                    $level = Orm_Kpi_Level::get_one(array('kpi_id' => $kpi->get_id(), 'level' => $type));
                                    $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => Orm_Survey_Question_Factor::get_instance($score['id'])->get_report_title()));
                                    if ($kpi->get_is_semester()) {
                                        $details = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(), 'semester_id' => $semester_id));
                                    } else {
                                        $details = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(), 'academic_year' => $year));
                                    }
                                    if (!$details->get_id()) {
                                        $details->set_semester_id($semester_id);
                                        $details->set_legend_id($legend->get_id());
                                        $details->save();
                                    }
                                    $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $details->get_id(), 'program_id' => $program->get_id()));
                                    if (!$program_value->get_id()) {
                                        $program_value->set_program_id($program->get_id());
                                        $program_value->set_detail_id($details->get_id());
                                    }
                                    $program_value->set_actual_benchmark(empty($score['score']) ? 0 : $score['score']);
                                    $program_value->save();
                                    error_log('Program:' . $program->get_name_en() . ' ' . $legend->get_title() . ': ' . $score['score']);
                                }
                            }
                        }
                    }

                    $courses_ids = array_column(Orm_Program_Plan::get_model()->get_all(array('college_id' => $college->get_id()),0,0,array(),Orm::FETCH_ARRAY),'course_id');
                    $course_evaluations = array_column(Orm_Edugate_Survey_Evaluation::get_model()->get_all(array('semester' => $semester_id, 'survey_id' => 1, 'course_in' => $courses_ids), 0, 0, array(), Orm::FETCH_ARRAY),'evaluation_serial');

                    $college_majors = array_column(Orm_Major::get_model()->get_all(array('college_id' => $college->get_id()),0,0,array(),Orm::FETCH_ARRAY),'integration_id');
                    $program_evaluations = array_column(Orm_Edugate_Survey_Evaluation::get_model()->get_all(array('survey_in' => array(50,51),'course_in' => $college_majors), 0, 0, array(), Orm::FETCH_ARRAY),'evaluation_serial');

                    if (!empty($course_evaluations) || !empty($program_evaluations)) {
                        $scores = Orm_Kpi_Survey::get_model()->get_student_score($semester_id,$program_evaluations,$course_evaluations);
                        foreach ($scores as $score) {
                            $kpi = Orm_Kpi::get_instance($score['kpi_id']);
                            if ($kpi->get_college_id() == 0 || $kpi->get_college_id() == $college->get_id()) {
                                $level = Orm_Kpi_Level::get_one(array('kpi_id' => $kpi->get_id(), 'level' => $type));
                                $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => Orm_Survey_Question_Factor::get_instance($score['id'])->get_report_title()));
                                if ($kpi->get_is_semester()) {
                                    $details = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(), 'semester_id' => $semester_id));
                                } else {
                                    $details = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(), 'academic_year' => $year));
                                }
                                if (!$details->get_id()) {
                                    $details->set_semester_id($semester_id);
                                    $details->set_legend_id($legend->get_id());
                                    $details->save();
                                }
                                $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $details->get_id(), 'college_id' => $college->get_id()));
                                if (!$college_value->get_id()) {
                                    $college_value->set_college_id($college->get_id());
                                    $college_value->set_detail_id($details->get_id());
                                }
                                $college_value->set_actual_benchmark(empty($score['score']) ? 0 : $score['score']);
                                $college_value->save();
                                error_log('College:' . $college->get_name_en() . ' ' . $legend->get_title() . ': ' . $score['score']);
                            }
                        }
                    }
                }

                $scores = Orm_Kpi_Survey::get_model()->get_student_score($semester_id);

                foreach ($scores as $score) {
                    $kpi = Orm_Kpi::get_instance($score['kpi_id']);
                    if ($kpi->get_college_id() == 0) {
                        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $kpi->get_id(), 'level' => $type));
                        $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => Orm_Survey_Question_Factor::get_instance($score['id'])->get_report_title()));
                        if ($kpi->get_is_semester()) {
                            $details = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(), 'semester_id' => $semester_id));
                        } else {
                            $details = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(), 'academic_year' => $year));
                        }
                        if (!$details->get_id()) {
                            $details->set_semester_id($semester_id);
                            $details->set_legend_id($legend->get_id());
                            $details->save();
                        }
                        $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $details->get_id()));
                        if (!$institution_value->get_id()) {
                            $institution_value->set_detail_id($details->get_id());
                        }
                        $institution_value->set_actual_benchmark(empty($score['score']) ? 0 : $score['score']);
                        $institution_value->save();
                        error_log('Institution '. $legend->get_title() . ': ' . $score['score']);
                    }
                }
            }
        }
    }

    public function get_single_value_internal_program($semester) {

        $this->load_modules();

        $semester_obj = Orm_Semester::get_instance($semester);
        foreach (Orm_Kpi::get_all(array('college_id'=>0)) as $kpi) {

            if ($kpi->get_code() == '4.12.8') continue;
            foreach (Orm_Kpi_Legend::get_all(array('kpi_id' => $kpi->get_id())) as $legend) {
                foreach (Orm_College::get_all() as $college) {
                    $program_ids = array_column(Orm_Program::get_model()->get_all(array('college_id' => $college->get_id()),0,0,array(),Orm::FETCH_ARRAY),'id');
                    if ($kpi->get_is_semester()) {
                        $filters_college = array('legend_id' => $legend->get_id(), 'semester_id'=>$semester_obj->get_id(),'kpi_id' => $kpi->get_id(),'actual_benchmark_greater' => '0.00');
                        $filters_program = array('program_in' => $program_ids,'legend_id' => $legend->get_id(), 'semester_id'=>$semester_obj->get_id(),'kpi_id' => $kpi->get_id(),'actual_benchmark_greater' => '0.00');
                    } else {
                        $filters_college = array('legend_id' => $legend->get_id(), 'academic_year'=>$semester_obj->get_year(),'kpi_id' => $kpi->get_id(),'actual_benchmark_greater' => '0.00');
                        $filters_program = array('program_in' => $program_ids,'legend_id' => $legend->get_id(), 'academic_year'=>$semester_obj->get_year(),'kpi_id' => $kpi->get_id(),'actual_benchmark_greater' => '0.00');
                    }
                    $college_values = Orm_Kpi_Program_Value::get_model()->get_all($filters_program,0,0,array(),Orm::FETCH_ARRAY);
                    $institution_values = Orm_Kpi_Program_Value::get_model()->get_all($filters_college,0,0,array(),Orm::FETCH_ARRAY);
                    $target_values = Orm_Kpi_Program_Value::get_model()->get_all($filters_college,0,0,array(),Orm::FETCH_ARRAY);
                    echo "\n";
                    usort($institution_values,
                        function($a,$b)
                        {
                            if ($a['actual_benchmark'] == $b['actual_benchmark']) return 0;
                            return ($a['actual_benchmark'] < $b['actual_benchmark']) ? -1 : 1;
                        });
                    print_r($institution_values);
                    usort($college_values,
                        function($a,$b)
                        {
                            if ($a['actual_benchmark'] == $b['actual_benchmark']) return 0;
                            return ($a['actual_benchmark'] < $b['actual_benchmark']) ? -1 : 1;
                        });
                    print_r($college_values);
                    usort($target_values,
                        function($a,$b)
                        {
                            if ($a['actual_benchmark'] == $b['actual_benchmark']) return 0;
                            return ($a['actual_benchmark'] < $b['actual_benchmark']) ? -1 : 1;
                        });

                    $median_institution = $this->array_median($institution_values);
                    $median_college = $this->array_median($college_values);
                    if (!empty($target_values)) {
                        if (in_array($kpi->get_id(),array(57,63,32))) {
                            reset($target_values);
                            $college_greatest = current($target_values);
                        }else{
                            $college_greatest = end($target_values);
                        }

                        print_r($college_greatest);
                    } else {
                        $college_greatest = null;
                    }
                    foreach (Orm_Program::get_all(array('college_id' => $college->get_id())) as $program) {
                        $institution = Orm_Kpi_Program_Value::get_one(array('program_id' => $program->get_id(),'legend_id' => $legend->get_id(), 'academic_year'=>$semester_obj->get_year(),'kpi_id' => $kpi->get_id()));
                        if ($institution->get_id()) {
                            $institution->set_target_benchmark(isset($college_greatest['actual_benchmark']) ? $college_greatest['actual_benchmark'] : 0.00);
                            $institution->set_internal_college_benchmark($median_college['actual_benchmark']);
                            $institution->set_internal_institution_benchmark($median_institution['actual_benchmark']);
                            $institution->save();
                        }
                    }
                }
            }
            error_log('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>');
            error_log('KPI' . $kpi->get_code() . ' has been done');
            error_log('<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
        }
    }

    public function get_single_value_internal_college($semester) {
        $this->load_modules();

        $semester_obj = Orm_Semester::get_instance($semester);
        foreach (Orm_Kpi::get_all(array('college_id'=>0)) as $kpi) {

            if ($kpi->get_code() == '4.12.8') continue;
            foreach (Orm_Kpi_Legend::get_all(array('kpi_id' => $kpi->get_id())) as $legend) {
                echo "\n";
                echo '=========================== '.$legend->get_title().' ===========================';
                echo "\n";
                foreach (Orm_College::get_all() as $college) {
                    $program_ids = array_column(Orm_Program::get_model()->get_all(array('college_id' => $college->get_id()),0,0,array(),Orm::FETCH_ARRAY),'id');
                    if ($kpi->get_is_semester()) {
                        $filters_college = array('legend_id' => $legend->get_id(), 'semester_id'=>$semester_obj->get_id(),'kpi_id' => $kpi->get_id(),'actual_benchmark_greater' => '0.00');
                        $filters_program = array('program_in' => $program_ids,'legend_id' => $legend->get_id(), 'semester_id'=>$semester_obj->get_id(),'kpi_id' => $kpi->get_id(),'actual_benchmark_greater' => '0.00');
                    } else {
                        $filters_college = array('legend_id' => $legend->get_id(), 'academic_year'=>$semester_obj->get_year(),'kpi_id' => $kpi->get_id(),'actual_benchmark_greater' => '0.00');
                        $filters_program = array('program_in' => $program_ids,'legend_id' => $legend->get_id(), 'academic_year'=>$semester_obj->get_year(),'kpi_id' => $kpi->get_id(),'actual_benchmark_greater' => '0.00');
                    }
                    $institution_values = Orm_Kpi_College_Value::get_model()->get_all($filters_college,0,0,array(),Orm::FETCH_ARRAY);
                    $college_values = Orm_Kpi_Program_Value::get_model()->get_all($filters_program,0,0,array(),Orm::FETCH_ARRAY);
                    echo '<pre>';
                    usort($institution_values,
                        function($a,$b)
                        {
                            if ($a['actual_benchmark'] == $b['actual_benchmark']) return 0;
                            return ($a['actual_benchmark'] < $b['actual_benchmark']) ? -1 : 1;
                        });
                    print_r($institution_values);
                    usort($college_values,
                        function($a,$b)
                        {
                            if ($a['actual_benchmark'] == $b['actual_benchmark']) return 0;
                            return ($a['actual_benchmark'] < $b['actual_benchmark']) ? -1 : 1;
                        });
                    print_r($college_values);
                    echo "\n";
                    echo '=========================== SORTED ===========================';
                    echo "\n";
                    print_r($institution_values);
                    print_r($college_values);
                    echo "\n";
                    echo '=========================== Median ===========================';
                    echo "\n";
                    $median_institution = $this->array_median($institution_values);
                    $median_college = $this->array_median($college_values);
                    print_r($median_institution);
                    print_r($median_college);
                    echo "\n";
                    echo '=========================== Greatest ===========================';
                    echo "\n";
                    if (!empty($college_values)) {
                        if (in_array($kpi->get_id(),array(57,63,32))) {
                            reset($college_values);
                            $college_greatest = current($college_values);
                        }else{
                            $college_greatest = end($college_values);
                        }
                        print_r($college_greatest);
                    } else {
                        $college_greatest = null;
                    }
                    $institution = Orm_Kpi_College_Value::get_one(array('college_id' => $college->get_id(),'legend_id' => $legend->get_id(), 'academic_year'=>$semester_obj->get_year(),'kpi_id' => $kpi->get_id()));
                    if ($institution->get_id()) {
                        $institution->set_target_benchmark(isset($college_greatest['actual_benchmark']) ? $college_greatest['actual_benchmark'] : 0.00);
                        $institution->set_internal_college_benchmark($median_college['actual_benchmark']);
                        $institution->set_internal_institution_benchmark($median_institution['actual_benchmark']);
                        $institution->save();
                    }
                }
            }
        }
    }

    public function get_single_value_internal_institution($semester) {
        $this->load_modules();
        $semester_obj = Orm_Semester::get_instance($semester);
        foreach (Orm_Kpi::get_all(array('college_id'=>0)) as $kpi) {
            if ($kpi->get_code() == '4.12.8') continue;
            foreach (Orm_Kpi_Legend::get_all(array('kpi_id' => $kpi->get_id())) as $legend) {
                if ($kpi->get_is_semester()) {
                    $filters = array('legend_id' => $legend->get_id(), 'semester_id'=>$semester_obj->get_id(),'kpi_id' => $kpi->get_id(),'actual_benchmark_greater' => '0.00');
                } else {
                    $filters = array('legend_id' => $legend->get_id(), 'academic_year'=>$semester_obj->get_year(),'kpi_id' => $kpi->get_id(),'actual_benchmark_greater' => '0.00');
                }
                $college_values = Orm_Kpi_College_Value::get_model()->get_all($filters,0,0,array(),Orm::FETCH_ARRAY);
                $program_values = Orm_Kpi_Program_Value::get_model()->get_all($filters,0,0,array(),Orm::FETCH_ARRAY);

                usort($college_values,
                    function($a,$b)
                    {
                        if ($a['actual_benchmark'] == $b['actual_benchmark']) return 0;
                        return ($a['actual_benchmark'] < $b['actual_benchmark']) ? -1 : 1;
                    });
                print_r($college_values);
                usort($program_values,
                    function($a,$b)
                    {
                        if ($a['actual_benchmark'] == $b['actual_benchmark']) return 0;
                        return ($a['actual_benchmark'] < $b['actual_benchmark']) ? -1 : 1;
                    });

                $median_college = $this->array_median($college_values);
                $median_program = $this->array_median($program_values);

                if (!empty($program_values)) {
                    if (in_array($kpi->get_id(),array(57,63,32))) {
                        reset($program_values);
                        $college_greatest = current($program_values);
                    }else{
                        $college_greatest = end($program_values);
                    }
                } else {
                    $college_greatest = null;
                }
                $institution = Orm_Kpi_Institution_Value::get_one(array('legend_id' => $legend->get_id(), 'academic_year'=>$semester_obj->get_year(),'kpi_id' => $kpi->get_id()));
                if ($institution->get_id()) {
                    $institution->set_target_benchmark(isset($college_greatest['actual_benchmark']) ? $college_greatest['actual_benchmark'] : 0.00);
                    $institution->set_internal_college_benchmark(isset($median_college['actual_benchmark']) ? $median_college['actual_benchmark'] : 0.00);
                    $institution->set_internal_institution_benchmark(isset($median_program['actual_benchmark']) ? $median_program['actual_benchmark'] : 0.00);
                    $institution->save();
                }
            }
            error_log('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>');
            error_log('KPI' . $kpi->get_code() . ' has been done');
            error_log('<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
        }
    }

    protected function array_median($array) {
        // perhaps all non numeric values should filtered out of $array here?
        $iCount = count($array);
        if (!$iCount) {
            return $median['actual_benchmark'] = '0.00';
            //throw new DomainException('Median of an empty array is undefined');
        }
        // if we're down here it must mean $array
        // has at least 1 item in the array.
        $middle_index = (int)floor($iCount / 2);
        $median['actual_benchmark'] = $array[$middle_index]['actual_benchmark']; // assume an odd # of items
        // Handle the even case by averaging the middle 2 items
        if ($iCount % 2 == 0) {
            $median['actual_benchmark'] = ($median['actual_benchmark'] + $array[$middle_index - 1]['actual_benchmark']) / 2;
        }
        return $median;
    }

    //Survey Deferred
    public function KPI_161()
    {
        $this->load_modules();
    }

    //Survey Staff / Faculty / Student first 2 questions.
    public function KPI_162()
    {
        //This function will use the compute_qualitative_kpi
    }

    public function KPI_163($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '1.6.3'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('% of Achieved');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '1.6.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100: 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '1.6.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '1.6.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $program_value->save();
        }
    }

    public function KPI_291()
    {
        $this->load_modules();
    }

    public function KPI_292()
    {
        //This function will use the compute_qualitative_kpi
    }

    public function KPI_293()
    {
        //This function will use the compute_qualitative_kpi
    }

    public function KPI_361($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '3.6.1'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('% of Students');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '3.6.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '3.6.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '3.6.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $program_value->save();
        }
    }

    public function KPI_362($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '3.6.2'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('% of Faculty');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '3.6.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '3.6.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '3.6.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $program_value->save();
        }
    }

    public function KPI_363()
    {
        //This function will use the compute_qualitative_kpi
    }

    public function KPI_364($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }
        $this->load_modules();

        $year = $this->get_academic_year($academic_year);

        $semesters = Orm_Semester::get_all(array('year' => $year));

        $KPI = Orm_Kpi::get_one(array('code' => '3.6.4'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$legend->get_id()) {
            $legend = new Orm_Kpi_Legend();
            $legend->set_level_id($level->get_id());
            $legend->set_title('% of Courses');
            $legend->save();
            $detail = new Orm_Kpi_Detail();
            $detail->set_semester_id($semesters[0]->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }
        foreach (Orm_College::get_all() as $college) {
            foreach (Orm_Program::get_all(array('college_id' => $college->get_id())) as $program) {

                $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(), 'academic_year' => $year));
                $value_program = Orm_Kpi_Program_Value::get_one(array('program_id' => $program->get_id(), 'detail_id' => $detail->get_id()));
                if (!$value_program->get_id()) {
                    $value_program->set_program_id($program->get_id());
                    $value_program->set_detail_id($detail->get_id());
                }
                $value_program->set_actual_benchmark(100);
                $value_program->save();
            }
            $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(), 'academic_year' => $year));
            $value_college = Orm_Kpi_College_Value::get_one(array('college_id' => $college->get_id(), 'detail_id' => $detail->get_id()));
            if (!$value_college->get_id()) {
                $value_college->set_college_id($college->get_id());
                $value_college->set_detail_id($detail->get_id());
            }
            $value_college->set_actual_benchmark(100);
            $value_college->save();
        }
        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(), 'academic_year' => $year));
        $value_institution = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
        if (!$value_institution->get_id()) {
            $value_institution->set_detail_id($detail->get_id());
        }
        $value_institution->set_actual_benchmark(100);
        $value_institution->save();
    }

    public function KPI_365($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '3.6.5'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Programs');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '3.6.5' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '3.6.5' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '3.6.5' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_366($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '3.6.6'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Programs');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '3.6.6' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '3.6.6' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '3.6.6' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_4121($semester)
    {
        $this->load_modules();
        $KPI = Orm_Kpi::get_one(array('code' => '4.12.1'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $legends = Orm_Kpi_Legend::get_all(array('level_id' => $level->get_id()));
        if (count($legends) == 0) {
            $domains = Orm_Cm_Learning_Domain::get_all();
            foreach ($domains as $domain) {
                $legend = new Orm_Kpi_Legend();
                $legend->set_level_id($level->get_id());
                $legend->set_title($domain->get_title());
                $legend->save();
                $detail = new Orm_Kpi_Detail();
                $detail->set_semester_id($semester);
                $detail->set_legend_id($legend->get_id());
                $detail->save();
            }
        }
        foreach ($legends as $legend) {
            $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(), 'semester_id' => $semester));
            $value_institution = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            $domain = Orm_Cm_Learning_Domain::get_one(array('title' => $legend->get_title()));
            if (!$value_institution->get_id()) {
                $value_institution->set_detail_id($detail->get_id());
            }
            $score = Orm_Cm_Course_Assessment_Method::get_model()->get_score_kpi($domain->get_id());
            $value_institution->set_actual_benchmark($score);
            $value_institution->save();

            $colleges = Orm_College::get_all();
            foreach ($colleges as $college) {

                $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(), 'semester_id' => $semester));
                $value_college = Orm_Kpi_College_Value::get_one(array('college_id' => $college->get_id(), 'detail_id' => $detail->get_id()));
                $domain = Orm_Cm_Learning_Domain::get_one(array('title' => $legend->get_title()));
                if (!$value_college->get_id()) {
                    $value_college->set_college_id($college->get_id());
                    $value_college->set_detail_id($detail->get_id());
                }
                $score = Orm_Cm_Course_Assessment_Method::get_model()->get_score_kpi($domain->get_id(),$college->get_id());
                $value_college->set_actual_benchmark($score);
                $value_college->save();

                $programs = Orm_Program::get_all(array('college_id' => $college->get_id()));
                foreach ($programs as $program) {
                    $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(), 'semester_id' => $semester));
                    $value_program = Orm_Kpi_Program_Value::get_one(array('program_id' => $program->get_id(), 'detail_id' => $detail->get_id()));
                    $domain = Orm_Cm_Learning_Domain::get_one(array('title' => $legend->get_title()));
                    if (!$value_program->get_id()) {
                        $value_program->set_program_id($program->get_id());
                        $value_program->set_detail_id($detail->get_id());
                    }
                    $score = Orm_Cm_Course_Assessment_Method::get_model()->get_score_kpi($domain->get_id(),$college->get_id(),$program->get_id());
                    $value_program->set_actual_benchmark($score);
                    $value_program->save();
                }
            }
        }
    }

    public function KPI_4122($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '4.12.2'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Graduates');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '4.12.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '4.12.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '4.12.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $program_value->save();
        }
    }

    public function KPI_4123($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '4.12.3'));

        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }

        $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$legend->get_id()) {
            $legend = new Orm_Kpi_Legend();
            $legend->set_level_id($level->get_id());
            $legend->set_title('Undergraduate Students');
            $legend->save();
            $detail = new Orm_Kpi_Detail();
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '4.12.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }

            $institution_value->set_actual_benchmark(intval($row['KPI_DENOMINATOR']) > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '4.12.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '4.12.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_4124($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '4.12.4'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Postgraduate Students');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '4.12.4' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '4.12.4' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '4.12.4' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_4125($semester)
    {
        $this->load_modules();

        $semester_obj = Orm_Semester::get_instance($semester);

        $kpi_obj = Orm_Kpi::get_one(array('code' => '4.12.5'));

        $colleges = Orm_College::get_all();
        foreach ($colleges as $college) {
            $programs = Orm_Program::get_all(array('college_id' => $college->get_id()));
            foreach ($programs as $program) {
                //Collect all program courses
                $courses_ids = array_column(Orm_Program_Plan::get_model()->get_courses(array('program_id' => $program->get_id())), 'integration_id');
                $evaluations = array_column(Orm_Edugate_Survey_Evaluation::get_model()->get_all(array('course_in' => $courses_ids, 'semester' => $semester_obj->get_integration_id())), 'evaluation_serial');
                $scores = Orm_Edugate_Survey_Response::get_model()->summary_report($evaluations, $semester);
                foreach ($scores as $score) {
                    if ($score['average']) {
                        $level = Orm_Kpi_Survey::get_one(array('kpi_id' => $kpi_obj->get_id(), 'level' => 'Students'));
                        if ($level->get_id()) {
                            $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => Orm_Survey_Question_Factor::get_instance($score['id'])->get_report_title()));
                            if ($legend->get_id()) {
                                $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(), 'semester_id' => $semester_obj->get_id()));
                                if (!$detail->get_id()) {
                                    $detail->set_legend_id($legend->get_id());
                                    $detail->set_semester_id($semester_obj->get_id());
                                    $detail->save();
                                    echo '.';
                                }
                                $program_value = Orm_Kpi_Program_Value::get_one(array('program_id' => $program->get_id(), 'detail_id' => $detail->get_id()));
                                if (!$program_value->get_id()) {
                                    $program_value->set_program_id($program->get_id());
                                    $program_value->set_detail_id($detail->get_id());
                                }
                                $program_value->set_actual_benchmark($score['average']);
                                $program_value->save();
                            }
                        }
                    }
                }
            }
            $courses_ids = array_column(Orm_Program_Plan::get_model()->get_courses(array('college_id' => $college->get_id())), 'integration_id');
            $evaluations = array_column(Orm_Edugate_Survey_Evaluation::get_model()->get_all(array('course_in' => $courses_ids, 'semester' => $semester_obj->get_integration_id())), 'evaluation_serial');
            $scores = Orm_Edugate_Survey_Response::get_model()->summary_report($evaluations, $semester);
            foreach ($scores as $score) {
                if ($score['average']) {
                    $level = Orm_Kpi_Survey::get_one(array('kpi_id' => 56, 'level' => 'Students'));
                    if ($level->get_id()) {
                        $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => Orm_Survey_Question_Factor::get_instance($score['id'])->get_report_title()));
                        if ($legend->get_id()) {
                            $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(), 'semester_id' => $semester_obj->get_id()));
                            if (!$detail->get_id()) {
                                $detail->set_legend_id($legend->get_id());
                                $detail->set_semester_id($semester_obj->get_id());
                                $detail->save();
                            }
                            $college_value = Orm_Kpi_College_Value::get_one(array('college_id' => $college->get_id(), 'detail_id' => $detail->get_id()));
                            if (!$college_value->get_id()) {
                                $college_value->set_college_id($college->get_id());
                                $college_value->set_detail_id($detail->get_id());
                            }
                            $college_value->set_actual_benchmark($score['average']);
                            $college_value->save();
                            echo '.';
                        }
                    }
                }
            }
        }
        $evaluations = array_column(Orm_Edugate_Survey_Evaluation::get_model()->get_all(array('semester' => $semester_obj->get_integration_id())), 'evaluation_serial');
        $scores = Orm_Edugate_Survey_Response::get_model()->summary_report($evaluations, $semester);
        foreach ($scores as $score) {
            if ($score['average']) {
                $level = Orm_Kpi_Survey::get_one(array('kpi_id' => 56, 'level' => 'Students'));
                if ($level->get_id()) {
                    $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => Orm_Survey_Question_Factor::get_instance($score['id'])->get_report_title()));
                    if ($legend->get_id()) {
                        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(), 'semester_id' => $semester_obj->get_id()));
                        if (!$detail->get_id()) {
                            $detail->set_legend_id($legend->get_id());
                            $detail->set_semester_id($semester_obj->get_id());
                            $detail->save();
                        }
                        $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
                        if (!$institution_value->get_id()) {
                            $institution_value->set_detail_id($detail->get_id());
                        }
                        $institution_value->set_actual_benchmark($score['average']);
                        $institution_value->save();
                        echo '.';
                    }
                }
            }
        }
    }

    public function KPI_4126($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '4.12.6'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Students');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '4.12.6' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '4.12.6' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '4.12.6' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_4127($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '4.12.7'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('% of PhD Holder');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '4.12.7' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '4.12.7' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '4.12.7' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_4128($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '4.12.8'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'Teaching Assistant'));
        $instructor_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'Instructor'));
        $assis_prof_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'Assistant Professor'));
        $assoc_prof_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'Associate Professor'));
        $prof_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'Professor'));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Teaching Assistant');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }
        if (!$instructor_legend->get_id()) {
            $instructor_legend = new Orm_Kpi_Legend();
            $instructor_legend->set_level_id($level->get_id());
            $instructor_legend->set_title('Instructor');
            $instructor_legend->save();
            $instructor_detail = new Orm_Kpi_Detail();
            $instructor_detail->set_semester_id($semester->get_id());
            $instructor_detail->set_legend_id($instructor_legend->get_id());
            $instructor_detail->save();
        }
        if (!$assis_prof_legend->get_id()) {
            $assis_prof_legend = new Orm_Kpi_Legend();
            $assis_prof_legend->set_level_id($level->get_id());
            $assis_prof_legend->set_title('Assistant Professor');
            $assis_prof_legend->save();
            $assis_prof_detail = new Orm_Kpi_Detail();
            $assis_prof_detail->set_semester_id($semester->get_id());
            $assis_prof_detail->set_legend_id($assis_prof_legend->get_id());
            $assis_prof_detail->save();
        }
        if (!$assoc_prof_legend->get_id()) {
            $assoc_prof_legend = new Orm_Kpi_Legend();
            $assoc_prof_legend->set_level_id($level->get_id());
            $assoc_prof_legend->set_title('Associate Professor');
            $assoc_prof_legend->save();
            $assoc_prof_detail = new Orm_Kpi_Detail();
            $assoc_prof_detail->set_semester_id($semester->get_id());
            $assoc_prof_detail->set_legend_id($assoc_prof_legend->get_id());
            $assoc_prof_detail->save();
        }
        if (!$prof_legend->get_id()) {
            $prof_legend = new Orm_Kpi_Legend();
            $prof_legend->set_level_id($level->get_id());
            $prof_legend->set_title('Professor');
            $prof_legend->save();
            $prof_detail = new Orm_Kpi_Detail();
            $prof_detail->set_semester_id($semester->get_id());
            $prof_detail->set_legend_id($prof_legend->get_id());
            $prof_detail->save();
        }

        $teaching_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$teaching_detail->get_id()) {
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $instructor_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $instructor_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$instructor_detail->get_id()) {
            $instructor_detail->set_semester_id($semester->get_id());
            $instructor_detail->set_legend_id($instructor_legend->get_id());
            $instructor_detail->save();
        }

        $assis_prof_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $assis_prof_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$assis_prof_detail->get_id()) {
            $assis_prof_detail->set_semester_id($semester->get_id());
            $assis_prof_detail->set_legend_id($assis_prof_legend->get_id());
            $assis_prof_detail->save();
        }

        $assoc_prof_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $assoc_prof_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$assoc_prof_detail->get_id()) {
            $assoc_prof_detail->set_semester_id($semester->get_id());
            $assoc_prof_detail->set_legend_id($assoc_prof_legend->get_id());
            $assoc_prof_detail->save();
        }

        $prof_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $prof_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$prof_detail->get_id()) {
            $prof_detail->set_semester_id($semester->get_id());
            $prof_detail->set_legend_id($prof_legend->get_id());
            $prof_detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '4.12.8' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            if ($row['DIM'] == 'Teaching Assistant') {
                $detail = $teaching_detail;
            } elseif ($row['DIM'] == 'Instructor') {
                $detail = $instructor_detail;
            } elseif ($row['DIM'] == 'Assistant Professor') {
                $detail = $assis_prof_detail;
            } elseif ($row['DIM'] == 'Associate Professor') {
                $detail = $assoc_prof_detail;
            } else {
                $detail = $prof_detail;
            }

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        error_log('Insitution Done');

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '4.12.8' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            if ($row['DIM'] == 'Teaching Assistant') {
                $detail = $teaching_detail;
            } elseif ($row['DIM'] == 'Instructor') {
                $detail = $instructor_detail;
            } elseif ($row['DIM'] == 'Assistant Professor') {
                $detail = $assis_prof_detail;
            } elseif ($row['DIM'] == 'Associate Professor') {
                $detail = $assoc_prof_detail;
            } else {
                $detail = $prof_detail;
            }

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        error_log('College Done');

        $query = "SELECT count(*) as num FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '4.12.8' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        $row_count = 0;

        while ($row = odbc_fetch_array($result)) {
            $row_count = $row['NUM'];
        }
        if ($row_count > 0) {
            $limit = ceil($row_count / 200);
            for ($i = 0; $i <= $limit; $i++) {
                $offset = $i * 200;
                $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '4.12.8' AND ACADEMIC_YEAR = '{$academic_year}' ORDER BY PROGRAM_ID Limit 200 OFFSET {$offset}";

                $result = odbc_exec($cs, $query);

                while ($prow = odbc_fetch_array($result)) {

                    if ($prow['DIM'] == 'Teaching Assistant') {
                        $detail = $teaching_detail;
                    } elseif ($prow['DIM'] == 'Instructor') {
                        $detail = $instructor_detail;
                    } elseif ($prow['DIM'] == 'Assistant Professor') {
                        $detail = $assis_prof_detail;
                    } elseif ($prow['DIM'] == 'Associate Professor') {
                        $detail = $assoc_prof_detail;
                    } else {
                        $detail = $prof_detail;
                    }
                    $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $prow['PROGRAM_ID']));
                    if (!$program_value->get_id()) {
                        $program_value->set_program_id($prow['PROGRAM_ID']);
                        $program_value->set_detail_id($detail->get_id());
                    }
                    $program_value->set_actual_benchmark($prow['KPI_DENOMINATOR'] > 0 ? $prow['KPI_NUMERATOR'] / $prow['KPI_DENOMINATOR'] : 0);
                    $program_value->save();
                }
            }
        }

        error_log('Programs Done');
    }

    public function KPI_4129($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '4.12.9'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('% of Students');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '4.12.9' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $institution_value->save();
        }

        error_log('Insitution Done');

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '4.12.9' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $college_value->save();
        }

        error_log('College Done');

        $query = "SELECT count(*) as num FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '4.12.9' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        $row_count = 0;

        while ($row = odbc_fetch_array($result)) {
            $row_count = $row['NUM'];
        }
        if ($row_count > 0) {
            $limit = ceil($row_count / 200);
            for ($i = 0; $i <= $limit; $i++) {
                $offset = $i * 200;
                $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '4.12.9' AND ACADEMIC_YEAR = '{$academic_year}' ORDER BY PROGRAM_ID Limit 200 OFFSET {$offset}";

                $result = odbc_exec($cs, $query);

                while ($prow = odbc_fetch_array($result)) {

                    $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
                    if (!$program_value->get_id()) {
                        $program_value->set_program_id($row['PROGRAM_ID']);
                        $program_value->set_detail_id($detail->get_id());
                    }
                    $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
                    $program_value->save();
                }
            }
        }
        error_log('Program Done');
    }

    public function KPI_41210($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '4.12.10'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Courses');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '4.12.10' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '4.12.10' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '4.12.10' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $program_value->save();
        }
    }

    public function KPI_41211($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '4.12.11'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $employed_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'Employed'));
        $enrolled_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'Enrolled'));
        $other_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'Other'));
        if (!$employed_legend->get_id()) {
            $employed_legend = new Orm_Kpi_Legend();
            $employed_legend->set_level_id($level->get_id());
            $employed_legend->set_title('Employed');
            $employed_legend->save();
            $employed_detail = new Orm_Kpi_Detail();
            $employed_detail->set_semester_id($semester->get_id());
            $employed_detail->set_legend_id($employed_legend->get_id());
            $employed_detail->save();
        }
        if (!$enrolled_legend->get_id()) {
            $enrolled_legend = new Orm_Kpi_Legend();
            $enrolled_legend->set_level_id($level->get_id());
            $enrolled_legend->set_title('Enrolled');
            $enrolled_legend->save();
            $enrolled_detail = new Orm_Kpi_Detail();
            $enrolled_detail->set_semester_id($semester->get_id());
            $enrolled_detail->set_legend_id($enrolled_legend->get_id());
            $enrolled_detail->save();
        }
        if (!$other_legend->get_id()) {
            $other_legend = new Orm_Kpi_Legend();
            $other_legend->set_level_id($level->get_id());
            $other_legend->set_title('Other');
            $other_legend->save();
            $other_detail = new Orm_Kpi_Detail();
            $other_detail->set_semester_id($semester->get_id());
            $other_detail->set_legend_id($other_legend->get_id());
            $other_detail->save();
        }

        $employed_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $employed_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$employed_detail->get_id()) {
            $employed_detail->set_semester_id($semester->get_id());
            $employed_detail->set_legend_id($employed_legend->get_id());
            $employed_detail->save();
        }

        $enrolled_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $enrolled_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$enrolled_detail->get_id()) {
            $enrolled_detail->set_semester_id($semester->get_id());
            $enrolled_detail->set_legend_id($enrolled_legend->get_id());
            $enrolled_detail->save();
        }

        $other_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $other_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$other_detail->get_id()) {
            $other_detail->set_semester_id($semester->get_id());
            $other_detail->set_legend_id($other_legend->get_id());
            $other_detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '4.12.11' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            if ($row['DIM'] == 'a') {
                $detail = $employed_detail;
            } elseif ($row['DIM'] == 'b') {
                $detail = $enrolled_detail;
            } else {
                $detail = $other_detail;
            }

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '4.12.11' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            if ($row['DIM'] == 'a') {
                $detail = $employed_detail;
            } elseif ($row['DIM'] == 'b') {
                $detail = $enrolled_detail;
            } else {
                $detail = $other_detail;
            }

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '4.12.11' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            if ($row['DIM'] == 'a') {
                $detail = $employed_detail;
            } elseif ($row['DIM'] == 'b') {
                $detail = $enrolled_detail;
            } else {
                $detail = $other_detail;
            }

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_571($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '5.7.1'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Student');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '5.7.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '5.7.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '5.7.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_572($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '5.7.2'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Operating Funds');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '5.7.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '5.7.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '5.7.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_573()
    {
        //This function will use the compute_qualitative_kpi
    }

    public function KPI_651($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '6.5.1'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('# of Website');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '6.5.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '6.5.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '6.5.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_652($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '6.5.2'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('# of Website');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '6.5.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '6.5.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '6.5.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_653()
    {
        //This function will use the compute_qualitative_kpi
    }

    public function KPI_654()
    {
        //This function will use the compute_qualitative_kpi
    }

    public function KPI_761($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '7.6.1'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $allocated_it_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'Allocated for IT'));
        $per_student_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'Per student'));
        $software_licences_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'Software licences'));
        $security_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'Security'));
        $maintenance_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'Maintenance'));
        if (!$allocated_it_legend->get_id()) {
            $allocated_it_legend = new Orm_Kpi_Legend();
            $allocated_it_legend->set_level_id($level->get_id());
            $allocated_it_legend->set_title('Allocated for IT');
            $allocated_it_legend->save();
            $allocated_it_detail = new Orm_Kpi_Detail();
            $allocated_it_detail->set_semester_id($semester->get_id());
            $allocated_it_detail->set_legend_id($allocated_it_legend->get_id());
            $allocated_it_detail->save();
        }
        if (!$per_student_legend->get_id()) {
            $per_student_legend = new Orm_Kpi_Legend();
            $per_student_legend->set_level_id($level->get_id());
            $per_student_legend->set_title('Per Program (Per student)');
            $per_student_legend->save();
            $per_student_detail = new Orm_Kpi_Detail();
            $per_student_detail->set_semester_id($semester->get_id());
            $per_student_detail->set_legend_id($per_student_legend->get_id());
            $per_student_detail->save();
        }
        if (!$software_licences_legend->get_id()) {
            $software_licences_legend = new Orm_Kpi_Legend();
            $software_licences_legend->set_level_id($level->get_id());
            $software_licences_legend->set_title('Software licences');
            $software_licences_legend->save();
            $software_licences_detail = new Orm_Kpi_Detail();
            $software_licences_detail->set_semester_id($semester->get_id());
            $software_licences_detail->set_legend_id($software_licences_legend->get_id());
            $software_licences_detail->save();
        }
        if (!$security_legend->get_id()) {
            $security_legend = new Orm_Kpi_Legend();
            $security_legend->set_level_id($level->get_id());
            $security_legend->set_title('Security');
            $security_legend->save();
            $security_detail = new Orm_Kpi_Detail();
            $security_detail->set_semester_id($semester->get_id());
            $security_detail->set_legend_id($security_legend->get_id());
            $security_detail->save();
        }
        if (!$maintenance_legend->get_id()) {
            $maintenance_legend = new Orm_Kpi_Legend();
            $maintenance_legend->set_level_id($level->get_id());
            $maintenance_legend->set_title('Maintenance');
            $maintenance_legend->save();
            $maintenance_detail = new Orm_Kpi_Detail();
            $maintenance_detail->set_semester_id($semester->get_id());
            $maintenance_detail->set_legend_id($maintenance_legend->get_id());
            $maintenance_detail->save();
        }

        $allocated_it_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $allocated_it_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$allocated_it_detail->get_id()) {
            $allocated_it_detail->set_semester_id($semester->get_id());
            $allocated_it_detail->set_legend_id($allocated_it_legend->get_id());
            $allocated_it_detail->save();
        }

        $per_student_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $per_student_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$per_student_detail->get_id()) {
            $per_student_detail->set_semester_id($semester->get_id());
            $per_student_detail->set_legend_id($per_student_legend->get_id());
            $per_student_detail->save();
        }

        $software_licences_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $software_licences_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$software_licences_detail->get_id()) {
            $software_licences_detail->set_semester_id($semester->get_id());
            $software_licences_detail->set_legend_id($software_licences_legend->get_id());
            $software_licences_detail->save();
        }

        $security_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $security_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$security_detail->get_id()) {
            $security_detail->set_semester_id($semester->get_id());
            $security_detail->set_legend_id($security_legend->get_id());
            $security_detail->save();
        }

        $maintenance_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $maintenance_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$maintenance_detail->get_id()) {
            $maintenance_detail->set_semester_id($semester->get_id());
            $maintenance_detail->set_legend_id($maintenance_legend->get_id());
            $maintenance_detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '7.6.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            if ($row['DIM'] == 'a') {
                $detail = $allocated_it_detail;
            } elseif ($row['DIM'] == 'b') {
                $detail = $per_student_detail;
            } elseif ($row['DIM'] == 'c') {
                $detail = $software_licences_detail;
            } elseif ($row['DIM'] == 'd') {
                $detail = $security_detail;
            } else {
                $detail = $maintenance_detail;
            }

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $institution_value->save();
        }

        error_log('Instituion Done');

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '7.6.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            if ($row['DIM'] == 'a') {
                $detail = $allocated_it_detail;
            } elseif ($row['DIM'] == 'b') {
                $detail = $per_student_detail;
            } elseif ($row['DIM'] == 'c') {
                $detail = $software_licences_detail;
            } elseif ($row['DIM'] == 'd') {
                $detail = $security_detail;
            } else {
                $detail = $maintenance_detail;
            }

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $college_value->save();
        }

        error_log('College Done');

        $query = "SELECT count(*) as num FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '7.6.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        $row_count = 0;

        while ($row = odbc_fetch_array($result)) {
            $row_count = $row['NUM'];
        }
        if ($row_count > 0) {
            $limit = ceil($row_count / 200);
            for ($i = 0; $i <= $limit; $i++) {
                $offset = $i * 200;

                $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '7.6.1' AND ACADEMIC_YEAR = '{$academic_year}' ORDER BY PROGRAM_ID Limit 200 OFFSET {$offset}";

                $result = odbc_exec($cs, $query);

                while ($row = odbc_fetch_array($result)) {

                    if ($row['DIM'] == 'a') {
                        $detail = $allocated_it_detail;
                    } elseif ($row['DIM'] == 'b') {
                        $detail = $per_student_detail;
                    } elseif ($row['DIM'] == 'c') {
                        $detail = $software_licences_detail;
                    } elseif ($row['DIM'] == 'd') {
                        $detail = $security_detail;
                    } else {
                        $detail = $maintenance_detail;
                    }

                    $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
                    if (!$program_value->get_id()) {
                        $program_value->set_program_id($row['PROGRAM_ID']);
                        $program_value->set_detail_id($detail->get_id());
                    }
                    $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
                    $program_value->save();
                }
            }
        }
        error_log('Program Done');
    }

    public function KPI_762()
    {
        //This function will use the compute_qualitative_kpi
    }

    public function KPI_763()
    {
        //This function will use the compute_qualitative_kpi
    }

    public function KPI_764()
    {
        //This function will use the compute_qualitative_kpi
    }

    public function KPI_841($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '8.4.1'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Expenditure');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '8.4.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '8.4.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '8.4.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_842($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '8.4.2'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Net Income');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '8.4.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '8.4.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '8.4.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_843($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '8.4.3'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Expenses');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '8.4.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '8.4.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '8.4.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $program_value->save();
        }
    }

    public function KPI_844($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '8.4.4'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Budget');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '8.4.4' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '8.4.4' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '8.4.4' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_845($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '8.4.5'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Expenses');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '8.4.5' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '8.4.5' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '8.4.5' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_846()
    {
        //Qualitative KPI
    }

    public function KPI_951($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '9.5.1'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Faculty Member');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '9.5.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '9.5.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '9.5.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_952($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '9.5.2'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Faculty Members');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '9.5.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '9.5.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '9.5.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_953($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '9.5.3'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Supporting Staff');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '9.5.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '9.5.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '9.5.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $program_value->save();
        }
    }

    public function KPI_1051($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '10.5.1'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Publications');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }

        $academic_year = ($from_year - 1) . '/' . ($to_year - 1);


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '10.5.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '10.5.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '10.5.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_1052($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '10.5.2'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Citations');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }

        $academic_year = ($from_year - 1) . '/' . ($to_year - 1);

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '10.5.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '10.5.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '10.5.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_1053($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '10.5.3'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Faculty Members');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }

        $academic_year = ($from_year - 1) . '/' . ($to_year - 1);

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '10.5.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '10.5.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '10.5.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_1054()
    {
        //Qualitative KPI
    }

    public function KPI_1055($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '10.5.5'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Innovation Funds');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '10.5.5' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '10.5.5' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '10.5.5' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_1056($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '10.5.6'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Research Income');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }

        $academic_year = ($from_year - 1) . '/' . ($to_year - 1);

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '10.5.6' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '10.5.6' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '10.5.6' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_1057($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '10.5.7'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('# of Papers');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }

        $academic_year = ($from_year - 1) . '/' . ($to_year - 1);

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '10.5.7' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '10.5.7' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '10.5.7' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_1058($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '10.5.8'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('No. of Research');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }

        $academic_year = ($from_year - 1) . '/' . ($to_year - 1);

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '10.5.8' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '10.5.8' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '10.5.8' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_1059($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '10.5.9'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Amount spent on Research');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '10.5.9' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '10.5.9' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '10.5.9' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_1141()
    {
        //This function will use the compute_qualitative_kpi
    }

    public function KPI_1142()
    {
        //Deferred KPI
    }

    public function KPI_1143($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '11.4.3'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'No. of Employee'));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('No. of Employee');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '11.4.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '11.4.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '11.4.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function KPI_1144($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => '11.4.4'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('No. Community');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($teaching_legend->get_id());
            $detail->save();
        }


        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = '11.4.4' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = '11.4.4' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = '11.4.4' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    //Strategic KPIs integration functions

    public function s1($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => 's.1'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$legend->get_id()) {
            $legend = new Orm_Kpi_Legend();
            $legend->set_level_id($level->get_id());
            $legend->set_title('Publications');
            $legend->save();
            $detail = new Orm_Kpi_Detail();
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = 'S.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = 'S.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = 'S.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function s2($from_year,$to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => 's.2'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$legend->get_id()) {
            $legend = new Orm_Kpi_Legend();
            $legend->set_level_id($level->get_id());
            $legend->set_title('Citations');
            $legend->save();
            $detail = new Orm_Kpi_Detail();
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = 'S.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = 'S.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = 'S.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function s3($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => 's.3'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$legend->get_id()) {
            $legend = new Orm_Kpi_Legend();
            $legend->set_level_id($level->get_id());
            $legend->set_title('Internal/External Research');
            $legend->save();
            $detail = new Orm_Kpi_Detail();
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = 'S.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = 'S.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = 'S.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function s4($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => 's.4'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$legend->get_id()) {
            $legend = new Orm_Kpi_Legend();
            $legend->set_level_id($level->get_id());
            $legend->set_title('% of Faculty');
            $legend->save();
            $detail = new Orm_Kpi_Detail();
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = 'S.4' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = 'S.4' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = 'S.4' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $program_value->save();
        }
    }

    public function s5($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => 's.5'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$legend->get_id()) {
            $legend = new Orm_Kpi_Legend();
            $legend->set_level_id($level->get_id());
            $legend->set_title('% of Faculty');
            $legend->save();
            $detail = new Orm_Kpi_Detail();
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = 'S.5' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = 'S.5' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = 'S.5' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $program_value->save();
        }
    }

    public function s6_1($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => 's.6.1'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'Faculty Member'));
        $other_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'Support Staff'));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Faculty Member');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }
        if (!$other_legend->get_id()) {
            $other_legend = new Orm_Kpi_Legend();
            $other_legend->set_level_id($level->get_id());
            $other_legend->set_title('Support Staff');
            $other_legend->save();
            $other_detail = new Orm_Kpi_Detail();
            $other_detail->set_semester_id($semester->get_id());
            $other_detail->set_legend_id($other_legend->get_id());
            $other_detail->save();
        }

        $teaching_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$teaching_detail->get_id()) {
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $other_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $other_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$other_detail->get_id()) {
            $other_detail->set_semester_id($semester->get_id());
            $other_detail->set_legend_id($other_legend->get_id());
            $other_detail->save();
        }

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = 'S.6.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {
            if ($row['DIM'] == 'Faculty') {
                $detail = $teaching_detail;
            } else {
                $detail = $other_detail;
            }
            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($teaching_detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = 'S.6.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            if ($row['DIM'] == 'Faculty') {
                $detail = $teaching_detail;
            } else {
                $detail = $other_detail;
            }

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = 'S.6.1' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            if ($row['DIM'] == 'Faculty') {
                $detail = $teaching_detail;
            } else {
                $detail = $other_detail;
            }

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $program_value->save();
        }
    }
    public function s6_2($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => 's.6.2'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$legend->get_id()) {
            $legend = new Orm_Kpi_Legend();
            $legend->set_level_id($level->get_id());
            $legend->set_title('Citations');
            $legend->save();
            $detail = new Orm_Kpi_Detail();
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = 'S.6.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = 'S.6.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = 'S.6.2' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }
    public function s6_3($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => 's.6.3'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$legend->get_id()) {
            $legend = new Orm_Kpi_Legend();
            $legend->set_level_id($level->get_id());
            $legend->set_title('Teaching Staff');
            $legend->save();
            $detail = new Orm_Kpi_Detail();
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = 'S.6.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = 'S.6.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = 'S.6.3' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function s7()
    {
        $this->load_modules();
    }

    public function s8($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => 's.8'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $undergraduate_retention_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'UG Retention Rate'));
        $undergraduate_graduate_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'UG Graduation Rate'));
        $postgraduate_retention_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'PG Retention Rate'));
        $postgraduate_graduate_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'PG Graduation Rate'));
        if (!$undergraduate_retention_legend->get_id()) {
            $undergraduate_retention_legend = new Orm_Kpi_Legend();
            $undergraduate_retention_legend->set_level_id($level->get_id());
            $undergraduate_retention_legend->set_title('UG Retention Rate');
            $undergraduate_retention_legend->save();
            $undergraduate_retention_detail = new Orm_Kpi_Detail();
            $undergraduate_retention_detail->set_semester_id($semester->get_id());
            $undergraduate_retention_detail->set_legend_id($undergraduate_retention_legend->get_id());
            $undergraduate_retention_detail->save();
        }
        if (!$undergraduate_graduate_legend->get_id()) {
            $undergraduate_graduate_legend = new Orm_Kpi_Legend();
            $undergraduate_graduate_legend->set_level_id($level->get_id());
            $undergraduate_graduate_legend->set_title('UG Graduation Rate');
            $undergraduate_graduate_legend->save();
            $undergraduate_graduate_detail = new Orm_Kpi_Detail();
            $undergraduate_graduate_detail->set_semester_id($semester->get_id());
            $undergraduate_graduate_detail->set_legend_id($undergraduate_graduate_legend->get_id());
            $undergraduate_graduate_detail->save();
        }
        if (!$postgraduate_retention_legend->get_id()) {
            $postgraduate_retention_legend = new Orm_Kpi_Legend();
            $postgraduate_retention_legend->set_level_id($level->get_id());
            $postgraduate_retention_legend->set_title('PG Retention Rate');
            $postgraduate_retention_legend->save();
            $postgraduate_retention_detail = new Orm_Kpi_Detail();
            $postgraduate_retention_detail->set_semester_id($semester->get_id());
            $postgraduate_retention_detail->set_legend_id($postgraduate_retention_legend->get_id());
            $postgraduate_retention_detail->save();
        }
        if (!$postgraduate_graduate_legend->get_id()) {
            $postgraduate_graduate_legend = new Orm_Kpi_Legend();
            $postgraduate_graduate_legend->set_level_id($level->get_id());
            $postgraduate_graduate_legend->set_title('PG Graduation Rate');
            $postgraduate_graduate_legend->save();
            $postgraduate_graduate_detail = new Orm_Kpi_Detail();
            $postgraduate_graduate_detail->set_semester_id($semester->get_id());
            $postgraduate_graduate_detail->set_legend_id($postgraduate_graduate_legend->get_id());
            $postgraduate_graduate_detail->save();
        }

        $undergraduate_retention_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $undergraduate_retention_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$undergraduate_retention_detail->get_id()) {
            $undergraduate_retention_detail->set_semester_id($semester->get_id());
            $undergraduate_retention_detail->set_legend_id($undergraduate_retention_legend->get_id());
            $undergraduate_retention_detail->save();
        }

        $undergraduate_graduate_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $undergraduate_graduate_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$undergraduate_graduate_detail->get_id()) {
            $undergraduate_graduate_detail->set_semester_id($semester->get_id());
            $undergraduate_graduate_detail->set_legend_id($undergraduate_graduate_legend->get_id());
            $undergraduate_graduate_detail->save();
        }

        $postgraduate_retention_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $postgraduate_retention_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$postgraduate_retention_detail->get_id()) {
            $postgraduate_retention_detail->set_semester_id($semester->get_id());
            $postgraduate_retention_detail->set_legend_id($postgraduate_retention_legend->get_id());
            $postgraduate_retention_detail->save();
        }

        $postgraduate_graduate_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $postgraduate_graduate_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$postgraduate_graduate_detail->get_id()) {
            $postgraduate_graduate_detail->set_semester_id($semester->get_id());
            $postgraduate_graduate_detail->set_legend_id($postgraduate_graduate_legend->get_id());
            $postgraduate_graduate_detail->save();
        }

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = 'S.8' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {
            if ($row['DIM'] == '1') {
                $detail = $undergraduate_retention_detail;
            } elseif ($row['DIM'] == '2') {
                $detail = $undergraduate_graduate_detail;
            } elseif ($row['DIM'] == '3') {
                $detail = $postgraduate_retention_detail;
            } else {
                $detail = $postgraduate_graduate_detail;
            }
            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = 'S.8' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            if ($row['DIM'] == '1') {
                $detail = $undergraduate_retention_detail;
            } elseif ($row['DIM'] == '2') {
                $detail = $undergraduate_graduate_detail;
            } elseif ($row['DIM'] == '3') {
                $detail = $postgraduate_retention_detail;
            } else {
                $detail = $postgraduate_graduate_detail;
            }

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT count(*) as num FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = 'S.8' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        $row_count = 0;

        while ($row = odbc_fetch_array($result)) {
            $row_count = $row['NUM'];
        }
        if ($row_count > 0) {
            $limit = ceil($row_count / 200);
            for ($i = 0; $i <= $limit; $i++) {
                $offset = $i * 200;
                $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = 'S.8' AND ACADEMIC_YEAR = '{$academic_year}' ORDER BY PROGRAM_ID Limit 200 OFFSET {$offset}";

                $result = odbc_exec($cs, $query);

                while ($row = odbc_fetch_array($result)) {

                    if ($row['DIM'] == '1') {
                        $detail = $undergraduate_retention_detail;
                    } elseif ($row['DIM'] == '2') {
                        $detail = $undergraduate_graduate_detail;
                    } elseif ($row['DIM'] == '3') {
                        $detail = $postgraduate_retention_detail;
                    } else {
                        $detail = $postgraduate_graduate_detail;
                    }

                    $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
                    if (!$program_value->get_id()) {
                        $program_value->set_program_id($row['PROGRAM_ID']);
                        $program_value->set_detail_id($detail->get_id());
                    }
                    $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
                    $program_value->save();
                }
            }
        }
    }

    public function s9($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => 's.9'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$legend->get_id()) {
            $legend = new Orm_Kpi_Legend();
            $legend->set_level_id($level->get_id());
            $legend->set_title('Graduate Enrolment');
            $legend->save();
            $detail = new Orm_Kpi_Detail();
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = 'S.9' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = 'S.9' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = 'S.9' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function s10($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => 's.10'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$legend->get_id()) {
            $legend = new Orm_Kpi_Legend();
            $legend->set_level_id($level->get_id());
            $legend->set_title('Student');
            $legend->save();
            $detail = new Orm_Kpi_Detail();
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = 'S.10' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = 'S.10' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = 'S.10' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function s11($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => 's.11'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$legend->get_id()) {
            $legend = new Orm_Kpi_Legend();
            $legend->set_level_id($level->get_id());
            $legend->set_title('% of Students');
            $legend->save();
            $detail = new Orm_Kpi_Detail();
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = 'S.11' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = 'S.11' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = 'S.11' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $program_value->save();
        }
    }

    public function s12($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => 's.12'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$legend->get_id()) {
            $legend = new Orm_Kpi_Legend();
            $legend->set_level_id($level->get_id());
            $legend->set_title('International Faculty');
            $legend->save();
            $detail = new Orm_Kpi_Detail();
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = 'S.12' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = 'S.12' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = 'S.12' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $program_value->save();
        }
    }

    public function s13($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => 's.13'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $undergraduate_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'Undergraduate'));
        $postgraduate_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'Postgraduate'));
        if (!$undergraduate_legend->get_id()) {
            $undergraduate_legend = new Orm_Kpi_Legend();
            $undergraduate_legend->set_level_id($level->get_id());
            $undergraduate_legend->set_title('Undergraduate');
            $undergraduate_legend->save();
            $undergraduate_detail = new Orm_Kpi_Detail();
            $undergraduate_detail->set_semester_id($semester->get_id());
            $undergraduate_detail->set_legend_id($undergraduate_legend->get_id());
            $undergraduate_detail->save();
        }
        if (!$postgraduate_legend->get_id()) {
            $postgraduate_legend = new Orm_Kpi_Legend();
            $postgraduate_legend->set_level_id($level->get_id());
            $postgraduate_legend->set_title('Postgraduate');
            $postgraduate_legend->save();
            $postgraduate_detail = new Orm_Kpi_Detail();
            $postgraduate_detail->set_semester_id($semester->get_id());
            $postgraduate_detail->set_legend_id($postgraduate_legend->get_id());
            $postgraduate_detail->save();
        }

        $undergraduate_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $undergraduate_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$undergraduate_detail->get_id()) {
            $undergraduate_detail->set_semester_id($semester->get_id());
            $undergraduate_detail->set_legend_id($undergraduate_legend->get_id());
            $undergraduate_detail->save();
        }

        $postgraduate_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $postgraduate_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$postgraduate_detail->get_id()) {
            $postgraduate_detail->set_semester_id($semester->get_id());
            $postgraduate_detail->set_legend_id($postgraduate_legend->get_id());
            $postgraduate_detail->save();
        }

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = 'S.13' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {
            if ($row['DIM'] == '1') {
                $detail = $undergraduate_detail;
            } else {
                $detail = $postgraduate_detail;
            }
            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = 'S.13' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            if ($row['DIM'] == '1') {
                $detail = $undergraduate_detail;
            } else {
                $detail = $postgraduate_detail;
            }

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = 'S.13' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            if ($row['DIM'] == '1') {
                $detail = $undergraduate_detail;
            } else {
                $detail = $postgraduate_detail;
            }

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] * 100 : 0);
            $program_value->save();
        }
    }

    public function s14()
    {
        //This function will use the compute_qualitative_kpi
    }

    public function s15($from_year, $to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => 's.15'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $teaching_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'Teaching Staff'));
        $other_legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id(), 'title' => 'Other Staff'));
        if (!$teaching_legend->get_id()) {
            $teaching_legend = new Orm_Kpi_Legend();
            $teaching_legend->set_level_id($level->get_id());
            $teaching_legend->set_title('Teaching Staff');
            $teaching_legend->save();
            $teaching_detail = new Orm_Kpi_Detail();
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }
        if (!$other_legend->get_id()) {
            $other_legend = new Orm_Kpi_Legend();
            $other_legend->set_level_id($level->get_id());
            $other_legend->set_title('Other Staff');
            $other_legend->save();
            $other_detail = new Orm_Kpi_Detail();
            $other_detail->set_semester_id($semester->get_id());
            $other_detail->set_legend_id($other_legend->get_id());
            $other_detail->save();
        }

        $teaching_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $teaching_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$teaching_detail->get_id()) {
            $teaching_detail->set_semester_id($semester->get_id());
            $teaching_detail->set_legend_id($teaching_legend->get_id());
            $teaching_detail->save();
        }

        $other_detail = Orm_Kpi_Detail::get_one(array('legend_id' => $other_legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$other_detail->get_id()) {
            $other_detail->set_semester_id($semester->get_id());
            $other_detail->set_legend_id($other_legend->get_id());
            $other_detail->save();
        }

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = 'S.15' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {
            if ($row['DIM'] == 'Faculty') {
                $detail = $teaching_detail;
            } else {
                $detail = $other_detail;
            }
            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($teaching_detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = 'S.15' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            if ($row['DIM'] == 'Faculty') {
                $detail = $teaching_detail;
            } else {
                $detail = $other_detail;
            }

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = 'S.15' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            if ($row['DIM'] == 'Faculty') {
                $detail = $teaching_detail;
            } else {
                $detail = $other_detail;
            }

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function s16($from_year ,$to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => 's.16'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$legend->get_id()) {
            $legend = new Orm_Kpi_Legend();
            $legend->set_level_id($level->get_id());
            $legend->set_title('No. MoU');
            $legend->save();
            $detail = new Orm_Kpi_Detail();
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = 'S.16' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = 'S.16' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = 'S.16' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function s17($from_year ,$to_year)
    {
        $academic_year = $from_year.'/'.$to_year;
        $this->validate_academic_year($from_year, $to_year);

        if (!$from_year || !$to_year) {
            die('No Academic Year Selected');
        }

        $this->load_modules();

        $cs = netezza_odbc_cs();

        $qms_academic_year = $this->get_academic_year($academic_year);

        $semester = Orm_Semester::get_one(array('year' => $qms_academic_year));

        $KPI = Orm_Kpi::get_one(array('code' => 's.17'));
        $level = Orm_Kpi_Level::get_one(array('kpi_id' => $KPI->get_id()));
        if (!$level->get_id()) {
            $level = new Orm_Kpi_Level();
            $level->set_level(time());
            $level->set_kpi_id($KPI->get_id());
            $level->save();
        }
        $legend = Orm_Kpi_Legend::get_one(array('level_id' => $level->get_id()));
        if (!$legend->get_id()) {
            $legend = new Orm_Kpi_Legend();
            $legend->set_level_id($level->get_id());
            $legend->set_title('FTE Faculty');
            $legend->save();
            $detail = new Orm_Kpi_Detail();
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $detail = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(),'academic_year' => $qms_academic_year));

        if (!$detail->get_id()) {
            $detail->set_semester_id($semester->get_id());
            $detail->set_legend_id($legend->get_id());
            $detail->save();
        }

        $query = "SELECT * FROM EQMS_KPI_INSTITUTION_NEW WHERE KPI_CODE = 'S.17' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $institution_value = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $detail->get_id()));
            if (!$institution_value->get_id()) {
                $institution_value->set_detail_id($detail->get_id());
            }
            $institution_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $institution_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_COLLEGE_NEW WHERE KPI_CODE = 'S.17' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $college_value = Orm_Kpi_College_Value::get_one(array('detail_id' => $detail->get_id(), 'college_id' => $row['COLLEGE_ID']));
            if (!$college_value->get_id()) {
                $college_value->set_college_id($row['COLLEGE_ID']);
                $college_value->set_detail_id($detail->get_id());
            }
            $college_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $college_value->save();
        }

        $query = "SELECT * FROM EQMS_KPI_PROGRAM_NEW WHERE KPI_CODE = 'S.17' AND ACADEMIC_YEAR = '{$academic_year}'";

        $result = odbc_exec($cs, $query);

        while ($row = odbc_fetch_array($result)) {

            $program_value = Orm_Kpi_Program_Value::get_one(array('detail_id' => $detail->get_id(), 'program_id' => $row['PROGRAM_ID']));
            if (!$program_value->get_id()) {
                $program_value->set_program_id($row['PROGRAM_ID']);
                $program_value->set_detail_id($detail->get_id());
            }
            $program_value->set_actual_benchmark($row['KPI_DENOMINATOR'] > 0 ? $row['KPI_NUMERATOR'] / $row['KPI_DENOMINATOR'] : 0);
            $program_value->save();
        }
    }

    public function kpis($year_from,$year_to) {
        $this->KPI_163($year_from,$year_to);
        error_log('KPI 1.6.3 DONE');
        $this->KPI_361($year_from,$year_to);
        error_log('KPI 3.6.1 DONE');
        $this->KPI_362($year_from,$year_to);
        error_log('KPI 3.6.2 DONE');
        $this->KPI_364($year_from,$year_to);
        error_log('KPI 3.6.4 DONE');
        $this->KPI_365($year_from,$year_to);
        error_log('KPI 3.6.5 DONE');
        $this->KPI_366($year_from,$year_to);
        error_log('KPI 3.6.6 DONE');
        $this->KPI_4122($year_from,$year_to);
        error_log('KPI 4.12.2 DONE');
        $this->KPI_4123($year_from,$year_to);
        error_log('KPI 4.12.3 DONE');
        $this->KPI_4124($year_from,$year_to);
        error_log('KPI 4.12.4 DONE');
        $this->KPI_4126($year_from,$year_to);
        error_log('KPI 4.12.6 DONE');
        $this->KPI_4127($year_from,$year_to);
        error_log('KPI 4.12.7 DONE');
        $this->KPI_4128($year_from,$year_to);
        error_log('KPI 4.12.8 DONE');
        $this->KPI_4129($year_from,$year_to);
        error_log('KPI 4.12.9 DONE');
        $this->KPI_41210($year_from,$year_to);
        error_log('KPI 4.12.10 DONE');
        $this->KPI_41211($year_from,$year_to);
        error_log('KPI 4.12.11 DONE');
        $this->KPI_571($year_from,$year_to);
        error_log('KPI 5.7.1 DONE');
        $this->KPI_572($year_from,$year_to);
        error_log('KPI 5.7.2 DONE');
        $this->KPI_651($year_from,$year_to);
        error_log('KPI 6.5.1 DONE');
        $this->KPI_652($year_from,$year_to);
        error_log('KPI 6.5.2 DONE');
        $this->KPI_761($year_from,$year_to);
        error_log('KPI 7.6.1 DONE');
        $this->KPI_841($year_from,$year_to);
        error_log('KPI 8.4.1 DONE');
        $this->KPI_842($year_from,$year_to);
        error_log('KPI 8.4.2 DONE');
        $this->KPI_843($year_from,$year_to);
        error_log('KPI 8.4.3 DONE');
        $this->KPI_844($year_from,$year_to);
        error_log('KPI 8.4.4 DONE');
        $this->KPI_845($year_from,$year_to);
        error_log('KPI 8.4.5 DONE');
        $this->KPI_951($year_from,$year_to);
        error_log('KPI 9.5.1 DONE');
        $this->KPI_952($year_from,$year_to);
        error_log('KPI 9.5.2 DONE');
        $this->KPI_953($year_from,$year_to);
        error_log('KPI 9.5.3 DONE');
        $this->KPI_1051($year_from,$year_to);
        error_log('KPI 10.5.1 DONE');
        $this->KPI_1052($year_from,$year_to);
        error_log('KPI 10.5.2 DONE');
        $this->KPI_1053($year_from,$year_to);
        error_log('KPI 10.5.3 DONE');
        $this->KPI_1055($year_from,$year_to);
        error_log('KPI 10.5.5 DONE');
        $this->KPI_1056($year_from,$year_to);
        error_log('KPI 10.5.6 DONE');
        $this->KPI_1057($year_from,$year_to);
        error_log('KPI 10.5.7 DONE');
        $this->KPI_1058($year_from,$year_to);
        error_log('KPI 10.5.8 DONE');
        $this->KPI_1059($year_from,$year_to);
        error_log('KPI 10.5.9 DONE');
        $this->KPI_1143($year_from,$year_to);
        error_log('KPI 11.4.3 DONE');
        $this->KPI_1144($year_from,$year_to);
        error_log('KPI 11.4.4 DONE');
    }

    public function strategic_kpis($year_from,$year_to) {
        $this->s1($year_from, $year_to);
        error_log('S1 Done');
        $this->s2($year_from, $year_to);
        error_log('S2 Done');
        $this->s3($year_from, $year_to);
        error_log('S3 Done');
        $this->s4($year_from, $year_to);
        error_log('S4 Done');
        $this->s5($year_from, $year_to);
        error_log('S5 Done');
        $this->s6_1($year_from,$year_to );
        error_log('S61 Done');
        $this->s6_2($year_from,$year_to );
        error_log('S62 Done');
        $this->s6_3($year_from,$year_to );
        error_log('S63 Done');
        $this->s8($year_from,$year_to );
        error_log('S8 Done');
        $this->s9($year_from,$year_to );
        error_log('S9 Done');
        $this->s10($year_from,$year_to );
        error_log('S10 Done');
        $this->s11($year_from,$year_to );
        error_log('S11 Done');
        $this->s12($year_from,$year_to );
        error_log('S12 Done');
        $this->s13($year_from,$year_to );
        error_log('S13 Done');
        $this->s14($year_from,$year_to );
        error_log('S14 Done');
        $this->s15($year_from,$year_to );
        error_log('S15 Done');
        $this->s16($year_from,$year_to );
        error_log('S16 Done');
        $this->s17($year_from,$year_to );
        error_log('S17 Done');
    }

    private function validate_academic_year($from_year, $to_year) {
        $valid = true;
        if (strlen(intval($from_year)) > 2 || strlen(intval($to_year)) > 2) {
            $valid = false;
        }
        if (!$from_year || !$to_year || !$valid) {
            die('No Academic Year Selected');
        }
    }

    public function institution_kpis() {

        Modules::load('kpi');
        $serverName = "10.190.17.37";
        $username = "eqms_user";
        $password = "eQMS#KSU*";
        $instance = "eqms";

//        $serverName = "127.0.0.1";
//        $username = "root";
//        $password = "";
//        $instance = "test";

        // Create connection
        $conn = new mysqli($serverName, $username, $password, $instance);
        $conn->set_charset('utf8');

        $sql = "SELECT * FROM KPI_INSTITUTION";

        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $kpi = Orm_Kpi::get_one(array('code' => $row['code']));
            if ($kpi->get_id()) {
                $kpi_level = Orm_Kpi_Level::get_one(array('kpi_id' => $kpi->get_id()));
                if ($kpi_level->get_id()) {
                    $legend = Orm_Kpi_Legend::get_one(array('level_id' => $kpi_level->get_id(),'title' => $row['dim']));
                    if (!$legend->get_id()) {
                        $legend->set_level_id($kpi_level->get_id());
                        $legend->set_title($row['dim']);
                        $legend->save();
                    }
                    $details = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(),'academic_year' => $this->get_academic_year($row['academic_year'])));
                    if (!$details->get_id()) {
                        $details->set_legend_id($legend->get_id());
                        $details->set_semester_id(Orm_Semester::get_one(array('name_like' => $row['academic_year']))->get_id());
                        $details->save();
                    }
                    $institution = Orm_Kpi_Institution_Value::get_one(array('detail_id' => $details->get_id()));
                    if ($institution->get_id()) {
                        $institution->set_actual_benchmark($row['denum'] ? $row['num'] / $row['denum'] : 0);
                        $institution->save();
                    } else {
                        $institution->set_actual_benchmark($row['denum'] ? $row['num'] / $row['denum'] : 0);
                        $institution->set_detail_id($details->get_id());
                        $institution->save();
                    }
                }
            }
            error_log("KPI: ".$row['code'] . " Year: " . $this->get_academic_year($row['academic_year']));
            unset($kpi);
            unset($kpi_level);
            unset($legend);
            unset($details);
            unset($college);
        }
    }


    public function college_kpis() {

        Modules::load('kpi');
        $serverName = "10.190.17.37";
        $username = "eqms_user";
        $password = "eQMS#KSU*";
        $instance = "eqms";

        // Create connection
        $conn = new mysqli($serverName, $username, $password, $instance);
        $conn->set_charset('utf8');

        $sql = "SELECT * FROM eqms.KPI_COLLEGE";

        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $kpi = Orm_Kpi::get_one(array('code' => $row['code']));
            if ($kpi->get_id()) {
                $kpi_level = Orm_Kpi_Level::get_one(array('kpi_id' => $kpi->get_id()));
                if ($kpi_level->get_id()) {
                    $legend = Orm_Kpi_Legend::get_one(array('level_id' => $kpi_level->get_id(),'title' => $row['dim']));
                    if (!$legend->get_id()) {
                        $legend->set_level_id($kpi_level->get_id());
                        $legend->set_title($row['dim']);
                        $legend->save();
                    }
                    $details = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(),'academic_year' => $this->get_academic_year($row['academic_year'])));
                    if (!$details->get_id()) {
                        $details->set_legend_id($legend->get_id());
                        $details->set_semester_id(Orm_Semester::get_one(array('name_like' => $row['academic_year']))->get_id());
                        $details->save();
                    }
                    $college = Orm_Kpi_College_Value::get_one(array('detail_id' => $details->get_id(),'college_id' => $row['college_id']));
                    if ($college->get_id()) {
                        $college->set_actual_benchmark($row['denum'] ? $row['num'] / $row['denum'] : 0);
                        $college->save();
                    } else {
                        $college->set_actual_benchmark($row['denum'] ? $row['num'] / $row['denum'] : 0);
                        $college->set_detail_id($details->get_id());
                        $college->set_college_id($row['college_id']);
                        $college->save();
                    }
                }
            }
            error_log("KPI: ".$row['code'] . " Year: " . $this->get_academic_year($row['academic_year']));
            unset($kpi);
            unset($kpi_level);
            unset($legend);
            unset($details);
            unset($college);
        }
    }

    public function program_kpis() {

        Modules::load('kpi');
        $serverName = "10.190.17.37";
        $username = "eqms_user";
        $password = "eQMS#KSU*";
        $instance = "eqms";

        // Create connection
        $conn = new mysqli($serverName, $username, $password, $instance);
        $conn->set_charset('utf8');

        $sql = "SELECT * FROM eqms.KPI_PROGRAM";

        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $kpi = Orm_Kpi::get_one(array('code' => $row['code']));
            if ($kpi->get_id()) {
                $kpi_level = Orm_Kpi_Level::get_one(array('kpi_id' => $kpi->get_id()));
                if ($kpi_level->get_id()) {
                    $legend = Orm_Kpi_Legend::get_one(array('level_id' => $kpi_level->get_id(),'title' => $row['dim']));
                    if (!$legend->get_id()) {
                        $legend->set_level_id($kpi_level->get_id());
                        $legend->set_title($row['dim']);
                        $legend->save();
                    }
                    $details = Orm_Kpi_Detail::get_one(array('legend_id' => $legend->get_id(),'academic_year' => $this->get_academic_year($row['academic_year'])));
                    if (!$details->get_id()) {
                        $details->set_legend_id($legend->get_id());
                        $details->set_semester_id(Orm_Semester::get_one(array('name_like' => $row['academic_year']))->get_id());
                        $details->save();
                    }
                    $program = Orm_Kpi_Program_Value::get_one(array('detail_id' => $details->get_id(),'program_id' => $row['program_id']));
                    if ($program->get_id()) {
                        $program->set_actual_benchmark($row['denum'] ? $row['num'] / $row['denum'] : 0);
                        $program->save();
                    } else {
                        $program->set_actual_benchmark($row['denum'] ? $row['num'] / $row['denum'] : 0);
                        $program->set_detail_id($details->get_id());
                        $program->set_program_id($row['program_id']);
                        $program->save();
                    }
                }
            }
            error_log("KPI: ".$row['code'] . " Year: " . $this->get_academic_year($row['academic_year']));
            unset($kpi);
            unset($kpi_level);
            unset($legend);
            unset($details);
            unset($program);
        }
    }

    function calculate_median($arr) {
        sort($arr);
        $count = count($arr); //total numbers in array
        $middle = floor(($count-1)/2); // find the middle value, or the lowest middle value
        if($count % 2) { // odd number, middle is the median
            $median = $arr[$middle];
        } else { // even number, calculate avg of 2 medians
            $low = $arr[$middle];
            $high = $arr[$middle+1];
            $median = (($low+$high)/2);
        }
        return $median;
    }

    public function employers() {
        $objPHPExcel = PHPExcel_IOFactory::load('CompanyList1.1.xlsx');
//get only the Cell Collection
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

//extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
            //header will/should be in row 1 only. of course this can be modified to suit your need.
            if (!$data_value) { break; }
            $arr_data[$row][$column] = $data_value;
        }
        foreach ($arr_data as $item) {
            $employer = Orm_User_Employer::get_one(array('email' => $item['B']));
            $employer->set_email($item['B']);

            $employer->set_first_name(trim($item['A'],'\''));
            $employer->set_last_name('');
            $employer->set_gender(Orm_User::GENDER_MALE);
            $employer->set_birth_date('0000-00-00');
            $employer->set_nationality('Saudi Arabia');
            $password = random_password();
            $employer->set_password(sha1($password));
            $employer->set_phone('');
            $employer->set_office_no('');
            $employer->set_fax_no('');
            $employer->set_address('');

            $employer->set_college_id(0);
            $employer->set_department_id(0);
            $employer->set_program_id(0);
            $employer->set_position(0);
            $employer->set_employed_duration(0);
            $employer->set_employed_in(0);
            $employer->set_activity(0);
            $employer->save();
//            Orm_Notification::send_notification(
//                Orm_User::get_logged_user_id(),
//                $employer->get_id(),
//                Orm_Notification_Template::ALUMNI_EMPLOYER_CREATED,
//                Orm_Notification::TYPE_COMMON,
//                array(
//                    '%link%',
//                    '%password%',
//                    '%email%',
//                ),
//                array(
//                    '<a href="' . base_url($this->config->item('root_url')) . '">' . base_url($this->config->item('root_url')) . '</a>',
//                    $password,
//                    $employer->get_email()
//                )
//            );
        }
//send the data in an array format
    }


    public function alumni() {
        $objPHPExcel = PHPExcel_IOFactory::load('alumni.xlsx');
//get only the Cell Collection
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

//extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
            //header will/should be in row 1 only. of course this can be modified to suit your need.
            if (!$data_value) { break; }
            $arr_data[$row][$column] = $data_value;
        }
        foreach ($arr_data as $item) {
            if (isset($item['B']) && $item['B'] && (strpos($item['B'],'student.ksu.edu.sa') === false) && (strpos($item['B'],'@') > 0))
            {
                $alumni = Orm_User_Alumni::get_one(array('email' => $item['B']));
                $alumni->set_email($item['B']);
                $alumni->set_first_name(trim($item['A'],'\''));
                $alumni->set_last_name('');
                $password = random_password();
                $alumni->set_password(sha1($password));
                $alumni->set_gender(Orm_User::GENDER_NOT_SPECIFIED);
                $alumni->set_birth_date('0000-00-00');
                $alumni->set_nationality('Saudi Arabia');
                $alumni->set_phone(isset($item['C']) ? $item['C'] : '-');
                $alumni->set_office_no('');
                $alumni->set_fax_no('');
                $alumni->set_address('');

                $alumni->set_college_id(isset($item['D']) ? $item['D'] : '0');
                $alumni->set_department_id(0);
                $alumni->set_program_id(0);
                $alumni->set_graduated(0);
                $alumni->set_activity(0);

                $alumni->save();
//                Orm_Notification::send_notification(
//                    Orm_User::get_logged_user_id(),
//                    $alumni->get_id(),
//                    Orm_Notification_Template::ALUMNI_EMPLOYER_CREATED,
//                    Orm_Notification::TYPE_COMMON,
//                    array(
//                        '%link%',
//                        '%password%',
//                        '%email%',
//                    ),
//                    array(
//                        '<a href="' . base_url($this->config->item('root_url')) . '">' . base_url($this->config->item('root_url')) . '</a>',
//                        $password,
//                        $alumni->get_email()
//                    )
//                );
            }
        }
//send the data in an array format
    }


    public function fix_kpis_nodes() {

        \Modules::load('kpi');
        \Modules::load('accreditation');

        /** @var \Node\ncai14\kpi[] $nodes */
        $nodes = Orm_Node::get_all(array('class_type' => 'Node\ncai14\kpi' ));

        foreach ($nodes as $node) {
            $kpi = \Orm_Kpi::get_one(array('code' => $node->get_kpi_ref_num()));

            if ($kpi->get_id()) {
                $node->set_standard($kpi->get_criteria_obj()->get_standard_obj()->get_code());
                $node->set_kpi_id($kpi->get_id());
                $node->set_kpi_info($kpi->get_title());
                $node->save();
                error_log('Node:' . $node->get_id() . ' Done');
            } else {
                error_log('Node:' . $node->get_id() . ' Error');
            }
        }
    }

    public function migrate_edugate_course_statements() {

    }

    public function migrate_edugate_evaluations($semester) {
        if (!$this->db->table_exists('edugate_survey_evaluation_'.$semester)) {
            $query = <<<SQL
CREATE TABLE `edugate_survey_evaluation_`{$semester} (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evaluation_serial` bigint(20) NOT NULL,
  `survey_id` int(11) NOT NULL DEFAULT '0',
  `semester` int(11) NOT NULL DEFAULT '0',
  `course_no` int(11) NOT NULL DEFAULT '0',
  `section_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `EvIndx` (`evaluation_serial`,`course_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SQL;

            $this->db->query($query);

            $query = <<<SQL
CREATE TABLE `edugate_survey_response_`{$semester} (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evaluation_id` int(11) NOT NULL DEFAULT '0',
  `statement_id` int(11) NOT NULL DEFAULT '0',
  `option_no` int(11) NOT NULL DEFAULT '0',
  `option_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `StatementIdx` (`statement_id`),
  KEY `StmIndx` (`evaluation_id`,`statement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SQL;

            $this->db->query($query);
        }
    }

    public function migrate_edugate_result($semester) {
        $query =
            "
            SELECT E.EVAL_SERIAL, case D.ARTICLE_DESC
WHEN 'أستمتع بالتعلّم مع زملائي في هذا المقرّر' THEN 1
WHEN 'أشعر بالرضا التامّ عن مصادر التعلّم (مواد المقرّر، الكتب، مساعِدات التعلّم، ألخ ...) المتوفرة لدعم نشاطاتي في التعلّم' THEN 2
WHEN 'استخدم أستاذ المقرّر تنوّعاً كبيراً في أساليب تقويم الطالب في المقرّر' THEN 3
WHEN 'بوسعي تخطيط مهام /واجبات التعلّم تبعاً لسرعتي في انجاز الواجبات' THEN 4
WHEN 'بوسعي حلّ المشكلات المتعلّقة بواجبات ومهام التعلّم الموكلة لي' THEN 5
WHEN 'تتوافق الواجبات / المهام بغية التعلّم في المقرّر مع أهداف المقرّر' THEN 6
WHEN 'تحققت أهداف المقرّر في نهاية الفصل الدراسي' THEN 7
WHEN 'تحقّق أهداف المقرّر التحسين المنشود' THEN 8
WHEN 'تحقّقتْ مخرجات ونتائج المقرّر في نهاية المقرّر' THEN 9
WHEN 'تساعد التسهيلات المتوافرة في بيئة التعلّم على إنجاز أنشطة التعلّم' THEN 10
WHEN 'تساهم الواجبات المطلوب مني إنجازها في المقرّر في تحقيق أهداف المقرّر' THEN 11
WHEN 'ساهم المقرّر في تطوير مهارات التحليل لديّ' THEN 12
WHEN 'ساهم المقرّر في تطوير مهاراتي في التفكير الناقد' THEN 13
WHEN 'ساهم المقرّر في تطوير مهاراتي في التواصل' THEN 14
WHEN 'ساهم المقرّر في تطوير مهارتي في العمل ضمن فريق' THEN 15
WHEN 'ساهم المقرّر في تطويري بشكل عام.' THEN 16
WHEN 'كانت أهداف المقرّر واضحة بالنسبة لي في بداية الفصل الدراسي' THEN 17
WHEN 'لأنني حصلت على معرفة تساهم في تطويري بشكلِ عام' THEN 18
WHEN 'لأنني حصلت على مهارات تساهم في تطويري بشكلِ عام' THEN 19
WHEN 'لديّ الآن المعرفة الأساسيّة المرجوّة من دراسة المقرّر' THEN 20
WHEN 'لديّ المقدرة على تطبيق المعرفة التي اكتسبتها من دراسة المقرّر' THEN 21
WHEN 'لديّ المقدرة على صياغة حلول لمشكلات تتعلّق بالمقرّر' THEN 22
WHEN 'يتعامل أستاذ المقرّر مع الطلبة باحترام حتى لو اختلفوا معه في الرأي' THEN 23
WHEN 'يتناسب الوقت المخصّص لإنجاز الواجبات والمهام بغية التعلّم مع حجم تلك الواجبات' THEN 24
WHEN 'يستخدم أستاذ المقرّر أحدث الوسائل المتوفّرة في تدريس المقرّر' THEN 25
WHEN 'يشجّع أستاذ المقرّر الطلبة على استكشاف محتوى المقرّر خارج متطلبات كتاب المقرّر' THEN 26
WHEN 'يعتمد توزيع الدرجات المخصصة للتقويم على أدائي في المقرّر' THEN 27
WHEN 'يلمّ أستاذ المقرّر بمحتويات المقرّر' THEN 28
WHEN 'يمتلك أستاذ المقرّر المهارات التي تساعده على إيصال المواضيع الصعبة باسلوب سهل الفهم' THEN 29
ELSE 0 END,D.OPTION_CODE,D.CNT
from T1_VEVAL_EVALUATION_DTL d left join T1_VEVAL_EVALUATION e on (d.EVAL_SERIAL = e.EVAL_SERIAL) where e.SEMESTER = {$semester}
            ";

        $cs = netezza_odbc_cs();
        $result = odbc_exec($cs, $query);
        while ($row = odbc_fetch_array($result)) {

        }
    }



    /**
     * get SOUP
     * @param $function
     * @param array $param
     * @param null $url
     * @param string $list
     *
     * @return null
     */
    private function getSOUP($function, $param = [], $url = null, $list = '') {
        $url = $url == null ? $this->_soapSIS : $this->_soapHR;
        $soapClient = new SoapClient($url);
        $param['wsUserName'] = "eaa";
        $param['wsPassword'] = "EAAeaa124578";

        $headers = new SoapHeader($url, 'UserCredentials', $param);
        $soapClient->__setSoapHeaders([$headers]);



        try {
            $info = $soapClient->__call($function, [$param]);

            if (isset($info->return)) {
                if (is_object($info->return)) {
                    if ($list != '') {
                        if (property_exists($info->return, $list)) {
                            $this->retry = 0;
                            unset($soapClient);
                            return $info->return;
                        } else {
                            print_r($param);
                            print($list . " is not found in object\n");
                            print("Can not Connect KKU Server. try #:" . $this->retry . ".\n");
                            if ($this->retry > 5) {
                                $this->retry++;
                                $this->getSOUP($function, $param, $url, $list);
                            } else {
                                unset($soapClient);
                                return $info->return;
                            }
                        }
                    } else {
                        unset($soapClient);
                        return $info->return;
                    }
                } else {
                    print_r($param);
                    print("return is not object\n");
                    print("Can not Connect KKU Server. try #:" . $this->retry . ".\n");
                    if ($this->retry > 5) {
                        $this->retry++;
                        $this->getSOUP($function, $param, $url, $list);
                    } else {
                        unset($soapClient);
                        return null;
                    }
                }
            } else {
                print_r($param);
                print("no data in return\n");
                print("Can not Connect KKU Server. try #:" . $this->retry . ".\n");
                if ($this->retry > 5) {
                    $this->retry++;
                    $this->getSOUP($function, $param, $url, $list);
                } else {
                    unset($soapClient);
                    return null;
                }
            }
        } catch (SoapFault $fault) {
            $this->retry++;
            print_r($param);
            print("Can not Connect KKU Server. try #:" . $this->retry . ".\n");
            print('SOAP Fault: (faultcode: {' . $fault->faultcode . '}, faultstring: {' . $fault->faultstring . "})\n");
            if ($this->retry > 5)
                $this->getSOUP($function, $param, $url, $list);
        }

        unset($soapClient);
        return null;
    }

    private function check_data($obj, $property){
        $rows = [];

        if(property_exists($obj, $property)){
            if(is_object($obj->$property)) {
                $rows = [$obj->$property];
            } else if(is_array($obj->$property)) {
                $rows = $obj->$property;
            }
        } else {
            print("no data\n");
//            return [];
        }

        return $rows;
    }
}
