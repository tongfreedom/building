<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;

class Picture extends \yii\db\ActiveRecord
{
    public $gall_file;

    public static function tableName()
    {
        return 'picture';
    }

    public function rules()
    {
        return [
            [['gall_id'], 'required'],
            [['gall_id', 'user_id', 'create', 'update', 'active'], 'integer'],
            [['gall_file'], 'file','extensions' => 'png, jpg, jpeg'],
            [['pic_img'], 'string', 'max' => 45],
        ];
    }

    public function attributeLabels()
    {
        return [
            'pic_id' => 'Picture ID',
            'pic_img' => 'Image',
            'gall_id' => 'Gallery',
            'user_id' => 'Create by',
            'create' => 'Create',
            'update' => 'Update',
            'active' => 'Active',
        ];
    }

    public function getGall()
    {
        return $this->hasOne(Gallery::className(), ['gall_id' => 'gall_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->user_id = Yii::$app->user->identity->id;
            if($insert){
                // $this->create = Yii::$app->mdate->datesave(date('d/m/Y'));
            }else{
                $this->update = Yii::$app->mdate->datesave(date('d/m/Y'));
            }
            return true;
        } else {
            return false;
        }
    }

    public function upload(){
        $this->gall_file = UploadedFile::getInstance($this, 'gall_file');
        if($this->gall_file != NULL){
           $name = time() . rand();
           $this->gall_file->saveAs('../upload/gallery/' . $name . '.' . $this->gall_file->extension);
           // thumbnail
           Image::thumbnail('../upload/gallery/' . $name . '.' . $this->gall_file->extension, 595, 397)->save('../upload/gallery/thumb/' . $name . '.' . $this->gall_file->extension, ['quality' => 80]);
           $this->pic_img = $name . '.' . $this->gall_file->extension;
           $this->save(false);
           return true;
        }else{
           return false;
        }
    }

}
