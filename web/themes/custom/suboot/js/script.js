//JS for navbar top fix.

document.addEventListener("DOMContentLoaded", function(){
    window.addEventListener('scroll', function() {
    if (window.scrollY > 50) {
    document.getElementById('navbar_top').classList.add('fixed-top');
    // add padding top to show content behind navbar
    navbar_height = document.querySelector('.navbar').offsetHeight;
    document.body.style.paddingTop = navbar_height + 'px';
    } else {
    document.getElementById('navbar_top').classList.remove('fixed-top');
    // remove padding top from body
    document.body.style.paddingTop = '0';
    }
    });
    });

// JS for navigation active link.
    window.addEventListener('DOMContentLoaded', event => {
    const mainNav = document.body.querySelector('#navigation');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#navigation',
            offset: 72,
        });
    };

});



