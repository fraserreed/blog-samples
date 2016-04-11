<?php

namespace DatabaseTesting\Tests\Persistence\Mappers;

use DatabaseTesting\Model\Book;
use DatabaseTesting\Tests\Persistence\ArrayDataSet;
use DatabaseTesting\Tests\Persistence\DatabaseTestCase;

use DatabaseTesting\Mappers\BookMapper;

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
        $bookMapper = new BookMapper( $this->getAdapter() );
        $allBooks   = $bookMapper->fetchAll();

        //verify the number of books returned
        $this->assertCount( 3, $allBooks );

        //verify each item
        /** @var \DatabaseTesting\Model\Book $book */
        $book = $allBooks[0];
        $this->assertEquals( 200, $book->getId() );
        $this->assertEquals( '978-0671028473', $book->getIsbn() );
        $this->assertEquals( 100, $book->getAuthorId() );
        $this->assertEquals( 'Mordecai Richler', $book->getAuthorName() );
        $this->assertEquals( 'The Apprenticeship of Duddy Kravitz', $book->getTitle() );

        $book = $allBooks[1];
        $this->assertEquals( 201, $book->getId() );
        $this->assertEquals( '978-0887769252', $book->getIsbn() );
        $this->assertEquals( 100, $book->getAuthorId() );
        $this->assertEquals( 'Mordecai Richler', $book->getAuthorName() );
        $this->assertEquals( 'Jacob Two-Two Meets the Hooded Fang', $book->getTitle() );

        $book = $allBooks[2];
        $this->assertEquals( 202, $book->getId() );
        $this->assertEquals( '978-1550139891', $book->getIsbn() );
        $this->assertEquals( 101, $book->getAuthorId() );
        $this->assertEquals( 'Farley Mowat', $book->getAuthorName() );
        $this->assertEquals( 'The Farfarers', $book->getTitle() );
    }

    public function testFetchByISBN()
    {
        $bookMapper = new BookMapper( $this->getAdapter() );

        /** @var \DatabaseTesting\Model\Book $book */
        $book = $bookMapper->fetchByISBN( '978-0887769252' );
        $this->assertEquals( 201, $book->getId() );
        $this->assertEquals( '978-0887769252', $book->getIsbn() );
        $this->assertEquals( 100, $book->getAuthorId() );
        $this->assertEquals( 'Mordecai Richler', $book->getAuthorName() );
        $this->assertEquals( 'Jacob Two-Two Meets the Hooded Fang', $book->getTitle() );

        //also verify a not-found request
        $book = $bookMapper->fetchByISBN( '978-9999988888' );
        $this->assertNull( $book );
    }

    public function testInsert()
    {
        //create a new book object
        $newBook = new Book();
        $newBook->setIsbn( '0-316-88179-1' );
        $newBook->setAuthorId( 101 );
        $newBook->setTitle( 'Never Cry Wolf' );

        //insert the book into the database
        $bookMapper = new BookMapper( $this->getAdapter() );
        $bookMapper->insert( $newBook );

        //fetch the book back using fetchByISBN
        $fetchedBook = $bookMapper->fetchByISBN( '0-316-88179-1' );

        //verify that the book fetched matches the book object
        $this->assertNotNull( $fetchedBook->getId() );
        $this->assertEquals( '0-316-88179-1', $fetchedBook->getIsbn() );
        $this->assertEquals( 101, $fetchedBook->getAuthorId() );
        $this->assertEquals( 'Farley Mowat', $fetchedBook->getAuthorName() );
        $this->assertEquals( 'Never Cry Wolf', $fetchedBook->getTitle() );
    }

    public function testUpdate()
    {
        $bookMapper = new BookMapper( $this->getAdapter() );

        //fetch a book from the database
        /** @var \DatabaseTesting\Model\Book $book */
        $book = $bookMapper->fetchByISBN( '978-0887769252' );
        $this->assertEquals( 201, $book->getId() );
        $this->assertEquals( '978-0887769252', $book->getIsbn() );
        $this->assertEquals( 100, $book->getAuthorId() );
        $this->assertEquals( 'Mordecai Richler', $book->getAuthorName() );
        $this->assertEquals( 'Jacob Two-Two Meets the Hooded Fang', $book->getTitle() );

        //update the object
        $book->setAuthorId( 101 );
        $book->setIsbn( '978-0-316-58633' );

        //persist the record back to the database
        $bookMapper->update( $book );

        //fetch it back again
        $fetchedBook = $bookMapper->fetchByISBN( '978-0-316-58633' );

        //verify the book fetch matches the updated book object
        $this->assertEquals( 201, $fetchedBook->getId() );
        $this->assertEquals( '978-0-316-58633', $fetchedBook->getIsbn() );
        $this->assertEquals( 101, $fetchedBook->getAuthorId() );
        $this->assertEquals( 'Farley Mowat', $fetchedBook->getAuthorName() );
        $this->assertEquals( 'Jacob Two-Two Meets the Hooded Fang', $fetchedBook->getTitle() );
    }

    public function testDelete()
    {
        $book = new Book();
        $book->setId( 201 );

        //delete a book from the database
        $bookMapper = new BookMapper( $this->getAdapter() );
        $bookMapper->delete( $book );

        //ensure it cannot be fetched back
        $fetchedBook = $bookMapper->fetchByISBN( '978-0887769252' );

        $this->assertNull( $fetchedBook );
    }
}