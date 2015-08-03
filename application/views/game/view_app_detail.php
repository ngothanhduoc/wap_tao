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
                                    <h1>Detail Apps</h1>
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
                                <img src="<?php echo base_url($app[0]['icon']); ?>">
                                <h2><?php echo $app[0]['name'] ?></h2>
                                <p id="info-game"><?php echo $app[0]['count_download'] ?> tải | <?php echo $app[0]['size'] ?>kb</p>
                                <input type="button" value="FREE" name="FREE" />
                            </a>
                        </li>
                        <li class="slide-game">
                            <div class="ui-grid-d owl-carousel owl-theme" id="slide-game-detail">
                                
                                <?php 
                                    if(!empty($app[0]['slide_image'])){
                                        $slide = json_decode($app[0]['slide_image'], TRUE);
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
                                <?php echo $app[0]['content'] ?>
                            </div>
                            
                        </li>
                    </ul>
                    

                </div>
