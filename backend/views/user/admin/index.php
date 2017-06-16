<?php
use dektrium\user\models\UserSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = '<i class="material-icons">assignment_ind</i> Users';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', [
    'module' => Yii::$app->getModule('user'),
]) ?>

<div class="user-index">
    <!-- Add -->
    <div style="text-align:right;">
        <p>
            <?= Html::a('<i class="material-icons">library_add</i> Add', ['/user/admin/create'], ['class' => 'btn btn-success waves-effect']) ?>
            <?= Html::a('<i class="material-icons">search</i> SEARCH', '#collapseSearch', [
                    'class' => 'btn btn-warning waves-effect',
                    'role' => 'button',
                    'data-toggle' => 'collapse',
                    'aria-expanded' => 'false',
                    'aria-controls' => 'collapseSearch',
                ]);
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
                <div class="header bg-light-green">
                    <h2>
                        <i class="material-icons">assignment_ind</i> Users
                    </h2>
                </div>
                <?php Pjax::begin(['id' => 'table']) ?>
                    <?= GridView::widget([
                        'dataProvider'  =>  $dataProvider,
                        'tableOptions' => [
                            'class' => 'table table-striped projects',
                        ],
                        'layout'        =>  "{items}\n{pager}",
                        'options'=>['class'=>'body table-responsive'],
                        'filterModel' => null,
                        'columns' => [
                            [
                                'header' => 'No',
                                'class' => 'yii\grid\SerialColumn',
                                'contentOptions' => [
                                    'class' => 'text-center'
                                ],
                                'headerOptions' => [
                                    'class' => 'text-center',
                                ],
                            ],
                            'profile.name',
                            'profile.lastname',
                            'email:email',
                            [
                                'attribute' => 'last_login_at',
                                'headerOptions' => [
                                    'class' => 'col-md-2',
                                ],
                                'format' => 'html',
                                'value' => function($data){
                                    if($data->last_login_at != null){
                                        return Yii::$app->Formatter->asDate($data->last_login_at, 'php:d/m/Y');
                                    }else{
                                        return "<span style='color:red'>ยังไม่เคยเข้าใช้งาน</span>";
                                    }
                                },
                            ],
                            [
                                'header' => 'Manage',
                                'headerOptions' => [
                                    'class' => 'text-center'
                                ],
                                'contentOptions' => [
                                    'class' => 'text-center'
                                ],
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{resend_password} {update} {delete}',
                                'buttons' => [
                                    'resend_password' => function ($url, $model, $key) {
                                        if (!$model->isAdmin) {
                                            return '
                                        <a data-method="POST" data-confirm="' . Yii::t('user', 'Are you sure?') . '" href="' . Url::to(['resend-password', 'id' => $model->id]) . '" class="btn bg-pink waves-effect" >
                                            <i class="material-icons" title="'.Yii::t('user', 'Generate and send new password to user').'">mail</i>
                                        </a>';
                                        }
                                    },
                                    'update' => function ($url, $model) {
                                        return Html::a('<i class="material-icons">edit</i>', $url, [
                                            'title' => Yii::t('app', 'Edit'),
                                            'class'=>'btn bg-cyan waves-effect',  
                                            'data-pjax'=>"0",                                 
                                        ]);
                                    },
                                    'delete' => function ($url, $model) {
                                        return Html::a('<i class="material-icons">delete</i>', $url, [
                                            'title' => Yii::t('app', 'Delete'),
                                            'class'=>'btn bg-red waves-effect',
                                            'data-method' => 'post',
                                            'data-confirm' => Yii::t('user', 'Are you sure?')
                                        ]);
                                    },
                                ]

                            ],
                        ],
                    ]); ?>
                <?php Pjax::end() ?>

                <script type="text/javascript">
                    jQuery(document).ready(function($) {
                        <?php if(Yii::$app->session->getFlash('success')):?>
                            showNotification('bg-green', 'บันทึกสำเร็จ', 'bottom', 'right', '', '');
                        <?php endif; ?>
                    });
                </script>
            </div>
        </div>
    </div>
</div>










