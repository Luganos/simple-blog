<?php


class Model
{
    
        protected $db = null;
        
        protected $host = "localhost";
        
        protected $user = "root";
        
        protected $pass = "123456789";
        
        protected $name = "simple-blog";
        
         
   public function __construct() 
   {
            
        try {
                 
                $this->db = new PDO("mysql:host={$this->host};dbname={$this->name}",$this->user,$this->pass);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
             } catch(PDOException $e) {
     
               error_log(date('Y-m-d H:i:s - ', time()). $e->getMessage() . "\n", 3, __DIR__ ."/error.log");
            }
    }
        
   /**
     * Prepare data before use
     * @mix $input - raw input data
    */
    public function validate($input)
    {
 
        if(is_array($input)){
            
           return array_map(__METHOD__, $input);
        }

        if(!empty($input) && is_string($input)){
            return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $input);
        }

        return $input;
 
    } 
    
    /**
     * Escape all HTML, JavaScript, and CSS
     * 
     * @param string $input The input string
     * @param string $encoding Which character encoding are we using?
     * @return string
     */
     public function noHTML($input, $encoding = 'UTF-8')
     {
          return htmlentities($input, ENT_QUOTES | ENT_HTML5, $encoding);
     }  
}