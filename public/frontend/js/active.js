(function($) {
    "use strict";
     $(document).on('ready', function() {

		/*====================================
			Header Sticky JS
		======================================*/
		var activeSticky = $("#active-sticky"),
			winDow = $(window);
			winDow.on("scroll", function () {
				var scroll = $(window).scrollTop(),
				isSticky = activeSticky;
				if (scroll < 50) {
				isSticky.removeClass("is-sticky");
				} else {
				isSticky.addClass("is-sticky");
			}
		});

		/*====================================
			Select2 JS
		======================================*/
		$('select').select2();
		 $('.inflanar-header__lang--list').select2({minimumResultsForSearch:Infinity});

		/*====================================
			CounterUp JS
		======================================*/
		$('.in-counter').counterUp({
			time: 1500,
		});


		/*====================================
			Aos Animate JS
		======================================*/
		AOS.init({
			duration:1500,
			disable:!1,
			offset:0,
			once:!0,
			easing:"ease"
		});


		/*====================================
			Scrool To Top JS
		======================================*/
		var lastScrollTop = '';
		var scrollToTopBtn = '.scrollToTop'

		function stickyMenu($targetMenu, $toggleClass) {
			var st = $(window).scrollTop();
			if ($(window).scrollTop() > 600) {
				if (st > lastScrollTop) {
				$targetMenu.removeClass($toggleClass);

				} else {
				$targetMenu.addClass($toggleClass);
				};
			} else {
				$targetMenu.removeClass($toggleClass);
			};
		 	lastScrollTop = st;
		};

		$(window).on("scroll", function () {
		  stickyMenu($('.sticky-header'), "active");
		  if ($(this).scrollTop() > 400) {
			$(scrollToTopBtn).addClass('show');
		  } else {
			$(scrollToTopBtn).removeClass('show');
		  }
		});

		$(scrollToTopBtn).on('click', function (e) {
		  e.preventDefault();
		  $('html, body').animate({
			scrollTop: 0
		  }, 500);
		  return false;
		});

		$('.inflanar-header__lang').on("click", function() {
			$('.select2-dropdown.select2-dropdown--below').addClass('active');
		});

		$('.inflanar-btn.inflanar-btn__search').on("click", function() {
			$('.inflanar-header__search').toggleClass('active');
		});


		$('.selection').on("click", function() {
			$('body').addClass('oy-hidden');
		});

		$(".wsus__message__button").click(function() {
            $(".wsus__message_area").addClass("show_chat");
        });

        $(".close_chat").click(function() {
            $(".wsus__message_area").removeClass("show_chat");
        });

	});


	/*====================================
		Mobile Menu
	======================================*/
	var $offcanvasNav = $("#offcanvas-menu a");
		$offcanvasNav.on("click", function () {
			var link = $(this);
			var closestUl = link.closest("ul");
			var activeLinks = closestUl.find(".active");
			var closestLi = link.closest("li");
			var linkStatus = closestLi.hasClass("active");
			var count = 0;

		closestUl.find("ul").slideUp(function () {
			if (++count == closestUl.find("ul").length)
			activeLinks.removeClass("active");
		});
		if (!linkStatus) {
			closestLi.children("ul").slideDown();
			closestLi.addClass("active");
		}
	});




	/*====================================
			Preloader JS
	======================================*/
	$(window).on('load', function (event) {
		$('#loading').delay(800).fadeOut(500);
	})



})(jQuery);

new ModalVideo('.js-video-btn');



// Function to switch to the next tab
function switchToNextTab() {
    var activeTab = document.querySelector('.list-group-item.active');
    var nextTab = activeTab.nextElementSibling;

    if (nextTab) {
        activeTab.classList.remove('active');
        document.querySelector(activeTab.getAttribute('href')).classList.remove('active', 'show');
        nextTab.classList.add('active');
        document.querySelector(nextTab.getAttribute('href')).classList.add('active', 'show');

        // Scroll to the top of the tab navigation container
        document.querySelector('.inflanar-bdetail__tabnav').scrollIntoView({ behavior: 'smooth' });
    }
}

// Function to switch to the previous tab
function switchToPreviousTab() {
    var activeTab = document.querySelector('.list-group-item.active');
    var previousTab = activeTab.previousElementSibling;

    if (previousTab) {
        activeTab.classList.remove('active');
        document.querySelector(activeTab.getAttribute('href')).classList.remove('active', 'show');
        previousTab.classList.add('active');
        document.querySelector(previousTab.getAttribute('href')).classList.add('active', 'show');

        // Scroll to the top of the tab navigation container
        document.querySelector('.inflanar-bdetail__tabnav').scrollIntoView({ behavior: 'smooth' });
    }
}


var nextBtn = document.getElementById('next_btn');
if (nextBtn) {
    // If it exists, add the event listener
    nextBtn.addEventListener('click', switchToNextTab);
}



var nextBtn = document.getElementById('step-prev-button');
if (nextBtn) {
    // If it exists, add the event listener
    nextBtn.addEventListener('click', switchToNextTab);
}





