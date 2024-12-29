<?php

class Controller {
    public function getNavbarItems(): array
    {
        $navbarItemsSql = DatabaseConnection::getConnection()->prepare("SELECT * FROM `navbar-items`");
        $navbarItemsSql->execute();

        return $navbarItemsSql->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}