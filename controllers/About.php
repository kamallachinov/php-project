<?php

class About extends Controller {
   public function index(): string
   {
       $pageTitle = "About page";

       $navbarItems = $this->getNavbarItems();

       return require_once 'views/about.view.php';
   }
}

return (new About())->index();
