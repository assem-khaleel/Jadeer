<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'models/integration/integration_interface.php');

ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');
set_time_limit(0);


/**
 *
 * @property Integration_model $integration
 *
 */
class Pnu extends MX_Controller implements integration_interface
{
    private $username = 'ACCAPPL';
    private $password = 'accapp';
    private $ip = 'BNRDB-SCAN.ADS.PNU.EDU.SA';
    private $dsn = 'BPROD.ADS.PNU.EDU.SA';
    private $time = 0;
    private $count = 0;

    public function __construct() {

        parent::__construct();

        if (!is_cli()) {
            exit('No direct script access allowed');
        }

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $this->load->model('integration/integration_model', 'integration');
    }

    public function index() {


		$this->semesters();

		$this->support_unit();

        $this->campuses();

        $this->colleges();

        $this->departments();

        $this->degrees();

        $this->programs();

        $this->majors();

        $this->courses();

        $this->program_plan();

        $this->student_statuses();

        $this->faculty_members();

        $this->staff_members();

        $this->student_members();

        $this->alumni_members();

        $semester_id = 0;

        $rs = $this->getView('select Semester_Code from CUSTAPP.ACC_SEMESTERS where SYSDATE between Start_Date and End_Date and SEMESTER_CODE not like \'%15\'');

        $semester_id = $rs[0]['SEMESTER_CODE'];


        $this->course_sections($semester_id);

        $this->course_students($semester_id);

    }

    public function semesters() {

        $semesterQuery = "select * from CUSTAPP.ACC_SEMESTERS where  SEMESTER_CODE not like '%15'ORDER BY SEMESTER_CODE";
        $semesters = $this->getView($semesterQuery);
        foreach ($semesters as $semester) {

            $semesterEnd = date('Y', strtotime($semester['END_DATE']));

            $this->integration->semester(
                $semester['SEMESTER_CODE'],
                date('Y-m-d', strtotime($semester['START_DATE'])),
                date('Y-m-d', strtotime($semester['END_DATE'])),
                $semesterEnd,
                $semester['SEMESTER_TITLE_EN']?: $semester['SEMESTER_TITLE_AR'],
                $semester['SEMESTER_TITLE_AR']?: $semester['SEMESTER_TITLE_EN']
            );
        }
    }

    public function support_unit()
    {
        // TODO: Implement support_unit() method.
    }

    public function campuses()
    {
        $campusQuery = 'select * from CUSTAPP.ACC_CAMPUS';
        $campuses = $this->getView($campusQuery);

        foreach ($campuses as $campus) {

            $this->integration->campus(
                $campus['CAMPUS_ID'],
                $campus['CAMPUS_DESC_EN'] ? : $campus['CAMPUS_DESC_AR'],
                $campus['CAMPUS_DESC_AR'] ? : $campus['CAMPUS_DESC_EN']
            );
        }
    }

    public function colleges() {
        $collegeQuery = 'select * from CUSTAPP.ACC_COLLEGES';
        $colleges = $this->getView($collegeQuery);

        foreach ($colleges as $college) {

            $this->integration->college(
                $college['COLLEGE_ID'],
                10,
                $college['COLLEGE_DESC_AR']?: $college['COLLEGE_DESC_EN'],
                $college['COLLEGE_DESC_EN']?: $college['COLLEGE_DESC_AR']
            );
        }
    }

    public function departments() {
        $departmentQuery = "SELECT * FROM CUSTAPP.ACC_DEPARTMENTS";
        $departments = $this->getView($departmentQuery);

        foreach ($departments as $row) {
            $this->integration->department(
                $row['DEPARTMENT_ID'],
                $row['COLLEGE_ID'],
                $row['DEPARTMENT_DESC_AR'] ?: $row['DEPARTMENT_DESC_EN'],
                $row['DEPARTMENT_DESC_EN'] ?: $row['DEPARTMENT_DESC_AR']
            );
        }
    }

    public function degrees()
    {
        $degreeQuery = "select * from CUSTAPP.ACC_DEGREES";
        $degrees = $this->getView($degreeQuery);

        foreach ($degrees AS $row) {
            $this->integration->degree(
                $row['DEGREE_ID'],
                $row['DEGREE_NAME_AR'] ? : $row['DEGREE_NAME_EN'],
                $row['DEGREE_NAME_EN'] ? : $row['DEGREE_NAME_AR']
            );
        }
    }

    public function programs() {

        $programSQL = "select distinct CUSTAPP.ACC_PROGRAMS.*, CUSTAPP.ACC_PROGRAMS_PLANS.CREDIT_HOURS from CUSTAPP.ACC_PROGRAMS
join CUSTAPP.ACC_PROGRAMS_PLANS on CUSTAPP.ACC_PROGRAMS.PROGRAM_ID = CUSTAPP.ACC_PROGRAMS_PLANS.PROGRAM_ID";
        $programs = $this->getView($programSQL);

        foreach ($programs as $program) {
            $this->integration->program(
                $program['PROGRAM_ID'],
                $program['DEPT_ID'],
                $program['DEGREE_ID'],
                $program['PROGRAM_NAME_AR'] ? : $program['PROGRAM_NAME_EN'],
                $program['PROGRAM_NAME_EN'] ? : $program['PROGRAM_NAME_AR'],
                '',
                '',
                $program['CREDIT_HOURS']
            );
        }
    }

    public function majors()
    {
        return;

        $degreeQuery = "select * from CUSTAPP.ACC_MAJORS";
        $degrees = $this->getView($degreeQuery);


//        $cs = netezza_odbc_cs();
//        $query = "SELECT * from T3_EQMS_MAJOR_PROGRAM";
//        $result = odbc_exec($cs, $query);

        foreach($degrees as $degree) {

            $this->integration->major(
                $degree['MAJOR_ID'],
                $degree['PROGRAM_ID'],
                $degree['MAJOR_DESC_AR'] ? : $degree['MAJOR_DESC_EN'],
                $degree['MAJOR_DESC_EN'] ? : $degree['MAJOR_DESC_AR']
            );
        }
    }

    public function courses()
    {

        $query = "select distinct COURSE_SUBJ_AR, COURSE_SUBJ_EN, COURSE_NUMBER, COURSE_NAME_AR, COURSE_NAME_EN, COLLEGE_ID, DEPARTMENT_ID, IS_TRAINING from CUSTAPP.ACC_COURSES";
        $result = $this->getView($query);

        foreach($result as $row) {

            $this->integration->course(
                $row['COURSE_SUBJ_AR'].' - '.$row['COURSE_NUMBER'],
                $row['DEPARTMENT_ID'],

                $row['COURSE_NAME_AR'] ?: $row['COURSE_NAME_EN'],
                $row['COURSE_NAME_EN'] ?: $row['COURSE_NAME_AR'],

                ($row['COURSE_SUBJ_AR'] ?: $row['COURSE_SUBJ_EN']) .' - '.$row['COURSE_NUMBER'],
                ($row['COURSE_SUBJ_EN'] ?: $row['COURSE_SUBJ_AR']) .' - '.$row['COURSE_NUMBER'],
                $row['IS_TRAINING']
            );

        }
    }

    public function program_plan()
    {

        $query = "
select CUSTAPP.ACC_PROGRAMS_PLANS.PROGRAM_ID, CUSTAPP.ACC_PROGRAMS_PLANS.CREDIT_HOURS, CUSTAPP.ACC_PROGRAMS_PLANS.AREA_ID, CUSTAPP.ACC_COURSES.COURSE_SUBJ_AR, CUSTAPP.ACC_COURSES.COURSE_NUMBER
from CUSTAPP.ACC_PROGRAMS_PLANS
join CUSTAPP.ACC_COURSES on
CUSTAPP.ACC_COURSES.COURSE_SUBJ_AR = CUSTAPP.ACC_PROGRAMS_PLANS.COURSE_SUBJ
and CUSTAPP.ACC_COURSES.COURSE_NUMBER = CUSTAPP.ACC_PROGRAMS_PLANS.COURSE_NUMBER
or CUSTAPP.acc_programs_plans.COURSE_RULE = CUSTAPP.ACC_COURSES.COURSE_SUBJ_AR|| CUSTAPP.ACC_COURSES.COURSE_NUMBER
where CUSTAPP.ACC_PROGRAMS_PLANS.TERM_EFF not like '%15'";


/*
select c.PROGRAM_ID,
        c.area_id,
        c.term_eff,
        c.CREDIT_HOURS,
        c.COURSE_SUBJ,
        c.COURSE_NUMBER
from    CUSTAPP.ACC_PROGRAMS_PLANS c
where   c.TERM_EFF not like '%15'
order   by 1, 2
*/

        $result = $this->getView($query);


        foreach($result as $row){

            $this->integration->program_plan(
                $row['PROGRAM_ID'],
                $row['COURSE_SUBJ_AR'].' - '.$row['COURSE_NUMBER'],
                intval(preg_replace('/\D/', '', $row['AREA_ID'])),
                $row['CREDIT_HOURS'],
                true
            );
        }
    }


    public function student_statuses() {

        $query = "SELECT * FROM CUSTAPP.ACC_STATUSES";
        $statuses = $this->getView($query);

        foreach($statuses as $row) {

            $row = array_merge([
                'statusDesc' => '',
                'statusDescE' => '',
            ], (array)$row);


            $this->integration->status(
                $row['STATUS_ID'],
                $row['STATUS_NAME_AR']?: $row['STATUS_NAME_EN'],
                $row['STATUS_NAME_EN']?: $row['STATUS_NAME_AR']
            );
        }
    }

    public function faculty_members() {
        $query = "SELECT * FROM CUSTAPP.ACC_Employee where EMAIL is not null and employee_id not in ('435008221', '436200107', 'MGADLAN')";
        $employees = $this->getView($query);

        foreach ($employees AS $row) {

            $login_id = strstr($row['EMAIL'], '@', true);

            $this->integration->faculty(
/* integration_id */    trim($row['EMPLOYEE_ID']),
/* email */             trim($row['EMAIL']),
/* login_id */          $login_id,
/* first_name */        $row['FIRST_NAME_AR']?: '',
/* last_name */         $row['LAST_NAME_AR']?: '',
/* is_active */         1,
/* dob */               $row['BIRTH_DATE'] ? : '',
/* nationality */       '',
/* college_id */        $row['COLLEGE_ID'],
/* department_id */     $row['DEPARTMENT_ID'],
/* program_id */        0,
/* male_gender */       $row['GENDER'] == 1,
/* phone */             '',
/* fax_no */            '',
/* office_no */         '',
/* address */           '',
/* job_position */      Orm_User_Faculty::JOB_POSITION_LECTURER,
/* academic_rank */     $this->get_academic_rank(trim($row['POSITION_ID'])),
/* service_time */      0,
/* general_specialty */ '',
/* specific_specialty */'',
/* graduate_from */     ''
            );
        }
    }

    public function get_academic_rank($rank) {

        switch ($rank) {
            case 'مع':
                return Orm_User_Faculty::ACADEMIC_RANK_TEACHING_ASSISTANT;
            case 'أ':
                return Orm_User_Faculty::ACADEMIC_RANK_PROFESSOR;
            case 'أ.م':
                return Orm_User_Faculty::ACADEMIC_RANK_ASSISTANT_PROF;
            case 'مح':
                return Orm_User_Faculty::ACADEMIC_RANK_LECTURER;
            case 'أ.ش':
                return Orm_User_Faculty::ACADEMIC_RANK_ASSOCIATE_PROF;
            default:
                return Orm_User_Faculty::ACADEMIC_RANK_TUTOR;
        }
    }

    public function staff_members() {
        $staffQuery = "SELECT * FROM apps.XXPNU_JADEER_EMP_INFORMATION_V WHERE EMAIL_ID is not NULL";
        $staffMembers = $this->getViewNew($staffQuery);

        foreach ($staffMembers AS $row) {

            $login_id = strstr($row['EMAIL_ID'], '@', true);

            $this->integration->staff(
/* integration_id */    trim($row['EMAIL_ID']),
/* email */             trim($row['EMAIL_ID']),
/* login_id */          $login_id,
/* first_name */        $row['FIRST_NAME_AR']?: $row['FIRST_NAME_ENG'],
/* last_name */         $row['LAST_NAME_AR']?: $row['LAST_NAME_ENG'],
/* is_active */         1,
/* dob */               '',
/* nationality */       '',
/* college_id */        0,
/* department_id */     0,
/* program_id */        0,
/* unit_id */           0,
/* male_gender */       $row['GENDER'] == 'M',
/* phone */             '',
/* fax_no */            '',
/* office_no */         '',
/* address */           '',
/* job_position */      -1,
/* service_time */      0
            );
        }
    }

    public function student_members()
    {
        $a = 0;

        while(true) {
            $a++;
            $studentQuery = "select * from (SELECT ROWNUM rnum , CUSTAPP.ACC_STUDENTS.*,CUSTAPP.ACC_NATIONS.NATIONALITY_NAME_AR
                          FROM CUSTAPP.ACC_STUDENTS
                          JOIN CUSTAPP.ACC_NATIONS on CUSTAPP.ACC_STUDENTS.NATIONALITY_ID = CUSTAPP.ACC_NATIONS.NATIONALITY_ID
                           where  CUSTAPP.ACC_STUDENTS.student_id not in ('435008221', '436200107', 'MGADLAN') and CUSTAPP.ACC_STUDENTS.status_id not in ('AS', 'خج') 
                          ) where rnum BETWEEN ".(($a-1)*5000+1)." and ".($a*5000);
            $students = $this->getView($studentQuery);

            if(count($students)==0) {
                break;
            }

            foreach ($students AS $row) {
                    $this->integration->student(
/* $integration_id */ $row['STUDENT_ID'],
/* $email          */ filter_var(trim($row['EMAIL']), FILTER_VALIDATE_EMAIL)? trim($row['EMAIL']): trim($row['STUDENT_ID']) . '@pnu.edu.sa',
/* $login_id       */ $row['STUDENT_ID'],
/* $first_name     */ trim((string) $row['FIRST_NAME_AR'])?: '',
/* $last_name      */ trim((string) $row['MI_NAME_AR'])?: $row['MI_NAME_EN'].' '.trim((string) $row['LAST_NAME_AR'])?: $row['LAST_NAME_EN'],
/* $is_active      */ $row['STATUS_ID']=='AS',
/* $dob            */ date('Y-m-d', strtotime(trim($row['BIRTH_DATE']))),
/* $nationality    */ $row['NATIONALITY_NAME_AR']? :  '',
/* $college_id     */ trim($row['COLL_ID']),
/* $department_id  */ trim($row['DEPT_ID']),
/* $program_id     */ trim($row['PROGRAM']),
/* $status_id      */ trim($row['STATUS_ID']),
/* $male_gender    */ $row['GENDER']==1,
/* $phone          */ '',
/* $fax_no         */ '',
/* $office_no      */ '',
/* $address        */ ''
                    );
            }
        }
    }

    public function alumni_members()
    {
        $a = 0;

        while(true) {
            $a++;
            $studentQuery = "select * from (SELECT ROWNUM rnum , CUSTAPP.ACC_STUDENTS.*,CUSTAPP.ACC_NATIONS.NATIONALITY_NAME_AR
                          FROM CUSTAPP.ACC_STUDENTS
                          JOIN CUSTAPP.ACC_NATIONS on CUSTAPP.ACC_STUDENTS.NATIONALITY_ID = CUSTAPP.ACC_NATIONS.NATIONALITY_ID
                           where  CUSTAPP.ACC_STUDENTS.student_id not in ('435008221', '436200107', 'MGADLAN') and CUSTAPP.ACC_STUDENTS.STATUS_ID='خج' 
                          ) where rnum BETWEEN ".(($a-1)*5000+1)." and ".($a*5000);
            $students = $this->getView($studentQuery);

            if(count($students)==0) {
                break;
            }

            foreach ($students AS $row) {
                $this->integration->alumni(
/* $integration_id */ $row['STUDENT_ID'],
/* $email          */ filter_var(trim($row['EMAIL']), FILTER_VALIDATE_EMAIL)? trim($row['EMAIL']): trim($row['STUDENT_ID']) . '@pnu.edu.sa',
/* $login_id       */ $row['STUDENT_ID'],
/* $first_name     */ trim((string) $row['FIRST_NAME_AR'])?: $row['FIRST_NAME_EN'],
/* $last_name      */ trim((string) $row['MI_NAME_AR'])?: $row['MI_NAME_EN'].' '.trim((string) $row['LAST_NAME_AR'])?: $row['LAST_NAME_EN'],
/* $is_active      */ true,
/* $dob            */ date('Y-m-d', strtotime(trim($row['BIRTH_DATE']))),
/* $nationality    */ $row['NATIONALITY_NAME_AR']? :  '',
/* $college_id     */ trim($row['COLL_ID']),
/* $department_id  */ trim($row['DEPT_ID']),
/* $program_id     */ trim($row['PROGRAM']),
/* $male_gender    */ $row['GENDER']==1,
/* $graduated      */ 0,
/* $phone          */ '',
/* $fax_no         */ '',
/* $office_no      */ '',
/* $address        */ ''
                );
            }
        }
    }


    public function course_sections($currentSemester)
    {

        $query = "select DISTINCT SEMESTER_ID, COURSE_SUBJ, COURSE_NUMBER, INSTRUCTOR_ID,CAMPUS_ID, SECTION_SEQ, ACTIVITY_CODE from CUSTAPP.ACC_SCHEDULE where SEMESTER_ID = '{$currentSemester}'";

        $result = $this->getView($query);

        foreach($result as $row) {
            $this->integration->course_sections(
                $row['COURSE_SUBJ'].' - '.$row['COURSE_NUMBER'] . ' - ' .$row['SECTION_SEQ'],
                $row['SEMESTER_ID'],
                $row['CAMPUS_ID'],
                $row['COURSE_SUBJ'].' - '.$row['COURSE_NUMBER'],
                $row['SECTION_SEQ'],
                $row['INSTRUCTOR_ID']
            );
        }
    }

    public function course_students($currentSemester)
    {
        $query = "select DISTINCT SEMESTER_ID, COURSE_SUBJ, COURSE_NUMBER, INSTRUCTOR_ID,CAMPUS_ID, SECTION_SEQ, ACTIVITY_CODE, STUDENT_ID from CUSTAPP.ACC_SCHEDULE where SEMESTER_ID = '{$currentSemester}'";

        $result = $this->getView($query);

        foreach($result as $row) {

            $this->integration->course_student(
                $row['COURSE_SUBJ'].' - '.$row['COURSE_NUMBER'] . ' - ' .$row['SECTION_SEQ'],
                $row['STUDENT_ID']
            );
        }
    }

    /**
     *
     * @param $selectQuery
     * @param bool $fetchAll
     * @return null
     */
    private function getView($selectQuery, $fetchAll = false)
    {
        $connection = oci_connect($this->username, $this->password, $this->ip . ':1522/' . $this->dsn, 'AL32UTF8');

        $query = oci_parse($connection, $selectQuery);

        if (!$query) {
            $e = oci_error($connection);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        $query_result = oci_execute($query);

        if (!$query_result) {
            $e = oci_error($query);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        $result = [];

        if (!$fetchAll) {
            while ($query_row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
                array_push($result, $query_row);
            }
        } else {
            oci_fetch_all($query, $query_row);
            $result = $query_row;
        }

        return $result;
    }

    function getViewNew($selectQuery, $fetchAll = false)
    {
        $username = 'jadeer';
        $password = 'Id0ntknOw';
        $ip = 'pmcragrpdb01.ADS.pnu.edu.sa';
        $dsn = 'GRPT.ADS.pnu.edu.sa';
        $connection = oci_connect($username, $password, $ip . ':1521/' . $dsn, 'AL32UTF8');

        $query = oci_parse($connection, $selectQuery);

        if (!$query) {
            $e = oci_error($connection);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        $query_result = oci_execute($query);

        if (!$query_result) {
            $e = oci_error($query);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        $result = [];

        if (!$fetchAll) {
            while ($query_row = oci_fetch_array($query, OCI_ASSOC + OCI_RETURN_NULLS)) {
                array_push($result, $query_row);
            }
        } else {
            oci_fetch_all($query, $query_row);
            $result = $query_row;
        }

        return $result;
    }

}
