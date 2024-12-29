<?php

class Dashboard extends Controller {
   public function index(): string
   {
       $pageTitle = "Dashboard page";

       $navbarItems = $this->getNavbarItems();

       return require_once 'views/dashboard.view.php';
   }
}

return (new Dashboard())->index();
