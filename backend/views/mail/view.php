<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Mail : ' . $model->mail_subject;
$this->params['breadcrumbs'][] = [
    'label' => '<i class="material-icons">email</i> Mail', 
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->title;

$assets = $this->theme->baseUrl.'/assets';
?>

<div class="mail-view">
    <!-- Add & Search -->
    <div style="text-align:right;">
        <p>
            <?= Html::a('<i class="material-icons">email</i> REPLY', '#collapseSearch', [
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
                                <i class="material-icons">email</i> Reply
                            </h2>
                        </div>
                        <?= $this->render('_reply', [
                            'model' => $model,
                            'reply' => $reply,
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-cyan">
                    <h2><?=$this->title; ?></h2>
                </div>

                <!-- DetailView -->
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'mail_name',
                        'mail_email:email',
                        'mail_subject',
                        'mail_details:ntext',
                        [ 
                            'label' => 'Status',
                            'format' => 'html',
                            'value' => $model->status($model->mail_status),
                        ],
                        [
                            'label' => 'Replied by',
                            'format' => 'html',
                            'value' => $model->replyby($model->mail_status,$model),
                        ],
                        [
                            'label' => 'Create',
                            'value' => Yii::$app->Formatter->asDate($model->create, 'php:d/m/Y'),
                        ]
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
