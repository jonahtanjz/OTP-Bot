<?php
class DB {

        private static function connect() {
                $pdo = new PDO('mysql:host=127.0.0.1;dbname= ;charset=utf8', 'Username', 'Password');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
        }

        public static function query($query, $names = array()) {
                $sql_statement = self::connect()->prepare($query);
                $sql_statement->execute($names);

                if (explode(' ', $query)[0] == 'SELECT') {
                $data = $sql_statement->fetchAll();
                return $data;
                }
        }

}
