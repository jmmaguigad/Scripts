<?php 
/*
* for parsing rss feed using yahoo! query language
* alternative for google feed api which is deprecated
* Params:
* url -> url link of rss of the site
* title -> title for the header of the rss container
* option 1 -> style for home
* option 2 -> style for about us
* UPDATE 03-07-2018 -> added condition to hide or display none "This RSS feed URL is deprecated" text reference: https://support.start.me/hc/en-us/articles/115005846665-Why-does-my-Google-News-feed-shows-this-RSS-feed-URL-is-deprecated-
*/
function parseRss($url,$title,$option) {
    $BASE_URL = "http://query.yahooapis.com/v1/public/yql";
    $yql_query = 'select title,link from rss where url="'.$url.'"';
    $yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=json";
    $session = curl_init($yql_query_url);
    curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
    $json = curl_exec($session);
    $phpObj =  json_decode($json);
    if(!is_null($phpObj->query->results)){
        if ($option == 1) {
            echo '<div class="col-md-4">';
        } elseif ($option == 2) {
            echo '<div class="col-md-12">';
        }
            echo '<div class="title-head" style="color:#0c9ec7">'.$title.'</div>';  
        if ($option == 1) {
            echo '<div class="footer-content text-center padding-ver-clear">';
        } elseif ($option == 2) {
            echo '<div style="font-size:13px;" class="footer-content text-center padding-ver-clear">';
        }        
            echo '<div style="overflow-y:scroll;height:250px;">';
            foreach($phpObj->query->results->item as $item){
            	($item->title == "This RSS feed URL is deprecated") ? $style = 'style="display:none;"' : $style = "";
                echo '<a href="'.$item->link.'" '.$style.' target="_blank">'.$item->title.'</a><hr '.$style.'>';
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';        
    }
}