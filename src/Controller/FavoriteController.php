<?php

namespace App\Controller;

use App\Model\Favorite;


class FavoriteController
{
    public function create($id_user, $id_product)
    {
        $favModel = new Favorite();
        $favModel->addProduct($id_product);
        $favModel->addToFavorite($id_user, $id_product);
        echo 'fav créé';
    }

    public function getFavorites($id_user)
    {
        $fav = new Favorite;
        return $fav->select($id_user);
    }

    
}
