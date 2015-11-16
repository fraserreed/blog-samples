<?php

namespace DatabaseTesting\Tests\Persistence\Mappers;

use DatabaseTesting\Tests\Persistence\ArrayDataSet;
use DatabaseTesting\Tests\Persistence\DatabaseTestCase;


class BookMapperTest extends DatabaseTestCase
{
    /**
     * Prepare data set for database tests
     *
     * @return \PHPUnit_Extensions_Database_DataSet_AbstractDataSet
     */
    public function getDataSet()
    {
        //xml dataset
        return $this->createFlatXMLDataSet( __DIR__ . '/../../Fixtures/library-test.xml' );

        //yaml dataset
        //return new \PHPUnit_Extensions_Database_DataSet_YamlDataSet( __DIR__ . '/../../Fixtures/library-test.yml' );

        //csv dataset
        //$dataSet = new \PHPUnit_Extensions_Database_DataSet_CsvDataSet();
        //$dataSet->addTable( 'authors', __DIR__ . '/../../Fixtures/library-test-authors.csv' );
        //$dataSet->addTable( 'books', __DIR__ . '/../../Fixtures/library-test-books.csv' );
        //return $dataSet;

        //array dataset
        //return new ArrayDataSet( array(
        //    'authors' => array(
        //        array( 'id' => 100, 'name' => 'Mordecai Richler' ),
        //        array( 'id' => 101, 'name' => 'Farley Mowat' )
        //    ),
        //    'books' => array(
        //        array( 'id' => 200, 'isbn' => '978-0671028473', 'title' => 'The Apprenticeship of Duddy Kravitz', 'author_id' => 100 ),
        //        array( 'id' => 201, 'isbn' => '978-0887769252', 'title' => 'Jacob Two-Two Meets the Hooded Fang', 'author_id' => 100 ),
        //        array( 'id' => 202, 'isbn' => '978-1550139891', 'title' => 'The Farfarers', 'author_id' => 101 )
        //    ),
        //) );
    }

    public function testFetchAll()
    {
        $this->markTestIncomplete( 'Not written yet.' );
//        $bookRecords = $this->db->fetchAll( "SELECT id, isbn, author, title FROM books" );
//
//        $books = array();
//
//        if( count( $bookRecords ) > 0 )
//        {
//            foreach( $bookRecords as $bookRecord )
//            {
//                $book = new Book();
//                $book->setId( $bookRecord[ 'id' ] );
//                $book->setIsbn( $bookRecord[ 'isbn' ] );
//                $book->setAuthor( $bookRecord[ 'author' ] );
//                $book->setTitle( $bookRecord[ 'title' ] );
//
//                $books[] = $book;
//            }
//        }
//
//        return $books;
    }

    public function testFetchByISBN()
    {
        $this->markTestIncomplete( 'Not written yet.' );
//        $bookRecord = $this->db->fetchOne(
//            "SELECT id, isbn, author, title FROM books WHERE isbn = ?",
//            [ $isbn ]
//        );
//
//        if( $bookRecord )
//        {
//            $book = new Book();
//            $book->setId( $bookRecord[ 'id' ] );
//            $book->setIsbn( $bookRecord[ 'isbn' ] );
//            $book->setAuthor( $bookRecord[ 'author' ] );
//            $book->setTitle( $bookRecord[ 'title' ] );
//
//            return $book;
//        }
//
//        return null;
    }

    public function testInsert()
    {
        $this->markTestIncomplete( 'Not written yet.' );
//        $bookRecord = [
//            'isbn'   => $book->getIsbn(),
//            'author' => $book->getAuthor(),
//            'title'  => $book->getTitle()
//        ];
//
//        $this->db->insert( 'books', $bookRecord );
//
//        return $book;
    }

    public function testUpdate()
    {
        $this->markTestIncomplete( 'Not written yet.' );
//        $bookRecord = [
//            'isbn'   => $book->getIsbn(),
//            'author' => $book->getAuthor(),
//            'title'  => $book->getTitle()
//        ];
//
//        $this->db->update( 'books', $bookRecord, [ 'id' => $book->getId() ] );
//
//        return $book;
    }

    public function testDelete()
    {
        $this->markTestIncomplete( 'Not written yet.' );
//        $this->db->delete( 'books', [ 'id' => $book->getId() ] );
    }
}