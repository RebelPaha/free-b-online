<script type="text/javascript">
    $(document).ready(function () {
        setInterval('spectrum();', 300)
    });
    var hue = 'rgb(255,0,0)';
    var hue1 = 'rgb(151,29,129)';
    function spectrum() {
        $('#migalka a').animate({ color:hue}, 500).animate({color:hue1}, 500);
    }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        /*Start DocumentReady*/
        var url=document.location.href;
        $.each($("#nav li a"),function(){
            if(this.href==url){$(this).addClass('checked');};
        });
        /*End DocumentReady*/
    });
</script>
<div>
    <ul id="nav">
        <li class="sub"><a href="/page/4">Где получить скидки</a>
            <ul>
                <?php
                $sql = "SELECT `id`, `category_name` FROM `categories`";
                $mysql = mysql_query($sql, $db);
                while ($rowAssoc = mysql_fetch_assoc($mysql)) {
                    echo '<li><a href="/page/' . NUMBER_PAGE_VENDER . '/category/' . $rowAssoc['id'] . '"><img src="' . DIR_MAIN_IMAGES . '/curs.png" style="margin-right:4px; margin-top:6px;" align="left" border="0">' . $rowAssoc['category_name'] . '</a></li>';
                }
                ?>
            </ul>
        </li>
        <li><a href="/page/3">Подарки за Free-B баллы</a></li>
        <li><a href="/page/29">Акции наших партнеров</a></li>
        <li id="migalka"><a href="/page/27">Новые партнеры</a></li>
    </ul>
</div>