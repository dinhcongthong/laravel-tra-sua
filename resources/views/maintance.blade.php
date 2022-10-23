<!DOCTYPE html>
<!--[if lt IE 7]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class='no-js' lang='en'>
<!--<![endif]-->

<head>
    <meta charset='utf-8' />
    <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible' />
    <title>Thế Giới Trà Sữa Is Coming Soon</title>

    <link rel="shortcut icon" href="https://we.graphics/demo/avenir/favicon.ico" />
    <link rel="apple-touch-icon" href="https://we.graphics/demo/avenir/images/favicon.png" />

    <link rel="stylesheet" href="https://we.graphics/demo/avenir/css/maximage.css" type="text/css" media="screen" charset="utf-8" />
    <link rel="stylesheet" href="https://we.graphics/demo/avenir/css/styles.css" type="text/css" media="screen" charset="utf-8" />

    <!--[if lt IE 9]><script src="https://we.graphics/demo/avenir/https://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

    <!--[if IE 6]>
   <style type="text/css" media="screen">
    .gradient {display:none;}
   </style>
  <![endif]-->
</head>

<body>

    <!-- Switch to full screen -->
    <button class="full-screen" onclick="$(document).toggleFullScreen()"></button>


    <!-- Slider Controls -->
    <a href="" id="arrow_left"><img src="https://we.graphics/demo/avenir/images/arrow-left.png" alt="Slide Left" /></a>
    <a href="" id="arrow_right"><img src="https://we.graphics/demo/avenir/images/arrow-right.png" alt="Slide Right" /></a>

    <!-- Home Page -->
    <section class="content show" id="home">
        <h1>Đang phát triển ...</h1>
        <h5>Site của chúng tôi đang trong giai đoạn phát triển!</h5>
        <p>Chúng tôi sẽ cố gắng hết sức bình sinh để hoàn thành nó sớm nhất có thể</p>
    </section>

    <!-- Background Slides -->
    <div id="maximage">
        <div>
            <img src="https://we.graphics/demo/avenir/images/backgrounds/bg-img-1.jpg" alt="" />
            <img class="gradient" src="https://we.graphics/demo/avenir/images/backgrounds/gradient.png" alt="" />
        </div>
        <div>
            <img src="https://we.graphics/demo/avenir/images/backgrounds/bg-img-2.jpg" alt="" />
            <img class="gradient" src="https://we.graphics/demo/avenir/images/backgrounds/gradient.png" alt="" />
        </div>
        <div>
            <img src="https://we.graphics/demo/avenir/images/backgrounds/bg-img-3.jpg" alt="" />
            <img class="gradient" src="https://we.graphics/demo/avenir/images/backgrounds/gradient.png" alt="" />
        </div>
        <div>
            <img src="https://we.graphics/demo/avenir/images/backgrounds/bg-img-4.jpg" alt="" />
            <img class="gradient" src="https://we.graphics/demo/avenir/images/backgrounds/gradient.png" alt="" />
        </div>
        <div>
            <img src="https://we.graphics/demo/avenir/images/backgrounds/bg-img-5.jpg" alt="" />
            <img class="gradient" src="https://we.graphics/demo/avenir/images/backgrounds/gradient.png" alt="" />
        </div>
    </div>

    <script data-cfasync="false" src="https://we.graphics/demo/avenir//cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js'></script>
    <script src="https://we.graphics/demo/avenir/js/jquery.easing.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://we.graphics/demo/avenir/js/jquery.cycle.all.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://we.graphics/demo/avenir/js/jquery.maximage.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://we.graphics/demo/avenir/js/jquery.fullscreen.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://we.graphics/demo/avenir/js/jquery.ba-hashchange.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://we.graphics/demo/avenir/https://direct.wegraphics.net/demo/avenir/js/main.js" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript" charset="utf-8">
        $(function() {
            $('#maximage').maximage({
                cycleOptions: {
                    fx: 'fade',
                    speed: 1000, // Has to match the speed for CSS transitions in jQuery.maximage.css (lines 30 - 33)
                    timeout: 5000,
                    prev: '#arrow_left',
                    next: '#arrow_right',
                    pause: 0,
                    before: function(last, current) {
                        if (!$.browser.msie) {
                            // Start HTML5 video when you arrive
                            if ($(current).find('video').length > 0) $(current).find('video')[0].play();
                        }
                    },
                    after: function(last, current) {
                        if (!$.browser.msie) {
                            // Pauses HTML5 video when you leave it
                            if ($(last).find('video').length > 0) $(last).find('video')[0].pause();
                        }
                    }
                },
                onFirstImageLoaded: function() {
                    jQuery('#cycle-loader').hide();
                    jQuery('#maximage').fadeIn('fast');
                }
            });

            // Helper function to Fill and Center the HTML5 Video
            jQuery('video,object').maximage('maxcover');

        });
    </script>
</body>

</html>
