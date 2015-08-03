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
                        <h1>News</h1>
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
            <div class="video">
                
            </div>
            <li class="header-game-content">
                </br>
                <h2><?php echo $news[0]['name'] ?></h2>
                <div style="clear: both">
                    </br>
                    <?php echo $news[0]['content'] ?>
                </div>

            </li>
        </ul>


    </div>

    <!------------------------------------------------------------->
