<?php

/**
 * Class Connection
 */
class Connection extends PDO
{
    public function __construct()
    {
        try
        {
            $file = __DIR__."/../Config/Database.ini";
            if(!file_exists($file))
                throw new \Exception("Error",500);

            $array = \parse_ini_file($file);
            parent::__construct(
                'mysql:host='.$array['HOST'].';'.
                'dbname='.$array['DATABASE'],
                $array['USER'],
                $array['PASSWORD'],
                array(
                    parent::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                )
            );
        }
        catch (\Exception $e)
        {
            throw new Exception(
                $e->getMessage(),
                $e->getCode()
            );
        }
    }
}