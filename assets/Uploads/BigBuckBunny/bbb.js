(function() {
    
    //inserts sources into a media tag
    function populateMedia(player, data, type){
        $.each(data, function(i, file){
            player.append("<source src='"+file.link+"' type='"+type+"/"+file.format+"'>");   
        });
    }
    
    var audioPlayer = $('#centerContent audio');
    var videoPlayer = $('#videoWrap video');
    
    //get json data from external file
    $.getJSON( "bbb.json", function() {
    }).done(function(data){
        
        //place page title
        $('title').html(data.headTitle);
        
        //place "skip" button text
        $('#skipVideo').html(data.skipText);
        
        //insert video sources
        populateMedia(videoPlayer, data.video,"video");
        
        //play video fullscreen
        videoPlayer.trigger("play");
        
        //insert audio sources
        populateMedia(audioPlayer, data.audio,"audio");
        
        //set background image
        $('html').css({"background": "#000 url("+data.bgImgPath+") no-repeat center center fixed",
                       "-webkit-background-size" : "cover",
                        "-moz-background-size" : "cover",
                        "-o-background-size" : "cover",
                        "background-size" : "cover"
                    });
                    
        //place copy text
        $('#centerContent').prepend("<p>"+data.copyText+"</p>");
        
        //place "Listen" button text
        $('#playAudio').html(data.listenText);
        
        //place Credits title
        $('#credits h4').html(data.creditsTitle);
        
        // insert credits links
        $.each(data.credits, function(i, cred){
            $('#credits p').append(cred.typeName+": <a href='"+cred.link+"'>"+cred.linkName+"</a><br/>\n");   
        });
        $("#credits").append(data.pageBy);
        
        
    });
    
    
    
    // click skip video
     $("a#skipVideo").click(function(e){
        e.preventDefault();
        videoPlayer.trigger("pause"); // "ended" event doesn't actually stop html5 video from playing, so pause first
        videoPlayer.trigger("ended");
        console.log("skip video");
     });
     
     //fade skip video button in/out with hover
    $('#videoWrap').hover(
        function(){
            $(this).children("a#skipVideo").fadeIn();
        },

        function(){
            $(this).children("a#skipVideo").fadeOut();
        }
    ); 
    
    //video completed/skipped
    videoPlayer.bind("ended", function() {
        
        $('html').css({'min-height' : '100%'}); //release video-oriented window constraints
        $('body').css({'min-height' : '100%'});
        $("#outerWrap").css({"background" : "none",    
                              "overflow" : "visible",
                              "min-height": "100%"
                            });
        $("#videoWrap").fadeOut();
        console.log("end triggered");
    });
        
        
    //click play audio 
    $("a#playAudio").click(function(e){
        e.preventDefault();
        audioPlayer.trigger("play");
        audioPlayer.parent().fadeIn(); //fade in audio player
        $(this).fadeOut(); //fade out "Listen" button
    });
    
})();