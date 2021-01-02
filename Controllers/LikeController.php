<?php
namespace Showcase\Controllers{

    use \Showcase\Framework\HTTP\Controllers\BaseController;
    use \Showcase\Framework\Validation\Validator;
    use \Showcase\Framework\HTTP\Links\URL;
    use \Showcase\Models\Picture;
    use \Showcase\Models\Like;

    class LikeController extends BaseController{

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
            if(Validator::Validate($request->getBody(), ['id'])){
                $like = new Like();
                $like->where([
                    'picture_id' => $request->getBody()['id'],
                    'ipaddress' => $request->remoteAddr
                ]);
                $pic = new Picture();
                $pic->get($request->getBody()['id']);
                if ($like->id !=  $request->getBody()['id'] && $like->ipaddress !=  $request->remoteAddr) {
                    $like = new Like();
                    $like->picture_id = $request->getBody()['id'];
                    $like->ipaddress = $request->remoteAddr;
                    $like->save();

                    $pic->likes += 1;
                    $pic->save();
                }

                return self::response()->json(array("likes"=> $pic->likes));
            }
        }
    }
}