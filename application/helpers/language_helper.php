<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function lang($string) {
    $key_string = trim(str_replace(array(' ', "'", "\n", "\r", "\t", "<br>"), array('_', '', '_', '', '', '<\br>'), strtolower(trim($string))));

    if ($key_string) {

        $line = get_instance()->lang->line($key_string);

        if (empty($line) && ENVIRONMENT == 'development') {
            $languages = get_instance()->config->item('languages');
            if ($languages) {
                foreach ($languages as $lang_key => $lang_value) {
                    $trans_obj = Orm_Translation::get_one(array('string' => $key_string, 'language_id' => $lang_value));
                    if (!$trans_obj->get_id()) {
                        $trans_obj->set_language_id($lang_value);
                        $trans_obj->set_string($key_string);
                        $trans_obj->set_translation($string);
                        $trans_obj->save();
                    }

                    $translation = str_replace("'", "\'", $string);
                    $txt = "\$lang['{$key_string}'] = '{$translation}';";

                    $file = APPPATH . "language/{$lang_key}/all_lang.php";

                    if(file_exists($file)) {
                        file_put_contents($file, $txt.PHP_EOL , FILE_APPEND);
                    } else {
                        Orm_Translation::generate_lang_file();
                    }
                }
            }
        } elseif (!empty($line)) {
            $string = $line;
        }
    }

    return $string;
}
