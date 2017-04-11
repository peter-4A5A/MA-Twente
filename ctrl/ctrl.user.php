<?php
  session_start();
  if (ISSET($_REQUEST['user'])) {

    require_once $_SERVER['DOCUMENT_ROOT'] . '/MA-Twente/classes/user.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/MA-Twente/classes/view.class.php';

    $user = new user();
    $view = new view();

    switch ($_REQUEST['user']) {
      case 'login':
        $email = $_POST['email'];
        $password = $_POST['password'];

        $login = $user->login($email, $password);

        if ($login == true) {
          header('Location: dashboard.html');
        }
        else if ($login == false) {
          $view->displayMessage("Not correct");
        }
        break;
        case 'forgot':

          $userExists = $user->checkEmailExists($_REQUEST['email']);

          if ($userExists == true) {
            $user->updatePassword($_REQUEST['email'], "1234");
            $view->displayMessage("Wachtwoord is aangepast");
          }
          else {
            $view->displayMessage("Something went wrong");
          }
          break;
        case 'addUser':
          # code...
          break;
        case 'logout':
          $user->logout();
          header('Location: /MA-Twente/index.php');
          break;
    }
  }

?>
