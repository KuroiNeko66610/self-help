<?php
namespace common\rules;

use yii\rbac\Rule;

class AuthorRule extends Rule
{
    public $name = 'isAuthor'; // Имя правила

    public function execute($user_id, $item, $params)
    {
        if (!isset($params['post'])) {
            return false;
        }
        return ($params['post']->user_id === $user_id);
    }
}