<script>
    $(function(){
        $('li.click_home').click(function(){


        });
    })

</script>
<div>

    <div data-role="header" id="header" class="list-app">
        <div data-role="navbar">
            <ul>
                <li class="click_home">
                    <a href="./" data-direction="reverse">
                        <img src="<?php echo base_url(); ?>wap/image/ico_back.png"/>
                        <h1>VIDEOS</h1>
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

        <ul data-role="listview" data-split-icon="gear" data-split-theme="a" data-inset="true" class="list-view list-view-news-video">
            <?php
            if (!empty($video))
                foreach ($video as $key => $value) {
                    ?>
                    <li>
                        <div class="over-play"></div>
                        <a href="<?php echo base_url('videos/' . utf8_to_ascii($value['name']) . '-' . $value['id_news_video']); ?>.html">
                            <img src="<?php echo base_url($value['image']); ?>" />
                            <h2><?php echo $value['name'] ?></h2>
                            <p id="descript-game"><?php echo limit_text($value['description'],20) ?></p>
                        </a>

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