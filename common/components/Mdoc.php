<?php 
namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use kartik\file\FileInput;
use yii\web\UploadedFile;
use yii\helpers\Html;
use yii\helpers\Url;

class Mdoc extends Component
{
  public function docform($model = null, $name = null, $folder=null, $model_name = null, $type = null)
  {
      $option = ['showUpload' => false];
      if($model->$name != NULL){
            $option['initialPreview'] = [Yii::$app->request->baseurl."/../upload/".$folder.'/'.$model->$name];
            $option['initialPreviewAsData'] = true;

            $arr = explode(".",$model->$name);
            if(end($arr) == 'pdf'){
              $option['initialPreviewFileType'] = ['pdf'];
            }else{
              $option['initialPreviewFileType'] = ['other'];
            }
           
            $option['allowedExtensions'] = ['doc', 'xdoc', 'pdf', 'xlsx', 'xls'];
            $option['initialCaption'] = $model->$name;
      }
      $doc_old = $name.'_old';

      $script_del = '<script>$("input[name=\''.$model_name.'['.$name.']\']").on(\'fileclear\', function(event){ $("input[name=\''.$model_name.'['.$doc_old.']\']").val(""); });</script>';

      return FileInput::widget([
          'model' => $model,
          'attribute' => $name,
          'pluginOptions' => $option,
      ]).Html::activeHiddenInput($model, $doc_old).$script_del;
  }
  
  public function docsave($model = null, $name = null, $folder = null, $type = null)
  {
      $model->$name = UploadedFile::getInstance($model, $name);
      if($model->$name != NULL){
          $name_doc = time() . rand();
          $model->$name->saveAs("../upload/".$folder."/" . $name_doc . '.' . $model->$name->extension);

          $model->$name = $name_doc . '.' .  $model->$name->extension;
      }else{
          $doc_old = $name.'_old';
          $model->$name = $model->$doc_old;
      }

      return $model->$name;
  }
}