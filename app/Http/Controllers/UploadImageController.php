<?php

namespace App\Http\Controllers;

use App\san_pham;
use Illuminate\Http\Request;
use App\upload_img;
use File;

class UploadImageController extends Controller
{
    public function multi_upload_img(Request $request, $id)
    {
        $name_img = array();
        if ( $files =  $request->file('file')) {
            $path = 'public/images/san_pham/'.$id;
            if(!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            foreach ($request->file('file') as $key => $file) {
                $name = uniqid() . $key . '.' .$file->getClientOriginalExtension();
                $name_img[] = $name;
                $filename[] = $file->move($path, $name);
            }

            $sp = san_pham::where('id',$id)->first();
//            return json_encode($id);
            if($sp->image == null || $sp->image == ''){
                $img = array();
                san_pham::where('id',$id)->update(['image' => json_encode($name_img)]);
            }
            else{
                $arr_image = json_decode($sp->image);
                $result = array_merge($arr_image, $name_img);
                san_pham::where('id',$id)->update(['image' => json_encode($result)]);
//                return $result;
            }
            return 1;
        }
        else{
            return 2;
        }
    }

    public function delete_img(Request $request, $id)
    {
        $path = 'public/images/san_pham/'.$id . '/' . $request->name;
        if(file_exists($path)) {
            unlink($path);
            $sp = san_pham::where('id',$id)->first();
            $arr_image = json_decode($sp->image);
            $index = array_search($request->name, $arr_image);
            if($index !== false){
                unset($arr_image[$index]);
//            return $arr_image;
                san_pham::where('id',$id)->update(['image' => json_encode(array_values($arr_image))]);
            }
        }
        return 1;
    }
}
