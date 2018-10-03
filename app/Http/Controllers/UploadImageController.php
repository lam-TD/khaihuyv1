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
        $sp = san_pham::where('id',$id);
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

            if(empty($sp->image)){
                $img = array();
                san_pham::where('id',$id)->update(['image' => json_encode($name_img)]);
            }
            else{
                $arr_image = json_decode($sp->image);
                array_push($arr_image, $name);
                san_pham::where('id',$id)->update(['image' => json_encode($name_img)]);
            }
            return 1;
        }
        else{
            return 2;
        }
    }
}
