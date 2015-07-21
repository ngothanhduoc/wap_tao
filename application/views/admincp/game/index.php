<script type="text/javascript" src="/admin/assets/js/backend/backend.game.js?v=09072015"></script>

<div class="pageheader notab">
	<h1 class="pagetitle">Danh sách game</h1>
	<span class="pagedesc"></span>
	
</div><!--pageheader-->
<div id="contentwrapper" class="contentwrapper lineheight21">
	<div id="jqxgrid"></div>				
</div><!--contentwrapper-->

<script type="text/javascript">
    setActiveMenu('game');
    setActiveSubMenu('backend-game-index');
    
    var users = <?php echo json_encode($users)?>;
</script>