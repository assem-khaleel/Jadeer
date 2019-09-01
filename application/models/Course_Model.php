<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Course_Model
 */
class Course_Model extends CI_Model
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

        $this->db->select('c.*');
        $this->db->distinct();
        $this->db->from(Orm_Course::get_table_name() . ' AS c');
        $this->db->where('c.is_deleted', 0);

        if (isset($filters['program_plan'])) {
            $this->db->join(Orm_Program_Plan::get_table_name() . ' AS pp', 'pp.course_id = c.id', 'INNER');
            $this->db->join(Orm_Program::get_table_name() . ' AS p', 'p.id = pp.program_id AND p.is_deleted = 0', 'INNER');
            $this->db->join(Orm_Department::get_table_name() . ' AS d', 'd.id = p.department_id AND d.is_deleted = 0', 'INNER');
            $this->db->join(Orm_College::get_table_name() . ' AS cl', 'cl.id = d.college_id AND cl.is_deleted = 0', 'INNER');
            $this->db->join(Orm_Campus_College::get_table_name().' AS cc', 'cl.id = cc.college_id', 'INNER');
            $this->db->join(Orm_Campus::get_table_name().' AS cp', 'cp.id = cc.campus_id AND cp.is_deleted = 0', 'INNER');

            License::valid_programs('p.id');
        } else {
            $this->db->join(Orm_Department::get_table_name() . ' AS d', 'd.id = c.department_id AND d.is_deleted = 0', 'INNER');
            $this->db->join(Orm_College::get_table_name() . ' AS cl', 'cl.id = d.college_id AND cl.is_deleted = 0', 'INNER');
            $this->db->join(Orm_Campus_College::get_table_name().' AS cc', 'cl.id = cc.college_id', 'INNER');
            $this->db->join(Orm_Campus::get_table_name().' AS cp', 'cp.id = cc.campus_id AND cp.is_deleted = 0', 'INNER');
        }

        License::valid_colleges('cl.id');

        // Edited  by shamaseen : why program_plan is needed ?
        // I've edit ever isset in filter to be !empty
        if (isset($filters['program_plan']) && !empty($filters['program_id'])) {
            $this->db->where('pp.program_id', $filters['program_id']);
        }

        if (!empty($filters['department_id'])) {
            $this->db->where('d.id', $filters['department_id']);
        }
        if (!empty($filters['college_id'])) {
            $this->db->where('cl.id', $filters['college_id']);
        }
        if (!empty($filters['campus_in'][0])) {
            $this->db->where_in('cp.id', $filters['campus_in']);
        }

        if (!empty($filters['have_student_in_semester_id'])) {
            $semester_id = intval($filters['have_student_in_semester_id']);

            $this->db->join(Orm_Course_Section::get_table_name() . ' AS cs', "c.id = cs.course_id AND cs.semester_id = {$semester_id}", 'INNER');
            $this->db->join(Orm_Course_Section_Student::get_table_name() . ' AS css', 'cs.id = css.section_id', 'INNER');
        }

        if (isset($filters['id'])) {
            $this->db->where('c.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('c.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('c.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('c.id', $filters['not_in_id']);
        }
        if (isset($filters['integration_id'])) {
            $this->db->where('c.integration_id', $filters['integration_id']);
        }
        if (!empty($filters['is_deleted'])) {
            $this->db->where('c.is_deleted', $filters['is_deleted']);
        }
        if (!empty($filters['type'])) {
            $this->db->where('c.type', $filters['type']);
        }
        if (!empty($filters['name_en'])) {
            $this->db->where('c.name_en', $filters['name_en']);
        }
        if (!empty($filters['name_ar'])) {
            $this->db->where('c.name_ar', $filters['name_ar']);
        }
        if (!empty($filters['code_en'])) {
            $this->db->where('c.code_en', $filters['code_en']);
        }
        if (!empty($filters['code_ar'])) {
            $this->db->where('c.code_ar', $filters['code_ar']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('c.name_en', $filters['keyword']);
            $this->db->or_like('c.name_ar', $filters['keyword']);
            $this->db->or_like('c.code_en', $filters['keyword']);
            $this->db->or_like('c.code_ar', $filters['keyword']);
            $this->db->group_end();
        }

        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        } else {
            $orders = array('name_en');
            $this->db->order_by(implode(',', $orders));
        }

        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }

        switch ($fetch_as) {
            case Orm::FETCH_OBJECT:
                return Orm_Course::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Course::to_object($row);
                }

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

    /**
     * insert new row to the table
     *
     * @param array $params
     * @return int
     */
    public function insert($params = array())
    {
        $this->db->insert(Orm_Course::get_table_name(), $params);
        return $this->db->insert_id();
    }

    /**
     * update item
     *
     * @param int $id
     * @param array $params
     * @return boolean
     */
    public function update($id, $params = array())
    {
        return $this->db->update(Orm_Course::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->update(Orm_Course::get_table_name(), array('is_deleted' => 1), array('id' => (int)$id));
    }

    public function get_teacher_course_ids($user_id, $active = true, $select = 'id')
    {
        $semester_id = Orm_Semester::get_active_semester_id();

        $this->db->select("c.{$select}");
        $this->db->distinct();
        $this->db->from(Orm_Course::get_table_name() . ' AS c');
        $this->db->where('c.is_deleted', 0);

        $this->db->join(Orm_Course_Section::get_table_name() . ' AS cs', 'cs.course_id = c.id AND cs.is_deleted = 0', 'INNER');
        $this->db->join(Orm_Course_Section_Teacher::get_table_name() . ' AS cst', "cst.section_id = cs.id AND cst.user_id = {$user_id}", 'INNER');

        if ($active) {
            $this->db->where('cs.semester_id', $semester_id);
        }

        return array_column($this->db->get()->result_array(), $select);
    }

    public function is_course_teacher($user_id, $course_id)
    {
        $user_id = intval($user_id);
        $course_id = intval($course_id);
        $semester_id = Orm_Semester::get_active_semester_id();

        $cs_table = Orm_Course_Section::get_table_name();
        $cst_table = Orm_Course_Section_Teacher::get_table_name();

        $sql = "SELECT COUNT(DISTINCT course_id) as flag
                FROM {$cs_table} AS cs 
                INNER JOIN $cst_table AS cst ON cst.section_id = cs.id
                WHERE cst.user_id = {$user_id} AND cs.course_id = {$course_id} AND cs.semester_id = {$semester_id}";

        $result = $this->db->query($sql)->result_array();

        return empty($result) ? false : true;
    }

}

