<?php

namespace App\Traits;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
trait StorageImageTrait{
    // Upload file
    public function storageTraitUpload($request,$fieldName,$folderName)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20).'.'.$file->getClientOriginalExtension();
            $FilePath = $request->file($fieldName)->storeAs('public/'.$folderName,$fileNameHash);
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($FilePath)
            ];
            return $dataUploadTrait;
        }
       return null;
    }

    public function storageTraitUploadMultiple($file,$folderName)
    {
       
           
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20).'.'.$file->getClientOriginalExtension();
            $FilePath = $file->storeAs('public/'.$folderName,$fileNameHash);
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($FilePath)
            ];
            return $dataUploadTrait;

}
}
?>