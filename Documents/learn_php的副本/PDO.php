<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/30
 * Time: 下午7:03
 */
$dbms='mysql';
$host='localhost';
$dbName='demo';
$user='root';
$pass='123456';
$dsn="$dbms:host=$host;dbname=$dbName";


try {
    $dbh = new PDO($dsn, $user, $pass,array(PDO::ATTR_PERSISTENT => true));
    echo "连接成功<br/>";
//    $dbh->exec('INSERT INTO student(id,name,gender) VALUES (8,"xiaoming","m")');
//    $dbh->exec("DELETE FROM student WHERE id = 8");
//    $dbh->exec("UPDATE student SET name = 'tom' WHERE id = 8");
    $st = $dbh->query('SELECT * FROM student');

    foreach ($st->fetchAll() as $row){
        print "{$row['name']}  <br>\n";
    }

    $dbh = null;
} catch (PDOException $e) {
    die ("Error!: " . $e->getMessage() . "<br/>");
}
