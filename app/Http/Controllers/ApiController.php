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
                $rssArray['item'] = array_map(function($item){
                    $item['pubDate'] = date(DATE_RSS, strtotime($item['pubDate']) );
                    return $item;
                }, $rssArray['item']);
                
                
                $all = $all->merge($rssArray['item']);
            }catch(\Exception $e){
                continue;
            }
            
        }

        return $all;

    }
}
