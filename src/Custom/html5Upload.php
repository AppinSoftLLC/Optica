<?php

namespace App\Custom;

class html5Upload
{

    private $absoluteDir = 'uploads';
    private $serverDir;
    private $post;
    public $response = array();

    public function __construct($post)
    {
        $year = date('Y');
        $month = date('m');

        $this->serverDir = $this->absoluteDir . '/' . $year . '/' . $month;

        if (!file_exists($this->serverDir)) {
            mkdir($this->serverDir, 0777, true);
        }

        $this->serverDir = $this->serverDir . '/';

        $this->post = $post;
    }

    public function uploadImage($setting = false)
    {
        if ($this->is_image($this->post['cmsmedia']['tmp_name'])) {
            $filename_raw = explode('.', $this->post['cmsmedia']['name']);
            $filename = preg_replace('/\s+/', '_', $filename_raw[0]) . '.' . strtolower($filename_raw[1]);

            if (file_exists($this->serverDir . $filename)) {
                $this->response['success'] = false;
                $this->response['message'] = 'There is a file with same name';
            } else {
                if (move_uploaded_file($this->post['cmsmedia']['tmp_name'], $this->serverDir . $filename)) {
                    $this->response['success'] = true;
                    $this->response['filename'] = $filename;
                    $this->response['url'] = '/' . $this->serverDir . $filename;
                    $this->response['message'] = 'Success!!!';

                    // $size = explode('x', $setting['imagelarge']);
                    // $this->makeThumbnails($filename, $size[0], $size[1]);

                    // $size = explode('x', $setting['imagemedium']);
                    // $this->makeThumbnails($filename, $size[0], $size[1]);

                    // $size = explode('x', $setting['imagesmall']);
                    // $this->makeThumbnails($filename, $size[0], $size[1]);
                } else {
                    $this->response['success'] = false;
                    $this->response['message'] = 'Failure!!!';
                }
            }
        } else {
            $this->response['success'] = false;
            $this->response['message'] = 'Only JPG files allowed';
        }

        return $this->response;
    }

    public function uploadBase64()
    {
        $data = explode(',', $this->post['data']);
        $imgData = base64_decode($data[1]);

        $name = explode('.', $this->post['name']);
        $index = count($name) - 1;
        $extension = strtolower($name[$index]);
        $filename = $name[0] . '.' . $extension;

        if (!$handle = fopen($this->serverDir . $filename, 'w+')) {
            $response['status'] = 300;
            $response['error'] = 'Can\'t create file';
        }

        if (fwrite($handle, $imgData) === false) {
            $response['status'] = 300;
        } else {
            $response['status'] = 'success';
        }

        fclose($handle);

        $response['url'] = '/' . $this->serverDir . $filename;
        $response['filename'] = $filename;

        return $response;
    }

    public function uploadPDF()
    {

        if ($this->is_pdf($this->post['cmsmedia']['tmp_name'])) {
            $filename = preg_replace('/\s+/', '_', $this->post['cmsmedia']['name']);
            if (file_exists($this->serverDir . $filename)) {
                $this->response['success'] = false;
                $this->response['message'] = 'There is a file with same name';
            } else {
                if (move_uploaded_file($this->post['cmsmedia']['tmp_name'], $this->serverDir . $filename)) {
                    $this->response['success'] = true;
                    $this->response['filename'] = $filename;
                    $this->response['url'] = '/' . $this->serverDir . $filename;
                    $this->response['type'] = 'pdf';
                    $this->response['message'] = 'Success!!!';
                } else {
                    $this->response['success'] = false;
                    $this->response['message'] = 'Failure!!!';
                }
            }
        } else {
            $this->response['success'] = false;
            $this->response['message'] = 'Only PDF files allowed';
        }

        return $this->response;
    }

    private function is_image($path)
    {
        $a = getimagesize($path);
        $image_type = $a[2];
        //IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP
        if (in_array($image_type, array(IMAGETYPE_JPEG, IMAGETYPE_PNG))) {
            return true;
        }
        return false;
    }

    private function is_pdf($path)
    {
        $content = file_get_contents($path);
        $finfo = new finfo(FILEINFO_MIME);
        $mime_type_found = $finfo->buffer($content);
        if ($mime_type_found === 'application/pdf; charset=binary') {
            return true;
        }
        return false;
    }

    private function makeThumbnails($img, $width, $height)
    {
        $arr_image_details = getimagesize($this->serverDir . $img);
        $original_width = $arr_image_details[0];
        $original_height = $arr_image_details[1];
        $ratio = $original_width / $original_height;

        if ($width / $height > $ratio) {
            $newWidth = $height * $ratio;
            $newHeight = $height;
        } else {
            $newWidth = $width;
            $newHeight = $width / $ratio;
        }

        if ($arr_image_details[2] == IMAGETYPE_GIF) {
            $imgt = "ImageGIF";
            $imgcreatefrom = "ImageCreateFromGIF";
        }
        if ($arr_image_details[2] == IMAGETYPE_JPEG) {
            $imgt = "ImageJPEG";
            $imgcreatefrom = "ImageCreateFromJPEG";
        }
        if ($arr_image_details[2] == IMAGETYPE_PNG) {
            $imgt = "ImagePNG";
            $imgcreatefrom = "ImageCreateFromPNG";
        }
        if ($imgt) {
            $old_image = $imgcreatefrom($this->serverDir . $img);
            $new_image = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresized($new_image, $old_image, 0, 0, 0, 0, $newWidth, $newHeight, $original_width, $original_height);
            $name = explode('.', $img);
            $imgt($new_image, $this->serverDir . $name[0] . '_' . $width . '.' . $name[1]);
        }
    }

}
