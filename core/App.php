<?php

namespace core;

use src\controllers\ProductController;
use src\controllers\UserController;
use src\controllers\ErrorController;


class App
{
    //UNE SEULE METHOD ICI, LA METHOD RUN
    public function run()
    {
        session_start();
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        //ATTENTION, CECI EST UN TEST ET N'EST PAS UNE BONNE PRATIQUE ! CE NE DOIT PAS ETRE LE ROLE DE CETTE CLASSE (MAIS CELUI D'UNE CLASS ROUTER) DE GERER LA VERIFICATION DES ROUTES
        //EN TERME DE CONVENTION, CHAQUE CONTROLLER EST UNE CLASSE
        if (isset($_SESSION['Admin']) && $_SESSION['Admin'] != null) {

            //INDEX = PRODUCT HOME
            if ($uri == '/' || $uri == '/index.php') {
                $controller = new ProductController();
                $controller->index();

                //LOGOUT
            } else if ($uri == '/logout') {
                $controller = new UserController();
                $controller->disconnect();

                //PRODUCT ROUTES
            } else if ($uri == '/editproduct' && isset($_GET['productid'])) {
                $controller = new ProductController();
                $controller->editProduct();
            } else if ($uri == '/product' && isset($_GET['productid'])) {
                $controller = new ProductController();
                $controller->updateThisProduct();
            } else if ($uri == '/newproduct') {
                $controller = new ProductController();
                $controller->newProduct();
            } else if ($uri == '/addproduct') {
                $controller = new ProductController();
                $controller->addProduct();

                //USERS ROUTES
            } else if ($uri == '/users') {
                $controller = new UserController();
                $controller->users();
            } else if ($uri == '/newuser') {
                $controller = new UserController();
                $controller->newUser();
            } else if ($uri == '/adduser') {
                $controller = new UserController();
                $controller->addUser();
            } else if ($uri == '/user' && isset($_GET['userid'])) {
                $controller = new UserController();
                $controller->updateThisUser();
            } else if ($uri == '/edituser' && isset($_GET['userid'])) {
                $controller = new UserController();
                $controller->editUser();

                //GESTION ERROR
            } else {
                http_response_code(404); //ON ENVOIT LA BONNE ERREUR AU NAVIGATEUR
                $controller = new ErrorController();
                $controller->error();
            }
        } else if ($uri == '/tryauth') {
            $controller = new UserController();
            $controller->tryConnexion();
        } else {
            //AUTHENTIFICATION
            $controller = new UserController();
            $controller->auth();
        }
    }
}
