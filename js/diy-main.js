"use strict"; // use strict to start
var playing = false;
var yplayer;
var height = "600px";
if (window.innerWidth > 1450) {
    height = "720px";
} else if (window.innerWidth < 760) {
    height = "450px";
} else if (window.innerWidth < 500) {
    height = "350px";
} else if (window.innerWidth < 400) {
    height = "250px";
}


var vvid = "60777705";
var yvid = "HBJ5A3IYwY8";
var first = "";
var autoplay = "";

if(adminUrl.has_intro_video && adminUrl.video_type==='youtube'){
    yvid = adminUrl.video_id;
}else if(adminUrl.has_intro_video && adminUrl.video_type==='vimeo'){
    vvid = adminUrl.video_id;
}

console.log(adminUrl);

(function($) {
    $(document).ready(function(){
        var ajax_url = adminUrl.url+'admin-ajax.php';
        var w = $("#vplayer").width();
        hidePlayers();
        var options = {
            id: vvid,
            width: w,
            loop: false
        };
        var vp = new Vimeo.Player("vplayer", options);
        if(adminUrl.has_intro_video && adminUrl.video_type==='youtube'){
            $("#yplayer").show();
        }else if(adminUrl.has_intro_video && adminUrl.video_type==='vimeo'){
            $("#vplayer").show();
        }



        $('.course_content_link').on('click', function(e){
            e.preventDefault();

            $(this).find("i").removeClass("fa-plus");
            $(this).find("i").addClass("fa-check");
            $("a.active_course_content").removeClass("active_course_content");
            $(this).addClass("active_course_content");
            var course_url = $(this).data("url");
            var vid = $(this).data("vid");
            var vtype = $(this).data("type");
            var title = $(this).data("title");
            var post_id = $(this).data("post");

            if(!vid){
                $("#vplayer").hide();
                $("#yplayer").hide();
                $.post(ajax_url,{
                    "action": "mt_course_nonce",
                    "mt_nonce":mt_course_nonce,
                    "post_id":post_id,
                },function( course_content ){
                    $('#course_content_body').html(course_content);
                });

                return;
            }


            if(playing) {
                vp.pause();
                yplayer.stopVideo();
            }else{
                playing=true;
            }
            $('#course_content_body').html('');
            hidePlayers();
            var vid = $(this).data("vid");
            var vtype = $(this).data("type");
            var title = $(this).data("title");
            $('#course_content_title').html(title);
            if (vtype == 1) { //vimeo
                $("#vplayer").show();
                vp.loadVideo(vid).then(function () {
                    vp.play();
                });
            } else {
                yplayer.loadVideoById(vid, 0, "hd720");
                $("#yplayer").show();
            }


            $.post(ajax_url,{
                "action": "mt_course_nonce",
                "mt_nonce":mt_course_nonce,
                "post_id":post_id,
            },function( course_content ){
                $('#course_content_body').html(course_content);
            });
        });

        var panel = $('#accordion .panel').first();
        panel.addClass('in');

        //panel = panel.find(".panel-collapse a").first();
        //panel.trigger('click');

    });

    function hidePlayers() {
        $("#vplayer").hide();
        $("#yplayer").hide();
    }

})(jQuery);

function onYouTubeIframeAPIReady() {
    yplayer = new YT.Player('yplayer', {
        height: height,
        width: '100%',
        videoId: yvid,
        events: {
            'onReady': onPlayerReady,
        },
        playerVars: {
            modestbranding: true,
            rel: 0,
        },
    });


}

function onPlayerReady(event) {
    if(autoplay){
        var data = autoplay.split("ep");
        if(data){
            $("#"+data[0]).trigger("click");
            var pos = $("#"+data[0]).position();
            $(".sidebar-content").scrollTop(pos.top-100);
        }
        $("#"+autoplay).click();
    }
}