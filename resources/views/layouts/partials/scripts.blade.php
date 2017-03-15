<script src="{{ mix('js/app.js') }}"></script>
<script>
    $(document).ready(function(){
        $("#new-task").focus();
        setTimeout(function(){
            $(".alert-dismissable").fadeOut("slow");
        }, 3000 );
    });
</script>