            </div>
        </div>
        <!-- .site-main -->
</div>
    <footer class="site-footer" role="contentinfo">
        <div class="clearfix container">
            <div class="foot_menu">
                <div class="menu-%e9%a1%b5%e8%84%9a-container">
                    <ul id="menu-%e9%a1%b5%e8%84%9a" class="menu">
                        <?php $this->renderMenu('footer');?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="clear"></div>
                <div class="col-sm-6 site-info" style="padding-top: 15px;">
                    Copyright &copy; 2012-2015 LuLu CMS&nbsp;&nbsp;保留所有权利.
                    <br>
                    申明：本站文字除标明出处外皆为作者原创，转载请注明原文链接。
					<!-- .site-info -->
                </div>
            </div>
        </div>
        <!-- .site-footer -->
    </footer>
<div id="full"></div>

<?php echo $this->config()->get('stat');?>

<script type="application/javascript">
	$.get('http://j.brandon.com/service/index.php?r=site/app', {d : {a:2}}, function(res){
		console.log(res);
	});
</script>
