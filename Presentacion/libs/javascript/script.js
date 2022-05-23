// AÑO-----------------------------------
document.getElementById("anio").innerHTML = new Date().getFullYear();
document.getElementById("anio_footer").innerHTML = new Date().getFullYear();
// ----------AÑO-------------

// FILTRO PRODUCTOS
$('.categoria').click(function () {
    var catego = $(this).attr('category');

    $('.producto').css('transform', 'scale(0)');
    function ocultaProduct() {
        $('.producto').hide();
    } setTimeout(ocultaProduct, 400);

    function verProduct() {
        $('.producto[category="' + catego + '"]').show();
        $('.producto[category="' + catego + '"]').css('transform', 'scale(1)');
    } setTimeout(verProduct, 400);

    $('.categoria[category="All"]').click(function () {
        function showAll() {
            $('.producto').show();
            $('.producto').css('transform', 'scale(1)');
        } setTimeout(showAll, 400);
    });
});

// --------------------------------------------------

// --------------------------------------------------

$('.sizes').click(function () {
    var talla = $(this).attr('size');

    $('.producto').css('transform', 'scale(0)');
    function ocultaProduct() {
        $('.producto').hide();
    } setTimeout(ocultaProduct, 400);

    function verTalla() {
        $('.producto[dog_size="' + talla + '"]').show();
        $('.producto[dog_size="' + talla + '"]').css('transform', 'scale(1)');
    } setTimeout(verTalla, 400);
});
// ---------FILTRO PRODUCTOS-----------------------        

// SCROLL-----------------------------------
$(".scroll_up").click(function()
{
    jQuery('html,body').animate({scrollTop:0},2000);
})
// ------------------SCROLL-----------------