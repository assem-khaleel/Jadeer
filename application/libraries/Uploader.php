<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploader {

    public static function move_file_to($input_name, $dest, $index = NULL) {

        if (isset($_FILES[$input_name])) {
            $file_item = $_FILES[$input_name];

            if (!is_dir(dirname($dest))) {
                mkdir(dirname($dest), 0755, true);
            }

            if ($file_item) {
                if (NULL !== $index AND isset($file_item['tmp_name'][$index])) {
                    move_uploaded_file($file_item['tmp_name'][$index], $dest);
                } elseif ($file_item['tmp_name']) {
                    move_uploaded_file($file_item['tmp_name'], $dest);
                }
            }
        }
    }

    public static function get_file_extension($input_name) {

        if (isset($_FILES[$input_name])) {
            $file_item = $_FILES[$input_name];

            if (is_array($file_item['name'])) {
                $extensions = array();
                foreach ($file_item['name'] as $index => $value) {
                    if ($value) {
                        $explode = explode(".", strtolower($value));
                        $file_ext = end($explode);
                        $extensions[$value] = $file_ext;
                    }
                }
                return $extensions;
            } else {
                if ($file_item['name']) {
                    $explode = explode(".", strtolower($file_item['name']));
                    $file_ext = end($explode);
                    return $file_ext;
                }
            }
        }
    }

    public static function zero_size_validator($field_name, $input_name = '', $error_msg = '') {

        if (isset($_FILES[$input_name])) {
            $file_item = $_FILES[$input_name];
            if (is_array($file_item['size'])) {
                foreach ($file_item['size'] as $index => $value) {
                    if (0 === $value) {
                        Validator::set_error($field_name, $error_msg, $index);
                    }
                }
            } else {
                if (0 === (int)$file_item['size']) {
                    Validator::set_error($field_name, $error_msg);
                }
            }
        }

    }

    public static function max_size_validator($field_name, $input_name = '', $max_size = 1024 /* 1K */, $error_msg = '') {
        if (isset($_FILES[$input_name])) {

            $size = '' . $max_size;
            $unit = strtolower(substr($size, strlen($size) - 1));
            $n = 1;
            switch ($unit) {
                case 'm':
                    $n = 1048576;
                    break;
                case 'g':
                    $n = 1073741824;
                    break;
                default : //'k'
                    $n = 1024;
                    break;
            }
            $max_size = intval($size) * $n;

            $file_item = $_FILES[$input_name];
            if (is_array($file_item['size'])) {
                foreach ($file_item['size'] as $index => $value) {
                    if ($value > $max_size) {
                        Validator::set_error($field_name, $error_msg, $index);
                    }
                }
            } else {
                if ($file_item['size'] > $max_size) {
                    Validator::set_error($field_name, $error_msg);
                }
            }
        }
    }

    public static function mime_type_validator($field_name, $input_name = '', $mime_types = array(), $error_msg = '') {
        if (isset($_FILES[$input_name])) {
            $file_item = $_FILES[$input_name];
            if (!is_array($mime_types)) {
                $mime_types = array($mime_types);
            }
            $lower_mime_types = array();
            foreach ($mime_types as $mime_type) {
                $lower_mime_types[strtolower($mime_type)] = strtolower($mime_type);
            }
            if (is_array($file_item['type'])) {
                foreach ($file_item['type'] as $index => $value) {
                    if ($value) {
                        if (!isset($lower_mime_types[strtolower($value)])) {
                            Validator::set_error($field_name, $error_msg, $index);
                        }
                    }
                }
            } else {
                if ($file_item['type']) {
                    if (!isset($lower_mime_types[strtolower($file_item['type'])])) {
                        Validator::set_error($field_name, $error_msg);
                    }
                }
            }
        }
    }

    public static function extension_validator($field_name, $input_name = '', $exts = array(), $error_msg = '') {
        if (isset($_FILES[$input_name])) {
            $file_item = $_FILES[$input_name];
            if (!is_array($exts)) {
                $exts = array($exts);
            }
            $lower_exts = array();
            foreach ($exts as $ext) {
                if ($ext) {
                    $lower_exts[strtolower($ext)] = strtolower($ext);
                }
            }

            if (is_array($file_item['name'])) {
                foreach ($file_item['name'] as $index => $value) {
                    if ($value) {
                        $explode = explode(".", strtolower($value));
                        $file_ext = end($explode);
                        if (!isset($lower_exts[$file_ext])) {
                            Validator::set_error($field_name, $error_msg, $index);
                        }
                    }
                }
            } else {
                if ($file_item['name']) {
                    $explode = explode(".", strtolower($file_item['name']));
                    $file_ext = end($explode);
                    if (!isset($lower_exts[$file_ext])) {
                        Validator::set_error($field_name, $error_msg);
                    }
                }
            }
        }
    }

    public static function forbidden_extension_validator($field_name, $input_name = '', $exts = array(), $error_msg = '') {
        if (isset($_FILES[$input_name])) {
            $file_item = $_FILES[$input_name];
            if (!is_array($exts)) {
                $exts = array($exts);
            }
            $lower_exts = array();
            foreach ($exts as $ext) {
                if ($ext) {
                    $lower_exts[strtolower($ext)] = strtolower($ext);
                }
            }

            if (is_array($file_item['name'])) {
                foreach ($file_item['name'] as $index => $value) {
                    if ($value) {
                        $explode = explode(".", strtolower($value));
                        $file_ext = end($explode);
                        if (isset($lower_exts[$file_ext])) {
                            Validator::set_error($field_name, $error_msg, $index);
                        }
                    }
                }
            } else {
                if ($file_item['name']) {
                    $explode = explode(".", strtolower($file_item['name']));
                    $file_ext = end($explode);
                    if (isset($lower_exts[$file_ext])) {
                        Validator::set_error($field_name, $error_msg);
                    }
                }
            }
        }
    }

    public static function common_validator($field_name, $input_name = '') {
        if (isset($_FILES[$input_name])) {
            $file_item = $_FILES[$input_name];
            if (is_array($file_item['error'])) {
                foreach ($file_item['error'] as $index => $value) {
                    if ($value) {
                        Validator::set_error($field_name, self::code_to_message($value), $index);
                    }
                }
            } else {
                if ($file_item['error']) {
                    Validator::set_error($field_name, self::code_to_message($file_item['error']));
                }
            }
        }
    }

    public static function image_size_validator($field_name, $input_name = '', $width = 16, $height = 16, $error_msg = '') {
        if (isset($_FILES[$input_name])) {
            $file_item = $_FILES[$input_name];

            if (is_array($file_item['tmp_name'])) {
                foreach ($file_item['tmp_name'] as $index => $value) {
                    if ($value) {

                        list($img_width, $img_height) = getimagesize($value);

                        if(!($width==$img_width && $height==$img_height)) {
                            Validator::set_error($field_name, $error_msg, $index);
                        }
                    }
                }
            } else {
                if ($file_item['tmp_name']) {
                    list($img_width, $img_height) = getimagesize($file_item['tmp_name']);

                    if(!($width==$img_width && $height==$img_height)) {
                        Validator::set_error($field_name, $error_msg);
                    }
                }
            }
        }
    }

    private static function code_to_message($code) {
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
                $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = "The uploaded file was only partially uploaded";
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = "No file was uploaded";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = "Missing a temporary folder";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = "Failed to write file to disk";
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = "File upload stopped by extension";
                break;

            default:
                $message = "Unknown upload error";
                break;
        }
        return lang($message);
    }

    public static function get_file_name($input_name, $dest, $overwrite = true, $index = NULL) {

        $file_name = '';
        if (isset($_FILES[$input_name])) {
            $file_item = $_FILES[$input_name];

            if (NULL !== $index) {
                if ($overwrite) {
                    $file_name = $file_item['name'][$index];
                } else {
                    $file_name = self::unique_name($dest, $file_item['name'][$index]);
                }
            } else {
                if ($overwrite) {
                    $file_name = $file_item['name'];
                } else {
                    $file_name = self::unique_name($dest, $file_item['name']);
                }
            }
        }

        return rtrim($dest, '/') . '/' . $file_name;
    }

    private static function unique_name($dir, $name, $suffix = '-') {

        $dir = FCPATH . trim($dir, '/') . '/';

        if (file_exists($dir . $name)) {

            $ext = '';

            if (preg_match('/\.((tar\.(gz|bz|bz2|z|lzo))|cpio\.gz|ps\.gz|xcf\.(gz|bz2)|[a-z0-9]{1,4})$/i', $name, $m)) {
                $ext = '.' . $m[1];
                $name = substr($name, 0, strlen($name) - strlen($m[0]));
            }

            $i = 1;
            
            $name .= $suffix;

            $max = $i + 100;

            while ($i <= $max) {
                $new_name = $name . ($i > 0 ? $i : '') . $ext;

                if (!file_exists($dir . $new_name)) {
                    return $new_name;
                }

                $i++;
            }

            return $name . uniqid() . $ext;
        }

        return $name;
    }

    public static function draw_file_upload($object, $name, $label, $output_html = null) {

        $uniqid = uniqid('file-');

        $function_name = "get_{$name}";
        $file = $object->$function_name() && file_exists(FCPATH . $object->$function_name());

        ob_start();
        ?>
        <div class="well well-sm">
            <div class="form-group">
                <label class="control-label"><?php echo $label; ?></label>

                <div class="m-b-1" >
                    <label id="<?php echo $uniqid ?>" class="custom-file px-file">
                        <input type="file" class="custom-file-input" name="<?php echo $name ?>" class="m-a-1">
                        <span class="custom-file-control form-control"> <?php echo lang('Choose file...'); ?></span>
                        <div class="px-file-buttons">
                            <button type="button" class="btn px-file-clear"><?php echo lang('Clear'); ?></button>
                            <button type="button" class="btn btn-primary px-file-browse"><?php echo lang('Browse'); ?></button>
                        </div>
                    </label>
                    <?php echo Validator::get_html_error_message($name); ?>
                </div>
                <?php
                if($file) {

                    if(is_null($output_html)) {
                        $output_html = '<a href="' . htmlfilter($object->$function_name()) . '" target="_blank" >' . lang('Download') . '</a>';
                    }

                    echo $output_html;
                }
                ?>
            </div>
            <script>
                $('#<?php echo $uniqid ?>').pxFile();
            </script>
        </div>
        <?php
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }

    public static function validator($name, $required = true, $file = null, array $mime_allow = array(), $max_size = null) {

        $file_exists = $file && file_exists(FCPATH . ltrim(str_replace(FCPATH, '', $file), DIRECTORY_SEPARATOR));

        $ci = get_instance();

        if(is_null($max_size)) {
            $max_size = $ci->config->item('upload_max_size');
        }

        if(empty($mime_allow)) {
            $mime_allow = $ci->config->item('upload_allow');
        }

        if($required && !$file_exists) {
            self::common_validator($name, $name);
            self::zero_size_validator($name, $name, lang('File not found.'));
        }

        self::max_size_validator($name, $name, $max_size, lang('File exceeds maximum allowed size.'));
        self::mime_type_validator($name, $name, $mime_allow, lang('File type not allowed.'));

    }

    public static function do_process($name, $path) {

        $size = intval(isset($_FILES[$name]['size']) ? $_FILES[$name]['size'] : 0);

        if($size === 0) {
            return null;
        }

        $file_path = $path . '.' . self::get_file_extension($name);
        $full_path = rtrim(FCPATH, '/') . $file_path;

        self::move_file_to($name, $full_path);

        return $file_path;

    }
}
