 <script>
            $(document).ready(function () {
                var owl = $("#slide-game-detail");
                owl.owlCarousel({
                    pagination: false,
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
                                    <h1>Detail</h1>
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

                <div class="content detail-app-games">
                    <ul data-role="listview" class="list-view" data-icon="false">
                        <li class="header-game">
                            <a href="#">
                                <img src="<?php echo base_url($game[0]['icon']); ?>">
                                <h2><?php echo $game[0]['name'] ?></h2>
                                <p id="info-game"><?php echo $game[0]['count_download'] ?> tải | <?php echo $game[0]['size'] ?>kb</p>
                                <input type="button" value="FREE" name="FREE" />
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
                            
                        </li>
                    </ul>
                    
<!--                    <ul data-role="listview" class="comment-game" data-icon="false">
                        <p>ĐÁNH GIÁ</p>
                        <li>
                            <a href="#">
                                <img src="./image/14.jpg">
                                <h2>Phúc Trần</h2>
                                <p id="date-comment">2015-07-17</p>
                                <p id="content-comment">Trở thành tỉ phú Tony Stark trong vai Iron Man trong game chạy.Trở thành tỉ phú Tony Stark trong vai Iron Man trong game chạy ..</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="./image/14.jpg">
                                <h2>Phúc Trần</h2>
                                <p id="date-comment">2015-07-17</p>
                                <p id="content-comment">Trở thành tỉ phú Tony Stark trong vai Iron Man trong game chạy ..</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="./image/14.jpg">
                                <h2>Phúc Trần</h2>
                                <p id="date-comment">2015-07-17</p>
                                <p id="content-comment">Trở thành tỉ phú Tony Stark trong vai Iron Man trong game chạy ..</p>
                            </a>
                        </li>
                        
                        

                    </ul>-->
                </div>

                <!------------------------------------------------------------->



                <div data-role="popup" id="purchase" data-theme="a" data-overlay-theme="b" class="ui-content" style="max-width:340px; padding-bottom:2em;">
                    <h3>Purchase Album?</h3>
                    <p>Your download will begin immediately on your mobile device when you purchase.</p>
                    <a href="index.html" data-rel="back" class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-check ui-btn-icon-left ui-btn-inline ui-mini">Buy: $10.99</a>
                    <a href="index.html" data-rel="back" class="ui-shadow ui-btn ui-corner-all ui-btn-inline ui-mini">Cancel</a>
                </div>

                <!-- /content -->