$(document).ready(function () {

    // login label
    $("#LoginLabel").hover(function () {
        $(this).stop().animate({
            top: "157px"
        }, 300);
        $("#Login").stop().animate({
            top: "-2px"
        }, 270);
    }, function () {
        $(this).stop().animate({
            top: "0"
        }, 300);
        $("#Login").stop().animate({
            top: "-161px"
        }, 300);
    });

    $("#LoginLabel").click(function () {
        if ($(this).css("top") < 125) {
            $(this).stop().animate({
                top: "157px"
            }, 300);
            $("#Login").stop().animate({
                top: "-2px"
            }, 300);
        } else {
            $(this).stop().animate({
                top: "0"
            }, 300);
            $("#Login").stop().animate({
                top: "-161px"
            }, 300);
        }
    });

    // login form
    $("#Login").hover(function () {
        $("#LoginLabel").stop().animate({
            top: "157px"
        }, 300);
        $(this).stop().animate({
            top: "-2px"
        }, 300);
    }, function () {
        $("#LoginLabel").stop().animate({
            top: "0"
        }, 300);
        $(this).stop().animate({
            top: "-161px"
        }, 300);
    });

    $(window).scroll(function () {
        $("#Login").stop().animate({
            top: "-161px"
        }, 300);

        $("#User").stop().animate({
            top: "-161px"
        }, 300);
    });

    // User label
    $("#UserLabel").hover(function () {
        $(this).stop().animate({
            top: "157px"
        }, 300);
        $("#User").stop().animate({
            top: "-2px"
        }, 300);
    }, function () {
        $(this).stop().animate({
            top: "0"
        }, 300);
        $("#User").stop().animate({
            top: "-161px"
        }, 300);
    });

    $("#UserLabel").click(function () {
        if ($(this).css("top") < 125) {
            $(this).stop().animate({
                top: "157px"
            }, 300);
            $("#User").stop().animate({
                top: "-2px"
            }, 300);
        } else {
            $(this).stop().animate({
                top: "0"
            }, 300);
            $("#User").stop().animate({
                top: "-161px"
            }, 300);
        }
    });


    // menu
    $("#navbar ul li a").focus(function () {
        $(this).animate({
            paddingTop: "11px",
            paddingBottom: "9px",
            paddingRight: "9px",
            paddingLeft: "11px"
        }, 100);
    });

    // menu active
    setNavigation();

    function setNavigation() {
        var path = window.location.pathname;
        path = path.replace(/\/$/, "");
        path = decodeURIComponent(path);
        path = path.substring(1);

        if (path === "") {
            path = 'index.php';
        }

        $('li a').each(function () {
            //alert(path);
            var href = $(this).attr('href');
            if (path === href) {
                $(this).closest('li').addClass('active');
            }
        });
    }

});