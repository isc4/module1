<?php
//QueryBuilder - Построитель запросов к бд
/*
1. Получение всех записей из таблицы
2. Получение одной записи из таблицы по id
3. Добавление записи в таблицу
4. Изменение записи в таблице по id
5. Удаление записи в таблице по id
6. Получение записей таблицы по ключевому значению
7. Поиск записи соответствующей указанным значениям логин - пароль 
*/


/*
* Class QueryBuilder
*
* @method getAll()
* @method getOne()
* @method make()
* @method update()
* @method delete()
* @method filter()
* @method login()
*/



class QueryBuilder {

    private $pdo; // подключение к бд

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // 1. Получение всех записей из таблицы
    /*
    * getAll( string $table ) : array
    */

    public function getAll($table)
    {
        $sql = "SELECT * FROM {$table}";
        $statment = $this->pdo->prepare($sql);
        $statment->execute();
        $posts = $statment->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

    // 2. Получение одной записи из таблицы по id
    /*
    * getOne( string $table, int $id ) : array
    */

    public function getOne($table, $id)
    {
        $sql = "SELECT * FROM {$table} WHERE id = :id";
        $statment = $this->pdo->prepare($sql);
        $statment->bindValue(":id", $id);
        $statment->execute();
        $posts = $statment->fetch(PDO::FETCH_ASSOC);
        return $posts;
    }

    // 3. Добавление записи в таблицу
    /*
    * make( string $table, array $data )
    */

    public function make($table,$data)
    {
        $keys = implode(', ', array_keys($data));
        $tags =":" . implode(', :', array_keys($data));
        $sql = "INSERT INTO {$table} ({$keys}) VALUE ({$tags})";
        $statment = $this->pdo->prepare($sql);
        $statment->execute($data);
    }

    // 4. Изменение записи в таблице по id
    /*
    * update( string $table, array $data, int $id  )
    */

    public function update($table, $data, $id)
    {
        $keys = array_keys($data);
        $string = '';
        foreach($keys as $key) {
            $string .= $key . '=:' . $key . ',';
        }
        $keys = rtrim($string, ',');
        $data['id'] = $id;
        $sql = "UPDATE {$table} SET {$keys} WHERE id=:id";
        $statment = $this->pdo->prepare($sql);
        $statment->bindValue(':id', $id);
        $statment->execute($data);
    }

    // 5. Удаление записи в таблице по id
    /*
    * delete( string $table, int $id  )
    */

    public function delete($table, $id)
    {
        $sql = "DELETE FROM {$table} WHERE id = :id";
        $statment = $this->pdo->prepare($sql);
        $statment->bindValue(":id", $id);
        $statment->execute();
    }

    // 6. Получение записей таблицы по ключевому значению
    /*
    * filter( string $table, string $field, string $key ) : array
    */

    public function filter ($table, $field, $key)
    {
        $sql = "SELECT * FROM {$table} WHERE {$field} = :{$field}";
        $statment = $this->pdo->prepare($sql);
        $statment->bindValue(":{$field}", $key);
        $statment->execute();
        $posts = $statment->fetch(PDO::FETCH_ASSOC);
        return $posts;

    }

    // 7. Поиск записи соответствующей указанным значениям логин - пароль 
    /*
    * login( string $table, array $data ) : array
    */

    public function login ($table, $data) 
    {
        $keys = array_keys($data);
        $string = '';
        foreach($keys as $key) {
            $string .= $key . '=:' . $key . ' AND ';
        }
        $keys = rtrim($string, ' AND ');
        $sql = "SELECT * FROM {$table} WHERE {$keys}";
        $statment = $this->pdo->prepare($sql);
        $statment->bindValue("{$keys}", implode(',', $data));
        $statment->execute($data);
        $posts = $statment->fetch(PDO::FETCH_ASSOC);
        return $posts;

    }
}
