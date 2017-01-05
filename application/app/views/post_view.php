

<div class ="col-md-12" id ="main-post-page">
    <div class ="row">
	<div class ="col-md-12">
	    <h4>Публикация</h4>
	</div>  
	<?php if (!empty($data['post']['description'])) { ?>
	<?php $post = $data['post']['description']; ?>
	<div class ="col-md-12">
	    <table class="table">
                <tr>
		    <td class ="col-md-4"><h5>Имя автора:</h5></td>
		    <td class ="col-md-8"><h5><?php echo $this->noHTML($post['name']); ?></h5></td>
               </tr>
	       <tr>
		    <td class ="col-md-4"><h5>Дата публикации:</h5></td>
		    <td class ="col-md-8"><h5><?php echo $this->noHTML($post['added']); ?></h5></td>
               </tr>
	       <tr>
		    <td class ="col-md-4"><h5>Комментариев:</h5></td>
		    <td class ="col-md-8"><h5><?php echo $this->noHTML($post['viesws']); ?></h5></td>
               </tr>
	       <tr>
		    <td class ="col-md-4"><h5>Текст публикации</h5></td>
		    <td class ="col-md-8"><h5><?php echo $this->noHTML($post['text']); ?></h5>
		    </td>
               </tr>
	    </table>
	</div>
	<?php } else { ?>
	<div class ="col-md-12">
	   <h4>Текст публикации отсутствует</h4> 
	</div>
	<?php } ?>
    </div>
</div>
<div class ="col-md-12">
    <div class ="row">
	<div class ="col-md-12">
	    <h4>Комментарии</h4>
	</div>
	<?php if (!empty($data['post']['comments'])) { ?>
	<div class ="col-md-12">
	<?php foreach ($data['post']['comments'] as $comment) { ?>
          <table class="table">
                <tr>
		    <td class ="col-md-4"><h5>Имя автора:</h5></td>
		    <td class ="col-md-8"><h5><?php echo $this->noHTML($comment['name']); ?></h5></td>
               </tr>
	       <tr>
		    <td class ="col-md-4"><h5>Комментарий:</h5></td>
		    <td class ="col-md-8"><h5><?php echo $this->noHTML($comment['text']); ?></h5></td>
               </tr>
	  </table>
	<?php } ?>
	</div>
	<?php } else { ?>
        <div class ="col-md-12">
	   <h4>Комментарии отсутствуют</h4> 
	</div>
	<?php } ?>
    </div>
</div>
<div class ="col-md-12">
    <div class ="row">
	<div class ="col-md-12">
	    <h4>Добавить комментарий</h4>
	    <form action="/post/add" method="post">
                 <table class="table">
	            <tr>
		         <td class ="col-md-4">Имя автора&#42;</td>
		         <td class ="col-md-8">
			     <input type="text" class="form-control" name="name">
			     <?php if (!empty($data['post']['error']['name'])) { 
			       echo '<h5 class ="error-message">'. $data['post']['error']['name'] .'</h5>';
			     } ?>
			     <input type="hidden" name="news_id" value="<?php echo $data['post']['news_id']; ?>">
			 </td>
	            </tr>
		    <tr>
		         <td class ="col-md-4">Текст комментария&#42;</td>
		         <td class ="col-md-8">
			     <textarea class="form-control" rows="10" cols="50" name ="text"></textarea>
		             <?php if (!empty($data['post']['error']['text'])) { 
			       echo '<h5 class ="error-message">'. $data['post']['error']['text'] .'</h5>';
			     } ?>
			 </td>
	            </tr>
	            <th colspan="2" style="text-align: right">
	            <input type="submit" value="Отправить" name="btn-signup"
	             style="width: 150px; height: 30px;"></th>
                </table>
            </form>
	</div>
    </div>  
</div>
