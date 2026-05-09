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
                var newContent = response;

                // If server returned a full HTML page, extract the #main-content from it
                if (typeof response === 'string' && response.indexOf('<html') !== -1) {
                    try {
                        var parser = new DOMParser();
                        var doc = parser.parseFromString(response, 'text/html');
                        var extracted = doc.querySelector('#main-content');
                        if (extracted) {
                            newContent = extracted.innerHTML;
                        } else {
                            // fallback: try .main-content-inner
                            var alt = doc.querySelector('.main-content-inner');
                            if (alt) newContent = alt.innerHTML;
                        }

                        // Update document title if available
                        var newTitle = doc.querySelector('title');
                        if (newTitle) document.title = newTitle.textContent;
                    } catch (err) {
                        console.warn('Parser error extracting HTML fragment:', err);
                    }
                }

                // Update content
                $(mainContentSelector).html(newContent);

                // Update URL
                if (pushState) {
                    history.pushState({ url: url }, '', url);
                }

                // Update Sidebar Active State
                updateSidebarActive(url);

                // Scroll to top
                window.scrollTo(0, 0);

                // Re-initialize scripts if needed
                if (window.SRTdash && typeof window.SRTdash.initPlugins === 'function') {
                    window.SRTdash.initPlugins();
                }

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

    // Handle link clicks (only intercept simple internal clicks)
    $(document).on('click', ajaxLinkSelector, function(e) {
        // Allow modifier keys to open in new tab/window
        if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;

        const $a = $(this);
        const url = $a.attr('href');

        if (!url || url.indexOf('#') === 0) return; // ignore anchors

        // Skip if logout, external, download, or has explicit no-ajax
        if ($a.is('[download]') || $a.data('no-ajax')) return;
        if (url.indexOf('logout') !== -1) return;
        if (url.indexOf('http') === 0 && url.indexOf(window.BASE_URL) !== 0) return;

        // Only intercept same-origin or relative links
        if (url.indexOf('http') === 0 || url.indexOf('//') === 0) {
            // if starts with BASE_URL, allow
            if (url.indexOf(window.BASE_URL) !== 0) return;
        }

        e.preventDefault();
        // stop other jQuery handlers from also acting on this click
        e.stopImmediatePropagation();
        console.debug('ajax_nav: intercepting click', url);
        loadPage(url);
    });

    // Capturing listener to intercept navigation before other scripts (helps prevent full reloads)
    document.addEventListener('click', function(e) {
        try {
            if (e.defaultPrevented) return;
            if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;

            var el = e.target;
            while (el && el.nodeName !== 'A') el = el.parentElement;
            if (!el) return;

            var href = el.getAttribute('href');
            if (!href || href.indexOf('#') === 0) return;
            if (el.target === '_blank' || el.hasAttribute('download') || el.dataset.noAjax) return;
            if (href.indexOf('logout') !== -1) return;

            if (href.indexOf('http') === 0 && href.indexOf(window.BASE_URL) !== 0) return;

            // At this point, it's an internal link we want to load via AJAX
            e.preventDefault();
            e.stopImmediatePropagation();
            console.debug('ajax_nav (capture): loading', href);
            if (window.SRTdash && typeof window.SRTdash.loadPage === 'function') {
                window.SRTdash.loadPage(href);
            }
        } catch (err) {
            console.warn('ajax_nav capture handler error', err);
        }
    }, true);

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
        const actionUrl = $form.attr('action') || window.location.href;

        // Skip search form or external forms
        if ($form.closest('.search-box').length) return;
        if (actionUrl.indexOf('http') === 0 && actionUrl.indexOf(window.BASE_URL) !== 0) return;
        
        e.preventDefault();
        showLoader();

        const formData = new FormData(this);
        const method = $form.attr('method') || 'POST';

        $.ajax({
            url: actionUrl,
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
