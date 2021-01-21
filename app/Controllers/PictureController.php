<?php
namespace Showcase\Controllers{

    use \Showcase\Framework\HTTP\Controllers\BaseController;
    use \Showcase\Framework\Validation\Validator;
    use \Showcase\Framework\IO\Debug\Log;
    use \Showcase\Models\Picture;
    use \Showcase\Framework\Session\Session;
    use \Showcase\Framework\Database\DB;

    class PictureController extends BaseController{

        /**
         * @return View
         */
        static function index(){
            return self::response()->view('App/welcome');
        }
        
        /**
         * @return View
         */
        static function create(){
            return self::response()->view('App/welcome');
        }
        
        /**
         * Post method
         * @param \Showcase\Framework\HTTP\Routing\Request
         * @return Redirection
         */
        static function store($request){
            if(Validator::Validate($request->getBody(), ['email', 'password'])){
                    return self::response()->Redirect('/'); 
            }
            return self::response()->Redirect('/contact'); 
        }

        static function viewed($request){
            if(Validator::Validate($request->getBody(), ['id'])){
                $pic = DB::model('Picture')->select()->where('id', $request->getBody()['id'])->first();
                $pic->views += 1;
                $pic->save();

                return self::response()->json(array("views"=> $pic->likes));
            }
        }

        static function getPictures($request){
            $page = 1;
            if (Validator::Validate($request->getBody(), ['page'])) {
                if($request->getBody()["page"] > 0) 
                    $page = $request->getBody()["page"];
            }
            $category = Session::retrieve('filter');
            $data = array();
            $count = 20;
                        
            if($category == null)
                $data = DB::table('pictures')->select()->get();
            else{
                $data = DB::table('pictures')->select()->where('category', $category['category'])->get();
            }
    
            $end = $page * $count;
            $start = $end - $count;
            if($start >= count($data))
                return self::response()->json(array());
            if($start > 0){
                $start += 1;
                $end += 1;
            }
            return self::response()->json(array_slice($data, $start, $end));
        }
    }
}