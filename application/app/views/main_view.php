
<div class ="col-md-12" id ="most-popular-news">
    <div class ="row">
	<div class ="col-md-12">
	    <?php if (count($data['comment']) > 0) { ?>
	    <h4 id="header-slider">Самые комментируемые</h4>
	    <div class="viewport">
	       <ul class="slidewrapper" data-current=0>
	       <?php $n = 1; ?>
	       <?php foreach($data['comment'] as $key => $value) { ?>
	          <?php if ($key > 0) { ?>
                  <li class='slide'>
		      <a href ="/post?news_id=<?php echo $value; ?>"><img src="images/main-image.jpg"/><span class ="comment-inside-slider">Публикация № <?php echo $value; ?></span></a>  
                  </li>
		  <?php $n++; ?>
	          <?php  } ?>
	          <?php  if ($n > 5) { ?>
	          <?php break; ?>  
	          <?php } ?>      
	       <?php } ?>
               </ul>
	       <div id="prev">prev</div>
               <div id="next">next</div>	
           </div> 
	    <?php } ?>  
	</div>	
    </div>
</div>
<div class ="col-md-12" id ="list-of-posts">
    <div class ="row">
	<?php if (!empty($data['records'])) { ?>
	<?php foreach ($data['records'] as $records) { ?>
	<?php foreach ($records as $record) { ?>
	<div class ="col-md-12">
	    <table class="table">
                <tr>
		    <td class ="col-md-4"><h5>Имя автора:</h5></td>
		    <td class ="col-md-8"><h5><?php echo $this->noHTML($record['name']); ?></h5></td>
               </tr>
	       <tr>
		    <td class ="col-md-4"><h5>Дата публикации:</h5></td>
		    <td class ="col-md-8"><h5><?php echo $this->noHTML($record['added']); ?></h5></td>
               </tr>
	       <tr>
		    <td class ="col-md-4"><h5>Комментариев:</h5></td>
		    <td class ="col-md-8"><h5><?php echo $this->noHTML($record['viesws']); ?></h5></td>
               </tr>
	       <tr>
		    <td class ="col-md-4"><h5>Текст публикации</h5></td>
		    <td class ="col-md-8"><h5>
		        <?php echo mb_strimwidth(strval($this->noHTML($record['text'])), 0, 100) . '...'; ?> 
			<a href ="/post?news_id=<?php echo $record['news_id']; ?>">Читать далее</a></h5>
		    </td>
               </tr>
	    </table>
	</div>
	<?php } ?>
      <?php } ?>
   <?php } ?>	
    </div>   
</div>
<div class ="col-md-12">
    <div class ="row">
	<div class ="col-md-12">
	    <h4>Добавить публикацию</h4>
	    <form action="/main/add" method="post">
                 <table class="table">
	            <tr>
		         <td class ="col-md-4">Имя пользователя&#42;</td>
		         <td class ="col-md-8">
			     <input type="text" class="form-control" name="name">
			     <?php if (!empty($data['post']['error']['name'])) { 
			       echo '<h5 class ="error-message">'. $data['post']['error']['name'] .'</h5>';
			     } ?>
			 </td>
	            </tr>
		    <tr>
		         <td class ="col-md-4">Текст публикации&#42;</td>
		         <td class ="col-md-8">
			     <textarea class="form-control" rows="10" cols="50"  name ="text"></textarea>
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