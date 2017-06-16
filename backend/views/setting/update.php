<?php
use yii\helpers\Html;

$this->title = 'Update Setting';
$this->params['breadcrumbs'][] = '<i class="material-icons">settings</i> '.$this->title;

$assets = $this->theme->baseUrl.'/assets';
?>

<div class="setting-update">
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

<script type="text/javascript">
    jQuery(document).ready(function($) {
        <?php if(Yii::$app->session->getFlash('success')):?>
            var text = '<?=Yii::$app->session->getFlash('success'); ?>';
            showNotification('bg-green', text, 'bottom', 'right', '', '');
        <?php endif; ?>
    });
</script>