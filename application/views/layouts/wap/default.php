<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>Multi-page template</title>
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
                    if (activePage['context'].URL == "<?php echo base_url('danh-sach-game.html') ?>" && ($(window).scrollTop() + $(window).height() > $(document).height() - 100)) {
                        loadMoreGame('game');
                    }

                    if (activePage['context'].URL == "<?php echo base_url('ung-dung.html') ?>" && ($(window).scrollTop() + $(window).height() > $(document).height() - 100)) {
                        loadMoreGame('app');
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

                        $.getJSON('./loadmore?menu='+type+'&cate=&page='+ _page, function(data) {
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
                    var  _json = $(this).attr('download');
                    var  _id_game = $(this).attr('id-game');
                    var _obj = JSON.parse(_json);
                    var _html = '';
                    for (var key in _obj) {
//                        alert( _obj[key] );
                        _html += '<a target="_blank" href="<?php echo base_url() ?>tai-game?id='+_id_game+'&platform='+_obj[key]+'" data-ajax="false"><button class="ui-bnt ui-btn ui-shadow ui-corner-all" style="text-transform: uppercase">'+_obj[key]+'</button></a>';
                        $('.bnt-download').html(_html);
                    }

                });
                /* attach if scrollstop for first time */

            });
        </script>
        <!--Start of Zopim Live Chat Script-->

    </head>

    <body>
        <div class="content-wap">
            <?php
                echo $content;
                
            ?>
            

                <!-- /content -->

                <div data-role="footer" id="footer">
                    <ul  >
                        <li><a href="#"><img src="<?php echo base_url(); ?>wap/image/ten_de.png" /> Giới Thiệu </a></li>
                        <li><a href="#"><img src="<?php echo base_url(); ?>wap/image/ten_de.png" /> Điều Khoản Sử Dụng</a></li>
                        <li><a href="#"><img src="<?php echo base_url(); ?>wap/image/ten_de.png" /> Chính Sách Bảo mật</a></li>
                        <li><a href="#"><img src="<?php echo base_url(); ?>wap/image/ten_de.png" /> Cài Đặt, Gỡ Bỏ</a></li>
                        <li><a href="#"><img src="<?php echo base_url(); ?>wap/image/ten_de.png" /> Hỗ Trợ</a></li>
                    </ul>
                    <div class="content view-orther-block"></div>
                    <ul  class="address">
                        <li><a href="#"> Hotline : 1900 6611 -  Hỗ trợ : hotro@iwin.vn  </a></li>
                        <li><a href="#"> Bản quyền thuộc về Mecorp </a></li>
                        <li><a href="#">Bản quyền thuộc về Mecorp </a></li>
                        <li><a href="#">Địa chỉ: 141 Lý Chính Thắng, P.7, Q. 3, TP.HCM</a></li>

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
            <div data-role="popup" id="popup-dl-on-<?php echo $ran ?>" data-theme="a" data-overlay-theme="b" class="ui-content" style="max-width:340px; padding-bottom:2em;">
                <h3>Tải Game</h3>
                <div class="bnt-download bnt-download-game">
                    <?php
                        foreach($k as $i){
                    ?>
                    <a target="_blank" href="<?php echo base_url() ?>tai-game?id=<?php echo $_SESSION['banner']['id_game_app']; ?>&platform=<?php echo $i; ?>" data-ajax="false"><button class="ui-bnt ui-btn ui-shadow ui-corner-all" style="text-transform: uppercase"><?php echo $i; ?></button></a>
                    <?php
                        }
                    ?>
                </div>
            </div>

        </div>
    </body>
</html>
