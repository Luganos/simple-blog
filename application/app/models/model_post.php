<?php

class Model_Post extends Model
{
	
	
	/* Get all comments for certain id
	 * @input $news_id
	 * @return array | NULL
	 */
	public function getComments($news_id) 
	{
	      try {
		  
		 if (!is_numeric($news_id)) {
		     return NULL;
		 }
		 
	         $stmt = $this->db->prepare("SELECT * FROM comments c LEFT JOIN news_comment nc ON(c.comment_id = nc.comment_id) INNER JOIN author a ON(a.author_id = c.author_id) WHERE nc.news_id =:news_id");
                 $stmt->execute(array(':news_id' => $news_id));
                 $records = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		 
		 if (is_array($records)) {
		     return $records;
		 } else {
		     return NULL;
		 }
		 
		 
	      } catch (PDOException $e) {
                 error_log(date('Y-m-d H:i:s - ', time()). $e->getMessage() . "\n", 3, __DIR__ ."/error.log");
	      }

	}
	
	/* Get post with certain id
	 * @input string $news_id
	 * @return array | NULL
        */
	public function getPost($news_id) 
	{
	    try {
		
	       if (!is_numeric($news_id)) {
		    return NULL;
	       }
              
               $stmt = $this->db->prepare("SELECT * FROM news n INNER JOIN author a ON(a.author_id = n.author_id) WHERE news_id=:news_id");
               $stmt->execute(array(':news_id'=> $news_id));
               $row = $stmt->fetch(PDO::FETCH_ASSOC);
	       
	       if (is_array($row)) {
		   
		     $result = array(
		                  'name'    => $row['name'],
		                  'text'    => $row['text'],
		                  'viesws'  => $this->getNumberViews($row['news_id']),
		                  'added'   => $row['date_added'],
		                  'news_id' => $row['news_id']
		      
		      );
		   return $result;
	       } else {
		   return NULL;
	       }
               
            } catch (Exception $e) {

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
	
    /* Add new comment to post
     * @input array
    */ 
    public function addNewComment($data) {
	    
	    try {
                
		 //Add new record in table comments
		
		$author_id = $this->getAuthorId($data['name']);
		
                 $stmt = $this->db->prepare("INSERT INTO comments SET text = :text, author_id = :author_id"); 
                 $stmt->execute(array(':text'=> $this->validate($data['text']), ':author_id' => $author_id));
              
		 $id = $this->db->lastInsertId();
		 
		 $stmt = $this->db->prepare("INSERT INTO news_comment SET news_id = :news_id, comment_id = :comment_id"); 
                 $stmt->execute(array(':news_id'=> $this->validate($data['news_id']), ':comment_id' => $id));

   
                return $stmt; 
                
            } catch (PDOException $e) {
                
                error_log(date('Y-m-d H:i:s - ', time()). $e->getMessage() . "\n", 3, __DIR__ ."/error.log");
                
            }
	    
	    
	}
}
