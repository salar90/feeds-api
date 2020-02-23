<?php
namespace App\Http\Controllers;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getFeed()
    {
        
        $feed1 = simplexml_load_file('http://salar.one/feed/');
        $feed2 = simplexml_load_file('https://medium.com/feed/@salar_one');
        // $merged = \MergeRSS\merge_rss(array($feed1, $feed2));
        // echo json_encode($merged);

        $feed1 = 'https://salar.one/feed/';
        $feed2 = 'https://medium.com/feed/@salar_one';


        $rss = \Feed::loadRss($feed2);
        return $rss->toArray();


    }
}
