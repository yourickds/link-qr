<?php

/** @var yii\web\View $this */
/** @var app\models\ShortLink $model */
/** @var string $code */
/** @var string $img */

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;

$this->title = 'Создать ссылку';
?>
<div class="site-index">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <?php Pjax::begin(['id' => 'short_link_create']); ?>

                    <?php $form = \yii\widgets\ActiveForm::begin([
                        'options' => ['data-pjax' => true],
                        'fieldConfig' => [
                            'template' => '<label class="col-form-label">{label}</label><div class="input-group">{input}</div><div class="mt-1 help-block text-danger">{error}</div>',
                        ]
                    ]); ?>

                    <?= $form->field($model, 'url')->textInput(['class' => 'form-control', 'type' => 'url', 'placeholder' => 'https://example.com/very-long-url']) ?>

                    <div class="mt-4">
                        <?= Html::submitButton('OK', ['id' => 'btn-submit', 'class' => 'btn btn-primary w-100 py-2', 'name' => 'create-btn']) ?>

                        <div id="loading-spinner" class="d-flex align-items-center d-none">
                            <strong>Loading...</strong>
                            <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                        </div>
                    </div>

                    <?php \yii\widgets\ActiveForm::end(); ?>

                    <?php if (!empty($code)): ?>
                        <div class="alert alert-success mt-4">
                            <h5 class="alert-heading">Ссылка создана!</h5>

                            <p class="mb-3">
                                <strong>Короткая ссылка:</strong><br>
                                <a href="<?= Url::to(['redirect/index', 'code' => $code], true) ?>"
                                   class="text-decoration-none text-primary fw-bold"
                                   target="_blank" data-pjax="0">
                                    <?= Url::to(['redirect/index', 'code' => $code], true) ?>
                                </a>
                            </p>

                            <?php if (!empty($img)): ?>
                                <div class="card bg-light border-0 shadow-sm mb-3">
                                    <div class="card-body text-center p-4">
                                        <img src="<?= $img ?>" alt="QR Code" class="mb-3" style="max-width: 250px; max-height: 250px;">
                                        <p class="text-muted small mb-0">Сканируйте QR-код или скопируйте ссылку</p>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <a href="<?= Url::to(['site/about']) ?>" class="btn btn-outline-secondary w-100 py-2">Узнать больше о проекте</a>
                        </div>

                    <?php endif; ?>

                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>

<?php $this->registerJsFile('@web/js/script.js', ['depends' => [\yii\web\JqueryAsset::class]]); ?>