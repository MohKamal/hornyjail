<?php
namespace Showcase\Models{
    use \Showcase\Framework\Database\Models\BaseModel;
    use \Exception;
    
    class Download extends BaseModel
    {
        /**
         * Init the model
         */
        public function __construct(){
            $this->migration = 'Download';
            BaseModel::__construct();
        }

    }

}