<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migrate
 *
 * @property CI_Migration $migration
 */
class Migrate extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!is_cli()) {
            exit('No direct script access allowed');
        }
    }

    public function index()
    {
        $this->load->library('migration');

        if ($this->migration->current() === FALSE)
        {
            show_error($this->migration->error_string());
        }
    }

    public function publish_translation() {

        $translations = $this->parse_csv_file(APPPATH . "migrations/translation.csv");

        $count = count($translations);
        $i = 0;
        foreach($translations as $translation) {
            $i++;
            error_log("{$i} / {$count}");

            $key_string = trim(str_replace(array(' ', "'", "\n", "\r", "\t"), array('_', '', '_', '', ''), strtolower(trim($translation['LANG_KEY']))));

            $languages = $this->config->item('languages');
            if ($languages) {
                foreach ($languages as $lang_key => $lang_value) {
                    $this->db->set('string', $key_string);
                    $this->db->set('translation', (isset($translation["LANG_{$lang_value}"]) ? $translation["LANG_{$lang_value}"] : $translation['LANG_KEY']));
                    $this->db->set('language_id', $lang_value);
                    $this->db->insert('translation');
                }
            }
        }
    }

    private function parse_csv_file($file_path)
    {
        $result = array();

        if (file_exists($file_path)) {

            $file = fopen($file_path, "r");

            $keys = fgetcsv($file, null, '|');

            if ($keys) {

                $row = 0;
                while (!feof($file)) {
                    if ($row > 0) {
                        $values = fgetcsv($file, null, '|');
                        if($values) {
                            if(count($values) == count($keys)) {
                                $result[] = array_combine($keys, $values);
                            } else {
                                error_log('Error: in (' . print_r($values, true) . ')');
                            }
                        }
                    }
                    $row++;
                }
            }

            fclose($file);
        }

        return $result;
    }
}