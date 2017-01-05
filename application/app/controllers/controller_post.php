<?php

class Controller_Post extends Controller
{
    
        /*
	 * Error after validate
	*/
	private $error = null;
	
    
        public function __construct()
	{
		
                $this->view = new View();
		$this->model = new Model_Post();
	}
        
	public function action_index()
	{
              if (isset($_GET['news_id']) && !empty($_GET['news_id']) && is_numeric(intval($_GET['news_id']))) {
		  
		  $data = $this->getContent(intval($_GET['news_id']));
		  
		  $this->view->generate('post_view.php', 'template_view.php', $data);
	      } else {
		  $this->redirect('controller_404');
	      }	
	}
	
	/* Get content for page
	 * @input int $news_id
	 * @return array
	 */
	private function getContent($news_id) {
	    
	     $result = array();
	    
	    $result['post']['comments'] = $this->model->getComments($news_id);
            $result['post']['description'] = $this->model->getPost($news_id); 
	    $result['post']['news_id'] = intval($news_id);

	    return $result;
	}
	
	public function action_add()
	{
	    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              if ($this->validate($_POST)) {
		  
		  $this->model->addNewComment($_POST);
		  
		  $data = $this->getContent(intval($_POST['news_id']));
 
		  $this->view->generate('post_view.php', 'template_view.php', $data);
	      } else {
		  
		  
		  $data = $this->getContent(intval($_POST['news_id']));
		  
		  $data['post']['error'] = $this->error;
		  
		  $this->view->generate('post_view.php', 'template_view.php', $data);
		  
	      }
	    } else {
		$this->redirect('controller_404');
	    }
	}
	
	/*
	 * validate data from form
	 * @input array $data
	 * @return array | bool
	 */
	private function validate($data) {
	    
	    if (strlen(trim($data['name'])) < 1) {
	    
		$this->error['name'] = 'Поле Имя автора обязательно для заполнения!';
	    }
	    
	    if (strlen(trim($data['text'])) < 1) {
	    
		$this->error['text'] = 'Поле Текст комментария обязательно для заполнения!';
	    }
	    
	    if (!is_numeric(intval($data['news_id']))) {
	    
		$this->error['news_id'] = 'Внутренняя ошибка. Попробуйте позже!';
	    }
	    
	    return !$this->error;
	}
	
	
}
