<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Node_Assessor_Model extends CI_Model
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

        $this->db->select('na.*');
        $this->db->distinct();
        $this->db->from(Orm_Node_Assessor::get_table_name().' AS na');

        if (isset($filters['id'])) {
            $this->db->where('na.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('na.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('na.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('na.id', $filters['not_in_id']);
        }
        if (isset($filters['node_id'])) {
            $this->db->where('na.node_id', $filters['node_id']);
        }
        if (isset($filters['in_node_id'])) {
            $this->db->where_in('na.node_id', $filters['in_node_id']);
        }
        if (isset($filters['assessor_id'])) {
            $this->db->where('na.assessor_id', $filters['assessor_id']);
        }
        if (isset($filters['in_assessor_id'])) {
            $this->db->where_in('na.assessor_id', $filters['in_assessor_id']);
        }

        if (isset($filters['system_number'])) {
            $this->db->join(Orm_Node::get_table_name().' AS n', 'na.node_id = n.id');
            $this->db->where('n.system_number', $filters['system_number']);
            $this->db->where('n.is_deleted', 0);
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
                return Orm_Node_Assessor::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Node_Assessor::to_object($row);
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
        $this->db->insert(Orm_Node_Assessor::get_table_name(), $params);
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
        return $this->db->update(Orm_Node_Assessor::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Node_Assessor::get_table_name(), array('id' => (int)$id));
    }

    public function get_assessor_systems($assessor_id) {
        $this->db->select('n.system_number');
        $this->db->distinct();
        $this->db->from(Orm_Node_Assessor::get_table_name().' AS na');
        $this->db->join(Orm_Node::get_table_name().' AS n', 'na.node_id = n.id');
        $this->db->where('na.assessor_id', $assessor_id);
        $result = $this->db->get()->result_array();

        return array_column($result, 'system_number');
    }

}

