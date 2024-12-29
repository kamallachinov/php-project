<?php

class Home extends Controller {
   public function index(): string
   {
       $pageTitle = "Home page";

       $navbarItems = $this->getNavbarItems();

       return require_once 'views/home.view.php';
   }
}

return (new Home())->index();
