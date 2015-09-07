<script xmlns="http://www.w3.org/1999/html">
    $(document).ready(function () {

        var owl = $("#slide-game-menu");
        owl.owlCarousel({
            pagination: false,
			items : 4,
			itemsDesktop : [1199,5],	
			itemsDesktopSmall : [979,5],
			itemsTablet: [768,5],
			itemsTabletSmall: false,
			itemsMobile : [460,4],
			
        });

        var owl_app = $("#slide-app-menu");
        owl_app.owlCarousel({
            pagination: false,
			items : 5,
			itemsCustom : false,
			itemsDesktop : [1199,5],
			itemsDesktopSmall : [980,5],
			itemsTablet: [768,5],
			itemsTabletSmall: false,
			itemsMobile : [479,5],
			singleItem : false,
			itemsScaleUp : false,
        });
        var owl_app = $("#game-fav");
        owl_app.owlCarousel({
            pagination: false,
			items : 5,
			itemsCustom : false,
			itemsDesktop : [1199,4],
			itemsDesktopSmall : [980,4],
			itemsTablet: [768,4],
			itemsTabletSmall: false,
			itemsMobile : [479,3],
			singleItem : false,
			itemsScaleUp : false,
        });
        $('li.video-click').click(function () {
            $('a.click-videos').click();
        });
        $('li.news-click').click(function () {
            $('a.click-news').click();
        });
        $('li.game-click').click(function () {
            $('a.click-game').click();
        });
        $('li.app-click').click(function () {
            $('a.click-app').click();
        });
        $('.logo-taigamefree').click(function(){
            _url_home = $(this).attr('href');
            location.href = _url_home;
        })
    });
    // Fix for back buttons

</script>

<div>

    <div data-role="header" id="header">
        <div data-role="navbar">
            <ul>
                <li>
                    <a href="<?php echo base_url() ?>" class="logo-taigamefree">
                        <h1 id="title-wap"><img  src="<?php echo base_url(); ?>wap/image/_icon_logo@3x.png"/></h1>
                    </a>
                </li>
                <li>
                    <form class="ui-filterable" id="form-search" action="<?php echo base_url() ?>tim-kiem" method="get">
                        <input id="autocomplete-input" name="data" data-type="search" placeholder="Tìm kiếm...">
                    </form>
                    <!--                                <ul data-role="listview" data-filter="true" data-filter-reveal="true" data-input="#autocomplete-input">
                                                        <li><a href="#">Acura</a></li>
                                                    </ul>-->
                </li>
            </ul>
        </div>
        <!-- /navbar -->


    </div>
    <!-- /header -->
    <div data-role="tabs" id="tabs">
        <div data-role="navbar" id="menu-wap">
            <ul>
                <li class="game-click"><a href="#one" data-ajax="false" class="ui-btn-active">
                        <div class="image-menu menu-game"></div>
                        Game
                    </a>
                </li>
                <li class="app-click"><a href="#two" data-ajax="false">
                        <div class="image-menu menu-app"></div>
                        App
                    </a></li>
                <li class="video-click"><a href="#three" data-ajax="false">
                        <div class="image-menu menu-video"></div>
                        Video
                    </a></li>
                <li class="news-click"><a href="#four" data-ajax="false">
                        <div class="image-menu menu-news"></div>
                        News
                    </a></li>

            </ul>
        </div>
        <div id="one" class="menu-tab-option">
<!--            <div class="ui-grid-d owl-carousel owl-theme" id="slide-game-menu">-->
<!---->
<!--                <div class="ui-block-a item"><a href="--><?php //echo base_url(); ?><!--danh-sach-game.html">-->
<!--                        <div class="ui-bar ui-bar-a" id="height-menu-child">Game</div>-->
<!--                    </a></div>-->
<!--                --><?php
//                if (!empty($cate['game_cate'])) {
//                    foreach ($cate['game_cate'] as $key => $value) {
//                        echo '<div class="ui-block-a item"><a href="' . base_url('game/danh-muc/' . $value['alias'] . '-' . $value['id_cate'] . '.html') . '"><div class="ui-bar ui-bar-a" id="height-menu-child">' . $value['title'] . '</div></a></div>';
//                    }
//                }
//                ?>
<!---->
<!---->
<!--            </div>-->
            <a href="./danh-sach-game.html" hidden class="click-game">dkasl;dksal;d</a>
            <!-- /grid-c -->
        </div>
        <div id="two" class="menu-tab-option">
<!--            <div class="ui-grid-d owl-carousel owl-theme" id="slide-app-menu">-->
<!--                <div class="ui-block-a item ">-->
<!--                    <a href="--><?php //echo base_url(); ?><!--ung-dung.html">-->
<!--                        <div class="ui-bar ui-bar-a" id="height-menu-child">Ứng Dụng</div>-->
<!--                    </a></div>-->
<!--                --><?php
//                if (!empty($cate['app_cate'])) {
//                    foreach ($cate['app_cate'] as $key => $value) {
//                        echo '<div class="ui-block-a item"><a href="' . base_url('ung-dung/danh-sach/' . $value['alias'] . '-' . $value['id_cate'] . '.html') . '"><div class="ui-bar ui-bar-a" id="height-menu-child">' . $value['title'] . '</div></a></div>';
//                    }
//                }
//                ?>
<!--            </div>-->
            <a href="./ung-dung.html" hidden class="click-app">dkasl;dksal;d</a>
            <!-- /grid-c -->
        </div>

        <div id="three">
            <a href="./videos.html" hidden class="click-videos">dkasl;dksal;d</a>
            <!-- /grid-c -->
        </div>
        <div id="four">
            <a href="./tin-tuc.html" hidden class="click-news">dkasl;dksal;d</a>
            <!-- /grid-c -->
        </div>

    </div>


    <div class="content name-block">
        <span>GAME YÊU THÍCH</span>
    </div>
    <div class="ui-grid-d owl-carousel owl-theme" id="game-fav">
        <?php
        if (!empty($game_fav))
            foreach ($game_fav as $key => $value) {
                ?>
                <div class="ui-block-a item">
                    <a href="<?php echo base_url('game/' . utf8_to_ascii($value['name']) . '-' . $value['id_game_app']); ?>.html">
                        <div class="ui-bar ui-bar-a" id="block-game-item">
                            <img src="<?php echo base_url($value['icon']); ?>"/>
                            <span class="name-game-item"><?php echo $value['name'] ?></span>
<!--                            <span class="des-game-item">--><?php //echo $value['description'] ?><!--</span>-->
                        </div>
                    </a>
                </div>
            <?php } ?>

    </div>
    <!-- /grid-c -->
    <div class="content view-orther-block">
        <a href="<?php echo base_url(); ?>danh-sach-game.html"><span>XEM THÊM</span></a>
    </div>
    <!------------------------------------------------------------->

    <div class="content name-block">
        <span>GAME MỚI</span>
    </div>
    <div class="content">
        <ul data-role="listview" data-split-icon="gear" data-split-theme="a" data-inset="true" class="list-view list-view-home">
            <?php
            if (!empty($game_new))
                foreach ($game_new as $key => $value) {
                    $temp = json_decode($value['download_url'], TRUE);
                    unset($temp['plist']);
                    $k = array_keys($temp);

                    ?>
                    <li>
                        <a href="<?php echo base_url('game/' . utf8_to_ascii($value['name']) . '-' . $value['id_game_app']); ?>.html">
                            <img src="<?php echo base_url($value['icon']); ?>"/>

                            <h2><?php echo $value['name'] ?></h2>

                            <p id="info-game"><?php echo $value['count_download'] ?> tải | <?php echo $value['size'] ?>
                                MB</p>

                            <p id="descript-game"><?php echo limit_text($value['description'], 20); ?></p>

                        </a>

                        <a href="#purchase" data-rel="popup" class="click-download" id-game="<?php echo $value['id_game_app']; ?>" download=' <?php echo json_encode($k); ?>' data-position-to="window" data-transition="pop">FREE</a>

                        <div class="free-download">FREE</div>
                    </li>
                <?php } ?>
        </ul>
    </div>
    <div class="content view-orther-block">
        <a href="<?php echo base_url(); ?>danh-sach-game.html"><span>XEM THÊM</span></a>
    </div>
    <!------------------------------------------------------------->

    <div class="content name-block">
        <span>APP</span>
    </div>
    <div class="content">
        <ul data-role="listview" data-split-icon="gear" data-split-theme="a" data-inset="true" class="list-view list-view-home">
            <?php
            if (!empty($app))
                foreach ($app as $key => $value) {
                    $temp = json_decode($value['download_url'], TRUE);
                    unset($temp['plist']);
                    $k = array_keys($temp);
                    ?>
                    <li>
                        <a href="<?php echo base_url('ung-dung/' . utf8_to_ascii($value['name']) . '-' . $value['id_game_app']); ?>.html">
                            <img src="<?php echo base_url($value['icon']); ?>"/>

                            <h2><?php echo $value['name'] ?></h2>

                            <p id="info-game"><?php echo $value['count_download'] ?> tải | <?php echo $value['size'] ?>
                                MB</p>

                            <p id="descript-game"><?php echo limit_text($value['description'], 20); ?></p>
                        </a>
                        <a href="#purchase" data-rel="popup" class="click-download" id-game="<?php echo $value['id_game_app']; ?>" download=' <?php echo json_encode($k); ?>' data-position-to="window" data-transition="pop">FREE</a>
                        <div class="free-download">FREE</div>
                    </li>
                <?php } ?>
        </ul>
    </div>
    <div class="content view-orther-block">
        <a href="<?php echo base_url(); ?>ung-dung.html"><span>XEM THÊM</span></a>
    </div>
    <!------------------------------------------------------------->

    <div class="content name-block">
        <span>TIN TỨC</span>
    </div>
    <div class="content">
        <ul data-role="listview" data-split-icon="gear" data-split-theme="a" data-inset="true"
            class="list-view list-view-news-video">
            <?php
            if (!empty($news))
                foreach ($news as $key => $value) {
                    ?>
                    <li>
                        <a href="<?php echo base_url('tin-tuc/' . utf8_to_ascii($value['name']) . '-' . $value['id_news_video']); ?>.html">

                            <img src="<?php echo base_url($value['image']); ?>"/>

                            <h2><?php echo $value['name'] ?></h2>

                            <p id="descript-game"><?php echo limit_text($value['description'], 20); ?></p>
                        </a>

                    </li>
                <?php } ?>

        </ul>
    </div>
    <div class="content view-orther-block">
        <a href="./tin-tuc.html"><span>XEM THÊM</span></a>
    </div>
    <!------------------------------------------------------------->

    <div class="content name-block">
        <span>VIDEOS</span>
    </div>
    <div class="content">
        <ul data-role="listview" data-split-icon="gear" data-split-theme="a" data-inset="true"
            class="list-view list-view-news-video">
            <?php
            if (!empty($videos))
                foreach ($videos as $key => $value) {
                    ?>
                    <li>
                        <div class="over-play"></div>
                        <a href="<?php echo base_url('videos/' . utf8_to_ascii($value['name']) . '-' . $value['id_news_video']); ?>.html">

                            <img src="<?php echo base_url($value['image']); ?>"/>

                            <h2><?php echo $value['name'] ?></h2>

                            <p id="descript-game"><?php echo limit_text($value['description'], 20); ?></p>
                        </a>

                    </li>
                <?php } ?>

        </ul>
    </div>
    <div class="content view-orther-block">
        <a href="./videos.html"><span>XEM THÊM</span></a>
    </div>
    <!------------------------------------------------------------->

    <div data-role="popup" id="purchase" data-theme="a" data-overlay-theme="b" class="ui-content" style="max-width:340px; padding-bottom:2em;">
        <h3>Tải Game</h3>
        <div class="bnt-download">
        </div>
    </div>
