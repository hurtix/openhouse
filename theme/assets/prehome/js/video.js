//api de youtube https://developers.google.com/youtube/iframe_api_reference

        // variable global para el play
        var player;

        // esta función se llama cuando API estÃ¡ listo para usar
        function onYouTubePlayerAPIReady() {
          // crear el actor global de la iframe especÃ­fico ( #video )
          player = new YT.Player('video', {
            events: {
              // llama esta funcion cuando la reproduccion ya esta play
              'onReady': onPlayerReady,
              'onStateChange':onPlay
              }
            });
        }

        function onPlayerReady(event) {

        // bind events
            var playButton = document.getElementById("play_button");
            playButton.addEventListener("click", function() {
                player.playVideo();
                    $(".fondovideo").hide();
                    $(".wrapper-video-youtube").fadeIn();
                });

          // var pauseButton = document.getElementById("pause_button");
          // pauseButton.addEventListener("click", function() {
          //   player.pauseVideo();
            
          // });
          
        }

        function onPlay(event){
            var myPlayerState;
            
            if (event.data == 2) {
                $(".wrapper-video-youtube").hide();
                $(".fondovideo").fadeIn(700);
            }
            myPlayerState = event.data;
        }
      


        // Inserta el api de youtube
        var tag = document.createElement('script');
        tag.src = "//www.youtube.com/player_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);