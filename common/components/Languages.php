<?php 
namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use common\models\Language;

class Languages extends Component
{
	private $_isCheck = false;
	private $_allModel = NULL;

	public function init()
	{
		$this->loadAll();
		Yii::$app->language = $this->getCurrent()->code;
		parent::init();
	}

	public function getAll()
	{
		$model = [];
		if($this->loadAll() != NULL){
			foreach ($this->loadAll() as $key => $_lang) {
				$model[] = $this->strEncode($_lang);
			}
		}
		
		return $model;
	}

	public function one($id)
	{
		if($this->loadAll() != NULL){
			foreach ($this->loadAll() as $key => $_lang) {
				if($_lang->lan_id == $id){
					return $this->strEncode($_lang);
				}				
			}
		}

		return NULL;
	}

	public function getCurrent()
	{
		$id = isset(Yii::$app->session['lang']) ? Yii::$app->session['lang'] : $this->getDefaultId();
		return $this->one($id);
	}

	public function getDefaultId(){
		$model = Language::findOne(1);
		if($model == NULL){
			$create = new Language();			
		}
		return 1;
	}

	public function getCode()
	{
		return $this->getCurrent()->code;
	}

	public function getId()
	{
		return $this->getCurrent()->id;
	}

	public function getHasLanguage()
	{
		return $this->_isCheck;
	}
	
	private function loadAll()
	{
		$this->_allModel = Language::find()->where(['active' => 1])->all();
		if($this->_allModel != NULL){
			$this->_isCheck = true;
		}

		return $this->_allModel;
	}

	private function strEncode($model)
	{
		return (object) [
			'id'=> $model->lan_id,
			'name'=>$model->lan_name,
			'code'=>$model->lan_code,			
		];
	}
}