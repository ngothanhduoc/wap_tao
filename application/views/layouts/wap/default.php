<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>Multi-page template</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>wap/css/themes/default/jquery.mobile-1.4.5.min.css">
        <!--<link rel="stylesheet" href="./css/style.default.css" type="text/css" />-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>wap/owl-carousel/owl.carousel.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>wap/owl-carousel/owl.theme.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>wap/owl-carousel/owl.transitions.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>wap/css/style.default.css" type="text/css" />
        <!--<link rel="shortcut icon" href="../favicon.ico">-->
        <script src="<?php echo base_url(); ?>wap/js/jquery.js"></script>
        <script>
            $(document).bind("mobileinit", function() {
                $.extend($.mobile, {
                   defaultPageTransition: 'slide'
                });
            });
            $(document).on('vclick', '[data-rel=back]', function(e) {
                e.stopImmediatePropagation();
                e.preventDefault();
                // $.mobile.back(e);
                var back = $.mobile.activePage.prev('[data-role=page]');
                $.mobile.changePage(back, {
                    transition: 'slide',
                    reverse: true,
                    changeHash: false
                });
            });
        </script>
        <script src="<?php echo base_url(); ?>wap/js/jquery.mobile-1.4.5.min.js"></script>
        <script src="<?php echo base_url(); ?>wap/owl-carousel/owl.carousel.min.js"></script>

        <!--Start of Zopim Live Chat Script-->
        
    </head>

    <body>
        <div class="content-wap">
            <?php 
                echo $content;
                
            ?>
            

                <!-- /content -->

                <div data-role="footer" id="footer">
                    <ul  >
                        <li><a href="#"><img src="<?php echo base_url(); ?>wap/image/ten_de.png" /> Giới Thiệu </a></li>
                        <li><a href="#"><img src="<?php echo base_url(); ?>wap/image/ten_de.png" /> Điều Khoản Sử Dụng</a></li>
                        <li><a href="#"><img src="<?php echo base_url(); ?>wap/image/ten_de.png" /> Chính Sách Bảo mật</a></li>
                        <li><a href="#"><img src="<?php echo base_url(); ?>wap/image/ten_de.png" /> Cài Đặt, Gỡ Bỏ</a></li>
                        <li><a href="#"><img src="<?php echo base_url(); ?>wap/image/ten_de.png" /> Hỗ Trợ</a></li>
                    </ul>
                    <div class="content view-orther-block"></div>
                    <ul  >
                        <li><a href="#"> Hotline : 1900 6611 -  Hỗ trợ : hotro@iwin.vn  </a></li>
                        <li><a href="#"> Bản quyền thuộc về Mecorp </a></li>
                        <li><a href="#">Bản quyền thuộc về Mecorp </a></li>
                        <li><a href="#">Địa chỉ: 141 Lý Chính Thắng, P.7, Q. 3, TP.HCM</a></li>

                    </ul>
                </div><!-- /footer -->

            </div><!-- /page -->

        </div>
    </body>
</html>
