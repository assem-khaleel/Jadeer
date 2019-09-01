<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 */
class Survey_Model extends CI_Model
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
        $this->db->from(Orm_Survey::get_table_name().' AS s');
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
        if (!empty($filters['title_english'])) {
            $this->db->where('s.title_english', $filters['title_english']);
        }
        if (!empty($filters['title_arabic'])) {
            $this->db->where('s.title_arabic', $filters['title_arabic']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('s.title_arabic', $filters['keyword']);
            $this->db->or_like('s.title_english', $filters['keyword']);
            $this->db->group_end();
        }
        if (!empty($filters['created_by'])) {
            $this->db->where('s.created_by', $filters['created_by']);
        }
        if (!empty($filters['date_added'])) {
            $this->db->where('s.date_added', $filters['date_added']);
        }
        if (!empty($filters['date_modified'])) {
            $this->db->where('s.date_modified', $filters['date_modified']);
        }
        if (!empty($filters['type'])) {
            $this->db->where('s.type', $filters['type']);
        }
        if (!empty($filters['type_in'])) {
            $this->db->where_in('s.type', $filters['type_in']);
        }
        // Added by shamaseen
        if (!empty($filters['has_factor_question'])) {
            $this->db->join(Orm_Survey_Page::get_table_name().' AS sp','sp.survey_id = s.id');
            $this->db->join(Orm_Survey_Question::get_table_name().' AS sq','sp.id = sq.page_id');
            $this->db->join(Orm_Survey_Question_Factor::get_table_name(). " AS qf ", "qf.question_id = sq.id");
            $this->db->group_by("qf.id");
            $this->db->having('count(qf.id) > 0');
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
                return Orm_Survey::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Survey::to_object($row);
                }
//                echo $this->db->last_query();
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
        $this->db->insert(Orm_Survey::get_table_name(), $params);
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
        return $this->db->update(Orm_Survey::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Survey::get_table_name(), array('id' => (int)$id));
    }

}

