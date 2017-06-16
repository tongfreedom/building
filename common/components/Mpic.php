<?php 
namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use kartik\file\FileInput;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use yii\helpers\Html;
use yii\helpers\Url;

class Mpic extends Component
{
  public function picform($model = null, $name = null, $folder = null, $model_name = null, $type = null)
  {
      $option = ['showUpload' => false];
      if($model->$name != NULL){
            $option['initialPreview'] = [Yii::$app->request->baseurl."/../upload/".$folder."/thumb/".$model->$name];
            $option['initialPreviewAsData'] = true;
            $option['initialPreviewFileType'] = 'image';

            if($type == 2){
                  $option['initialPreviewFileType'] = 'video';
            }
            $option['initialCaption'] = $model->$name;
      }
      $img_old = $name.'_old';

      $script_del = '<script>$("input[name=\''.$model_name.'['.$name.']\']").on(\'fileclear\', function(event){ $("input[name=\''.$model_name.'['.$img_old.']\']").val(""); });</script>';

      return FileInput::widget([
          'model' => $model,
          'attribute' => $name,
          'pluginOptions' => $option,
      ]).Html::activeHiddenInput($model, $img_old).$script_del;
  }

  public function picsave($model = null, $name = null, $folder = null, $type = null, $width = 120, $height = 120, $resize = null)
  {
      $model->$name = UploadedFile::getInstance($model, $name);
      if($model->$name != NULL){
          $name_pic = time() . rand();
          $model->$name->saveAs("../upload/".$folder."/" . $name_pic . '.' . $model->$name->extension);

          // thumbnail
          if($type != 2){
            if($resize == 1){
              $savePath = "../upload/".$folder."/thumb/" . $name_pic . '.' .  $model->$name->extension;
              Image::getImagine()->open("../upload/".$folder."/" . $name_pic . '.' . $model->$name->extension)->thumbnail(new Box($width, $height))->save($savePath, ['quality' => 90]);
            }else{
              Image::thumbnail("../upload/".$folder."/" . $name_pic . '.' .  $model->$name->extension, $width, $height)->save("../upload/".$folder."/thumb/" . $name_pic . '.' .  $model->$name->extension, ['quality' => 80]);
            }
          }

          $model->$name = $name_pic . '.' .  $model->$name->extension;
      }else{
          $img_old = $name.'_old';
          $model->$name = $model->$img_old;
      }

      return $model->$name;
  }
  
  public function picShow($value = null, $folder = null){
      if($value){
        $image=Yii::$app->getUrlManager()->getBaseUrl().'/upload/'.$folder."/".$value;
      }else{
        $image=Yii::$app->getUrlManager()->getBaseUrl().'/upload/imagenull/no_image.jpg';
      }
      return $image;
  }
}