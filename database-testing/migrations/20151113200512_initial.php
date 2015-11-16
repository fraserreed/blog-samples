<?php

use Phinx\Migration\AbstractMigration;


class Initial extends AbstractMigration
{
    public function up()
    {
        // create the authors table
        $table = $this->table( 'authors' );
        $table->addColumn( 'name', 'string' )
            ->create();

        $authors = array(
            array( 1, 'Khaled Hosseini' ),
            array( 2, 'Bill Bryson' )
        );

        foreach( $authors as $author )
            $this->execute(
                "INSERT INTO authors ( id, name )
                VALUES ( '" . $author[ 0 ] . "' , '" . $author[ 1 ] . "')"
            );

        // create the books table
        $table = $this->table( 'books' );
        $table->addColumn( 'isbn', 'string', [ 'length' => 16 ] )
            ->addColumn( 'author_id', 'integer' )
            ->addColumn( 'title', 'string' )
            ->create();

        $books = array(
            array( 1, '9780767908184', 2, 'A Short History of Nearly Everything' ),
            array( 2, '9781594480003', 1, 'The Kite Runner' ),
            array( 3, '9780767919371', 2, 'The Life and Times of the Thunderbolt Kid' ),
            array( 4, '9780385539289', 2, 'The Road to Little Dribbling' )
        );

        foreach( $books as $book )
            $this->execute(
                "INSERT INTO books ( id, isbn, author_id, title )
                VALUES ( " . $book[ 0 ] . " , '" . $book[ 1 ] . "', '" . $book[ 2 ] . "', '" . $book[ 3 ] . "')"
            );
    }

    public function down()
    {
        //drop the tables
        $this->table( 'books' )->drop();
        $this->table( 'authors' )->drop();
    }
}
