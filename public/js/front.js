// mousehover efekt na user ikoni
$("#user-ikona").on("mouseover", function () {
     $(".prijava").css("display","inline-block");     
}); 
$(".ulaz").on("mouseleave", function () {
    $(".prijava").css("display","none");
}); 
$("#user-ikona").on("mouseleave", function () {
    $(".prijava").css("display","none");     
});



