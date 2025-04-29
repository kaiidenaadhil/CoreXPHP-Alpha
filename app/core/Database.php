<?php

class Database{

  protected static $instance = null;

  protected $conn;

  public function __construct()

  {

    try

    {  
      

        $dsn = DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME;

        $this->conn = new PDO($dsn,DB_USER,DB_PASS);

        $this->conn->exec("SET NAMES utf8mb4");


        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    }catch(PDOException $e)

    {

      $e->getMessage();

	  

    }





  }

  

    public static function getInstance()

    {

        if(!self::$instance)

        {

        self::$instance =  new self();

        }



        return self::$instance;

    }

    

    public function getConnection()

    {

        return $this->conn;

    }





  

}