<?php

namespace src\controllers;

use core\BaseController;
use src\models\Favorite;

class FavoriteController extends BaseController
{

    public function favorite($id, $userid)
    {
        echo $id;
        echo $userid;
    }
}