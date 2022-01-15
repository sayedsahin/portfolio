
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
	/* global bootstrap: false */
	(function () {
		'use strict'
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
		tooltipTriggerList.forEach(function (tooltipTriggerEl) {
			new bootstrap.Tooltip(tooltipTriggerEl)
		})
	})();
	window.addEventListener('DOMContentLoaded', event => {

	    // Toggle the side navigation
	    const sidebarToggle = document.body.querySelector('#sidebarToggle');
	    if (sidebarToggle) {
	        // Uncomment Below to persist sidebar toggle between refreshes
	        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
	        //     document.body.classList.toggle('sb-sidenav-toggled');
	        // }
	        sidebarToggle.addEventListener('click', event => {
	        	event.preventDefault();
	        	document.body.classList.toggle('sb-sidenav-toggled');
	        	localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
	        });
	    }

	});
</script>
</body>
</html>