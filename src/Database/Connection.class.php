<?php

namespace Kernel\Database;

/**
 * Class Connection
 */
class Connection
{
    private static $instance = null;
    const OPTIONS = [
      \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
      \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    ];

    /**
     * @return null|\PDO
     * @throws \Exception
     */
    public static function connect()
    {
        try {
            if(!self::$instance) {
                $result = self::getAccess();
                self::$instance = new \PDO(
                    'mysql:dbname=' . $result['DATABASE'] . ';host=' . $result['HOST'],
                    $result['USER'],
                    $result['PASSWORD'],
                    self::OPTIONS
                );
                return self::$instance;
            }
            return self::$instance;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }

    /**
     * Fechar connexão
     */
    public static function closeConnection()
    {
        self::$instance = null;
    }

    /**
     * @return array|bool
     */
    private static function getAccess()
    {
        $result = parse_ini_file(__DIR__ . '/../Config/Database.ini');
        return $result;
    }
}