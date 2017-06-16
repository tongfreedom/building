<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Article;

$this->title = 'Article';
$this->params['breadcrumbs'][] = '<i class="material-icons">library_books</i> '.$this->title;
?>

<div class="article-index">
    <!-- Add & Search -->
    <div style="text-align:right;">
        <p>
            <?= Html::a('<i class="material-icons">library_add</i> ADD', ['create'], ['class' => 'btn btn-success waves-effect']) ?>
            <?= Html::a('<i class="material-icons">search</i> SEARCH', '#collapseSearch', [
                    'class' => 'btn btn-warning waves-effect',
                    'role' => 'button',
                    'data-toggle' => 'collapse',
                    'aria-expanded' => 'false',
                    'aria-controls' => 'collapseSearch',
                ]) 
            ?>
        </p>
        <!-- Search -->
        <div class="collapse" id="collapseSearch">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header text-left bg-amber">
                            <h2>
                                <i class="material-icons">search</i> Search
                            </h2>
                        </div>
                        <?= $this->render('_search', [
                            'model' => $searchModel,
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-deep-orange">
                    <h2>
                        <i class="material-icons">library_books</i> <?=$this->title; ?>
                    </h2>
                </div>

                <?php Pjax::begin(['id' => 'table']) ?>

                <?php
                    $showData=[
                        [
                            'header' => 'No',
                            'headerOptions' => [
                                'style' => 'width:50px;'
                            ],
                            'class' => 'yii\grid\SerialColumn',
                        ],
                        [
                            'attribute' => 'art_title',
                            'headerOptions' => [
                                'class' => 'col-md-4'
                            ],
                        ],
                        [
                           'attribute' => 'type',
                           'headerOptions' => [
                                'class' => 'col-md-4'
                            ],
                            'value' => 'type.type_name'
                        ],
                        [
                           'attribute' => 'art_view',
                           'headerOptions' => [
                                'style'=>'width: 50px',
                                'class' => 'text-center',
                            ],
                            'contentOptions' => [
                                'class' => 'text-center'
                            ],
                        ],
                        [
                            'attribute' => 'create',
                            'headerOptions' => [
                                'style'=>'width: 50px',
                                'class' => 'text-center',
                            ],
                            'contentOptions' => [
                                'class' => 'text-center',
                            ],
                            'value' => function($data){
                                return Yii::$app->Formatter->asDate($data->create, 'php:d/m/Y');
                            },
                        ],
                    ];

					// KM
                    array_push($showData,
                    [
                        'attribute' => 'art_km',
                        'format' => 'raw',
                        'headerOptions' => [
                            'class' => 'text-center col-md-2',
                            'style'=>'width: 50px'
                        ],
                        'contentOptions' => [
                                'class' => 'text-center'
                            ],
                        'value' => function($data){
                                $html = '<div class="switch"><label>';
                                $html .= Html::checkBox('art_km',$data->art_km,[
                                    'data-id' => $data->art_id,
                                    'class' => 'chk-art-km'
                                ]);
                                $html .= '<span class="lever switch-col-cyan"></span></label></div>';
                                return $html;
                        },
                    ]);


                    // Publish
                    array_push($showData,
                    [
                        'attribute' => 'publish',
                        'format' => 'raw',
                        'headerOptions' => [
                            'class' => 'text-center col-md-2',
                            'style'=>'width: 50px'
                        ],
                        'contentOptions' => [
                                'class' => 'text-center'
                            ],
                        'value' => function($data){
                                $html = '<div class="switch"><label>';
                                $html .= Html::checkBox('publish',$data->publish,[
                                    'data-id' => $data->art_id,
                                    'class' => 'chk-publish'
                                ]);
                                $html .= '<span class="lever switch-col-cyan"></span></label></div>';
                                return $html;
                        },
                    ]);

                    // Language
                    foreach (Yii::$app->languages->all as $ln) {
                        $lan_id = $ln->id;
                        array_push($showData, [
                                'header' => $ln->name,
                                'format'=>'raw',
                                'headerOptions' => ['class'=>'text-center', 'style'=>'width: 50px'],
                                'contentOptions' => ['class'=>'text-center'],
                                'value' => function ($data) use ($lan_id){

                                    if($lan_id==1){
                                        $check = Article::findOne(['lan_id'=>$lan_id, 'art_id'=>$data->art_id]);
                                        $parent = null;
                                    }else{
                                        $check = Article::findOne(['lan_id'=>$lan_id, 'parent_id'=>$data->art_id]);
                                        $parent = $data->art_id;
                                    }
                                    if($check){
                                        return Html::a('<i class="material-icons">edit</i>', [
                                            'update', 
                                            'id'=>$check->art_id,
                                            'lan_id'=>$lan_id,
                                            'parent_id' => $parent
                                        ],
                                        [
                                            'title' => Yii::t('app', 'Edit'),
                                            'class'=>'btn bg-blue waves-effect sweet-button',
                                            'data-pjax'=>"0",                                  
                                        ]);
                                    }else{
                                        return Html::a('<i class="material-icons">library_add</i>', [
                                            'create', 
                                            'lan_id'=>$lan_id, 
                                            'parent_id'=> $parent
                                        ], 
                                        [
                                            'title' => Yii::t('app', 'Add'),
                                            'class'=>'btn bg-green waves-effect sweet-button',
                                            'data-pjax'=>"0",                          
                                        ]);
                                    }
                                },
                            ]
                        );
                    }

                    // Manage
                    array_push($showData,
                        [
                            'header' => 'Manage',
                            'headerOptions' => [
                                'class' => 'text-center col-md-2'
                            ],
                            'contentOptions' => [
                                'class' => 'text-center'
                            ],
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {delete}',
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a('<i class="material-icons">visibility</i>', Yii::$app->urlManagerFrontEnd->createUrl(['article/view','id' => $model->art_id]), [
                                        'title' => Yii::t('app', 'View'),
                                        'class'=>'btn bg-orange waves-effect sweet-button',  
                                        'data-pjax'=>"0",  
                                        'target' => '_blank',                               
                                    ]);
                                },
                                'delete' => function ($url, $model) {
                                    return Html::a('<i class="material-icons">delete</i>', 'javascript:void(0);', [
                                        'title' => Yii::t('app', 'Delete'),
                                        'class'=>'btn bg-red waves-effect sweet-button',
                                        'data-type' => 'delete',
                                        'data-url' => Yii::$app->homeUrl.'?r=article/delete&id='.$model->art_id,
                                    ]);
                                },
                            ]
                        ]
                    );
                ?>
                
                <!-- Gridview -->
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'tableOptions' => [
                        'class' => 'table table-striped',
                    ],
                    'layout'        =>  "{items}\n{pager}",
                    'options'=>['class'=>'body table-responsive'],
                    'filterModel' => null,
                    'columns' => $showData
                ]); ?>
                
                <!-- Jquery Ready -->
                <script type="text/javascript">
                    jQuery(document).ready(function($) {
                        switcher();

                        <?php if(Yii::$app->session->getFlash('success')):?>
                            var text = '<?=Yii::$app->session->getFlash('success'); ?>';
                            showNotification('bg-green', text, 'bottom', 'right', '', '');
                        <?php endif; ?>
                    });
                </script>

                <?php Pjax::end() ?>
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script>
function switcher(){
    $('.chk-publish').change(function(event) {
        if (this.checked) {
            var value = 1;
        }else{
            var value = 0;
        }
        var type = 'publish';
        var id = $(this).data('id');
        $.ajax({
            url: '<?= Url::to(["index"]);?>',
            type: 'POST',
            data: {checkbox:true, type:type, id:id, value: value},
        })
        .done(function() {
            if(value){
                var bg = 'bg-green';
                var text = 'Publish On';
            }else{
                var bg = 'bg-red';
                var text = 'Publish Off';
            }
            showNotification(bg, text,'bottom', 'right', '', '');
        });
        return false;
    });
	
	
	$('.chk-art-km').change(function(event) {
        if (this.checked) {
            var value = 1;
        }else{
            var value = 0;
        }
        var type = 'km';
        var id = $(this).data('id');
        $.ajax({
            url: '<?= Url::to(["index"]);?>',
            type: 'POST',
            data: {checkbox:true, type:type, id:id, value: value},
        })
        .done(function() {
            if(value){
                var bg = 'bg-green';
                var text = 'KM On';
            }else{
                var bg = 'bg-red';
                var text = 'KM Off';
            }
            showNotification(bg, text,'bottom', 'right', '', '');
        });
        return false;
    });
}
</script>