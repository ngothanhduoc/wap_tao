<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>Tải Game Free</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>wap/css/themes/default/jquery.mobile-1.4.5.min.css">
        <!--<link rel="stylesheet" href="./css/style.default.css" type="text/css" />-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>wap/owl-carousel/owl.carousel.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>wap/owl-carousel/owl.theme.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>wap/owl-carousel/owl.transitions.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>wap/css/style.default.css" type="text/css" />
        <!--<link rel="shortcut icon" href="../favicon.ico">-->
        <script src="<?php echo base_url(); ?>wap/js/jquery.js"></script>
        <script>
            $(document).bind("mobileinit", function() {
                $.extend($.mobile, {
                   defaultPageTransition: 'slide'
                });

            });

        </script>
        <script src="<?php echo base_url(); ?>wap/js/jquery.mobile-1.4.5.min.js"></script>
        <script src="<?php echo base_url(); ?>wap/owl-carousel/owl.carousel.min.js"></script>

        <script>
            var platform = "<?php echo $_SESSION['platform'] ?>";
            var _search = null;

            var str_search = 'tim-kiem';



            function cut_str_id(url){
                var id_url = url.split(".html");
                var id_url = id_url[0].split("-");
                var id_leng = id_url.length;
                return id_url[id_leng - 1];
            }
            $(function(){

                $(document).on("scrollstop", checkScroll);
                /* check scroll function */


                function checkScroll() {

                    var activePage = $.mobile.pageContainer.pagecontainer("getActivePage"),
                        screenHeight = $.mobile.getScreenHeight(),
                        contentHeight = $(".ui-content", activePage).outerHeight(),
                        header = $(".ui-header", activePage).outerHeight() - 1,
                        scrolled = $(window).scrollTop(),
                        footer = $(".ui-footer", activePage).outerHeight() - 1,
                        scrollEnd = contentHeight - screenHeight + header + footer;
                    console.log(activePage['context'].URL);

                    var str_cat_game = '/danh-muc/';
                    var str_cat_app = '/danh-sach/';

                        var url = activePage['context'].URL;

                    var result = url.match(str_cat_app);
                    if(result != null)
                        var list_cat_app = '1';

                    var result = url.match(str_cat_game);
                    if(result != null)
                        var list_cat_game = '1';



                    var cat_load = cut_str_id(url);

                    if (activePage['context'].URL == "<?php echo base_url('danh-sach-game.html') ?>" && ($(window).scrollTop() + $(window).height() > $(document).height() - 100)) {
                        loadMoreGame('game');
                    }

                    if ( list_cat_game == '1' && ($(window).scrollTop() + $(window).height() > $(document).height() - 100)) {
                        loadMoreGame('game&cat='+cat_load);
                    }

                    if (activePage['context'].URL == "<?php echo base_url('ung-dung.html') ?>" && ($(window).scrollTop() + $(window).height() > $(document).height() - 100)) {
                        loadMoreGame('app');
                    }

                    if ( list_cat_app == '1' && ($(window).scrollTop() + $(window).height() > $(document).height() - 100)) {
                        loadMoreGame('app&cat='+cat_load);
                    }

                    if (activePage['context'].URL == "<?php echo base_url('tin-tuc.html') ?>" && ($(window).scrollTop() + $(window).height() > $(document).height() - 100)) {
                        loadMoreGame('news');
                    }

                    if (activePage['context'].URL == "<?php echo base_url('videos.html') ?>" && ($(window).scrollTop() + $(window).height() > $(document).height() - 100)) {
                        loadMoreGame('videos');
                    }
                }

                /* add more function */
                function loadMoreGame(type) {
                    $(document).off("scrollstop");
                    $.mobile.loading("show", {
                        text: "Đang tải..",
                        textVisible: false
                    });

                        var _me = $('div.loadmore');
                        var _addhtml = _me.prev();
                        var _page = _me.attr('offset');
                        var _first_page = _me.attr('first-page');

                        $.getJSON('<?php echo base_url() ?>loadmore?menu='+type+'&page='+ _page, function(data) {
                            //load view
                            if (data.isLoadmore) {
                                _me.attr('offset', data.page);
                                _addhtml.append(data.html);
                                _me.removeAttr('first-page');
                            }
                            else {
                                _me.remove();
                            }
                            $(document).on("scrollstop", checkScroll);
                            $.mobile.loading("hide");
                        });


                }

                $('.click-download').click(function(){
                    var _json = $(this).attr('download');
                    var _id_game = $(this).attr('id-game');
                    var _obj = JSON.parse(_json);
                    var _html = '';

                    if(platform == 'pc') {
                        for (var key in _obj) {
//                        alert( _obj[key] );
                            _html += '<a target="_blank" href="<?php echo base_url() ?>tai-game?id=' + _id_game + '&platform=' + _obj[key] + '" data-ajax="false"><button class="ui-bnt ui-btn ui-shadow ui-corner-all" style="text-transform: uppercase">' + _obj[key] + '</button></a>';
                            $('.bnt-download').html(_html);
                        }
                    }else{
                        $('#purchase').remove();
                        for (var key in _obj) {
                            if(_obj[key] == '<?php echo $_SESSION['platform'] ?>') {
                                _html = '<?php echo base_url() ?>tai-game?id=' + _id_game + '&platform=' + _obj[key];
                                if (confirm('Bạn có tải game?')) {
                                    window.open(_html);
                                }

                            }

                        }

                    }

                });
                /* attach if scrollstop for first time */

            });

        </script>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-67194175-1', 'auto');
		  ga('send', 'pageview');

		</script>

    </head>

    <body>
        <div class="content-wap">
            <?php
                echo $content;
            ?>
            

                <!-- /content -->

                <div data-role="footer" id="footer">
                    <ul>
                        <?php
                            $info = $_SESSION['wap_info'];
                            if(!empty($info))
                                foreach ($info as $k => $v) {
                                    echo '<li><a href="'.base_url().'thong-tin/'.$v['alias'].'.html"><img src="'.base_url().'wap/image/ten_de.png" /> '.$v['title'].' </a></li>';
                                }

                        ?>


                    <div class="content view-orther-block"></div>
                    <ul  class="address">
                        <li>
                            <a href="#">
                                <?php echo $_SESSION['footer'][0]['content'] ?>
                            </a>
                        </li>


                    </ul>
                </div><!-- /footer -->
            <div class="content download-ontop">
                <?php
                    $temp = json_decode($_SESSION['banner']['download_url'], TRUE);
                    unset($temp['plist']);
                    $k = array_keys($temp);
                    $ran = rand(0,100);
                ?>
                <img src="<?php echo base_url($_SESSION['banner']['icon']) ?>"/>
                <span><?php echo $_SESSION['banner']['name']; ?></span>
                <a href="#popup-dl-on-<?php echo $ran ?>" data-rel="popup" id-game="<?php echo $_SESSION['banner']['id_game_app']; ?>" download=' <?php echo json_encode($k); ?>' class="" data-transition="pop"><div class="dl-bnt"></div></a>
            </div>
            <?php if($_SESSION['platform'] == 'pc') { ?>
                <div data-role="popup" id="popup-dl-on-<?php echo $ran ?>" data-theme="a" data-overlay-theme="b"
                     class="ui-content" style="max-width:340px; padding-bottom:2em;">
                    <h3>Tải Game</h3>

                    <div class="bnt-download bnt-download-game">
                        <?php

                        foreach ($k as $i) {
                            ?>
                            <a target="_blank"
                               href="<?php echo base_url() ?>tai-game?id=<?php echo $_SESSION['banner']['id_game_app']; ?>&platform=<?php echo $i; ?>"
                               data-ajax="false">
                                <button class="ui-bnt ui-btn ui-shadow ui-corner-all"
                                        style="text-transform: uppercase"><?php echo $i; ?></button>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            }else{
                ?>
                <script>
                    $(function(){
                        $(".dl-bnt").click(function(){
                            if (confirm('Bạn có tải game?')) {
                                window.open('<?php echo base_url() ?>tai-game?id=<?php echo $_SESSION['banner']['id_game_app']; ?>&platform=<?php echo $_SESSION['platform']; ?>');
                            }
                        })

                    })


                </script>
                <?php
            }
            ?>

        </div>
    </body>
</html>
