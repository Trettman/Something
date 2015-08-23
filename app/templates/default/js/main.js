$(document).ready(function(){
   
    //Checks the initial position of the sticky header
    var stickyHeaderTop = $("#main_nav").offset().top;
    
    $(window).scroll(function(){
        if(window.innerWidth > 1080){ //The page becomes more mobiles friendly when the width is less than 1080px, so then we don't want to have a sticky header
            if($(window).scrollTop() > stickyHeaderTop){
                $("#main_nav").css({position: "fixed", top: "0px"});
                $("#main_nav").css("background-color", "white");
                $("#stickyalias").css("display", "block");
            } else{
                $("#main_nav").css({position: "static", top: "0px"});
                $("#main_nav").css("background-color", "#E1E3E4");
                $("#stickyalias").css("display", "none");
            }
        }
    });
    
    $("#show_mobile_menu").click(function(){
        if($("#menu").is(":hidden")){
            $("#menu").slideDown("slow");
        } else{
            $("#menu").slideUp("slow");
        }            
    });
    
    $("#add_input_button").click(function(){
        $("#input_field_container").append( "<div class='p'>" + 
                                                "<input type='text' class='type' name='type_of_liquor[]' placeholder='Type of liquor'>" +
                                                "<input type='number' class='amount' name='amount_of_type[]' placeholder='Amount'>" +
                                                "<br clear='all'>" +
                                            "</div>");
    });
});