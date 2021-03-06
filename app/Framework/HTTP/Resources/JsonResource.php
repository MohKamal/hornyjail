<?php
namespace  Showcase\Framework\HTTP\Resources {
    use \Showcase\Framework\IO\Debug\Log;
    
    class JsonResource{

        /**
         * Object to return to json
         */
        protected $object = null;        

        /**
         * Init the resource with model and create all properties
         * With removing the hidden properties
         * @return json
         */
        public function __construct($obj){
            $this->object = $obj;
            return $this->initObject();
        }

        /**
         * Init this object with the object properties
         * or with the custom ones set by user
         */
        private function initObject(){
            $newKeys = $this->handle();
            if(!is_null($this->object)){
                $class_vars = get_object_vars($this->object);
                unset($class_vars['migration']);
                unset($class_vars['idDetails']);
                unset($class_vars['db']);
                if (empty($newKeys)) {
                    foreach ($class_vars as $key => $value) {
                        $this->createProperty($key, $value);
                    }
                }else{
                    foreach ($newKeys as $key => $value) {
                        $this->createProperty($key, $value);
                    }
                }
            }
            
            return $this;
        }

        /**
         * create properties to this object
         */
        private function createProperty($name, $value){
            $this->{$name} = $value;
        }

        
        /**
         * Getters
         * @param string property name
         * @return Mixte
         */
        function __get($name)
        {
            if (!is_null($this->object)) {
                if (isset($this->object->{$name})) {
                    return $this->object->{$name};
                }
            }
            if (isset($this->{$name})) {
                return $this->{$name};
            }
        }

        /**
         * Create a json from array of objects
         * @return array
         */
        public static function array($collection){
            if(empty($collection))
                return array();

            $newCollection = array();
            foreach($collection as $obj){
                $json = new static($obj);
                $newCollection[] = $json;
            }
            return $newCollection;
        }
    }
}