<footer>
    <hr>
    <p>&copy;<?php echo $config['company']?><a href="https://shankai.top" target="_blank"><?php echo $config['author']?></a></p>
</footer>

        </div>
    </div>
</div>

<script src="<?php echo ADMIN_PATH;?>/lib/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
    $("[rel=tooltip]").tooltip();
    $(function() {
        $('.demo-cancel-click').click(function(){return false;});
    });
</script>
<script src="<?php echo ADMIN_PATH;?>/js/common.js"></script>

</body>
</html>