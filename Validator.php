<?php
//Validator - валидация входящих данных
/*
1. Проверка на пустоту
2. Проверка длинны пароля на соответствие
3. Проверка email на соответствие
4. Проверка пароля на соответствие
*/


/*
* Class Valodation
*
* @method ischeckForEmpty()
* @method maxLenght()
* @method isemailValid()
* @method ispasswordValid()
*/
class Validation {

// 1. Проверка на пустоту
/*
* ischeckForEmpty( string $data ) : bool
*/
public static function ischeckForEmpty($data)
{
    if (!empty($data)) {
        return true;  
    } else {
        return false;
    }
}


// 2. Проверка длинны пароля на соответствие
/*
* maxLenght( string $password, integer $longPass ) : bool
*/
public static function maxLenght($password, int $longPass)
{
   if (strlen($password) !== $longPass) {
    return false;
   } else {
    return true;
   }
}


//3. Проверка email на соответствие
/*
* isemailValid( string $email ) : bool
*/
public static function isemailValid($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

//4. Проверка пароля на соответствие
/*
* ispasswordValid( string $password1, string $password2 ) : bool
*/
public static function ispasswordValid($password1, $password2)
{
    if (password_verify($password1, $password2)) {
        return true;
    } else {
        return false;
    }
}


 
}
