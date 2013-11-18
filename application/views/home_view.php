
    <article id="page-content">
        <section>
            <img src="application/views/images/1.jpg" width="380px">
        </section>
        <aside>	
            <h3>最新文章</h3>
            <ul class="list"><?php if ($new_list):?>
                <?php foreach($new_list as $val):?>
                <li>[<?php echo $val['cat_name'];?>] <a href="article/<?php echo $val['id'];?>"><?php echo $val['title'];?></a><span class="date"> - <?php echo date('Y-m-d', $val['created']);?></span></li>
                <?php endforeach;?>
                <?php else:?>
                <li>没有文章！</li>
                <?php endif;?>
            </ul>
        </aside>
    </article>          
