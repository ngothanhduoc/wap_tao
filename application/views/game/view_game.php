
<div class="page-game" >

    <div data-role="header" id="header" class="list-app">
        <div data-role="navbar">
            <ul>
                <li>
                    <a href="./" data-direction="reverse">
                        <img src="<?php echo base_url(); ?>wap/image/ico_back.png"/>
                        <h1>GAME</h1>
                    </a>
                </li>
                <li>
                    <form class="ui-filterable" id="form-search" action="<?php echo base_url() ?>tim-kiem" method="get">
                        <input id="autocomplete-input" name="data" data-type="search" placeholder="Tìm kiếm...">
                    </form>
                </li>
            </ul>
        </div><!-- /navbar -->


    </div><!-- /header -->

    <div class="content">
        <ul data-role="listview" data-split-icon="gear" data-split-theme="a" data-inset="true" class="list-view add-more-list-game">
            <?php
            if (!empty($game))
                foreach ($game as $key => $value) {
                    $temp = json_decode($value['download_url'], TRUE);
                    unset($temp['plist']);
                    $k = array_keys($temp);
                    ?>
                    <li>
                        <a href="<?php echo base_url('game/' . utf8_to_ascii($value['name']) . '-' . $value['id_game_app']); ?>.html">
                            <img src="<?php echo base_url($value['icon']); ?>" />
                            <h2><?php echo $value['name'] ?></h2>
                            <p id="info-game"><?php echo $value['count_download'] ?> tải | <?php echo $value['size'] ?>kb</p>
                            <p id="descript-game"><?php echo limit_text($value['description'],20) ?></p>
                        </a>
                        <a href="#purchase-game" onclick='abc("a.click-download-game-<?php echo $value['id_game_app']; ?>");'  data-rel="popup"  class="click-download-game-<?php echo $value['id_game_app']; ?>" id-game="<?php echo $value['id_game_app']; ?>" download='<?php echo json_encode($k); ?>' data-position-to="window" data-transition="pop">FREE</a>
                        <div class="free-download">FREE</div>
                    </li>
                <?php } ?>
        </ul>
        <div class="loadmore" offset="2" first-page="first"></div>
    </div>

    <!------------------------------------------------------------->

    <div data-role="popup" id="purchase-game" data-theme="a" data-overlay-theme="b" class="ui-content" style="max-width:340px; padding-bottom:2em;">
        <h3>Tải Game</h3>
        <div class="bnt-download bnt-download-game">

        </div>
    </div>

    <!-- /content -->


    <!-- /content -->
    <script>
        function abc(a){

                var _json = $(a).attr('download');
                var _id_game = $(a).attr('id-game');
                var _obj = JSON.parse(_json);
                var _html = '';
                if (platform == 'pc') {
                    for (var key in _obj) {

                        _html += '<a target="_blank" href="<?php echo base_url() ?>tai-game?id=' + _id_game + '&platform=' + _obj[key] + '" data-ajax="false"><button class="ui-bnt ui-btn ui-shadow ui-corner-all" style="text-transform: uppercase">' + _obj[key] + '</button></a>';
                        $('.bnt-download-game').html(_html);
                    }
                } else {
                    $('#purchase-game').remove();
                    for (var key in _obj) {
                        if (_obj[key] == '<?php echo $_SESSION['platform'] ?>') {
                            _html = '<?php echo base_url() ?>tai-game?id=' + _id_game + '&platform=' + _obj[key];

                            if (confirm('Bạn có tải game?')) {
                                window.open(_html);
                            }
                        }

                    }
                }
        }


    </script>