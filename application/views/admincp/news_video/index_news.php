<script type="text/javascript" src="/admin/assets/js/backend/backend.news.js?v=09072015"></script>

<div class="pageheader notab">
	<h1 class="pagetitle">Danh Tin Tức</h1>
	<span class="pagedesc"></span>
	
</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
	<div id="jqxgrid"></div>				
</div><!--contentwrapper-->

<script type="text/javascript">
    setActiveMenu('news_video');
    setActiveSubMenu('backend-news_video-index_news');
    
    var users = <?php echo json_encode($users)?>;
</script>