<?php
# This grabs the keyword off the url -- index.php?keyword=Clouds
$keyword = $_GET['keyword'];
# Only do this if we've already passed in a keyword (i.e. it's not blank)
if ($keyword != "") {
    $search_query = $keyword; //change this
    $search_query = urlencode($search_query);
    $googleRealURL = "https://www.google.com/search?q=".$search_query."&tbm=isch&tbs=isz:l&hl=fr&sa=X&ved=0CAEQpwVqFwoTCND258HJtO0CFQAAAAAdAAAAABAL&biw=1263&bih=910";
    // Call Google with CURL + User-Agent
    $ch = curl_init($googleRealURL);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux i686; rv:20.0) Gecko/20121230 Firefox/20.0');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $google = curl_exec($ch);
    /*$array_imgurl = array();
    $array_imghtml = explode("\"ou\":\"", $google); //the big url is inside JSON snippet "ou":"big url"
    foreach ($array_imghtml as $key => $value) {
        if ($key > 0) {
            $array_imghtml_2 = explode("\",\"", $value);
            $array_imgurl[] = $array_imghtml_2[0];
        }
    }
    var_dump($array_imgurl); //array contains the urls for the big images*/
    $timestamp = time();
    $file = $timestamp . '.html';
    // Écrit le résultat dans le fichier
    file_put_contents($file, $google);
    $html = file_get_contents($file);
    //Create a new DOM document
    /*$dom = new DOMDocument;

    //Parse the HTML. The @ is used to suppress any parsing errors
    //that will be thrown if the $html string isn't valid XHTML.
    @$dom->loadHTML($html);

    //Get all links. You could also use any other tag name here,
    //like 'img' or 'table', to extract other tags.
    $links = $dom->getElementsByTagName('a');

    //Iterate over the extracted links and display their URLs
    foreach ($links as $link){
        //Extract and show the "href" attribute.
        echo $link->nodeValue;
        echo $link->getAttribute('href'), '<br>';
    }*/
    downloadPictures(".jpg", $html);
    downloadPictures(".png", $html);
}

function downloadPictures($ext, $html){
    preg_match_all('/https:(.*?)' . $ext . '/', $html, $matches);
    //var_dump($matches);
    $timestamp = time();
    $folder = 'pictures/' . $timestamp . '/';
    if(!file_exists($folder))
        mkdir($folder, 0777, true);
    foreach($matches as $list){
        foreach ($list as $img) {
            getSSLPage($ext, $img, $folder);
        }
    }
}

function getSSLPage($ext, $url, $folder) {
    $ch = curl_init($url);
    $timestamp = time();
    echo $url . ' => ' . $folder . $timestamp . $ext . '<br>';
    $fp = fopen($folder .  $timestamp . $ext, 'w');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSLVERSION,3); 
    curl_setopt($ch, CURLOPT_CAINFO, __DIR__ . "/cacert.pem");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);
}
?>
