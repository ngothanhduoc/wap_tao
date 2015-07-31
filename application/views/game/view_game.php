<div>

    <div data-role="header" id="header" class="list-app">
        <div data-role="navbar">
            <ul>
                <li>
                    <a href="./" data-direction="reverse">
                        <img src="./image/ico_back.png"/>
                        <h1>GAME</h1>
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
            <li>
                <a href="./detail.html">
                    <img src="./image/4.jpg">
                    <h2>Iron Man 3 - The Official</h2>
                    <p id="info-game">50 tải | 350kb</p>
                    <p id="descript-game">Trở thành tỉ phú Tony Stark trong vai Iron Man trong game chạy ..</p>
                </a>
                <a href="#purchase" data-rel="popup" data-position-to="window" data-transition="pop"></a>
            </li>
            <li>
                <a href="#">
                    <img src="./image/3.jpg">
                    <h2>Wolfgang Amadeus Phoenix</h2>
                    <p id="info-game">50 tải | 350kb</p>
                    <p id="descript-game">Trở thành tỉ phú Tony Stark trong vai Iron Man trong game chạy ..</p>
                </a>
                <a href="#purchase" data-rel="popup" data-position-to="window" data-transition="pop">Purchase album</a>
            </li>
            <li>
                <a href="./detail.html">
                    <img src="./image/1.jpg">
                    <h2>Wolfgang Amadeus Phoenix</h2>
                    <p id="info-game">50 tải | 350kb</p>
                    <p id="descript-game">Trở thành tỉ phú Tony Stark trong vai Iron Man trong game chạy ..</p>
                </a>
                <a href="#purchase" data-rel="popup" data-position-to="window" data-transition="pop">Purchase album</a>
            </li>
            <li>
                <a href="./detail.html">
                    <img src="./image/5.jpg">
                    <h2>Wolfgang Amadeus Phoenix</h2>
                    <p id="info-game">50 tải | 350kb</p>
                    <p id="descript-game">Trở thành tỉ phú Tony Stark trong vai Iron Man trong game chạy ..</p>
                </a>
                <a href="#purchase" data-rel="popup" data-position-to="window" data-transition="pop">Purchase album</a>
            </li>
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