<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Author;

class PracticeController extends Controller
{
    public function practice15()
    {

        # Eager load the author with the book
        $books = Book::with('author')->get();

        foreach ($books as $book) {
            if ($book->author) {
                dump($book->author->first_name . ' ' . $book->author->last_name . ' wrote ' . $book->title);
            } else {
                dump($book->title . ' has no author associated with it.');
            }
        }

        dump($books->toArray());
    }

    public function practice14()
    {
        # Get an example book
        $book = Book::whereNotNull('author_id')->first();

        # Get the author from this book using the "author" dynamic property
        # "author" corresponds to the the relationship method defined in the Book model
        $author = $book->author;

        # Output
        dump($book->title . ' was written by ' . $author->first_name . ' ' . $author->last_name);
        dump($book->toArray());
    }

    public function practice13()
    {
        $author = Author::where('first_name', '=', 'J.K.')->first();

        $book = new Book();
        $book->slug = 'fantastic-beasts-and-where-to-find-them';
        $book->title = "Fantastic Beasts and Where to Find Them";
        $book->published_year = 2001;
        $book->cover_url = 'https://hes-bookmark.s3.amazonaws.com/cover-placeholder.png';
        $book->info_url = 'https://en.wikipedia.org/wiki/Fantastic_Beasts_and_Where_to_Find_Them';
        $book->purchase_url = 'http://www.barnesandnoble.com/w/fantastic-beasts-and-where-to-find-them-j-k-rowling/1004478855';
        $book->author()->associate($author); # <--- Associate the author with this book
        $book->description = 'Fantastic Beasts and Where to Find Them is a 2001 guide book written by British author J. K. Rowling (under the pen name of the fictitious author Newt Scamander) about the magical creatures in the Harry Potter universe. The original version, illustrated by the author herself, purports to be Harry Potter’s copy of the textbook of the same name mentioned in Harry Potter and the Philosopher’s Stone (or Harry Potter and the Sorcerer’s Stone in the US), the first novel of the Harry Potter series. It includes several notes inside it supposedly handwritten by Harry, Ron Weasley, and Hermione Granger, detailing their own experiences with some of the beasts described, and including in-jokes relating to the original series.';
        $book->save();
        dump($book->toArray());
    }

    public function practice12(Request $request)
    {
        // # Retrieve the currently authenticated user via the Auth facade
        // $user = Auth::user();
        // dump($user->toArray());

        // # Retrieve the currently authenticated user via request object
        // $user = $request->user();
        // dump($user->toArray());

        # Check if the user is logged in
        if (Auth::check()) {
            dump('The user ID is '.Auth::id());
        }
    }

    public function practice11()
    {

        // $results = Book::all();
        // dump($results); # Shows an object of type Illuminate\Database\Eloquent\Collection that contains multiple Book objects

        // $results = Book::where('published_year', '>', 1990)->get();
        // dump($results); # Shows an object of type Illuminate\Database\Eloquent\Collection that contains multiple Book objects

        # Even if our query finds just 1 result, *get* still yields a Collection, it'll just be a Collection of 1 object:
        $results = Book::where('title', '=', 'The Martian')->get();
        dump($results); # Shows an object of type Illuminate\Database\Eloquent\Collection that contains 1 Book object

        // # Similarly, if our query does not find any results, *get* still yields a Collection, it’ll just be empty
        // $results = Book::where('author', '=', 'Amy Tan')->get();
        // dump($results); # Empty collection

        // # Even if we limit our query to 1 book, because we're using the *get* method, we will get a Collection in return
        // $results = Book::limit(1)->get();

    }

    public function practice10()
    {

        $results = Book::first();
        dump($results); # Shows an object of type App\Models\Book

        $results = Book::find(1);
        dump($results); # Shows an object of type App\Models\Book

    }

    public function practice9()
    {

        // Resources and Practice queries

        // Query practice 1
        // $result = Book::orderBy('created_at', 'desc')->limit(2)->get();
        // dump($result->toArray());

        // Query Practice 2
        // $result = Book::where('published_year', '>', '1950')->get();
        // dump($result->toArray());

        // Query Practice 3
        // $result = Book::orderBy('title')->get();
        // dump($result->toArray());

        // Query Practice 4
        // $result = Book::orderBy('published_year', 'desc')->get();
        // dump($result->toArray());

        // Query Practice 5
        // $result = Book::where('author', '=', 'J.K.Rowling')->update('JK Rowling');
        // dump($result->toArray());

        // Query Practice 6
        // $result = Book::where('author', 'LIKE', 'Rowling')->get();
        // if (!$result) {
        //     dump("Book not found, can not delete.");
        // } else {
        //    $result->delete();

        //     dump('deletion complete');
        // }

    }

    public function practice8()
    {
        # First get a book to update
        $book = Book::where('author', '=', 'F. Scott Fitzgerald')->first();

        if (!$book) {
            dump("Book not found, can not delete.");
        } else {
            $book->delete();

            dump('deletion complete');
        }

        # Output books to confirm the above query worked as expected
        dump(Book::where('author', '=', 'F. Scott Fitzgerald')->get()->toArray());
    }

    public function practice7()
    {
        $books = Book::where('author', '=', 'J.K. Rowling')->get();

        if (!$books) {
            dump("Book not found, can not update.");
        } else {

            foreach($books as $book) {

                # Change some properties
                $book->author = 'JK Rowling';

                # Save the changes
                $book->save();

            }

            dump('Update complete');
        }

        # Output books to confirm the above query worked as expected
        dump(Book::orderBy('published_year')->get()->toArray());
    }


    public function practice6()
    {
        # First get a book to update
        $book = Book::where('author', '=', 'F. Scott Fitzgerald')->first();

        if (!$book) {
            dump("Book not found, can not update.");
        } else {
            # Change some properties
            $book->title = 'The Really Great Gatsby';
            $book->published_year = '2025';

            # Save the changes
            $book->save();

            dump('Update complete');
        }

        # Output books to confirm the above query worked as expected
        dump(Book::orderBy('published_year')->get()->toArray());
    }

    public function practice5()
    {

        $book = new Book();
        $books = $book->where('title', 'LIKE', '%Harry Potter%')->orWhere('published_year', '>', 1998)->get();

        dump($books->toArray());

    }

    public function practice4()
    {
        $book = new Book();
        $book->slug = 'the-martian';
        $book->title = 'The Martian';
        $book->author = 'Anthony Weir';
        $book->published_year = 2011;
        $book->cover_url = 'https://hes-bookmark.s3.amazonaws.com/the-martian.jpg';
        $book->info_url = 'https://en.wikipedia.org/wiki/The_Martian_(Weir_novel)';
        $book->purchase_url = 'https://www.barnesandnoble.com/w/the-martian-andy-weir/1114993828';
        $book->description = 'The Martian is a 2011 science fiction novel written by Andy Weir. It was his debut novel under his own name. It was originally self-published in 2011; Crown Publishing purchased the rights and re-released it in 2014. The story follows an American astronaut, Mark Watney, as he becomes stranded alone on Mars in the year 2035 and must improvise in order to survive.';

        # Invoke the Eloquent `save` method to generate a new row in the
        # `books` table, with the above data
        $book->save();

        # Confirm results
        dump('Added: ' . $book->title);
        dump(Book::all()->toArray());
    }

    public function practice3()
    {
        dump(DB::select('SHOW DATABASES;'));
    }

    public function practice2()
    {
        dump(config('database'));
    }
    /**
     * First practice example
     * GET /practice/1
     */
    public function practice1()
    {
        dump('This is the first example.');
    }

    /**
     * ANY (GET/POST/PUT/DELETE)
     * /practice/{n?}
     * This method accepts all requests to /practice/ and
     * invokes the appropriate method.
     * http://bookmark.yourdomain.com.loc/practice => Shows a listing of all practice routes
     * http://bookmark.yourdomain.com.loc/practice/1 => Invokes practice1
     * http://bookmark.yourdomain.com.loc/practice/5 => Invokes practice5
     * http://bookmark.yourdomain.com.loc/practice/999 => 404 not found
     */
    public function index(Request $request, $n = null)
    {
        $methods = [];

        # Load the requested `practiceN` method
        if (!is_null($n)) {
            $method = 'practice' . $n; # practice1

            # Invoke the requested method if it exists; if not, throw a 404 error
            return (method_exists($this, $method)) ? $this->$method($request) : abort(404);
        } # If no `n` is specified, show index of all available methods
        else {
            # Build an array of all methods in this class that start with `practice`
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    $methods[] = $method;
                }
            }

            # Load the view and pass it the array of methods
            return view('practice')->with([
                'methods' => $methods,
                'books' => Book::all(),
                'fields' => [
                    'id', 'updated_at', 'created_at', 'slug', 'title', 'author', 'published_year'
                ]
            ]);
        }
    }
}