<script src="/admin/assets/js/core/popper.min.js" ></script>
<script src="/admin/assets/js/core/bootstrap.min.js" ></script>
<script src="/admin/assets/js/plugins/perfect-scrollbar.min.js" ></script>
<script src="/admin/assets/js/plugins/smooth-scrollbar.min.js" ></script>
<script src="/admin/res/extras/github-buttons/buttons.min.js"></script>
<script src="/admin/res/extras/jquery/jquery-3.6.0.min.js"></script>
<script src="/admin/assets/js/material-dashboard.min.js?v=3.0.4"></script>

<script>
	var win = navigator.platform.indexOf('Win') > -1;
	
	if (win && document.querySelector('#sidenav-scrollbar')) {
		var options = {
			damping: '0.5'
		}
		
		Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
	}
</script>