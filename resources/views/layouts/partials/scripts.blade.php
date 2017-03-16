<script src="{{ mix('js/app.js') }}"></script>
<script>
    $(document).ready(function(){
        $("#new-task").focus();
        setTimeout(function(){
            $(".alert-dismissable").fadeOut("slow");
        }, 3000 );
        $('#scroll-btn').click(function() {
        	$('body').scrollTop(0);
        });
		$('input[type=checkbox]').change(function(e){
			if ($('input[type=checkbox]:checked').length > 3) {
				$(this).prop('checked', false);
			}
		});
    });
</script>
