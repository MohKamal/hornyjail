<?php
namespace Showcase\Models{
    use \Showcase\Framework\Database\Models\BaseModel;
    use \Exception;
    
    class Picture extends BaseModel
    {
        /**
         * Init the model
         */
        public function __construct(){
            $this->migration = 'Picture';
            BaseModel::__construct();
        }

    }

}