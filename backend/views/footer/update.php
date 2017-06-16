<?php
use yii\helpers\Html;

$this->title = 'Update Contact';
$this->params['breadcrumbs'][] = '<i class="material-icons">contacts</i> '.$this->title;

$assets = $this->theme->baseUrl.'/assets';
?>

<div class="contact-update">
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
					       		if($model->lan_id != 1){
				       				$icon = Html::img($assets.'/images/icon-uk.png',[
				       					'style' => 'width:25px;',
				       					'title' => 'english',
				       					'alt' => 'english',
				       				]);
					       		}
					       		echo $icon;
					       	?>
					       </span>
						</li>
					</ul>
	            </div>

	            <ul class="nav nav-tabs tab-nav-right m-l-10" role="tablist">
	            	<?php  
						$classthai = 'active';
						$classeng = '';

						if($model->lan_id != 1){
							$classthai = '';
							$classeng = 'active';
						}
	            	?>
                    <li role="presentation" class="<?=$classthai; ?>">
                    	<?=Html::a('Thai',['/footer/update','id' => 1]); ?>
                    </li>
                    <li role="presentation" class="<?=$classeng; ?>">
                    	<?=Html::a('English',['/footer/update','id' => 2]); ?>
                    </li>
                </ul>
			    <?= $this->render('_form', [
			        'model' => $model,
			    ]) ?>
	        </div>
	    </div>
	</div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        <?php if(Yii::$app->session->getFlash('success')):?>
            var text = '<?=Yii::$app->session->getFlash('success'); ?>';
            showNotification('bg-green', text, 'bottom', 'right', '', '');
        <?php endif; ?>
    });
</script>