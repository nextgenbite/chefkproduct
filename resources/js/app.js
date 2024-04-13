require('./bootstrap');

// import 'jquery-lazy'
import 'flowbite';
import './dark-mood';
// import './dataTables.tailwindcss';
import Alpine from 'alpinejs';
window.Alpine = Alpine;

Alpine.start();
// $(function() {
//     $('.lazy').lazy({
//         threshold : 200,
//     placeholder : "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC",
//         // beforeLoad: function(element) {
//         //     var imageSrc = element.data('src');
//         //     console.log('image "' + imageSrc + '" is about to be loaded');
//         // },
//         scrollDirection: 'vertical',
//         effect: "fadeIn",
//         effectTime: 1000,
//         threshold: 0
//     });
// })

function lazyLoadImages() {
    $('img[data-src]').each(function() {
        var $img = $(this);
        // Load image when it's about to enter the viewport
        if ($img.offset().top < $(window).scrollTop() + $(window).height() + 200) {
            $img.attr('src', $img.attr('data-src'));
            $img.removeAttr('data-src');
        }
    });
}
// Lazy load images on initial page load
lazyLoadImages();
// Lazy load images on scroll
$(window).scroll(function() {
    lazyLoadImages();
});

// <!--Start of Tawk.to Script-->
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6616a9c81ec1082f04e0de92/1hr48eec7';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
// <!--End of Tawk.to Script-->