<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Пользователи', 'icon' => 'user', 'url' => ['/user'] ,
                        'visible' => Yii::$app->user->can('admin')],
                    ['label' => 'Категории', 'icon' => 'folder', 'url' => ['/category'] ,
                        'visible' => Yii::$app->user->can('moderator')],
                    ['label' => 'Инструкции', 'icon' => 'image', 'url' => ['/post']],
                    //['label' => 'Пользователи', 'icon' => 'fa fa-user-circle-o', 'url' => ['/user']],

                  //  ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

                ],
            ]
        ) ?>

    </section>

</aside>
