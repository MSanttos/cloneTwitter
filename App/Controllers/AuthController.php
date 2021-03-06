<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action {

  public function autenticar(){
    // echo 'cheguei aqui';
    
    $usuario = Container::getModel('Usuario');
    $usuario->__set('email', $_POST['email']);
    $usuario->__set('senha', md5($_POST['senha']));

    //verifica se o usuario existe
    $retorno = $usuario->autenticar();

    if($usuario->__get('id') != '' && $usuario->__get('nome') != ''){

      session_start();

      $_SESSION['id'] = $usuario->__get('id');
      $_SESSION['nome'] = $usuario->__get('nome');

      header('Location: /timeline');
      //echo 'Autenticado';
    }else{
      header('Location: /?login=erro');
    }
  }

  public function sair(){
    session_start();

    session_destroy();

    header('Location: /');
  }
}

?>