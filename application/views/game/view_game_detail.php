<?php
$temp = json_decode($game[0]['download_url'], TRUE);
unset($temp['plist']);
$k = array_keys($temp);
$ran = rand(0,100);
?>
 <script>
            $(document).ready(function () {
                var owl_detail = $("#slide-game-detail");
                owl_detail.owlCarousel({
                    pagination: false,
					items : 5,
					itemsCustom : false,
					itemsDesktop : [1199,5],
					itemsDesktopSmall : [980,2],
					itemsTablet: [768,2],
					itemsTabletSmall: false,
					itemsMobile : [479,2],
					itemsScaleUp : true,
                });
            });
        </script>
            <div>

                <div data-role="header" id="header" class="list-app">
                    <div data-role="navbar">
                        <ul>
                            <li>
                                <a href="#" onclick="window.history.back()" data-direction="reverse">
                                    <img src="<?php echo base_url(); ?>wap/image/ico_back.png"/>
                                    <h1>Chi Tiết</h1>
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

                <div class="content detail-app-games">
                    <ul data-role="listview" class="list-view" data-icon="false">
                        <li class="header-game">
                            <a href="#popup-dl-game-<?php echo $ran ?>" data-rel="popup" class="" data-transition="pop">
                                <img src="<?php echo base_url($game[0]['icon']); ?>">
                                <h2><?php echo $game[0]['name'] ?></h2>
                                <p id="info-game"><?php echo $game[0]['count_download'] ?> tải | <?php echo $game[0]['size'] ?>kb</p>
                                <input class="down-game" type="button" value="FREE" name="FREE" />
                            </a>
                        </li>
                        <li class="slide-game">
                            <div class="ui-grid-d owl-carousel owl-theme" id="slide-game-detail">
                                
                                <?php 
                                    if(!empty($game[0]['slide_image'])){
                                        $slide = json_decode($game[0]['slide_image'], TRUE);
                                        foreach ($slide as $key ) {

                                ?>
                                
                                <div class="ui-block-a item">
                                    <a href="">
                                        <div class="ui-bar ui-bar-a" id="block-game-item-slide">
                                            <img src="<?php echo base_url($key); ?>" />

                                        </div>
                                    </a>
                                </div>
                                    <?php }} ?>
                            </div><!-- /grid-c -->
                        </li>
                        <li class="header-game-content" id="slide-game-menu">
                            <div style="clear: both">
                                </br>
                                <?php echo $game[0]['content'] ?>
                            </div>
                            <a href="#popup-dl-game-<?php echo $ran ?>" data-rel="popup" class="" data-transition="pop"><input class="down-game" type="button" value="FREE" name="FREE" /></a>
                        </li>
                    </ul>
                    

                </div>

                <!------------------------------------------------------------->


                <?php if($_SESSION['platform'] == 'pc') { ?>
                <div data-role="popup" id="popup-dl-game-<?php echo $ran ?>" data-theme="a" data-overlay-theme="b" class="ui-content" style="max-width:340px; padding-bottom:2em;">
                    <h3>Tải Game</h3>
                    <div class="bnt-download bnt-download-game">
                        <?php
                        foreach($k as $i){
                            ?>
                            <a target="_blank" href="<?php echo base_url() ?>tai-game?id=<?php echo $game[0]['id_game_app']; ?>&platform=<?php echo $i; ?>" data-ajax="false"><button class="ui-bnt ui-btn ui-shadow ui-corner-all" style="text-transform: uppercase"><?php echo $i; ?></button></a>
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
                            $(".down-game").click(function(){
                                <?php
                                    foreach($k as $i){
                                        if($_SESSION['platform'] == $i){
                                ?>
                                    if (confirm('Bạn có tải game?')) {
                                        window.open('<?php echo base_url() ?>tai-game?id=<?php echo $game[0]['id_game_app']; ?>&platform=<?php echo $i; ?>');
                                    }
                                <?php
                                  }}
                                ?>
                            })

                        })


                    </script>
                    <?php
                }
                ?>

                <!-- /content -->