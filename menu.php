<!-- 下拉导航菜单 -->
<nav id="nav" class="nav home">
<h3><a href="javascript:void(0)">小说网</a></h3>
    <div id="scrollerBox" class="scrollerBox">
        <div class="scroller">
            <ul>
                <?php foreach($catelist as $item){?>
                <li><a href="booklist.php?cateid=<?php echo $item['id'];?>"><?php echo $item['name'];?></a></li>
                <?php }?>
            </ul>
        </div>
    </div>
</nav>
<!-- 下拉导航菜单END -->