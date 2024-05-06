window.prototype = this;
require('./bootstrap');
import 'flowbite';
import './dark-mood';

// Import SweetAlert
import Swal from 'sweetalert2';

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


function showFrontendAlert(type, message) {
    // Map 'danger' type to 'error' for consistency
    if (type === 'danger') {
        type = 'error';
    }

    Swal.fire({
        position: 'top-end',
        icon: type,
        title: message,
        toast: true,
        timerProgressBar: true,
        showConfirmButton: false,
timer: 3000,

    });
}

window.showFrontendAlert =showFrontendAlert;