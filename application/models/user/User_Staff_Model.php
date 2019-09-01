<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Orm::get_ci_model('User_Model', 'user');

class User_Staff_Model extends User_Model
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

        $this->db->select(['us.*', Orm_User::get_table_name().'.*']);
        $this->db->distinct();
        $this->db->from(Orm_User_Staff::get_table_name().' AS us');

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
                return Orm_User_Staff::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_User_Staff::to_object($row);
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

    public function get_filters($filters, $alias = 'us')
    {

        $this->db->join(Orm_User::get_table_name(), Orm_User::get_table_name().".id = {$alias}.user_id", 'INNER');

        parent::get_filters($filters, Orm_User::get_table_name());

        if (isset($filters['user_id'])) {
            $this->db->where("{$alias}.user_id", $filters['user_id']);
        }
        if (!empty($filters['role_id'])) {
            $this->db->where("{$alias}.role_id", $filters['role_id']);
        }
        if (isset($filters['role_in'])) {
            $this->db->where_in("{$alias}.role_id", $filters['role_in']);
        }
        if (!empty($filters['unit_id'])) {
            $this->db->where("{$alias}.unit_id", $filters['unit_id']);
        }
        // Added by shamaseen
        if (!empty($filters['campus_in'])) {
            $this->db->where_in("{$alias}.campus_id", $filters['campus_in']);
        }

        if (!empty($filters['campus_id'])) {
            $this->db->where("{$alias}.campus_id", $filters['campus_id']);
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
        if (!empty($filters['service_time']) && is_array($filters['service_time'])) {

            $service_times = array();

            foreach ($filters['service_time'] as $service_time) {
                switch ($service_time) {
                    case Orm_User_Staff::SERVICE_TIME_1_TO_3 :
                        $service_times[] = "({$alias}.service_time >= 1 AND {$alias}.service_time <= 3)";
                        break;

                    case Orm_User_Staff::SERVICE_TIME_4_TO_6 :
                        $service_times[] = "({$alias}.service_time >= 4 AND {$alias}.service_time <= 6)";
                        break;

                    case Orm_User_Staff::SERVICE_TIME_7_TO_10 :
                        $service_times[] = "({$alias}.service_time >= 7 AND {$alias}.service_time <= 10)";
                        break;

                    case Orm_User_Staff::SERVICE_TIME_11_TO_15 :
                        $service_times[] = "({$alias}.service_time >= 11 AND {$alias}.service_time <= 15)";
                        break;

                    case Orm_User_Staff::SERVICE_TIME_16_TO_20 :
                        $service_times[] = "({$alias}.service_time >= 16 AND {$alias}.service_time <= 20)";
                        break;

                    case Orm_User_Staff::SERVICE_TIME_21_TO_25 :
                        $service_times[] = "({$alias}.service_time >= 21 AND {$alias}.service_time <= 25)";
                        break;

                    case Orm_User_Staff::SERVICE_TIME_25_TO_ANY :
                        $service_times[] = "({$alias}.service_time > 25)";
                        break;
                }
            }

            $service_times = '(' . implode(' OR ', $service_times) . ')';

            $this->db->where($service_times);
        }
        if (!empty($filters['job_position']) && is_array($filters['job_position'])) {
            $this->db->where_in("{$alias}.job_position", $filters['job_position']);
        }
    }

    /**
     * replace new row to the table
     * @param array $params
     * @return int
     */
    public function replace($params = array())
    {
        return $this->db->replace(Orm_User_Staff::get_table_name(), $params);
    }

    public function get_by_user_id($user_id)
    {

        $this->db->select('*');
        $this->db->distinct();
        $this->db->from(Orm_User_Staff::get_table_name());
        $this->db->where('user_id', $user_id);

        return $this->db->get()->row_array();
    }

}

