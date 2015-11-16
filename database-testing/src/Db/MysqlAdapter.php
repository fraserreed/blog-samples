<?php

namespace DatabaseTesting\Db;

use PDO, PDOException;


class MysqlAdapter implements IDbAdapter
{
    /**
     * @var string
     */
    private $dsn;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var PDO
     */
    protected static $db = null;

    /**
     * Initialize MySQL database connection class
     *
     * @param $dsn
     * @param $username
     * @param $password
     */
    public function __construct( $dsn, $username, $password )
    {
        $this->dsn      = $dsn;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        if( !self::$db )
            self::$db = new PDO( $this->dsn, $this->username, $this->password );

        return self::$db;
    }

    /**
     * Insert record into the database
     *
     * @param       $table
     * @param array $bind
     *
     * @return int
     */
    public function insert( $table, $bind = array() )
    {
        $db = $this->getConnection();

        $query = $db->prepare(
            "INSERT INTO `{$table}` (" . implode( ', ', array_keys( $bind ) ) . ") " .
            " VALUES ( :" . implode( ', :', array_keys( $bind ) ) . " )"
        );

        $query->execute( $bind );

        return $db->lastInsertId( $table );
    }

    /**
     * Update record in the database
     *
     * @param       $table
     * @param array $bind
     * @param array $where
     */
    public function update( $table, $bind = array(), $where = array() )
    {
        $db = $this->getConnection();

        $setValues = array();

        foreach( $bind as $column => $value )
            $setValues[] = $column . " = :" . $column;

        $whereValues = array();

        foreach( $where as $column => $value )
            $whereValues[] = $column . " = " . $db->quote( $value );

        $query = $db->prepare(
            "UPDATE `{$table}` SET " . implode( ', ', $setValues ) . " WHERE " . implode( ' AND ', $whereValues )
        );

        $query->execute( $bind );
    }

    /**
     * Delete record from the database
     *
     * @param       $table
     * @param array $where
     */
    public function delete( $table, $where = array() )
    {
        $db = $this->getConnection();

        $whereValues = array();

        foreach( $where as $column => $value )
            $whereValues[] = $column . " = :" . $column;

        $query = $db->prepare(
            "DELETE FROM `{$table}` WHERE " . implode( ' AND ', $whereValues )
        );

        $query->execute( $where );
    }

    /**
     * @param       $statement
     * @param array $bind
     *
     * @return array
     */
    public function fetchAll( $statement, $bind = array() )
    {
        return $this->select( $statement, $bind );
    }

    /**
     * @param       $statement
     * @param array $bind
     *
     * @return array
     */
    public function fetchOne( $statement, $bind = array() )
    {
        $rows = $this->select( $statement, $bind );

        if( count( $rows ) > 0 )
            return $rows[ 0 ];

        return null;
    }

    /**
     * Prepare and execute select statement, with binding values
     *
     * @param       $statement
     * @param array $bind
     *
     * @return array
     * @throws \ezcDbHandlerNotFoundException
     */
    private function select( $statement, $bind = array() )
    {
        $db = $this->getConnection();

        $query = $db->prepare( $statement );
        $query->execute( $bind );

        return $query->fetchAll();
    }
}
