<?php
namespace App\Http\Controllers;

use FeedException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

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

    public function getFeed(Request $request)
    {
        $defaultList = [
            'https://salar.one/feed/',
            'https://medium.com/feed/@salar_one'
        ];

        $list = $request->get('list');
        
        if(empty($list)){
            $list = $defaultList;
        }

        $all = collect();
        foreach($list as $feed){
            try{
                $rss = \Feed::loadRss($feed);
                $rssArray = $rss->toArray();
                $all = $all->merge($rssArray['item']);
            }catch(FeedException $e){
                continue;
            }
        }

        return $all;
        



        // $rss = \Feed::loadRss($fee2);
        // return $rss->toArray();


    }
}
