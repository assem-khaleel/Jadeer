<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Semester_Model
 */
class Semester_Model extends CI_Model
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

        $this->db->select('s.*');
        $this->db->distinct();
        $this->db->from(Orm_Semester::get_table_name().' AS s');
        $this->db->where('s.is_deleted', 0);

        if (isset($filters['id'])) {
            $this->db->where('s.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('s.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('s.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('s.id', $filters['not_in_id']);
        }
        if (isset($filters['integration_id'])) {
            $this->db->where('s.integration_id', $filters['integration_id']);
        }
        if (!empty($filters['year'])) {
            $this->db->where('s.year', $filters['year']);
        }
        if (!empty($filters['start'])) {
            $this->db->where('s.start', $filters['start']);
        }
        if (!empty($filters['end'])) {
            $this->db->where('s.end', $filters['end']);
        }
        if (!empty($filters['name_en'])) {
            $this->db->where('s.name_en', $filters['name_en']);
        }
        if (!empty($filters['name_ar'])) {
            $this->db->where('s.name_ar', $filters['name_ar']);
        }
        if (!empty($filters['date'])) {
            $this->db->where('s.start <=', $filters['date']);
            $this->db->where('s.end >=', $filters['date']);
        }
        if (!empty($filters['name_like'])) {
            $this->db->like('s.name', $filters['name_like']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('s.name_en', $filters['keyword']);
            $this->db->or_like('s.name_ar', $filters['keyword']);
            $this->db->group_end();
        }

        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }

        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }

        switch ($fetch_as) {
            case Orm::FETCH_OBJECT:
                return Orm_Semester::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Semester::to_object($row);
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
        $this->db->insert(Orm_Semester::get_table_name(), $params);
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
        return $this->db->update(Orm_Semester::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->update(Orm_Semester::get_table_name(), array('is_deleted'=>1), array('id' => (int) $id));
    }

    public function get_max_id()
    {
        $this->db->select_max('integration_id','integration_id');
        $result = $this->db->get(Orm_Semester::get_table_name())->row_array();

        $this->db->where('integration_id',$result['integration_id']);
        $result = $this->db->get(Orm_Semester::get_table_name())->row_array();
        return (!empty($result['id']) ? $result['id'] : 0);
    }

    public function get_last_five_semesters($semester_id)
    {
        $semester = Orm_Semester::get_instance($semester_id);
        $semester_name = UI_LANG == 'arabic' ? 'name_ar' : 'name_en';
        $this->db->select("id, {$semester_name} as year");
        $this->db->distinct(true);
        $this->db->from(Orm_Semester::get_table_name());
        $this->db->where('integration_id <= ',$semester->get_integration_id());
        $this->db->order_by('integration_id','desc');
        $this->db->limit(5);
        return $this->db->get()->result_array();
    }

    public function get_last_five_years($year)
    {
        $this->db->select('year');
        $this->db->distinct(true);
        $this->db->from(Orm_Semester::get_table_name());
        $this->db->where('year <= ',$year);
        $this->db->order_by('year','desc');
        $this->db->limit(5);
        return $this->db->get()->result_array();
    }
}

