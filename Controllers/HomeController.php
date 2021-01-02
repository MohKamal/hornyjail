<?php
/**
 * 
 * Default controller in the Showcase
 * 
 */
namespace Showcase\Controllers{

    use \Showcase\Framework\HTTP\Controllers\BaseController;
    use \Showcase\Models\Search;
    use \Showcase\Framework\HTTP\Links\URL;
    use \Showcase\Framework\Database\DB;
    use \Showcase\Framework\Session\Session;

    class HomeController extends BaseController{

        /**
         * Return the welcome view
         */
        static function Index(){
            return self::response()->view('App/welcome');
        }

        /**
         * Return the welcome view
         */
        static function Search(){
            $lines = file("../ressources/words.txt", FILE_IGNORE_NEW_LINES);
            $rand_keys = array_rand($lines, 1);
            Search::GetPictures($lines[$rand_keys]);
            //get categories from db
            $categories = DB::table('pictures')->select(['category'])->distinct()->get();
            $rand_keys = array_rand($categories, 1);
            Session::store('filter', $categories[$rand_keys]);
            return self::response()->redirect('/');
        }
    }
}