<?php

use App\Post;
use App\Commons\CSV;
use Symfony\Component\HttpFoundation\StreamedResponse;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('posts', 'PostController@index');
Route::post('paginator/posts', 'PostController@paginator');
Route::get('paginator/list', 'PostController@showPosts');

Route::get('test', 'TestController@index');
Route::get('test/update', 'TestController@update');

Route::get('csv2', function () {
    $titles = ['id' => 'Id', 'title' => 'Title', 'body' => 'Body'];
    $contents = [
        ['id' => 1, 'title' => 'JavaScript', 'body' => 'This is JavaScript Subject']
    ];
    $filename = 'data';
    return CSV::titles($titles)
        // ->filename($filename)
        // ->contents($contents)
        // ->sendStream() // all contents
        // ->sendStream(true) // filter only contents by the required fields
        ->sendStream(function ($fp, $delimiter) {
            // Chunking large queries for no memory leak
            $count = 1;
            $max   = 2;
            Post::chunk(10, function($posts) use ($fp, $delimiter, &$count, $max) {
                if ($count > $max) return false; // break loop chunk()
                foreach ($posts as $post) {
                    if ($count > $max) break;
                    // Add each new row
                    fputcsv($fp, [$post->id, $post->title, $post->body], $delimiter);
                }
                $count++;
            });
        });
});
Route::get('csv', function () {
    // unlimited for download time
    set_time_limit(0);
    $delimiter = ',';
    /**
     * The CSV isn’t actually outputted until send() is called 
     * (which is done automatically later by Laravel) and you can add headers if you want.
     * 
     * Notes:
     * - Remember check your execution time, so set it to unlimited with:
     *      set_time_limit(0); 
     *      or reset it every chunk.
     * - Exporting UTF-8 data? Set the UTF-8 BOM directly after opening the stream: 
     *      fputs($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));
     * - Check your countries settings for the delimiter. 
     *      In the Netherlands for example, MS Excel recognizes the ';' delimiter, 
     *      but not the (default) ','.
     * - Is it still taking too long (download)? 
     *      You could use a Queue to create a file in the background and present 
     *      it as a download when ready.
     */
    $response = new StreamedResponse(function() {
        // Open output stream
        $handle = fopen('php://output', 'w');

        // Add CSV headers
        fputcsv($handle, [
            'Id',
            'Title', 
            'Content'
        ]);

        // Get all users
        // foreach (Post::find(1) as $post) {
        //     // Add a new row with data
        //     fputcsv($handle, [
        //         $post->id,
        //         $post->title,
        //         $post->body
        //     ]);
        // }
        
        // Chunking large queries for no memory leak
        Post::chunk(500, function($posts) use($handle) {
            foreach ($posts as $post) {
                // Add a new row with data
                fputcsv($handle, [
                  $post->id,
                  $post->title,
                  $post->body
                ]);
            }
        });

        // Close the output stream
        fclose($handle);
    }, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="export.csv"',
    ]);

    return $response;//->send();
});
