<?php
/*
Template Name: Bangumi Page
*/
?>

<?php get_header(); ?>
			
			<!--<div id="content" class="clearfix row">-->
			
				<!--<div id="main" class="col-md-8 clearfix" role="main">-->
	<div  class="col-md-8 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="post" id="post-<?php the_ID(); ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class('panel panel-default clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header class="panel-heading">
							
							
		            <h2><?php the_title(); ?></h2>
    <div class="info">
			<?php edit_post_link(__('Edit', 'inove'), '<span class="editpost">', '</span>'); ?>
			<?php if ($comments || comments_open()) : ?>
				<span class="addcomment"><a href="#respond"><?php _e('Leave a comment', 'inove'); ?></a></span>
				<span class="comments"><a href="#comments"><?php _e('Go to comments', 'inove'); ?></a></span>
			<?php endif; ?>
			<div class="fixed"></div>
		</div>
						
						</header> <!-- end article header -->
					<div style="padding=10px;"></div>
						<section class="list-group clearfix" itemprop="articleBody">
<?php
$data = file_get_contents("http://api.bgm.tv/user/vespa/collection?cat=watching");
$data = json_decode($data, true); 
$numb = count($data);


echo '<h1 style="margin-bottom: 10px;margin-top: 10px;">追番中</h1>';
for ($i=0; $i<$numb; $i++) {  
	$weekday = $data[$i]['subject']['air_weekday'];
	$weekday = str_replace(array("1","2","3","4","5","6","7"),array("周一","周二","周三","周四","周五","周六","周日",),$weekday);
  
	$bankumitype = $data[$i]['subject']['type'];
  $bankumitype = 
    str_replace(array("2","6"),array("二次元","三次元",),$bankumitype);
  
  
	if ($data[$i]['subject']['eps']=="0") {
		$eps = "??";
	} else {
		$eps = $data[$i]['subject']['eps'];
	}
	if ($data[$i]['ep_status'] < $eps || $data[$i]['subject']['eps']=="0")
  { 
    $proc = $data[$i]['ep_status'].'/'.$eps;
    echo '<a target="_blank" rel="nofollow" href="'.$data[$i]['subject']['url'].'" class="list-group-item">
	  <p class="pull-left"><img src="'.$data[$i]['subject']['images']['medium'].'" alt="'.$data[$i]['subject']['name_cn'].'" style="border-radius:10px;"></p>
		<p class="list-group-item-text">
			<strong>'.$data[$i]['name'].'</strong> <small class="text-muted2">'.$data[$i]['subject']['name_cn'].'</small><br>
<p class="text-muted"><span class="glyphicon glyphicon-type"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;类型: '.$bankumitype.'.</p>
			<p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> 首播时间:'.$data[$i]['subject']['air_date'].'</p>
	<p class="text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;放送日:'.$weekday.'</p>
			<p class="text-muted"><span class="glyphicon glyphicon-expand"></span> 观看进度:'.$proc.'</p>

			<p class="text-muted"><span class="glyphicon glyphicon-user"></span> 有'.$data[$i]['subject']['collection']['doing'].'人也正在看</p>

<p class="text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp最后更新: '.date('Y-m-d',$data[$i]['lasttouch']).'</p>

  
		</p>
	</a>';
  } 
}


echo '<h1 style="margin-bottom: 10px;margin-top: 10px;">已看完</h1>';
for ($i=0; $i<$numb; $i++) {  
	$weekday = $data[$i]['subject']['air_weekday'];
	$weekday = str_replace(array("1","2","3","4","5","6","7"),array("周一","周二","周三","周四","周五","周六","周日",),$weekday);
  
	$bankumitype = $data[$i]['subject']['type'];
  $bankumitype = 
    str_replace(array("2","6"),array("二次元","三次元",),$bankumitype);
  
 
  
	if ($data[$i]['subject']['eps']=="0") {
		$eps = "??";
	} else {
		$eps = $data[$i]['subject']['eps'];
	}
  
	if ($data[$i]['ep_status'] >= $eps && $data[$i]['subject']['eps'] != "0")
  { 
    echo '<a target="_blank" rel="nofollow" href="'.$data[$i]['subject']['url'].'" class="list-group-item">
	  <p class="pull-left"><img src="'.$data[$i]['subject']['images']['medium'].'" alt="'.$data[$i]['subject']['name_cn'].'" style="border-radius:10px;"></p>
		<p class="list-group-item-text">
			<strong>'.$data[$i]['name'].'</strong> <small class="text-muted2">'.$data[$i]['subject']['name_cn'].'</small><br>
<p class="text-muted"><span class="glyphicon glyphicon-type"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;类型: '.$bankumitype.'.</p>
			<p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> 首播时间:'.$data[$i]['subject']['air_date'].'</p>
	<p class="text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;放送日:'.$weekday.'</p>
	
<p class="text-muted"><span class="glyphicon glyphicon-expand"></span> 集数:'.$eps.'</p>
			<p class="text-muted"><span class="glyphicon glyphicon-user"></span> 有'.$data[$i]['subject']['collection']['doing'].'人也正在看</p>

<p class="text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp最后更新: '.date('Y-m-d',$data[$i]['lasttouch']).'</p>

  
		</p>
	</a>';
  }
 
}
?>
						</section> <!-- end article section -->
						
						<footer>
			
							<?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags","bonestheme") . ':</span> ', ', ', '</p>'); ?>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					  </div>
					<?php comments_template('',true); ?>
					
					<?php endwhile; ?>		
					
					<?php else : ?>
					
					<article id="post-not-found" class="panel panel-default clearfix">
						<header class="panel-heading">
							<h3 class="panel-title">404 - Page or file not found</h3>
						</header> <!-- end article header -->
						<section class="post_content panel-body">
							<p><span class="glyphicon glyphicon-warning-sign"></span> 抱歉，这里还什么也没有。<br>Sorry, What you were looking for is not here.</p>
						</section> <!-- end article section -->

					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->

		 <!--	</div> end #content -->
			
<?php get_footer(); ?>