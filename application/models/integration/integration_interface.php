<?php

/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 7/4/17
 * Time: 11:54 AM
 */
interface integration_interface
{
    public function semesters();
    public function support_unit();
    public function campuses();
    public function colleges();
    public function departments();
    public function degrees();
    public function programs();
    public function courses();
    public function program_plan();
    public function faculty_members();
    public function staff_members();
    public function student_members();
    public function alumni_members();
    public function course_sections($semester_id);
    public function course_students($semester_id);
}