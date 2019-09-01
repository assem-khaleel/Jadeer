<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Orm::get_ci_model('User_Model', 'user');

class User_Student_Model extends User_Model
{

    /**
     * get table rows according to the assigned filters and page
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     * @param int $fetch_as
     *
     * @return array
     */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS)
    {

        $page = (int)$page;
        $per_page = (int)$per_page;

        $this->db->select(['us.*', Orm_User::get_table_name() . '.*']);
        $this->db->distinct();
        $this->db->from(Orm_User_Student::get_table_name() . ' AS us');

        $this->get_filters($filters);

        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }

        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }

        switch ($fetch_as) {
            case Orm::FETCH_OBJECT:
                return Orm_User_Student::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_User_Student::to_object($row);
                }
//                print_r($this->db->last_query());die;
                return $objects;
                break;
            case Orm::FETCH_ARRAY:
                return $this->db->get()->result_array();
                break;
            case Orm::FETCH_COUNT:
                return $this->db->count_all_results();
                break;
        }
    }

    public function get_filters($filters, $alias = 'us')
    {

        $this->db->join(Orm_User::get_table_name(), Orm_User::get_table_name() . ".id = {$alias}.user_id", 'INNER');


        parent::get_filters($filters, Orm_User::get_table_name());


        if (isset($filters['user_id'])) {
            $this->db->where("{$alias}.user_id", $filters['user_id']);
        }
        if (!empty($filters['campus_id'])) {

            if (!empty($filters['semesters_id'])) {
                $semester_id = $filters['semesters_id'];
                $campus_id = $filters['campus_in'];

                $query = "SELECT DISTINCT ccs.id FROM " . Orm_Course_Section::get_table_name() . " AS ccs WHERE ccs.campus_id IN (";
                if (count($campus_id) > 1) {
                    foreach ($campus_id as $campus) {
                        $query .= $campus . ",";
                    }
                    $query = rtrim($query, ',');
                } else {
                    foreach ($campus_id as $key => $campus) {
                        $query .= $campus;
                    }
                }

                $query .= ") AND ccs.semester_id = {$semester_id}";
                $query = "SELECT DISTINCT ccss.user_id FROM " . Orm_Course_Section_Student::get_table_name() . " AS ccss WHERE ccss.section_id IN ({$query})";

//                $this->db->join("($query) AS campus_section_table", "campus_section_table.user_id = {$alias}.user_id", 'INNER', false);

            } else {
                $campus_id = intval($filters['campus_id']);
                $semester_id = empty($filters['semester_id']) ? Orm_Semester::get_active_semester_id() : intval($filters['semester_id']);

                $query = "SELECT DISTINCT ccs.id FROM " . Orm_Course_Section::get_table_name() . " AS ccs WHERE ccs.campus_id = {$campus_id} AND ccs.semester_id = {$semester_id}";
                $query = "SELECT DISTINCT ccss.user_id FROM " . Orm_Course_Section_Student::get_table_name() . " AS ccss WHERE ccss.section_id IN ({$query})";

            }

        }

        // Added by shamaseen
        if (!empty($filters['campus_in'])) {
            if (!empty($filters['semesters_id'])) {
                $semester_id = $filters['semesters_id'];
                $campus_id = $filters['campus_in'];

                $query = "SELECT DISTINCT ccs.id FROM " . Orm_Course_Section::get_table_name() . " AS ccs WHERE ccs.campus_id IN (";
                if (count($campus_id) > 1) {
                    foreach ($campus_id as $campus) {
                        $query .= $campus . ",";
                    }
                    $query = rtrim($query, ',');
                } else {
                    foreach ($campus_id as $key => $campus) {
                        $query .= $campus;
                    }
                }

                $query .= ") AND ccs.semester_id = {$semester_id}";
                $query = "SELECT DISTINCT ccss.user_id FROM " . Orm_Course_Section_Student::get_table_name() . " AS ccss WHERE ccss.section_id IN ({$query})";

//                $this->db->join("($query) AS campus_section_table", "campus_section_table.user_id = {$alias}.user_id", 'INNER', false);

            } else {
                $campus_id = $filters['campus_in'];

                $query = "SELECT DISTINCT ccs.id FROM " . Orm_Course_Section::get_table_name() . " AS ccs WHERE ccs.campus_id IN (";
                if (count($campus_id) > 1) {
                    foreach ($campus_id as $campus) {
                        $query .= $campus . ",";
                    }
                    $query = rtrim($query, ',');
                } else {
                    foreach ($campus_id as $key => $campus) {
                        $query .= $campus;
                    }

                }

                $query .= ")";


                $query = "SELECT DISTINCT ccss.user_id FROM " . Orm_Course_Section_Student::get_table_name() . " AS ccss WHERE ccss.section_id IN ({$query})";

//                $this->db->join("($query) AS campus_section_table", "campus_section_table.user_id = {$alias}.user_id", 'INNER', false);
            }

            $this->db->join("($query) AS campus_section_table", "campus_section_table.user_id = {$alias}.user_id", 'INNER', false);

        }

        if (!empty($filters['college_id'])) {
            $this->db->where("{$alias}.college_id", $filters['college_id']);
        }
        if (!empty($filters['department_id'])) {
            $this->db->where("{$alias}.department_id", $filters['department_id']);
        }
        if (!empty($filters['program_id'])) {
            $this->db->where("{$alias}.program_id", $filters['program_id']);
        }
        if (!empty($filters['status'])) {
            $this->db->where("{$alias}.status", $filters['status']);
        }
        if (!empty($filters['level_of_study']) && is_array($filters['level_of_study'])) {
            $this->db->where_in("{$alias}.level_of_study", $filters['level_of_study']);
        }
        if (!empty($filters['section_id'])) {

            $section_id = intval($filters['section_id']);
            $query = "SELECT DISTINCT css.user_id FROM " . Orm_Course_Section_Student::get_table_name() . " AS css WHERE css.section_id = {$section_id}";

            $this->db->join("($query) AS section_table", "section_table.user_id = {$alias}.user_id", 'INNER', false);

        } elseif (!empty($filters['course_id'])) {
            $course_id = intval($filters['course_id']);
            $semester_id = empty($filters['semester_id']) ? Orm_Semester::get_active_semester_id() : intval($filters['semester_id']);

            $query = "SELECT DISTINCT cs.id FROM " . Orm_Course_Section::get_table_name() . " AS cs WHERE cs.course_id = {$course_id} AND cs.semester_id = {$semester_id}";
            $query = "SELECT DISTINCT css.user_id FROM " . Orm_Course_Section_Student::get_table_name() . " AS css WHERE css.section_id IN ({$query})";

            $this->db->join("($query) AS section_table", "section_table.user_id = {$alias}.user_id", 'INNER', false);
        }
    }

    /**
     * replace new row to the table
     * @param array $params
     * @return int
     */
    public function replace($params = array())
    {
        return $this->db->replace(Orm_User_Student::get_table_name(), $params);
    }

    public function get_by_user_id($user_id)
    {

        $this->db->select('*');
        $this->db->distinct();
        $this->db->from(Orm_User_Student::get_table_name());
        $this->db->where('user_id', $user_id);

        return $this->db->get()->row_array();
    }

}

