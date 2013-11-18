
    <article id="page-content">
        <section>
        	<hgroup>
            <a href="./">首页</a> / <?php echo $breadcrumbs;?>
        	</hgroup>
 
            	<h4><?php echo $title;?></h4>
	            <ul class="list"><?php if ($article_list):?>
	            	<?php foreach($article_list as $val):?>
	                <li>[<?php echo $val['cat_name'];?>] <a href="article/<?php echo $val['id'];?>"><?php echo $val['title'];?></a><span class="date"> - <?php echo date('Y-m-d H:i:s', $val['created']);?></span></li>
	            	<?php endforeach;?>
	            	<?php else:?>
	            	<li>没有文章！</li>
	            	<?php endif;?>
	            </ul>
        </section>
        <aside>	
            <h2>Related</h2>
            <p></p>
        </aside>
    </article>          
