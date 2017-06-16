<?php 
namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use backend\models\Tag;

class Mtag extends Component
{
  public function tagshow($tag_id = null)
  {
      if($tag_id != null){
          $model = Tag::findOne(['tag_id' => $tag_id]);
          $tag = $model->tag_name;
      }else{
          $tag = null;
      }
      
      return $tag;
  }

  public function tagsave($tag_id = null, $tag_name = null)
  {
        if($tag_id != null){
            $tag = Tag::findOne(['tag_id' => $tag_id]);
        }else{
            $tag = new Tag;
        }

        $tag->tag_name = $tag_name;
        $tag->save();

        $tag_id = $tag->tag_id;

        return $tag_id;
  }

  public function gettag($id = null){
    $tag = Tag::find()->where(['=', 'tag_id', $id])->one();
    $tag = explode(",",$tag->tag_name);
    
    return $tag;
  }
}