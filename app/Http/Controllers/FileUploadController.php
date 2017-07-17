<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function postUpload(Request $request){
        // $dir = $request->input('dir','unknown');
        if ($request->hasFile('myfile') && $request->file('myfile')-> isValid()) {
            $file = $request->file('myfile');
            $clientName = $file -> getClientOriginalName();//客户端文件名称
            // $tmpName = $file ->getFileName();//缓存在tmp文件夹中的文件名例如php8933.tmp 这种类型的.
            // $realPath = $file -> getRealPath();    //所以这里道出了文件上传的原理,将文件上传的某个临时目录中,然后使用PHP的函数将文件移动到指定的文件夹
            $entension = $file -> getClientOriginalExtension(); //上传文件的后缀.
            // $mimeTye = $file -> getMimeType();//大家对mimeType应该不陌生了
            $newName = md5(date('ymdhis').$clientName).'_'.$clientName;
            $path = $file -> move('storage/uploads/public',$newName);
            return '<a href="/'.$path.'">download</a>';
            // 如果这样写的话,默认是会放置在 我们 public/storage/uploads/php79DB.tmp  貌似不是我们希望的,如果我们希望将其放置在app的storage目录下的uploads目录中,并且需要改名的话..
            // $path = $file -> move(app_path().'/storage/uploads',$newName);
            // 这里app_path()就是app文件夹所在的路径.$newName 可以是你通过某种算法获得的文件的名称.主要是不能重复产生冲突即可.  比如 $newName = md5(date('ymdhis').$clientName).".".$extension;
            // 利用日期和客户端文件名结合 使用md5 算法加密得到结果.不要忘记在后面加上文件原始的拓展名.
            //

        }
    }
}
