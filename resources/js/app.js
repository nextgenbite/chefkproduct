require('./bootstrap');

import 'jquery-lazy'
import 'flowbite';
import './dark-mood';
// import './dataTables.tailwindcss';
import Alpine from 'alpinejs';
window.Alpine = Alpine;

Alpine.start();
$(function() {
    $('.lazy').lazy({
        threshold : 200,
    placeholder : "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"
        // beforeLoad: function(element) {
        //     var imageSrc = element.data('src');
        //     console.log('image "' + imageSrc + '" is about to be loaded');
        // },
        // scrollDirection: 'vertical',
        // effect: "fadeIn",
        // effectTime: 1000,
        // threshold: 0
    });
})