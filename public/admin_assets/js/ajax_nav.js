/**
 * ShoeSeller Admin - AJAX Navigation & Form Submission
 * Enables SPA-like experience for the admin dashboard
 */

$(document).ready(function() {
    const mainContentSelector = '#main-content';
    
    // Select all links that are internal and should be loaded via AJAX
    // Exclude: target="_blank", javascript links, hashes, links with onclick, and external links
    const ajaxLinkSelector = 'a:not([target="_blank"]):not([href^="javascript"]):not([href="#"]):not([onclick])';
    
    // Add loading overlay
    $('body').append('<div id="ajax-loader" style="display:none; position:fixed; top:0; left:0; width:100%; height:3px; background:rgba(212, 175, 55, 0.2); z-index:9999;"><div class="bar" style="width:0; height:100%; background:#d4af37; transition: width 0.3s ease;"></div></div>');

    function showLoader() {
        $('#ajax-loader').show().find('.bar').css('width', '30%');
    }

    function finishLoader() {
        $('#ajax-loader').find('.bar').css('width', '100%');
        setTimeout(() => {
            $('#ajax-loader').fadeOut().find('.bar').css('width', '0');
        }, 300);
    }

    // Function to load content via AJAX
    window.SRTdash = window.SRTdash || {};
    window.SRTdash.loadPage = loadPage;

    function loadPage(url, pushState = true) {
        showLoader();
        
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                // Update content
                $(mainContentSelector).html(response);
                
                // Update URL
                if (pushState) {
                    history.pushState({ url: url }, '', url);
                }
                
                // Update Sidebar Active State
                updateSidebarActive(url);
                
                // Scroll to top
                window.scrollTo(0, 0);
                
                // Re-initialize scripts if needed
                // Since most scripts are in scripts.js and use delegated events or init functions,
                // we might need to re-call some of them.
                if (window.SRTdash && typeof window.SRTdash.initPlugins === 'function') {
                    window.SRTdash.initPlugins();
                }

                // If the page contains charts, they might need re-init
                // This depends on how the chart scripts are structured
                
                finishLoader();
            },
            error: function(xhr, status, error) {
                finishLoader();
                console.error('AJAX Load Error:', error);
                if (window.SRTdash && window.SRTdash.toast) {
                    window.SRTdash.toast('Không thể tải trang. Vui lòng thử lại.', 'danger');
                } else {
                    alert('Không thể tải trang. Vui lòng thử lại.');
                }
            }
        });
    }

    // Handle link clicks
    $(document).on('click', ajaxLinkSelector, function(e) {
        const url = $(this).attr('href');
        
        // Skip if logout, external, or special
        if (url.indexOf('logout') !== -1) return;
        if (url.indexOf('http') === 0 && url.indexOf(window.BASE_URL) !== 0) return;
        
        e.preventDefault();
        loadPage(url);
    });

    // Handle browser back/forward
    window.onpopstate = function(event) {
        if (event.state && event.state.url) {
            loadPage(event.state.url, false);
        } else {
            loadPage(window.location.href, false);
        }
    };

    // Update sidebar active class
    function updateSidebarActive(url) {
        $('.sidebar-menu li').removeClass('active');
        $('.sidebar-menu a').each(function() {
            if (this.href === url || url.indexOf(this.href) === 0) {
                $(this).closest('li').addClass('active');
                // Also handle metismenu expansion
                $(this).parents('ul').addClass('in');
                $(this).parents('li').addClass('active');
            }
        });
    }

    // Handle form submissions via AJAX
    $(document).on('submit', 'form:not([target])', function(e) {
        const $form = $(this);
        const url = $form.attr('action') || window.location.href;

        // Skip search form or external forms
        if ($form.closest('.search-box').length) return;
        if (url.indexOf('http') === 0 && url.indexOf(window.BASE_URL) !== 0) return;
        
        e.preventDefault();
        showLoader();

        const formData = new FormData(this);
        const url = $form.attr('action') || window.location.href;
        const method = $form.attr('method') || 'POST';

        $.ajax({
            url: url,
            type: method,
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                // If the response is HTML, it's likely the same page with success/error messages
                $(mainContentSelector).html(response);
                finishLoader();
                window.scrollTo(0, 0);
                
                // Show toast if success message exists in response
                if (response.indexOf('alert-success') !== -1 && window.SRTdash && window.SRTdash.toast) {
                    window.SRTdash.toast('Cập nhật thành công!', 'success');
                }
            },
            error: function(xhr, status, error) {
                finishLoader();
                console.error('AJAX Submit Error:', error);
                if (window.SRTdash && window.SRTdash.toast) {
                    window.SRTdash.toast('Có lỗi xảy ra khi lưu dữ liệu.', 'danger');
                }
            }
        });
    });
});
