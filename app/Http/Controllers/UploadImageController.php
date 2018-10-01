<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\upload_img;

class UploadImageController extends Controller
{
    public function handleUpload($uploadDirectory, $newDirectory, $name = null){

        if (is_writable($this->chunksFolder) &&
            1 == mt_rand(1, 1/$this->chunksCleanupProbability)){

            // Run garbage collection
            $this->cleanupChunks();
        }

        // Check that the max upload size specified in class configuration does not
        // exceed size allowed by server config
        if ($this->toBytes(ini_get('post_max_size')) < $this->sizeLimit ||
            $this->toBytes(ini_get('upload_max_filesize')) < $this->sizeLimit){
            $neededRequestSize = max(1, $this->sizeLimit / 1024 / 1024) . 'M';
            return array('error'=>"Server error. Increase post_max_size and upload_max_filesize to ".$neededRequestSize);
        }

        if ($this->isInaccessible($uploadDirectory)){
            return array('error' => "Server error. Uploads directory isn't writable");
        }

        $type = $_SERVER['CONTENT_TYPE'];
        if (isset($_SERVER['HTTP_CONTENT_TYPE'])) {
            $type = $_SERVER['HTTP_CONTENT_TYPE'];
        }

        if(!isset($type)) {
            return array('error' => "No files were uploaded.");
        } else if (strpos(strtolower($type), 'multipart/') !== 0){
            return array('error' => "Server error. Not a multipart request. Please set forceMultipart to default value (true).");
        }

        // Get size and name
        $file = $_FILES[$this->inputName];
        $size = $file['size'];
        if (isset($_REQUEST['qqtotalfilesize'])) {
            $size = $_REQUEST['qqtotalfilesize'];
        }

        if ($name === null){
            $name = $this->getName();
        }

        // check file error
        if($file['error']) {
            return array('error' => 'Upload Error #'.$file['error']);
        }

        // Validate name
        if ($name === null || $name === ''){
            return array('error' => 'File name empty.');
        }

        // Validate file size
        if ($size == 0){
            return array('error' => 'File is empty.');
        }

        if (!is_null($this->sizeLimit) && $size > $this->sizeLimit) {
            return array('error' => 'File is too large.', 'preventRetry' => true);
        }

        // Validate file extension
        $pathinfo = pathinfo($name);
        $ext = isset($pathinfo['extension']) ? $pathinfo['extension'] : '';

        if($this->allowedExtensions && !in_array(strtolower($ext), array_map("strtolower", $this->allowedExtensions))){
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'File has an invalid extension, it should be one of '. $these . '.');
        }

        // Save a chunk
        $totalParts = isset($_REQUEST['qqtotalparts']) ? (int)$_REQUEST['qqtotalparts'] : 1;

        $uuid = $_REQUEST['qquuid'];
        if ($totalParts > 1){
            # chunked upload

            $chunksFolder = $this->chunksFolder;
            $partIndex = (int)$_REQUEST['qqpartindex'];

            if (!is_writable($chunksFolder) && !is_executable($uploadDirectory)){
                return array('error' => "Server error. Chunks directory isn't writable or executable.");
            }

            $targetFolder = $this->chunksFolder.DIRECTORY_SEPARATOR.$uuid;

            if (!file_exists($targetFolder)){
                mkdir($targetFolder, 0777, true);
            }

            $target = $targetFolder.'/'.$partIndex;
            $success = move_uploaded_file($_FILES[$this->inputName]['tmp_name'], $target);

            return array("success" => true, "uuid" => $uuid);

        }
        else {
            # non-chunked upload

            $target = join(DIRECTORY_SEPARATOR, array($uploadDirectory, $newDirectory, $name));

            if ($target){
                $this->uploadName = basename($target);

                if (!is_dir(dirname($target))){
                    mkdir(dirname($target), 0777, true);
                }
                if (move_uploaded_file($file['tmp_name'], $target)){
                    $this->watermarkImg($file['name'], $target, $newDirectory);
                    return array('success'=> true, "uuid" => $uuid);
                }
            }

            return array('error'=> 'Could not save uploaded file.' .
                'The upload was cancelled, or server error encountered');
        }
    }

    public function multiupload_img(Request $request)
    {
        $uploader = new handler();

        // Specify the list of valid extensions, ex. array("jpeg", "xml", "bmp")
        $uploader->allowedExtensions = array(); // all files types allowed by default

        // Specify max file size in bytes.
        $uploader->sizeLimit = 2097152;

        // Specify the input name set in the javascript.
        $uploader->inputName = "qqfile"; // matches Fine Uploader's default inputName value by default

        // If you want to use the chunking/resume feature, specify the folder to temporarily save parts.
        $uploader->chunksFolder = "chunks";

        $method = $uploader->ismemethod();

        // This will retrieve the "intended" request method.  Normally, this is the
        // actual method of the request.  Sometimes, though, the intended request method
        // must be hidden in the parameters of the request.  For example, when attempting to
        // delete a file using a POST request. In that case, "DELETE" will be sent along with
        // the request in a "_method" parameter.

        if ($method == "POST") {
            header("Content-Type: text/plain");

            // Assumes you have a chunking.success.endpoint set to point here with a query parameter of "done".
            // For example: /myserver/handlers/endpoint.php?done
            if (isset($_GET["done"])) {
                $result = $uploader->combineChunks("files");
            }
            // Handles upload requests
            else {
                // Call handleUpload() with the name of the folder, relative to PHP's getcwd()
                $id_sv = servicesModel::where('id',$id)->select('id')->first();
                if ($id_sv != null) {
                    $result = $uploader->handleUpload("public/thumbnails/gallery",$id);
                    // $lam = getcwd();
                    // dd($result);
                    // To return a name used for uploaded file you can use the following line.
                    $result["uploadName"] = $uploader->getUploadName();
                }
            }

            echo json_encode($result);
        }
        // for delete file requests
        else if ($method == "DELETE") {
            // return $request->all();
            $result = $uploader->handleDelete("public/thumbnails/gallery",$id,$request->name);
            return json_encode($result);
        }
        else {
            header("HTTP/1.0 405 Method Not Allowed");
        }
    }
}
