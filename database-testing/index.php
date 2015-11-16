<?php

require_once __DIR__ . '/vendor/autoload.php';

$dbAdapter = new \DatabaseTesting\Db\MysqlAdapter( 'mysql:host=10.0.0.20;dbname=library;', 'root', 'tutorial' );

$bookMapper = new \DatabaseTesting\Mappers\BookMapper( $dbAdapter );

$books = $bookMapper->fetchAll();

echo "Fetching all (" . count( $books ) . ").. \n";
var_dump( $books );

echo "Inserting new record.. \n";

$book = new \DatabaseTesting\Model\Book();
$book->setIsbn( 'new-isbn-test' );
$book->setAuthorId( 1 );
$book->setTitle( 'New Title' );

$bookMapper->insert( $book );

$books = $bookMapper->fetchAll();

echo "Fetching all (" . count( $books ) . ").. \n";
var_dump( $books );

$book = $bookMapper->fetchByISBN( '9780767908184' );

echo "Fetching one (ISBN: 9780767908184).. \n";
var_dump( $book );

$book->setAuthorId( 1 );

echo "Updating author on ISBN: 9780767908184.. \n";

$bookMapper->update( $book );

$books = $bookMapper->fetchAll();

echo "Fetching all (" . count( $books ) . ").. \n";
var_dump( $books );

echo "Deleting last item in list.. \n";
$bookMapper->delete( array_pop( $books ) );

$books = $bookMapper->fetchAll();

echo "Fetching all (" . count( $books ) . ").. \n";
var_dump( $books );
