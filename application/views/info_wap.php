<script>
    $(document).ready(function () {

    });
</script>
<div>

    <div data-role="header" id="header" class="list-app">
        <div data-role="navbar">
            <ul>
                <li>
                    <a href="#" onclick="window.history.back()" data-direction="reverse">
                        <img src="<?php echo base_url(); ?>wap/image/ico_back.png"/>
                        <h1> &nbsp;</h1>
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

    <div class="content detail-app-games list-view-videos-news">
        <ul data-role="listview" class="list-view" data-icon="false">

            <li class="header-game-content" style="border: none;">
                <h2><?php echo $data[0]['title'] ?></h2>
                <div style="clear: both">
                    </br>
                    <?php echo $data[0]['content'] ?>
                </div>

            </li>
        </ul>


    </div>

    <!------------------------------------------------------------->
