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

$(document).ready(function() {
    $(document).on('click', '#loading-btn',function() {
$(this).prop('disabled', true); // Disable the button
$('#loading-spinner').removeClass('hidden'); // Show the loading spinner or animation
$('#loading-spinner').addClass('inline');
$(this).closest('form').submit(); // Submit the form
// Simulate an AJAX request (replace this with your actual AJAX call)
setTimeout(function() {
    // After some delay, enable the button and hide the loading spinner
    $(this).prop('disabled', false);
    $('#loading-spinner').addClass('hidden');
}, 3000); // Simulate a 3-second delay
});
});