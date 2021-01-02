<?php
namespace Showcase\Models{
    use \Showcase\Framework\Database\Models\BaseModel;
    use \Exception;
    use \Showcase\Models\Picture;
    
    class Search extends BaseModel
    {
        /**
         * Init the model
         */
        public function __construct(){
            $this->migration = 'NameMigration';
            BaseModel::__construct();
        }

        public static function GetPictures($keyword)
        {
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
                $timestamp = time();
                $file = $timestamp . '.html';
                // Écrit le résultat dans le fichier
                file_put_contents($file, $google);
                $html = file_get_contents($file);
                self::savePictures(".jpg", $html, $keyword);
                self::savePictures(".png", $html, $keyword);
                self::savePictures(".gif", $html, $keyword);
            }
        }
            
        static function savePictures($ext, $html, $keyword){
            preg_match_all('/https:(.*?)' . $ext . '/', $html, $matches);
            foreach($matches as $list){
                foreach ($list as $img) {
                    $pic = new Picture();
                    $pic->name = basename($img);
                    $pic->url = $img;
                    $pic->category = $keyword;
                    $pic->save();
                }
            }
        }

    }

}