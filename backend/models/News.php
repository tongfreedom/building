<?php
namespace backend\models;

use Yii;

class News extends \yii\db\ActiveRecord
{
    public  $tag = null, $news_img_old  = null;
    
    public static function tableName()
    {
        return 'news';
    }

    public function rules()
    {
        return [
            [['news_title', 'type_id'], 'required'],
            [['news_detail'], 'string'],
            [['news_view', 'type_id', 'tag_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id','news_hot','news_price'], 'integer'],
            [['type_id'], 'required'],
            [['news_title'], 'string', 'max' => 255],
            [['news_img'], 'string', 'max' => 45],
            [['tag'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'news_id' => 'News ID',
            'news_title' => 'Title',
            'news_img' => 'Cover Image',
            'news_detail' => 'Detail',
            'news_view' => 'Views',
            'type_id' => 'Type',
            'tag_id' => 'TAG',
            'publish' => 'Publish',
            'user_id' => 'Create by',
            'create' => 'Create',
            'update' => 'Update',
            'active' => 'Active',
            'lan_id' => 'Language',
            'parent_id' => 'Parent',
            'news_hot' => 'Hot News',
			'news_price' => 'Annouce & Tender',
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
