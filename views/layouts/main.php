<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top'],
    ]);


    $items = [];
    if (Yii::$app->user->isGuest) {
        $items[] = ['label' => 'Регистрация', 'url' => ['/user/create']];
        $items[] = ['label' => 'Авторизация', 'url' => ['/site/login']];
    } else {
        if (Yii::$app->user->identity->role_id === 1) {
            $items[] = ['label' => 'Главная страница', 'url' => ['/site/index']];
            $items[] = ['label' => 'Все заявления', 'url' => ['/report/index']];
        } else {
            $items[] = ['label' => 'Главная страница', 'url' => ['/site/index']];
            $items[] = ['label' => 'Мои заявления', 'url' => ['/report/index']];
            $items[] = ['label' => 'Создать заявление', 'url' => ['/report/create']];
        }
        $items[] = '<li class="nav-item">'
        . Html::beginForm(['/site/logout'])
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->login . ')',
            ['class' => 'nav-link btn btn-link logout']
        )
        . Html::endForm()
        . '</li>';        
    }

    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $items,
            
            // ['label' => 'Главная страница', 'url' => ['/site/index']],
            // ['label' => 'Регистрация', 'url' => ['/user/create']],
            // ['label' => 'Заявления', 'url' => ['/report/index']],
            // ['label' => 'Создать заявление', 'url' => ['/report/create']],
            // Yii::$app->user->isGuest
            //     ? ['label' => 'Авторизация', 'url' => ['/site/login']]
                // : '<li class="nav-item">'
                //     . Html::beginForm(['/site/logout'])
                //     . Html::submitButton(
                //         'Logout (' . Yii::$app->user->identity->login . ')',
                //         ['class' => 'nav-link btn btn-link logout']
                //     )
                //     . Html::endForm()
                //     . '</li>'
        
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">Доступные страницы: <a href="/web">Главная страница</a> 
            <a href="/web/user/create">Регистрация</a> </br>
        Тел: +79007005005 Email: narush.net@gmail.com
        </div>
            <div class="col-md-6 text-center text-md-end"></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
