<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(__DIR__ . '/Uploader.php');

class Uploader_Image extends Uploader {

    /**
     * Resize image
     *
     * @param  string   $path               image file
     * @param  int      $width              new width
     * @param  int      $height             new height
     * @param  bool	    $keepProportions    crop image
     * @param  bool	    $resizeByBiggerSide resize image based on bigger side if true
     * @param  string   $destformat         image destination format
     * @param  string   $type               auto|imagick|mogtify|gd
     * @return string|false
     * @author Dmitry (dio) Levashov
     * @author Alexey Sukhotin
     **/
    public static function imgResize($path, $width, $height, $keepProportions = false, $resizeByBiggerSide = true, $destformat = null, $type = 'auto') {

        if (($type == 'imagick' || $type == 'auto') && extension_loaded('imagick')) {
            $imgLib = 'imagick';
        } else {
            $imgLib = function_exists('gd_info') ? 'gd' : '';
        }

        if (($s = @getimagesize($path)) == false) {
            return false;
        }

        $result = false;

        list($size_w, $size_h) = array($width, $height);

        if ($keepProportions == true) {

            list($orig_w, $orig_h) = array($s[0], $s[1]);

            /* Resizing by biggest side */
            if ($resizeByBiggerSide) {
                if ($orig_w > $orig_h) {
                    $size_h = round($orig_h * $width / $orig_w);
                    $size_w = $width;
                } else {
                    $size_w = round($orig_w * $height / $orig_h);
                    $size_h = $height;
                }
            } else {
                if ($orig_w > $orig_h) {
                    $size_w = round($orig_w * $height / $orig_h);
                    $size_h = $height;
                } else {
                    $size_h = round($orig_h * $width / $orig_w);
                    $size_w = $width;
                }
            }
        }

        switch ($imgLib) {
            case 'imagick':

                try {
                    $img = new imagick($path);
                } catch (Exception $e) {
                    return false;
                }

                // Imagick::FILTER_BOX faster than FILTER_LANCZOS so use for createTmb
                // resize bench: http://app-mgng.rhcloud.com/9
                // resize sample: http://www.dylanbeattie.net/magick/filters/result.html
                $filter = ($destformat === 'png' /* createTmb */)? Imagick::FILTER_BOX : Imagick::FILTER_LANCZOS;

                $ani = ($img->getNumberImages() > 1);
                if ($ani && is_null($destformat)) {
                    $img = $img->coalesceImages();
                    do {
                        $img->resizeImage($size_w, $size_h, $filter, 1);
                    } while ($img->nextImage());
                    $img = $img->optimizeImageLayers();
                    $result = $img->writeImages($path, true);
                } else {
                    if ($ani) {
                        $img->setFirstIterator();
                    }
                    $img->resizeImage($size_w, $size_h, $filter, 1);
                    $result = $img->writeImage($path);
                }

                $img->destroy();

                return $result ? $path : false;

                break;

            case 'gd':
                $img = self::gdImageCreate($path,$s['mime']);

                if ($img &&  false != ($tmp = imagecreatetruecolor($size_w, $size_h))) {

                    self::gdImageBackground($tmp,'#ffffff');

                    if (!imagecopyresampled($tmp, $img, 0, 0, 0, 0, $size_w, $size_h, $s[0], $s[1])) {
                        return false;
                    }

                    $result = self::gdImage($tmp, $path, $destformat, $s['mime']);

                    imagedestroy($img);
                    imagedestroy($tmp);

                    return $result ? $path : false;

                }
                break;
        }

        return $result;
    }

    /**
     * Crop image
     *
     * @param  string   $path               image file
     * @param  int      $width              crop width
     * @param  int      $height             crop height
     * @param  bool	    $x                  crop left offset
     * @param  bool	    $y                  crop top offset
     * @param  string   $destformat         image destination format
     * @param  string   $type               auto|imagick|mogtify|gd
     * @return string|false
     * @author Dmitry (dio) Levashov
     * @author Alexey Sukhotin
     **/
    public static function imgCrop($path, $width, $height, $x, $y, $destformat = null, $type = 'auto') {

        if (($type == 'imagick' || $type == 'auto') && extension_loaded('imagick')) {
            $imgLib = 'imagick';
        } else {
            $imgLib = function_exists('gd_info') ? 'gd' : '';
        }

        if (($s = @getimagesize($path)) == false) {
            return false;
        }

        $result = false;

        switch ($imgLib) {
            case 'imagick':

                try {
                    $img = new imagick($path);
                } catch (Exception $e) {
                    return false;
                }

                $ani = ($img->getNumberImages() > 1);
                if ($ani && is_null($destformat)) {
                    $img = $img->coalesceImages();
                    do {
                        $img->setImagePage($s[0], $s[1], 0, 0);
                        $img->cropImage($width, $height, $x, $y);
                        $img->setImagePage($width, $height, 0, 0);
                    } while ($img->nextImage());
                    $img = $img->optimizeImageLayers();
                    $result = $img->writeImages($path, true);
                } else {
                    if ($ani) {
                        $img->setFirstIterator();
                    }
                    $img->setImagePage($s[0], $s[1], 0, 0);
                    $img->cropImage($width, $height, $x, $y);
                    $img->setImagePage($width, $height, 0, 0);
                    $result = $img->writeImage($path);
                }

                $img->destroy();

                return $result ? $path : false;

                break;

            case 'gd':
                $img = self::gdImageCreate($path,$s['mime']);

                if ($img &&  false != ($tmp = imagecreatetruecolor($width, $height))) {

                    self::gdImageBackground($tmp, '#ffffff');

                    $size_w = $width;
                    $size_h = $height;

                    if ($s[0] < $width || $s[1] < $height) {
                        $size_w = $s[0];
                        $size_h = $s[1];
                    }

                    if (!imagecopy($tmp, $img, 0, 0, $x, $y, $size_w, $size_h)) {
                        return false;
                    }

                    $result = self::gdImage($tmp, $path, $destformat, $s['mime']);

                    imagedestroy($img);
                    imagedestroy($tmp);

                    return $result ? $path : false;

                }
                break;
        }

        return $result;
    }

    /**
     * Create an gd image according to the specified mime type
     *
     * @param string $path image file
     * @param string $mime
     * @return gd image resource identifier
     */
    protected static function gdImageCreate($path,$mime){
        switch($mime){
            case 'image/jpeg':
                return imagecreatefromjpeg($path);

            case 'image/png':
                return imagecreatefrompng($path);

            case 'image/gif':
                return imagecreatefromgif($path);

            case 'image/xbm':
                return imagecreatefromxbm($path);
        }
        return false;
    }

    /**
     * Assign the proper background to a gd image
     *
     * @param resource $image gd image resource
     * @param string $bgcolor background color in #rrggbb format
     */
    protected static function gdImageBackground($image, $bgcolor){

        if( $bgcolor == 'transparent' ){
            imagesavealpha($image,true);
            $bgcolor1 = imagecolorallocatealpha($image, 255, 255, 255, 127);

        }else{
            list($r, $g, $b) = sscanf($bgcolor, "#%02x%02x%02x");
            $bgcolor1 = imagecolorallocate($image, $r, $g, $b);
        }

        imagefill($image, 0, 0, $bgcolor1);
    }

    /**
     * Output gd image to file
     *
     * @param resource $image gd image resource
     * @param string $filename The path to save the file to.
     * @param string $destformat The Image type to use for $filename
     * @param string $mime The original image mime type
     */
    protected static function gdImage($image, $filename, $destformat, $mime ){

        if ($destformat == 'jpg' || ($destformat == null && $mime == 'image/jpeg')) {
            return imagejpeg($image, $filename, 100);
        }

        if ($destformat == 'gif' || ($destformat == null && $mime == 'image/gif')) {
            return imagegif($image, $filename, 7);
        }

        return imagepng($image, $filename, 7);
    }

    public static function draw_file_upload($object, $name, $label, $output_html = null) {

        $function_name = "get_{$name}";
        $file_path = htmlfilter($object->$function_name());

        if(is_null($output_html)) {
            $output_html = "<img src='{$file_path}' class='img-thumbnail img-rounded' >";
        }

        return parent::draw_file_upload($object, $name, $label, $output_html);

    }

    public static function validator($name, $required = true, $file = null, array $mime_allow = array(), $max_size = null) {

        if(empty($mime_allow)) {
            $mime_allow = array('image/png', 'image/gif', 'image/jpeg', 'image/xbm');
        }

        parent::validator($name, $required, $file, $mime_allow, $max_size);
    }

}
