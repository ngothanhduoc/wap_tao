<div>

    <div data-role="header" id="header" class="list-app">
        <div data-role="navbar">
            <ul>
                <li>
                    <a href="<?php echo base_url() ?>"  data-direction="reverse">
                        <img src="<?php echo base_url(); ?>wap/image/ico_back.png"/>
                        <h1>APPS</h1>
                    </a>
                </li>
                <li>
                    <form class="ui-filterable" id="form-search">
                        <input id="autocomplete-input" data-type="search" placeholder="Tìm kiếm...">
                    </form>
                </li>
            </ul>
        </div><!-- /navbar -->


    </div><!-- /header -->

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
                            <p id="descript-game"><?php echo limit_text($value['description'],20) ?></p>
                        </a>
                        <a href="#purchase" data-rel="popup" data-position-to="window" data-transition="pop"></a>
                        <div class="free-download">FREE</div>
                    </li>
                <?php } ?>
        </ul>
    </div>
    <div class="content view-orther-block">
        <span>XEM THÊM</span>
    </div>
    <!------------------------------------------------------------->



    <div data-role="popup" id="purchase" data-theme="a" data-overlay-theme="b" class="ui-content" style="max-width:340px; padding-bottom:2em;">
        <h3>Purchase Album?</h3>
        <p>Your download will begin immediately on your mobile device when you purchase.</p>
        <a href="index.html" data-rel="back" class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-check ui-btn-icon-left ui-btn-inline ui-mini">Buy: $10.99</a>
        <a href="index.html" data-rel="back" class="ui-shadow ui-btn ui-corner-all ui-btn-inline ui-mini">Cancel</a>
    </div>

    <!-- /content -->