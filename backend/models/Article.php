<?php
namespace backend\models;

use Yii;

class Article extends \yii\db\ActiveRecord
{
    public  $tag, $art_img_old  = null;

    public static function tableName()
    {
        return 'article';
    }

    public function rules()
    {
        return [
            [['art_title','type_id'], 'required'],
            [['art_detail'], 'string'],
            [['art_view', 'tag_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id', 'type_id','art_km'], 'integer'],
            [['art_title'], 'string', 'max' => 255],
            [['art_img'], 'string', 'max' => 45],
            [['tag'], 'string'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'art_id' => Yii::t('lan','Article ID'),
            'art_title' => Yii::t('lan','Title'),
            'art_img' => Yii::t('lan','Cover Image'),
            'art_detail' => Yii::t('lan','Article Detail'),
            'art_view' => Yii::t('lan','Views'),
            'user_id' => Yii::t('lan','User'),
            'lan_id' => Yii::t('lan','language'),
            'parent_id' => Yii::t('lan','Parent ID'),
            'create' => Yii::t('lan','Create'),
            'update' => Yii::t('lan','Update date'),
            'active' => Yii::t('lan','Active'),
            'tag_id' => Yii::t('lan','TAG'),
            'publish' => Yii::t('lan','Publish'),
            'type_id' => Yii::t('lan','Type'),
			'art_km' => Yii::t('lan','Knowledge Management'),
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->user_id = Yii::$app->user->identity->id;
            if($insert){
                $this->create = Yii::$app->mdate->datesave(date('d/m/Y'));
            }else{
                $this->update = Yii::$app->mdate->datesave(date('d/m/Y'));
            }
            return true;
        } else {
            return false;
        }
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'user_id']);
    }

    public function getType()
    {
        return $this->hasOne(Type::className(), ['type_id' => 'type_id']);
    }
}
