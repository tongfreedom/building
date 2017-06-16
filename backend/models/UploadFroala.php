<?php

namespace backend\models;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadFroala extends Model
{
    public $imageFile, $docFile, $videoFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['docFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf, doc'],
            [['videoFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'mp4'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            if($this->imageFile){
                $this->imageFile->saveAs('../upload/froala/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            }else if($this->docFile){
                $this->docFile->saveAs('../upload/froala/doc/' . $this->docFile->baseName . '.' . $this->docFile->extension);
            }else{
                $this->videoFile->saveAs('../upload/froala/video/' . $this->videoFile->baseName . '.' . $this->videoFile->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}