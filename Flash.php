<?php

//Message - флэш сообщения по средствам сессии

/*
* Class Message
*
* @method make()
*/


class Message {

    // 1. Флэш сообщения
    /*
    * make( string $message) : string
    */

    public static function make($message)
    {   
       return $_SESSION['message'] = $message;
  
    }
}
