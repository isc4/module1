<?php

//Message - флэш сообщения по средствам сессии

/*
* Class Message
* @method success()
* @method error()
* @method make()
*/

class Message {

    public $class;

    // 1. Тип сообщения при положительном результате (SUCCESS)
    /*
    * success( string $message)
    */
 
    public function success($message)
    {
        $_SESSION['message'] = $message;
        $this->class = 'container-fluid alert alert-success';
        $this->make();
        
    }

        // 1. Тип сообщения при отрицательном результате (ERROR)
    /*
    * error( string $message)
    */

    public function error($message)
    {
        $_SESSION['message'] = $message;
        $this->class = 'container-fluid alert alert-danger';
        $this->make();
    }

    // Вывод Flash сообщения

    public function make()
    {   
        if (isset($_SESSION['message'])) {
            echo '<div class="' . $this->class . '">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
  
    }
}
