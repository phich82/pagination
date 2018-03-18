<?php

namespace App\Commons;

use PHPUnit\Framework\Constraint\Exception;
use Symfony\Component\HttpFoundation\StreamedResponse;


class CSV
{
    private static $timeLimit = 60;
    private static $delimiter = ',';
    private static $filename  = null;
    private static $headers   = [];
    private static $titles    = [];
    private static $fields    = [];
    private static $contents  = [];


    /**
     * set limited executaion time
     *
     * @param integer $n
     * @return object
     */
    public static function limitTime($n)
    {
        if (is_int($n)) self::$timeLimit = $n;
        return new self;
    }

    /**
     * 
     */
    public static function delimiter($delimiter = ',')
    {
        self::$delimiter = $delimiter;
        return new self;
    }

    /**
     * set csv filename
     *
     * @param string $filename
     * @return object
     */
    public static function filename($filename = null)
    {
        self::$filename = $filename;
        return new self;
    }

    /**
     * set titles & fields required for csv
     *
     * @param array $titles
     * @return object
     */
    public static function titles($titles = [])
    {
        if (!is_array($titles)) throw new Exception('Argument should be an array.');
        self::$titles = array_values($titles);
        self::$fields = array_keys($titles);
        return new self;
    }

    /**
     * set contents for csv
     *
     * @param array $contents
     * @return object
     */
    public static function contents($contents = [])
    {
        self::$contents = $contents;
        return new self;
    }

    /**
     * get default headers
     *
     * @param string $filename
     * @return array
     */
    private static function headersDefault($filename = 'data')
    {
        return [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'.csv"',
        ];
    }

    /**
     * set headers when sending to browser
     *
     * @param string|array $headers
     * @return object
     */
    public static function headers($headers)
    {
        if ($headers) {
            if (is_string($headers)) {
                $split = explode(':', $headers);
                if (count($split) === 2) self::$headers[$split[0]] = $split[1];
            }
            else if (is_array($headers) && count($headers)) self::$headers = $headers;
        }
        return new self;
    }

    /**
     * get headers
     *
     * @return array
     */
    private static function getHeaders()
    {
        $headers = !empty(self::$headers) ? self::$headers : self::headersDefault();
        if (self::$filename) {
            // replace filename in headers by self::filename
            if (array_key_exists('Content-Disposition', $headers)) {
                $contentDisposition = $headers['Content-Disposition'];
                $headers['Content-Disposition'] = preg_replace('#filename\=\"(.*)\.csv\"#i', 'filename="'.self::$filename.'.csv"', $contentDisposition);
            }
        }
        return $headers;
    }

    /**
     * send csv file to browser for download
     *
     * @return void
     */
    public function send() {

    }

    /**
     * send csv file to browser for download by streaming
     *
     * @return object
     */
    public function sendStream($callback = null)
    {
        // set the limited time for download
        set_time_limit(self::$timeLimit); // 0: unlimited

        // required
        $titles    = self::$titles;
        $delimiter = self::$delimiter;
        $headers   = self::getHeaders();
        $contents  = self::$contents;
        $fields    = self::$fields;

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
        $response = new StreamedResponse(function() use ($contents, $titles, $fields, $delimiter, $headers, $callback) {
            // Open output stream
            $fp = fopen('php://output', 'w');

            // Add titles for CSV
            fputcsv($fp, $titles, $delimiter);

            if (is_callable($callback)) { // callback, execute it
                // Chunking large queries for no memory leak
                $callback($fp, $delimiter);
            } else {
                // check contents
                if (!empty($contents)) {
                    // contents contain total of fields more than total of the required fields (self::fields)
                    if ($callback === true) { // true: filter by fields required
                        foreach ($contents as $row) {
                            if (!empty($fields)) {
                                $out = [];
                                foreach ($fields as $field) { // only filter for fields required
                                    if (array_key_exists($field, $row)) $out[] = $row[$field];
                                }
                                // Add each new row
                                fputcsv($fp, $out, $delimiter);
                                $out = []; // reset
                            } else fputcsv($fp, $row, $delimiter);
                        }
                    } else { // default
                        foreach ($contents as $row) fputcsv($fp, $row, $delimiter);
                    }
                }
            }
            // Close output stream
            fclose($fp);
        }, 200, $headers);

        return $response; //->send();
    }
}