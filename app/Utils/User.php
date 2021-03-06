<?php


namespace Oquiz\Utils;


class User{

//Classe servant de librairie de fonction
  public static function isConnected() {
    return !empty($_SESSION['user']);
  }


  public static function getUser() {
    if (self::isConnected()) {
        return $_SESSION['user'];
    }
    return false;
  }

    public static function setUser($userModel) {
      if (is_object($userModel)) {
          $_SESSION['user'] = $userModel;
      }
  }

  public static function logout(){

      unset($SESSION['user']);

      // Je peux aussi supprimer toutes les données en session
      session_unset();

      // Je peux aussi supprimer la sesssion complète (mais agit comme session_unset)
      session_destroy();
  }


}
