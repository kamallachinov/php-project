<?php

class NotFound extends Controller {
   public function index(): string
   {
       $pageTitle = "404 Not Found";

       $navbarItems = $this->getNavbarItems();

       return '404 Not Found';
   }
}

echo (new NotFound())->index();
