<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Faq;
use himiklab\sortablegrid\SortableGridView;

$this->title = 'FAQ';
$this->params['breadcrumbs'][] = '<i class="material-icons">help</i> '.$this->title;
?>

<div class="faq-index">
    <div style="text-align:right;">
        <!-- Add & Search -->
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
                    <h2><i class="material-icons">help</i> <?=$this->title; ?></h2>
                </div>

                <?php Pjax::begin(['id' => 'table']) ?>

                <?php
                    $showData=[
                        [
                            'attribute' => 'faq_order',
                            'header' => 'No',
                            'format' => 'raw',
                            'filter' => false,
                            'value' => function($data){
                                return '<span class="btn bg-cyan waves-effect"><i class="material-icons">swap_vert</i></span>';
                            },
                            'contentOptions' => ['class' => 'text-center','style' => 'width:50px;'],
                            'headerOptions' => ['class' => 'text-center']
                        ],
                        [
                            'attribute' => 'faq_question',
                            'header' => 'Question',
                            'headerOptions' => [
                                'class' => 'col-md-4'
                            ],
                        ],
                        [
                           'attribute' => 'type',
                           'header' => 'Type',
                           'headerOptions' => [
                                'class' => 'col-md-4'
                            ],
                            'value' => 'type.type_name'
                        ],
                        [
                            'attribute' => 'create',
                            'header' => 'Create',
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

                    // Publish
                    array_push($showData,
                    [
                        'attribute' => 'publish',
                        'header' => 'Publish',
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
                                    'data-id' => $data->faq_id,
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
                                        $check = Faq::findOne(['lan_id'=>$lan_id, 'faq_id'=>$data->faq_id]);
                                        $parent = null;
                                    }else{
                                        $check = Faq::findOne(['lan_id'=>$lan_id, 'parent_id'=>$data->faq_id]);
                                        $parent = $data->faq_id;
                                    }
                                    if($check){
                                        return Html::a('<i class="material-icons">edit</i>', [
                                            'update', 
                                            'id'=>$check->faq_id,
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
                            'template' => '{delete}',
                            'buttons' => [
                                'delete' => function ($url, $model) {
                                    return Html::a('<i class="material-icons">delete</i>', 'javascript:void(0);', [
                                        'title' => Yii::t('app', 'Delete'),
                                        'class'=>'btn bg-red waves-effect sweet-button',
                                        'data-type' => 'delete',
                                        'data-url' => Yii::$app->homeUrl.'?r=faq/delete&id='.$model->faq_id,
                                    ]);
                                },
                            ]
                        ]
                    );
                ?>

                <!-- Gridview -->
                <?= SortableGridView::widget([
                    'dataProvider' => $dataProvider,
                    'sortableAction' => url::to(['faq/sort']),
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
}
</script>