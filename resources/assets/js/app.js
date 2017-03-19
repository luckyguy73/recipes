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
        $('#uploadBtn').change(function() {
            $('#uploadFile').val(this.files[0].name);
        });
        $('#deleteBtn').click(function( e ) {
            e.preventDefault();
            swal({
                title: "Please confirm!",
                text: "Click delete to remove recipe",
                type: "warning",
                showConfirmButton: true,
                confirmButtonText: "Delete",
                showCancelButton: true,
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $('.deleteForm').submit();
                }
            });
        }); 
    });
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});
