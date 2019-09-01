<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Tm_Training_Model
 *
 * @property CI_DB_query_builder | CI_DB_mysqli_driver $db
 */
class Tm_Training_Model extends CI_Model {

    /**
     * get table rows according to the assigned filters and page
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     * @param int $fetch_as
     *
     * @return Orm_Tm_Training | Orm_Tm_Training[] | array | int
     */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {

        $page = (int) $page;
        $per_page = (int) $per_page;

        $this->db->select('tt.*');
        $this->db->distinct();
        $this->db->from(Orm_Tm_Training::get_table_name() . ' AS tt');

        if (isset($filters['id'])) {
            $this->db->where('tt.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('tt.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('tt.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('tt.id', $filters['not_in_id']);
        }
        if (!empty($filters['name_en'])) {
            $this->db->where('tt.name_en', $filters['name_en']);
        }
        if (!empty($filters['name_ar'])) {
            $this->db->where('tt.name_ar', $filters['name_ar']);
        }
        if (!empty($filters['duration'])) {
            $this->db->where('tt.duration', $filters['duration']);
        }
        if (!empty($filters['date'])) {
            $this->db->where('tt.date', $filters['date']);
        }
        if (!empty($filters['greater_date'])) {
            $this->db->where('tt.date >=', $filters['greater_date']);
        }
        if (!empty($filters['less_date'])) {
            $this->db->where('tt.date <=', $filters['less_date']);
        }
        if (!empty($filters['from_date']) && !empty($filters['to_date'])) {
            $this->db->group_start();
            $this->db->where('tt.date >=', $filters['from_date']);
            $this->db->where('tt.date <=', $filters['to_date']);
            $this->db->group_end();
        }
        if (isset($filters['type_id'])) {
            $this->db->where('tt.type_id', $filters['type_id']);
        }
        if (!empty($filters['organization'])) {
            $this->db->where('tt.organization', $filters['organization']);
        }
        if (!empty($filters['location'])) {
            $this->db->where('tt.location', $filters['location']);
        }
        if (!empty($filters['instructor_information'])) {
            $this->db->where('tt.instructor_information', $filters['instructor_information']);
        }
        if (!empty($filters['description'])) {
            $this->db->where('tt.description', $filters['description']);
        }
        if (!empty($filters['training_outline'])) {
            $this->db->where('tt.training_outline', $filters['training_outline']);
        } 
        if (!empty($filters['level'])) {
            $this->db->where('tt.level', $filters['level']);
        }
        if (isset($filters['college_id'])) {
            $this->db->where('tt.college_id', $filters['college_id']);
        }
        if (isset($filters['department_id'])) {
            $this->db->where('tt.department_id', $filters['department_id']);
        }
        if (isset($filters['creator_id']) && !isset($filters['user_id'])) {
            $this->db->where('tt.creator_id', $filters['creator_id']);
        }
        if (isset($filters['not_creator_id']) && !isset($filters['not_user_id'])) {
            $this->db->where('tt.creator_id !=', $filters['not_creator_id']);
        }
        if (isset($filters['status'])) {
            $this->db->where('tt.status', $filters['status']);
        }
        
        if (isset($filters['user_id']) && !isset($filters['creator_id'])) {
            $this->db->join(Orm_Tm_Members::get_table_name() . ' AS tm', 'tt.id = tm.training_id ', 'left');
            $this->db->where('tm.user_id', $filters['user_id']);
        }
        if (isset($filters['not_user_id']) && !isset($filters['not_creator_id'])) {
            $this->db->join(Orm_Tm_Members::get_table_name() . ' AS tm', 'tt.id = tm.training_id ', 'left');
            $this->db->where('tm.user_id !=', $filters['user_id']);
        }

        if (isset($filters['user_id']) && isset($filters['creator_id'])) {
            $this->db->join(Orm_Tm_Members::get_table_name() . ' AS tm', 'tt.id = tm.training_id ', 'left');
            $this->db->group_start();
            $this->db->where('tt.creator_id', $filters['creator_id']);
            $this->db->or_where('tm.user_id', $filters['user_id']);
            $this->db->group_end();
        }

        if (isset($filters['not_user_id']) && isset($filters['not_creator_id']) && isset($filters['member_status'])) {

            $this->db->join(Orm_Tm_Members::get_table_name() . ' AS tm', 'tt.id = tm.training_id ', 'left');
            $this->db->where('tt.creator_id !=', $filters['not_creator_id']);
            $this->db->where('tt.id not in (select training_id from tm_members where status = 1 and user_id = '.$filters['not_user_id'].'  )',null,false);
        }

        else if(isset($filters['member_status']))
        {
            $this->db->join(Orm_Tm_Members::get_table_name() . ' AS tm', 'tt.id = tm.training_id and tm.status IN (2 , 0)', 'left');
        }

        if (isset($filters['level_id'])) {
            $this->db->join(Orm_Tm_Level::get_table_name() . ' AS tl', 'tt.id = tl.training_id ', 'left');
            $this->db->where_in('tl.level_id', $filters['level_id']);
        }
        
        
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('tt.name_ar', $filters['keyword']);
            $this->db->or_like('tt.name_en', $filters['keyword']);
            $this->db->or_like('tt.type_id', $filters['keyword']);
            $this->db->group_end();
        }

        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }

        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }

        switch($fetch_as) {
            case Orm::FETCH_OBJECT:
                return Orm_Tm_Training::to_object($this->db->get()->row_array());

                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Tm_Training::to_object($row);
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

    /**
     * insert new row to the table
     *
     * @param array $params
     * @return int
     */
    public function insert($params = array()) {
        $this->db->insert(Orm_Tm_Training::get_table_name(), $params);
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
        return $this->db->update(Orm_Tm_Training::get_table_name(), $params, array('id' => $id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id) {
        return $this->db->delete(Orm_Tm_Training::get_table_name(), array('id' => $id));
    }

}

