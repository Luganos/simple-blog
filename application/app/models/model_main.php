<?php

class Model_Main extends Model
{
   
   /*
    * Add new record in news table
    * @param  string $author
    * @param  string $record
    */
   public function addRecord($author, $record) 
   {
       
           try {
	       
	        $author_id = $this->getAuthorId($author);

                $stmt = $this->db->prepare("INSERT INTO news (text, author_id, date_added) 
                                                       VALUES(:text, :author_id, NOW())");
              
                $stmt->bindparam(":text",$this->validate($record));
                $stmt->bindparam(":author_id", $author_id);          
                $stmt->execute(); 
   
                return $stmt; 
                
            } catch (PDOException $e) {
                
                error_log(date('Y-m-d H:i:s - ', time()). $e->getMessage() . "\n", 3, __DIR__ ."/error.log");
                
            }  
   }
   
   /*
    * Get author id
    * @param  string $author
    * @return int
    */
   private function getAuthorId($author) {
       
      try {
          $stmt = $this->db->prepare("SELECT author_id FROM author WHERE name=:name LIMIT 1");
          $stmt->execute(array(':name'=> $this->validate($author)));
          $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
          
          if($stmt->rowCount() > 0)
          {
               return intval($userRow['author_id']);
          } else {
	      
	      return $this->createNewAuthor($author);
	  }
       } catch(PDOException $e) {
           error_log(date('Y-m-d H:i:s - ', time()). $e->getMessage() . "\n", 3, __DIR__ ."/error.log");
       }     
   }
   
   /*
    * Get author id
    * @param  string $author
    * @return int
   */
   private function createNewAuthor($author)
   {
   
       try { 
       
          $stmt = $this->db->prepare("INSERT INTO author SET name = :name"); 
          $stmt->execute(array(':name'=> $this->validate($author)));
      
          $id = $this->db->lastInsertId();
      
          if (is_numeric($id)) {
	    return $id; 
          } else {
	     return NULL;
          }
       } catch (PDOException $e) {
	   error_log(date('Y-m-d H:i:s - ', time()). $e->getMessage() . "\n", 3, __DIR__ ."/error.log");   
       } 
   }
      
   /*
    * Get number of views
    * @param  int $news_id
    * @return int
   */
   private function getNumberViews($news_id) {
       
         try {
             $stmt = $this->db->prepare("SELECT COUNT(news_id) AS count FROM news_comment WHERE news_id=:news_id");
             $stmt->execute(array(':news_id'=> $news_id));
             $count = $stmt->fetch(PDO::FETCH_ASSOC);
          
             if(is_numeric($count['count'])) {
               return $count['count'];
             } else {
	       return 0;
	     }
          } catch(PDOException $e) {
              error_log(date('Y-m-d H:i:s - ', time()). $e->getMessage() . "\n", 3, __DIR__ ."/error.log");
          }  
   }
   
   
   /*
    * Get all records
    * @return array | NULL
   */
   public function getRecords() 
   {
      try {
	  
          $stmt = $this->db->prepare("SELECT n.text, n.author_id, a.name, n.date_added, n.news_id FROM news n LEFT JOIN author a ON(a.author_id = n.author_id) ORDER BY n.news_id DESC");
          $stmt->execute();
          $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
	  
	  $result = array();
	  
	  if (is_array($records)) {
	      
	      foreach ($records as $record) {

		  $result[][]= array(
		                  'name'    => $record['name'],
		                  'text'    => $record['text'],
		                  'viesws'  => $this->getNumberViews($record['news_id']),
		                  'added'   => $record['date_added'],
		                  'news_id' => $record['news_id']
		      
		  );
		  
	      }

	       return $result;
	      
	  } else {
	      return NULL;
	  }  
       } catch(PDOException $e) {
           error_log(date('Y-m-d H:i:s - ', time()). $e->getMessage() . "\n", 3, __DIR__ ."/error.log");
       }   
   } 
}
