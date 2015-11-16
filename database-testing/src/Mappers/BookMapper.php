<?php

namespace DatabaseTesting\Mappers;

use DatabaseTesting\Db\IDbAdapter;
use DatabaseTesting\Model\Book;


class BookMapper
{
    /**
     * @var \DatabaseTesting\Db\IDbAdapter
     */
    protected $db;

    /**
     * @param IDbAdapter $dbAdapter
     */
    public function __construct( IDbAdapter $dbAdapter )
    {
        $this->db = $dbAdapter;
    }

    /**
     * Fetch all books in the library
     *
     * @return array
     */
    public function fetchAll()
    {
        $bookRecords = $this->db->fetchAll( "SELECT b.id, b.isbn, b.author_id, a.name as author_name, b.title FROM books b INNER JOIN authors a ON b.author_id = a.id" );

        $books = array();

        if( count( $bookRecords ) > 0 )
        {
            foreach( $bookRecords as $bookRecord )
            {
                $book = new Book();
                $book->setId( $bookRecord[ 'id' ] );
                $book->setIsbn( $bookRecord[ 'isbn' ] );
                $book->setAuthorId( $bookRecord[ 'author_id' ] );
                $book->setAuthorName( $bookRecord[ 'author_name' ] );
                $book->setTitle( $bookRecord[ 'title' ] );

                $books[] = $book;
            }
        }

        return $books;
    }

    /**
     * Fetch a book by the ISBN
     *
     * @param $isbn
     *
     * @return Book
     */
    public function fetchByISBN( $isbn )
    {
        $bookRecord = $this->db->fetchOne(
            "SELECT b.id, b.isbn, b.author_id, a.name as author_name, b.title FROM books b INNER JOIN authors a ON b.author_id = a.id WHERE b.isbn = ?",
            [ $isbn ]
        );

        if( $bookRecord )
        {
            $book = new Book();
            $book->setId( $bookRecord[ 'id' ] );
            $book->setIsbn( $bookRecord[ 'isbn' ] );
            $book->setAuthorId( $bookRecord[ 'author_id' ] );
            $book->setAuthorName( $bookRecord[ 'author_name' ] );
            $book->setTitle( $bookRecord[ 'title' ] );

            return $book;
        }

        return null;
    }

    /**
     * Insert a book record into the database
     *
     * @param Book $book
     *
     * @return Book
     */
    public function insert( Book $book )
    {
        $bookRecord = [
            'isbn'      => $book->getIsbn(),
            'author_id' => $book->getAuthorId(),
            'title'     => $book->getTitle()
        ];

        $this->db->insert( 'books', $bookRecord );

        return $book;
    }

    /**
     * Update a book record into the database
     *
     * @param Book $book
     *
     * @return Book
     */
    public function update( Book $book )
    {
        $bookRecord = [
            'isbn'      => $book->getIsbn(),
            'author_id' => $book->getAuthorId(),
            'title'     => $book->getTitle()
        ];

        $this->db->update( 'books', $bookRecord, [ 'id' => $book->getId() ] );

        return $book;
    }

    public function delete( Book $book )
    {
        $this->db->delete( 'books', [ 'id' => $book->getId() ] );
    }

}