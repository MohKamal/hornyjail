<?php
namespace Showcase\Models{
    use \Showcase\Framework\Database\Models\BaseModel;
    use \Exception;
    
    class Like extends BaseModel
    {
        /**
         * Init the model
         */
        public function __construct(){
            $this->migration = 'Likes';
            BaseModel::__construct();
        }

    }

}