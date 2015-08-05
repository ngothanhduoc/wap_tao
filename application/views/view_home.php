<script>
    $(document).ready(function () {

        var owl = $("#slide-game-menu");
        owl.owlCarousel({
            pagination: false,
        });

        var owl_app = $("#slide-app-menu");
        owl_app.owlCarousel({
            pagination: false,
        });
        var owl_app = $("#game-fav");
        owl_app.owlCarousel({
            pagination: false,
        });
    });
</script>
<div>

    <div data-role="header" id="header">
        <div data-role="navbar">
            <ul>
                <li>
                    <a href="./">
                        <h1 id="title-wap"><img src="<?php echo base_url(); ?>wap/image/logo.png"/></h1>
                    </a>
                </li>
                <li>
                    <form class="ui-filterable" id="form-search">
                        <input id="autocomplete-input" data-type="search" placeholder="Tìm kiếm...">
                    </form>
                    <!--                                <ul data-role="listview" data-filter="true" data-filter-reveal="true" data-input="#autocomplete-input">
                                                        <li><a href="#">Acura</a></li>
                                                    </ul>-->
                </li>
            </ul>
        </div><!-- /navbar -->


    </div><!-- /header -->
    <div data-role="tabs" id="tabs">
        <div data-role="navbar" id="menu-wap">
            <ul>
                <li><a href="#one" data-ajax="false" class="ui-btn-active"> 
                        <div class="image-menu menu-game"></div>
                        Game
                    </a>
                </li>
                <li><a href="#two" data-ajax="false">
                        <div class="image-menu menu-app"></div>
                        App
                    </a></li>
                <li><a href="#three" data-ajax="false">
                        <div class="image-menu menu-video"></div>
                        Video
                    </a></li>
                <li><a href="#four" data-ajax="false">
                        <div class="image-menu menu-news"></div>
                        News
                    </a></li>
            </ul>
        </div>
        <div id="one">
            <div class="ui-grid-d owl-carousel owl-theme" id="slide-game-menu">

                <div class="ui-block-a item active-item"><a href="<?php echo base_url(); ?>danh-sach-game.html"><div class="ui-bar ui-bar-a" id="height-menu-child">Game</div></a></div>
                <?php 
                    if (!empty($cate['game_cate'])) {
                        foreach ($cate['game_cate'] as $key => $value) {
                            echo '<div class="ui-block-a item"><a href="'.base_url('game/danh-muc/'.$value['alias'].'.html').'"><div class="ui-bar ui-bar-a" id="height-menu-child">'.$value['title'].'</div></a></div>';
                        }
                    }
                ?>
                

            </div><!-- /grid-c -->
        </div>
        <div id="two">
            <div class="ui-grid-d owl-carousel owl-theme" id="slide-app-menu">
                <div class="ui-block-a item active-item"><a href="<?php echo base_url(); ?>ung-dung.html"><div class="ui-bar ui-bar-a" id="height-menu-child">Ứng Dụng</div></a></div>
                <?php 
                    if (!empty($cate['app_cate'])) {
                        foreach ($cate['app_cate'] as $key => $value) {
                            echo '<div class="ui-block-a item"><a href="'.base_url('ung-dung/danh-sach/'.$value['alias'].'.html').'"><div class="ui-bar ui-bar-a" id="height-menu-child">'.$value['title'].'</div></a></div>';
                        }
                    }
                ?>
            </div><!-- /grid-c -->
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
                            <img src="<?php echo base_url($value['icon']); ?>" />
                            <span class="name-game-item"><?php echo $value['name'] ?></span>
                            <span class="des-game-item"><?php echo $value['description'] ?></span>
                        </div>
                    </a>
                </div>
            <?php } ?>

    </div><!-- /grid-c -->
    <div class="content view-orther-block">
        <a href="<?php echo base_url(); ?>danh-sach-game.html"><span>XEM THÊM</span></a>
    </div>
    <!------------------------------------------------------------->

    <div class="content name-block">
        <span>GAME MỚI</span>
    </div>
    <div class="content">
        <ul data-role="listview" data-split-icon="gear" data-split-theme="a" data-inset="true" class="list-view">
            <?php
            if (!empty($game_new))
                foreach ($game_new as $key => $value) {
                    ?>
                    <li>
                        <a href="<?php echo base_url('game/' . utf8_to_ascii($value['name']) . '-' . $value['id_game_app']); ?>.html">
                            <img src="<?php echo base_url($value['icon']); ?>" />
                            <h2><?php echo $value['name'] ?></h2>
                            <p id="info-game"><?php echo $value['count_download'] ?> tải | <?php echo $value['size'] ?>kb</p>
                            <p id="descript-game"><?php echo $value['description'] ?></p>
                        </a>
                        <a href="#purchase" data-rel="popup" data-position-to="window" data-transition="pop"></a>
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
        <ul data-role="listview" data-split-icon="gear" data-split-theme="a" data-inset="true" class="list-view">
            <?php
            if (!empty($app))
                foreach ($app as $key => $value) {
                    ?>
                    <li>
                        <a href="<?php echo base_url('ung-dung/' . utf8_to_ascii($value['name']) . '-' . $value['id_game_app']); ?>.html">
                            <img src="<?php echo base_url($value['icon']); ?>" />
                            <h2><?php echo $value['name'] ?></h2>
                            <p id="info-game"><?php echo $value['count_download'] ?> tải | <?php echo $value['size'] ?>kb</p>
                            <p id="descript-game"><?php echo $value['description'] ?></p>
                        </a>
                        <a href="#purchase" data-rel="popup" data-position-to="window" data-transition="pop"></a>
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
        <ul data-role="listview" data-split-icon="gear" data-split-theme="a" data-inset="true" class="list-view list-view-news-video">
            <?php
            if (!empty($news))
                foreach ($news as $key => $value) {
                    ?>
                    <li>
                        <a href="<?php echo base_url('tin-tuc/' . utf8_to_ascii($value['name']) . '-' . $value['id_news_video']); ?>.html">
                            <img src="<?php echo base_url($value['image']); ?>" />
                            <h2><?php echo $value['name'] ?></h2>
                            <p id="descript-game"><?php echo $value['description'] ?></p>
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
        <ul data-role="listview" data-split-icon="gear" data-split-theme="a" data-inset="true" class="list-view list-view-news-video">
            <?php
            if (!empty($videos))
                foreach ($videos as $key => $value) {
                    ?>
                    <li>
                        <a href="<?php echo base_url('videos/' . utf8_to_ascii($value['name']) . '-' . $value['id_news_video']); ?>.html">
                            <img src="<?php echo base_url($value['image']); ?>" />
                            <h2><?php echo $value['name'] ?></h2>
                            <p id="descript-game"><?php echo $value['description'] ?></p>
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
        <h3>Purchase Album?</h3>
        <p>Your download will begin immediately on your mobile device when you purchase.</p>
        <a href="index.html" data-rel="back" class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-check ui-btn-icon-left ui-btn-inline ui-mini">Buy: $10.99</a>
        <a href="index.html" data-rel="back" class="ui-shadow ui-btn ui-corner-all ui-btn-inline ui-mini">Cancel</a>
    </div>
