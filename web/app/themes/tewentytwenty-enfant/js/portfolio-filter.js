// assets/js/portfolio-filter.js
jQuery(document).ready(function($) {
    $('.category-tag').on('click', function() {
        var category = $(this).data('category');

        $('.category-tag').removeClass('active');
        $(this).addClass('active');

        if (category === 'all') {
            $('.portfolio-item').removeClass('hidden');
        } else {
            $('.portfolio-item').addClass('hidden');
            $('.portfolio-item.category-' + category).removeClass('hidden');
        }

        var activeTech = $('.tech-tag.active').data('tech');
        if (activeTech && activeTech !== 'all') {
            $('.portfolio-item').addClass('hidden');
            $('.portfolio-item.category-' + category + '.tech-' + activeTech).removeClass('hidden');
        }
    });

    $('.tech-tag').on('click', function() {
        var tech = $(this).data('tech');

        $('.tech-tag').removeClass('active');
        $(this).addClass('active');

        if (tech === 'all') {
            $('.portfolio-item').removeClass('hidden');
        } else {
            $('.portfolio-item').addClass('hidden');
            $('.portfolio-item.tech-' + tech).removeClass('hidden');
        }

        var activeCategory = $('.category-tag.active').data('category');
        if (activeCategory && activeCategory !== 'all') {
            $('.portfolio-item').addClass('hidden');
            $('.portfolio-item.category-' + activeCategory + '.tech-' + tech).removeClass('hidden');
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.section-menu a');
    const sections = document.querySelectorAll('section[id]');

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);
            window.scrollTo({
                top: targetSection.offsetTop - 60,
                behavior: 'smooth'
            });
        });
    });

    window.addEventListener('scroll', function() {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 60;
            if (window.scrollY >= sectionTop) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href').substring(1) === current) {
                link.classList.add('active');
            }
        });
    });
});