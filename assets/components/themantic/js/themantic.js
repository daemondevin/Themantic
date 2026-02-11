/**
 * Themantic - Custom JavaScript
 * 
 * @package themantic
 */

(function($) {
    'use strict';
    
    var Themantic = {
        
        /**
         * Initialize
         */
        init: function() {
            this.initializeMenus();
            this.initializeDropdowns();
            this.initializeModals();
            this.initializeAccordions();
            this.initializeTabs();
            this.initializeSmoothScroll();
            this.initializeLazyLoad();
        },
        
        /**
         * Initialize Semantic UI menus
         */
        initializeMenus: function() {
            $('.ui.menu .ui.dropdown').dropdown({
                on: 'hover'
            });
            
            // Mobile sidebar
            $('.ui.sidebar').sidebar({
                context: 'body'
            });
        },
        
        /**
         * Initialize dropdowns
         */
        initializeDropdowns: function() {
            $('.ui.dropdown').dropdown();
        },
        
        /**
         * Initialize modals
         */
        initializeModals: function() {
            $('.ui.modal').modal();
        },
        
        /**
         * Initialize accordions
         */
        initializeAccordions: function() {
            $('.ui.accordion').accordion();
        },
        
        /**
         * Initialize tabs
         */
        initializeTabs: function() {
            $('.ui.tabular.menu .item').tab();
        },
        
        /**
         * Smooth scroll to anchors
         */
        initializeSmoothScroll: function() {
            $('a[href*="#"]:not([href="#"])').click(function() {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
                    && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html, body').animate({
                            scrollTop: target.offset().top - 70
                        }, 1000);
                        return false;
                    }
                }
            });
        },
        
        /**
         * Lazy load images
         */
        initializeLazyLoad: function() {
            if ('loading' in HTMLImageElement.prototype) {
                const images = document.querySelectorAll('img[loading="lazy"]');
                images.forEach(img => {
                    img.src = img.dataset.src;
                });
            } else {
                // Fallback for browsers that don't support lazy loading
                const script = document.createElement('script');
                script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
                document.body.appendChild(script);
            }
        }
    };
    
    // Initialize on document ready
    $(document).ready(function() {
        Themantic.init();
    });
    
    // Make Themantic globally accessible
    window.Themantic = Themantic;
    
})(jQuery);
