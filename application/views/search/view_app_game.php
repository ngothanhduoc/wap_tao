<?php
/**
 * Created by PhpStorm.
 * User: thanhduoc
 * Date: 8/30/15
 * Time: 1:24 AM
 */
?>
<script>

    $(function(){
        setTimeout(function(){

            function getQueryVariable(variable) {
                var query = window.location.search.substring(1);
                var vars = query.split("&");
                for (var i = 0; i < vars.length; i++) {
                    var pair = vars[i].split("=");
                    if (pair[0] == variable) {
                        return pair[1];
                    }
                }
                return (false);
            }

            var _get = getQueryVariable('data');

            $.getJSON('<?php echo base_url() ?>action_search?data=' + _get, function (data) {
                $('.view-search').append(data.html);
            });
        }, 300)

    })


</script>
<div>

    <div data-role="header" id="header" class="list-app">
        <div data-role="navbar">
            <ul>
                <li>
                    <a href="<?php echo base_url() ?>" data-direction="reverse">
                        <img src="<?php echo base_url(); ?>wap/image/ico_back.png"/>

                        <h1>Tìm</h1>
                    </a>
                </li>
                <li>
                    <form class="ui-filterable" id="form-search" action="<?php echo base_url() ?>tim-kiem" method="get">
                        <input id="autocomplete-input" name="data" data-type="search" placeholder="Tìm kiếm...">
                    </form>
                </li>
            </ul>
        </div>
        <!-- /navbar -->


    </div>
    <!-- /header -->

    <div class="content">
        <ul data-role="listview" data-split-icon="gear" data-split-theme="a" data-inset="true" class="list-view view-search">

        </ul>
        <div class="loadmore" offset="2" first-page="first"></div>
    </div>

    <!------------------------------------------------------------->


    <div data-role="popup" id="purchase-app" data-theme="a" data-overlay-theme="b" class="ui-content"
         style="max-width:340px; padding-bottom:2em;">
        <h3>Tải Ứng Dụng</h3>

        <div class="bnt-download bnt-download-app">
            <a href="http://wapgame.local/tai-game?id=17&platform=android" data-ajax="false">
                <button class="ui-bnt">Android</button>
            </a>
            <button class="ui-bnt">IOS</button>
            <button class="ui-bnt">JAVA</button>
        </div>
    </div>

    <!-- /content -->

