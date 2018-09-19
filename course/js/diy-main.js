(function($) {
    $(document).ready(function(){
        $('.course_content_link').click(function(e){
            e.preventDefault();
            course_url = $(this).data("url");


            $('#course_content_body').load(course_url);

            // $.ajax({
            //     url: course_url,
            //     method: "POST",
            //     dataType: "html"
            // }).done(function( course_content ){
            //     //$('#course_content_title').text(course_content.course_title);
            //     $('#course_content_body').append(course_content);
            //
            //     //console.log(course_content.course_title);
            // });
        });

    });

})(jQuery);