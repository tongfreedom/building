<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "team".
 *
 * @property integer $team_id
 * @property string $team_prefixname
 * @property string $team_firstname
 * @property string $team_lastname
 * @property string $team_position
 * @property string $team_level
 * @property string $team_img
 * @property integer $team_order
 * @property string $team_tel
 * @property string $team_email
 * @property integer $dep_id
 * @property integer $publish
 * @property integer $user_id
 * @property integer $create
 * @property integer $update
 * @property integer $active
 * @property integer $lan_id
 * @property integer $parent_id
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['team_order', 'dep_id', 'publish', 'user_id', 'create', 'update', 'active', 'lan_id', 'parent_id'], 'integer'],
            [['dep_id'], 'required'],
            [['team_prefixname', 'team_img', 'team_tel', 'team_email'], 'string', 'max' => 45],
            [['team_firstname', 'team_lastname', 'team_position', 'team_level'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'team_id' => 'รหัสบุคลากร',
            'team_prefixname' => 'คำนำหน้าชื่อ',
            'team_firstname' => 'ชื่อ',
            'team_lastname' => 'นามสกุล',
            'team_position' => 'ตำแหน่ง',
            'team_level' => 'ระดับ',
            'team_img' => 'รุปภาพ',
            'team_order' => 'ลำดับ',
            'team_tel' => 'เบอร์ติดต่อ',
            'team_email' => 'อีเมล์',
            'dep_id' => 'แผนก',
            'publish' => 'เผยแพร่',
            'user_id' => 'ผู้สร้าง',
            'create' => 'วันที่สร้าง',
            'update' => 'วันที่แก้ไข',
            'active' => 'สถานะ',
            'lan_id' => 'ภาษา',
            'parent_id' => 'Parent',
        ];
    }

    public function Fullname($model)
    {
        return $model->team_prefixname.' '.$model->team_firstname.' '.$model->team_lastname;
    }
}
