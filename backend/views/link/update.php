<?php
use yii\helpers\Html;

$this->title = 'Update Link : ' . $model->link_name;
$this->params['breadcrumbs'][] = ['label' => '<i class="material-icons">link</i> Link', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$assets = $this->theme->baseUrl.'/assets';
?>

<div class="link-update">

	<div class="row clearfix">
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	        <div class="card">
	            <div class="header bg-cyan">
	                <h2><?=$this->title; ?></h2>
	                <ul class="header-dropdown m-r--5">
						<li>
							<span>
					       	<?php
					       		$icon = Html::img($assets.'/images/icon-th.png',[
					       			'style' => 'width:25px;',
					       			'title' => 'thai',
					       			'alt' => 'thai',
					       		]);
					       		if(isset($_GET['lan_id'])){
					       			if($_GET['lan_id'] != 1){
					       				$icon = Html::img($assets.'/images/icon-uk.png',[
					       					'style' => 'width:25px;',
					       					'title' => 'english',
					       					'alt' => 'english',
					       				]);
					       			}
					       		}
					       		echo $icon;
					       	?>
					       </span>
						</li>
					</ul>
	            </div>
			    <?= $this->render('_form', [
			        'model' => $model,
			    ]) ?>
	        </div>
	    </div>
	</div>
</div>