<?php


class Controller_Main extends Controller
{
    
        /*
	 * Error after validate
	 */
        private $error = null;

        public function __construct()
	{

                $this->view = new View();
                $this->model = new Model_Main();
	}
    
    
    	/*
	 * Default action
	 * @return mixed
	*/
	public function action_index()
	{
	        $data['records'] = $this->model->getRecords();

		$data['comment'] = $this->getMostPopularPost($data['records']);

		$this->view->generate('main_view.php', 'template_view.php', $data);
	}
	
	
	/*
	 * Get list of most popular post for slider
	 * @input array $data
	 * @return array | null
	 */
	private function getMostPopularPost($data) {
	    
	    	$views = array();
		$news = array();
		
		if(is_array($data)) {
		    
		   foreach ($data as $key => $value) {
		     $views[$key] = $value[0]['viesws'];
		     $news[$key] = $value[0]['news_id'];
		   }
		                 
		   
		   array_multisort($views, SORT_DESC, $news, SORT_ASC, $data);
		   
		   return array_combine($views, $news); 
		} else {
		    return NULL;
		}
	    
	}
	
	
	/*
	 * Add new record in the table news
	 * @return mixed
	 */
        public function action_add()
	{
	    
	    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              if ($this->validate($_POST)) {
		  
		  $author = $_POST['name'];
		    
		  $record = $_POST['text'];
		  
		  $this->model->addRecord($author, $record);
		  
		  $data['records'] = $this->model->getRecords();
		  
		  $data['comment'] = $this->getMostPopularPost($data['records']);
 
		  $this->view->generate('main_view.php', 'template_view.php', $data);
	      } else {
		  
		  
		  $data['records'] = $this->model->getRecords();
		  
		  $data['comment'] = $this->getMostPopularPost($data['records']);
		  
		  $data['post']['error'] = $this->error;
		  
		  $this->view->generate('main_view.php', 'template_view.php', $data);
		  
	      }
	    } else {
		$this->redirect('controller_404');
	    }
	}
	
	/*
	 * Validate filled data
	 * @input $data array
	 * @return array | bool
	 */
	private function validate($data) {
	    
	    if (strlen(trim($data['name'])) < 1) {
	    
		$this->error['name'] = 'Поле Имя пользователя обязательно для заполнения!';
	    }
	    
	    if (strlen(trim($data['text'])) < 1) {
	    
		$this->error['text'] = 'Поле Текст публикации обязательно для заполнения!';
	    }
	    
	    
	    return !$this->error;
	}
}