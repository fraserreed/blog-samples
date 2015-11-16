<?php

namespace DatabaseTesting\Db;

interface IDbAdapter
{
    /**
     * Initialize the database connection
     *
     * @param     $dsn
     * @param     $username
     * @param     $password
     */
    public function __construct( $dsn, $username, $password );

    /**
     * Insert a record into the database
     *
     * @param       $table
     * @param array $bind
     *
     * @return int
     */
    public function insert( $table, $bind = array() );

    /**
     * Update a record in the database
     *
     * @param       $table
     * @param array $bind
     * @param array $where
     */
    public function update( $table, $bind = array(), $where = array() );

    /**
     * Delete a record from the database
     *
     * @param       $table
     * @param array $where
     */
    public function delete( $table, $where = array() );

    /**
     * Fetch a collection of records
     *
     * @param       $statement
     * @param array $bind
     *
     * @return array
     */
    public function fetchAll( $statement, $bind = array() );

    /**
     * Fetch a single record
     *
     * @param       $statement
     * @param array $bind
     *
     * @return array
     */
    public function fetchOne( $statement, $bind = array() );
}