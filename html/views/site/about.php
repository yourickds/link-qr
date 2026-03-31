<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'О проекте';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h1 class="display-4 fw-bold text-primary">Link QR</h1>
                    <p class="lead text-muted">Упрощённый сервис коротких ссылок с автоматическими QR-кодами</p>
                </div>

                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>О проекте</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">
                            Это веб-приложение для создания и управления короткими ссылками. 
                            Сервис позволяет упрощать длинные URL, генерировать QR-коды автоматически 
                            и отслеживать статистику посещений.
                        </p>

                        <h5 class="mt-4 mb-3">Что умеет проект:</h5>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="card h-100 border-primary">
                                    <div class="card-body text-center p-4">
                                        <h6 class="card-title fw-bold">Короткие ссылки</h6>
                                        <p class="card-text text-muted small">
                                            Преобразование длинных URL в короткие, удобные для запоминания и передачи.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card h-100 border-success">
                                    <div class="card-body text-center p-4">
                                        <h6 class="card-title fw-bold">QR-коды</h6>
                                        <p class="card-text text-muted small">
                                            Автоматическая генерация QR-кодов для каждой созданной ссылки.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card h-100 border-warning">
                                    <div class="card-body text-center p-4">
                                        <h6 class="card-title fw-bold">Статистика</h6>
                                        <p class="card-text text-muted small">
                                            Отслеживание посещений, IP адресов и User-Agent пользователей.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card h-100 border-info">
                                    <div class="card-body text-center p-4">
                                        <h6 class="card-title fw-bold">Проверка URL</h6>
                                        <p class="card-text text-muted small">
                                            Автоматическая проверка доступности целевых сайтов перед созданием ссылки.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h5 class="mt-4 mb-3">Как это работает:</h5>
                        
                        <ol class="list-group list-group-numbered mb-4">
                            <li class="list-group-item bg-light">
                                <strong>Создание ссылки</strong>
                                <p class="mb-0 text-muted small">Вы вводите длинный URL на главной странице, система генерирует уникальный код.</p>
                            </li>
                            <li class="list-group-item bg-light">
                                <strong>Генерация QR-кода</strong>
                                <p class="mb-0 text-muted small">Система автоматически создаёт QR-код, который можно отсканировать с телефона.</p>
                            </li>
                            <li class="list-group-item bg-light">
                                <strong>Проверка доступности</strong>
                                <p class="mb-0 text-muted small">Перед созданием ссылки проверяется, доступен ли целевой URL.</p>
                            </li>
                            <li class="list-group-item bg-light">
                                <strong>Перенаправление</strong>
                                <p class="mb-0 text-muted small">При клике или сканировании QR-кода пользователь перенаправляется на целевой сайт.</p>
                            </li>
                            <li class="list-group-item bg-light">
                                <strong>Статистика</strong>
                                <p class="mb-0 text-muted small">Каждое посещение записывается в базу данных для анализа.</p>
                            </li>
                        </ol>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="<?= Url::home() ?>" class="btn btn-primary btn-lg px-4 me-md-2">Создать ссылку</a>
                            <a href="<?= Url::to(['/short-link/index']) ?>" class="btn btn-outline-secondary btn-lg px-4">Управление ссылками</a>
                        </div>
                    </div>
                </div>

                <div class="card bg-light border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="mb-3">Технологии</h5>
                        <p class="text-muted mb-1"><strong>Backend:</strong> PHP 8.2 + Yii Framework 2</p>
                        <p class="text-muted mb-1"><strong>QR-коды:</strong> BaconQrCode библиотека</p>
                        <p class="text-muted mb-1"><strong>Проверка URL:</strong> CURL для HTTP запросов</p>
                        <p class="text-muted mb-0"><strong>База данных:</strong> MySQL</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
