<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Kpi_Detail extends Orm {
    
    /**
    * @var $instances Orm_Kpi_Detail[]
    */
    protected static $instances = array();
    protected static $table_name = 'kpi_detail';

    
    /**
    * class attributes
    */
    protected $id = 0;
    protected $legend_id = 0;
    protected $semester_id = 0;

    const TYPE_INSTITUTION = 0;
    const TYPE_COLLEGE = 1;
    const TYPE_PROGRAM = 2;
    
    /**
    * @return Kpi_Detail_Model
    */
    public static function get_model() {
        return Orm::get_ci_model('Kpi_Detail_Model');
    }
    
    /**
    * get instance
    *
    * @param int $id
    * @return Orm_Kpi_Detail
    */
    public static function get_instance($id) {

        $id = intval($id);
        if(isset(self::$instances[$id])) {
            return self::$instances[$id];
        }
        
        return self::get_one(array('id' => $id));
    }
    
    /**
    * get all Objects
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    *
    * @return Orm_Kpi_Detail[] | int
    */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }
    
    /**
    * get one Object
    *
    * @param array $filters
    * @param array $orders
    * @return Orm_Kpi_Detail
    */
    public static function get_one($filters = array(), $orders = array()) {
        
        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);
        
        if ($result && $result->get_id()) {
            return $result;
        }
        
        return new Orm_Kpi_Detail();
    }
    
    /**
    * get count
    *
    * @param array $filters
    * @return int
    */
    public static function get_count($filters = array()) {
        return self::get_model()->get_all($filters, 0, 0, array(), Orm::FETCH_COUNT);
    }
    
    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['legend_id'] = $this->get_legend_id();
        $db_params['semester_id'] = $this->get_semester_id();
        
        return $db_params;
    }

    public function save() {
        if ($this->get_object_status() == 'new') {
            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);
        } elseif($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }

        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this->get_id();
    }
    
    public function delete() {
        return self::get_model()->delete($this->get_id());
    }
    
    public function set_id($value) {
        $this->add_object_field('id',$value);
        $this->id = $value;
        $this->push_instance();
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function set_legend_id($value) {
        $this->add_object_field('legend_id',$value);
        $this->legend_id = $value;
    }
    
    public function get_legend_id() {
        return $this->legend_id;
    }
    
    public function set_semester_id($value) {
        $this->add_object_field('semester_id',$value);
        $this->semester_id = $value;
    }
    
    public function get_semester_id() {
        return $this->semester_id;
    }

    /**
     * draw the value of KPI in charts  depends on specific parameters
     * @param $level_id
     * @param $benchmark
     * @param int $type
     * @param array $filters
     * @param Orm_Kpi $kpi
     * @return string
     */
    public static function draw_kpi_chart_values($level_id, $benchmark, $type = 0, $filters = array(), $kpi = null) {

        $values = array();

        $level = Orm_Kpi_Level::get_instance($level_id);
        $level_legends = $level->get_legends();

        foreach ($level_legends as $level_legend) {
            $filters['legend_id'] = $level_legend->get_id();

            switch ($type) {

                case self::TYPE_COLLEGE :
                    $values[] = Orm_Kpi_College_Value::get_one($filters)->to_array();
                    break;

                case self::TYPE_PROGRAM :
                    $values[] = Orm_Kpi_Program_Value::get_one($filters)->to_array();
                    break;

                default:
                    $values[] = Orm_Kpi_Institution_Value::get_one($filters)->to_array();
                    break;
            }
        }
        $columns_values = array_column($values, $benchmark);

        if ($kpi->get_overall()) {
            $count = 0;
            $overall_value = 0;
            foreach ($columns_values as $value) {
                $overall_value += (double) round($value, 2);
                if ($value != 0) {
                    $count++;
                }
            }
            $overall_value = $count ? round($overall_value / $count, 2) : 0;
        } else {
            $overall_value = implode(',', $columns_values);
        }
        return $overall_value ? $overall_value : 0;
    }

    /**
     * draw the value of KPI  depends on specific parameters
     * @param $level_id
     * @param $benchmark
     * @param int $type
     * @param array $filters
     * @param Orm_Kpi $kpi
     * @return float|int|string
     */
    public static function draw_kpi_values($level_id, $benchmark, $type = 0, $filters = array(), $kpi = null) {

        $values = array();

        $level = Orm_Kpi_Level::get_instance($level_id);
        $level_legends = $level->get_legends();

        foreach ($level_legends as $level_legend) {
            $filters['legend_id'] = $level_legend->get_id();

            switch ($type) {

                case self::TYPE_COLLEGE :

                    $benchmarks = Orm_Kpi_College_Value::get_one($filters)->to_array();
                    $values[$level_legend->get_title()] = $benchmarks[$benchmark];
                    break;

                case self::TYPE_PROGRAM :
                    $benchmarks = Orm_Kpi_Program_Value::get_one($filters)->to_array();
                    $values[$level_legend->get_title()] = $benchmarks[$benchmark];
                    break;

                default:
                    $benchmarks = Orm_Kpi_Institution_Value::get_one($filters)->to_array();
                    $values[$level_legend->get_title()] = $benchmarks[$benchmark];
                    break;
            }
        }

        if ($kpi->get_overall()) {
            $overall_value = count($values) ? round(array_sum($values) / count($values), 2) : 0;
        } else {
                $overall_value = $values;
        }
        return $overall_value;
    }

    /**
     * draw the input of KPI value depends on specific parameters
     * @param $level_id
     * @param $benchmark
     * @param int $type
     * @param array $filters
     * @return string
     */
    public static function draw_kpi_values_inputs($level_id, $benchmark, $type = 0, $filters = array()) {
        $html = '';

        $level = Orm_Kpi_Level::get_instance($level_id);
        $level_legends = $level->get_legends();

        foreach ($level_legends as $level_legend) {
            $filters['legend_id'] = $level_legend->get_id();

            switch ($type) {

                case self::TYPE_COLLEGE :
                    $row = Orm_Kpi_College_Value::get_one($filters);
                    $function_name = 'get_' . $benchmark;
                    $html .= '<td><input class="form-control" name="' . htmlfilter($benchmark) . '[' . htmlfilter($level_legend->get_id()) . ']" value="' . htmlfilter($row->$function_name()) . '"></td>';
                    break;

                case self::TYPE_PROGRAM :
                    $row = Orm_Kpi_Program_Value::get_one($filters);
                    $function_name = 'get_' . $benchmark;
                    $html .= '<td><input class="form-control" name="' . htmlfilter($benchmark) . '[' . htmlfilter($level_legend->get_id()) . ']" value="' . htmlfilter($row->$function_name()) . '"></td>';
                    break;

                default:
                    $row = Orm_Kpi_Institution_Value::get_one($filters);
                    $function_name = 'get_' . $benchmark;
                    $html .= '<td><input class="form-control" name="' .htmlfilter( $benchmark) . '[' . htmlfilter($level_legend->get_id()) . ']" value="' . htmlfilter($row->$function_name()) . '"></td>';
                    break;
            }
        }
        return $html;
    }

    /**
     * draw the input of external benchmark depends on specific parameters
     * @param $level_id
     * @param $label
     * @param int $type
     * @param array $filters
     * @return string
     */
    public static function draw_kpi_external_benchmarks_inputs($level_id, $label, $type = 0, $filters = array()) {
        $html = '';

        $level = Orm_Kpi_Level::get_instance($level_id);
        $level_legends = $level->get_legends();

        foreach ($level_legends as $level_legend) {
            $filters['legend_id'] = $level_legend->get_id();

            switch ($type) {

                case self::TYPE_COLLEGE :
                    $row = Orm_Kpi_College_Value::get_one($filters);
                    $html .= '<td><input class="form-control" name="external_values_' . htmlfilter($level_legend->get_id()) . '[]" value="' . htmlfilter($row->get_external_benchmark_by_label($label)) . '"></td>';
                    break;

                case self::TYPE_PROGRAM :
                    $row = Orm_Kpi_Program_Value::get_one($filters);
                    $html .= '<td><input class="form-control" name="external_values_' . htmlfilter($level_legend->get_id()) . '[]" value="' . htmlfilter($row->get_external_benchmark_by_label($label)) . '"></td>';
                    break;

                default:
                    $row = Orm_Kpi_Institution_Value::get_one($filters);
                    $html .= '<td><input class="form-control" name="external_values_' . htmlfilter($level_legend->get_id()) . '[]" value="' . htmlfilter($row->get_external_benchmark_by_label($label)) . '"></td>';
                    break;
            }
        }
        return $html;
    }

    /**
     * draw the  external benchmark chart depends on specific parameters
     * @param $level_id
     * @param $label
     * @param int $type
     * @param array $filters
     * @param Orm_Kpi $kpi
     * @return float|int|string
     */
    public static function draw_kpi_external_benchmarks_chart($level_id, $label, $type = 0, $filters = array(), $kpi = null) {

        $level = Orm_Kpi_Level::get_instance($level_id);
        $level_legends = $level->get_legends();
        $values = array();

        foreach ($level_legends as $level_legend) {
            $filters['legend_id'] = $level_legend->get_id();

            switch ($type) {

                case self::TYPE_COLLEGE :
                    $row = Orm_Kpi_College_Value::get_one($filters);
                    $values[] = $row->get_external_benchmark_by_label($label);
                    break;

                case self::TYPE_PROGRAM :
                    $row = Orm_Kpi_Program_Value::get_one($filters);
                    $values[] = $row->get_external_benchmark_by_label($label);
                    break;

                default:
                    $row = Orm_Kpi_Institution_Value::get_one($filters);
                    $values[] = $row->get_external_benchmark_by_label($label);
                    break;
            }
        }

        if ($kpi->get_overall()) {
            $overall_value = 0;
            foreach ($values as $value) {
                $overall_value += (double) $value;
            }
            $overall_value = count($values) ? $overall_value / count($values) : 0;
        } else {
            $overall_value = implode(',', $values);
        }
        return $overall_value;
    }

    /**
     * draw the external benchmark depends on specific parameters
     * @param $legend_id
     * @param int $type
     * @param array $filters
     * @param null $kpi
     * @return mixed
     */
    public static function get_external_benchmarks($legend_id, $type = 0, $filters = array(), $kpi=null) {
        $filters['legend_id'] = $legend_id;
        switch ($type) {
            case self::TYPE_COLLEGE :
                $row = Orm_Kpi_College_Value::get_one($filters);
                $benchmarks = $row->get_external_benchmark_array();
                break;

            case self::TYPE_PROGRAM :
                $row = Orm_Kpi_Program_Value::get_one($filters);
                $benchmarks = $row->get_external_benchmark_array();
                break;

            default:
                $row = Orm_Kpi_Institution_Value::get_one($filters);
                $benchmarks = $row->get_external_benchmark_array();
                break;
        }
        return $benchmarks;
    }

    /**
     * get the value of KPI depends on Institution level
     * @return Orm_Kpi_Institution_Value
     */
    public function get_institution_value() {
        return Orm_Kpi_Institution_Value::get_one(array('detail_id' => $this->get_id()));
    }

    /**
     * get the value of KPI depends on college level and college id
     * @param $college_id
     * @return Orm_Kpi_College_Value
     */
    public function get_college_value($college_id) {
        return Orm_Kpi_College_Value::get_one(array('detail_id' => $this->get_id(), 'college_id' => $college_id));
    }

    /**
     * get the value of KPI depends on program level and program id
     * @param $program_id
     * @return Orm_Kpi_Program_Value
     */
    public function get_program_value($program_id) {
        return Orm_Kpi_Program_Value::get_one(array('detail_id' => $this->get_id(), 'program_id' => $program_id));
    }
}

