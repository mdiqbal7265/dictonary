;(function($){
    $(document).ready(function(){
        
        $(".menu-item").on('click',function(){
            $(".auth").hide();
            var target = "#"+$(this).data("target");
            $(target).show();
        });

        $(".word-item").on('click',function(){
            $(".word").hide();
            var target = "#"+$(this).data("target");
            $(target).show();
        });

        $(".delete").on('click', function(){
            var id = $(this).data("taskid");
            $("#taskid").val(id);
            $("#deleteform").submit();
        });
        $(".logout").on('click', function(){
            $("#logout_form").submit();
        });

    })
})(jQuery);