<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\News;

$this->title = 'News';
$this->params['breadcrumbs'][] = '<i class="material-icons">chrome_reader_mode</i> '.$this->title;

?>

<div class="news-index">
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
                        <i class="material-icons">chrome_reader_mode</i> <?=$this->title; ?>
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
                            'attribute' => 'news_title',
                            'headerOptions' => [
                                'class' => 'col-md-6'
                            ],
                        ],
                        [
                           'attribute' => 'type',
                           'headerOptions' => [
                                'class' => 'col-md-2'
                            ],
                            'value' => 'type.type_name'
                        ],
                        [
                           'attribute' => 'news_view',
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

                    // Hot news
                    array_push($showData,
                    [
                        'attribute' => 'news_hot',
                        'format' => 'raw',
                        'headerOptions' => [
                            'class' => 'text-center col-md-2',
                        ],
                        'contentOptions' => [
                                'class' => 'text-center'
                            ],
                        'value' => function($data){
                                $html = '<div class="switch"><label>';
                                $html .= Html::checkBox('publish',$data->news_hot,[
                                    'data-id' => $data->news_id,
                                    'class' => 'chk-hot'
                                ]);
                                $html .= '<span class="lever switch-col-indego"></span></label></div>';
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
                                    'data-id' => $data->news_id,
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
                                    // Find
                                    if($lan_id==1){
                                        $check = News::findOne(['lan_id'=>$lan_id, 'news_id'=>$data->news_id]);
                                        $parent = null;
                                    }else{
                                        $check = News::findOne(['lan_id'=>$lan_id, 'parent_id'=>$data->news_id]);
                                        $parent = $data->news_id;
                                    }
                                    if($check){
                                        return Html::a('<i class="material-icons">edit</i>', [
                                            'update', 
                                            'id'=>$check->news_id,
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
                                    return Html::a('<i class="material-icons">visibility</i>', Yii::$app->urlManagerFrontEnd->createUrl(['news/view','id' => $model->news_id]), [
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
                                        'data-url' => Yii::$app->homeUrl.'?r=news/delete&id='.$model->news_id,
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

    $('.chk-hot').change(function(event) {
        if (this.checked) {
            var value = 1;
        }else{
            var value = 0;
        }
        var type = 'hot';
        var id = $(this).data('id');
        $.ajax({
            url: '<?= Url::to(["index"]);?>',
            type: 'POST',
            data: {checkbox:true, type:type, id:id, value: value},
        })
        .done(function() {
            if(value){
                var bg = 'bg-green';
                var text = 'Hot News Enabled';
            }else{
                var bg = 'bg-red';
                var text = 'Hot News Disabled';
            }
            showNotification(bg, text,'bottom', 'right', '', '');
        });
        return false;
    });
}
</script>