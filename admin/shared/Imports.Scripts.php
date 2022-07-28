<script src="/admin/res/js/material-dashboard/core/bootstrap.min.js" ></script>
<script src="/admin/res/js/material-dashboard/core/popper.min.js" ></script>
<script src="/admin/res/js/material-dashboard/plugins/perfect-scrollbar.min.js" ></script>
<script src="/admin/res/js/material-dashboard/plugins/smooth-scrollbar.min.js" ></script>
<script src="/shared/extras/github-buttons/buttons.min.js"></script>
<script src="/shared/extras/jquery/jquery-3.6.0.min.js"></script>
<script src="/admin/res/js/material-dashboard/material-dashboard.js"></script>

<script>
	var win = navigator.platform.indexOf('Win') > -1;
	
	if (win && document.querySelector('#sidenav-scrollbar')) {
		var options = {
			damping: '0.5'
		}
		
		Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
	}
</script>