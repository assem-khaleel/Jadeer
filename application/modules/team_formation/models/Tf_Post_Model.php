<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Tf_Post_Model
 *
 * @property CI_DB_query_builder | CI_DB_mysqli_driver $db
 */
class Tf_Post_Model extends CI_Model {

    /**
     * get table rows according to the assigned filters and page
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     * @param int $fetch_as
     *
     * @return Orm_Tf_Post | Orm_Tf_Post[] | array | int
     */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {

        $page = (int) $page;
        $per_page = (int) $per_page;

        $this->db->select('tp.*');
        $this->db->distinct();
        $this->db->from(Orm_Tf_Post::get_table_name() . ' AS tp');

        if (isset($filters['id'])) {
            $this->db->where('tp.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('tp.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('tp.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('tp.id', $filters['not_in_id']);
        }
        if (isset($filters['club_id'])) {
            $this->db->where('tp.club_id', $filters['club_id']);
        }
        if (isset($filters['in_club_id'])) {
            $this->db->where_in('tp.club_id', $filters['in_club_id']);
        }
        if (!empty($filters['content'])) {
            $this->db->where('tp.content', $filters['content']);
        }
        if (!empty($filters['date_created'])) {
            $this->db->where('tp.date_created', $filters['date_created']);
        }
        if (!empty($filters['greater_date_created'])) {
            $this->db->where('tp.date_created >=', $filters['greater_date_created']);
        }
        if (!empty($filters['less_date_created'])) {
            $this->db->where('tp.date_created <=', $filters['less_date_created']);
        }
        if (!empty($filters['from_date_created']) && !empty($filters['to_date_created'])) {
            $this->db->group_start();
            $this->db->where('tp.date_created >=', $filters['from_date_created']);
            $this->db->where('tp.date_created <=', $filters['to_date_created']);
            $this->db->group_end();
        }
        if (isset($filters['creator'])) {
            $this->db->where('tp.creator', $filters['creator']);
        }

        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }
        $this->db->order_by('date_created', 'desc');
        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }

        switch($fetch_as) {
            case Orm::FETCH_OBJECT:
                return Orm_Tf_Post::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Tf_Post::to_object($row);
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
    public function insert($params = array()) {
        $this->db->insert(Orm_Tf_Post::get_table_name(), $params);
        return $this->db->insert_id();
    }

    /**
     * update item
     *
     * @param int $id
     * @param array $params
     * @return boolean
     */
    public function update($id, $params = array()) {
        return $this->db->update(Orm_Tf_Post::get_table_name(), $params, array('id' => $id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id) {
        return $this->db->delete(Orm_Tf_Post::get_table_name(), array('id' => $id));
    }

}

