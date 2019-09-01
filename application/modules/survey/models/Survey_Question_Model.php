<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_Question_Model extends CI_Model
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

        $this->db->select('sq.*');
        $this->db->distinct();
        $this->db->from(Orm_Survey_Question::get_table_name().' AS sq');

        if (isset($filters['id'])) {
            $this->db->where('sq.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('sq.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('sq.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('sq.id', $filters['not_in_id']);
        }
        if (isset($filters['page_id'])) {
            $this->db->where('sq.page_id', $filters['page_id']);
        }
        if (isset($filters['survey_id'])) {
            $this->db->join(Orm_Survey_Page::get_table_name() . ' AS sp', 'sq.page_id = sp.id', 'INNER');
            $this->db->where('sp.survey_id', $filters['survey_id']);
        }
        if (!empty($filters['class_type'])) {
            $this->db->where('sq.class_type', $filters['class_type']);
        }
        if (!empty($filters['question_english'])) {
            $this->db->where('sq.question_english', $filters['question_english']);
        }
        if (!empty($filters['question_arabic'])) {
            $this->db->where('sq.question_arabic', $filters['question_arabic']);
        }
        if (!empty($filters['description_english'])) {
            $this->db->where('sq.description_english', $filters['description_english']);
        }
        if (!empty($filters['description_arabic'])) {
            $this->db->where('sq.description_arabic', $filters['description_arabic']);
        }
        if (!empty($filters['order'])) {
            $this->db->where('sq.order', $filters['order']);
        }
        if (!empty($filters['greater_order'])) {
            $this->db->where('sq.order >=', $filters['greater_order']);
        }
        if (!empty($filters['is_require'])) {
            $this->db->where('sq.is_require', $filters['is_require']);
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
                $row = $this->db->get()->row_array();
                return Orm_Survey_Question::to_object($row, (empty($row['class_type']) ? null : $row['class_type']));
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Survey_Question::to_object($row, (empty($row['class_type']) ? null : $row['class_type']));
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
        $this->db->insert(Orm_Survey_Question::get_table_name(), $params);
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
        return $this->db->update(Orm_Survey_Question::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Survey_Question::get_table_name(), array('id' => (int)$id));
    }

}

