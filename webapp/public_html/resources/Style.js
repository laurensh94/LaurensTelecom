$(document).ready(function(){
    
    
    // menu
    $("#navbar ul li a").focus(function(){
        $(this).animate({
            paddingTop : "11px",
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

        if(path === ""){
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