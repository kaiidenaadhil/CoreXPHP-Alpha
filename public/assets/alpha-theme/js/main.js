$(document).ready(function() {
  const toggle = document.querySelector('.toggle');
  const menu = document.querySelector('.menu');

  if (toggle && menu) {
    toggle.addEventListener('click', function() {
      toggle.classList.toggle('active');

      if (menu.style.display === 'flex') {
        menu.style.display = 'none';
      } else {
        menu.style.display = 'flex';
      }
    });
  }

  $(window).scroll(function() {
    if ($(this).scrollTop() >= 400) {
      $('.footer-menu').addClass('fixed');
    } else {
      $('.footer-menu').removeClass('fixed');
    }
  });

  $('.searching').click(function() {
    $('.search-container').toggleClass('visible', function() {
      if ($(this).hasClass('visible')) {
        $(this).find('.search-form input').focus();
      }
    });
  });

  var lastScrollPosition = $(window).scrollTop();

  $(window).scroll(function() {
    var currentScrollPosition = $(this).scrollTop();

    if (currentScrollPosition > lastScrollPosition) {
      $('nav ul').addClass('hidden');
      $('.header').addClass('hidden');
    } else {
      $('nav ul').removeClass('hidden');
      $('.header').removeClass('hidden');
    }

    lastScrollPosition = currentScrollPosition;
  });

  $(".carousel-container").each(function() {
    var container = $(this);
    var carousel = container.find(".carousel");
    var slides = carousel.find(".carousel-slide");
    var dots = container.find(".dot");
    var currentIndex = 0;

    showSlide(currentIndex);

    function showSlide(index) {
      slides.hide();
      dots.removeClass("active");

      $(slides[index]).show();
      $(dots[index]).addClass("active");
    }

    dots.click(function() {
      var dotIndex = $(this).index();
      currentIndex = dotIndex;
      showSlide(currentIndex);
    });
  });


 // share text for post 
 $(document).on("click", ".show-more", function() {
  var post = $(this).closest('.sharedText');
  var description = post.find('.description');
  var fullText = description.data('fulltext');
  description.html(fullText); // Use .html() to display HTML content
  $(this).hide();
  post.find('.show-less').show();
});

$(document).on("click", ".show-less", function() {
  var post = $(this).closest('.sharedText');
  var description = post.find('.description');
  var fullText = description.data('fulltext');
  var truncatedText = fullText.substr(0, 120);
  description.html(truncatedText); // Use .html() to display HTML content
  $(this).hide();
  post.find('.show-more').show();
});


  // $(document).on("click", ".edit", function(e) {
  //   e.preventDefault();
  //   var menuId = $(this).attr('name');
  //   $('.hidden-menu').not('#' + menuId).css('display', 'none');
  //   $('#' + menuId).css('display', 'block');

  // });

  $(document).ready(function() {
    $(document).on("click", ".edit", function(e) {
      e.preventDefault();
      var menuId = $(this).data('target');
      $('.hidden-menu.' + menuId).toggle();
    });
  });
  


  $(document).click(function(event) {
    if (!$(event.target).closest('.hidden-menu').length && !$(event.target).closest('.edit').length) {
      $('.hidden-menu').css('display', 'none');
    }
  });


});



  // Model function to open or close the modal or Close by clicking outside the modal
$(document).ready(function() {
  $('#closeModal').on('click', function() {
    closeModal();
  });
  $(document).on('click', function(event) {
    const $modalOverlay = $('#modalOverlay');
    if ($(event.target).is($modalOverlay)) {
      closeModal();
    }
  });

  //Example how to open model : 
  $('.delete-btn').on('click', function() {
    openModal();
    const $modalContent = $('#modalContent');
    const formTaskContent = `
      <div>Delete Prompt</div>
      Add your thought to this repost </br>
      <button class="share-button" data-action="share">Share</button>
      <button class="repost-button" data-action="repost">Repost</button>
    `;
    $modalContent.html(formTaskContent);
  });
});
function openModal() {
  const $modalOverlay = $('#modalOverlay');
  $modalOverlay.css('opacity', 1);
  $modalOverlay.css('pointer-events', 'auto');
}
// Function to close the modal
function closeModal() {
  const $modalOverlay = $('#modalOverlay');
  $modalOverlay.css('opacity', 0);
  $modalOverlay.css('pointer-events', 'none');
}


const toggleButton = document.querySelector("#theme-toggle");
const sunIcon = toggleButton.querySelector(".uil-sun");
const moonIcon = toggleButton.querySelector(".uil-moon");

function setCookie(name, value, days) {
  const expires = new Date();
  expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
  document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/`;
}

function getCookie(name) {
  const cookieName = `${name}=`;
  const decodedCookie = decodeURIComponent(document.cookie);
  const cookieArray = decodedCookie.split(';');
  for (let i = 0; i < cookieArray.length; i++) {
    let cookie = cookieArray[i];
    while (cookie.charAt(0) === ' ') {
      cookie = cookie.substring(1);
    }
    if (cookie.indexOf(cookieName) === 0) {
      return cookie.substring(cookieName.length, cookie.length);
    }
  }
  return null;
}

function toggleTheme() {
  const currentColorScheme = document.documentElement.getAttribute("color-scheme");
  const newColorScheme = currentColorScheme === "dark" ? "light" : "dark";
  document.documentElement.setAttribute("color-scheme", newColorScheme);
  setCookie("preferredTheme", newColorScheme, 14);

  // Toggle sun and moon icons
  if (newColorScheme === "dark") {
    sunIcon.style.display = "none";
    moonIcon.style.display = "inline";
  } else {
    sunIcon.style.display = "inline";
    moonIcon.style.display = "none";
  }
}

toggleButton.addEventListener("click", toggleTheme);

document.addEventListener("DOMContentLoaded", () => {
  const preferredTheme = getCookie("preferredTheme");
  if (preferredTheme) {
    document.documentElement.setAttribute("color-scheme", preferredTheme);
    if (preferredTheme === "dark") {
      sunIcon.style.display = "none";
      moonIcon.style.display = "inline";
    } else {
      sunIcon.style.display = "inline";
      moonIcon.style.display = "none";
    }
  }
});


// Model for pic

$(document).ready(function () {
  var carouselPhotoImgClass = ".carousel-photo img";
  var singleImageClass = ".single-image";
  var currentGallery;
  var currentIndex;

  $(document).on("click", carouselPhotoImgClass, function() {
      currentGallery = $(this).closest('.carousel-photo-container');
      currentIndex = $(this).index();
      updateModal(currentGallery, currentIndex);
      updateButtonsState();
      $("#imageModal").show();
  });

  $(document).on("click", singleImageClass, function() {
      var imageUrl = $(this).attr('src');
      $("#modalImage").attr("src", imageUrl);
      $("#imageNumber").text("1 of 1");
      $("#prevBtn, #nextBtn").hide(); // Hide navigation for single images
      $("#imageModal").show();
  });

  $(document).on("click", "#closePicModal", function() {
      $("#modalImage").attr("src", ""); // Empty the modal image
      $("#imageModal").hide();
  });

  $(document).on("click", "#nextBtn", function() {
      currentIndex = (currentIndex + 1) % currentGallery.find(carouselPhotoImgClass).length;
      updateModal(currentGallery, currentIndex);
      updateButtonsState();
  });

  $(document).on("click", "#prevBtn", function() {
      currentIndex = (currentIndex - 1 + currentGallery.find(carouselPhotoImgClass).length) % currentGallery.find(carouselPhotoImgClass).length;
      updateModal(currentGallery, currentIndex);
      updateButtonsState();
  });

  function updateModal(gallery, index) {
      var currentImage = gallery.find(carouselPhotoImgClass).eq(index);

      $("#modalImage").attr("src", currentImage.attr("src"));
      $("#imageNumber").text(`${index + 1} of ${gallery.find(carouselPhotoImgClass).length}`);
  }

  function updateButtonsState() {
      var totalImages = currentGallery.find(carouselPhotoImgClass).length;

      if (currentIndex === 0) {
          $("#prevBtn").prop("disabled", true).addClass("disabled");
      } else {
          $("#prevBtn").prop("disabled", false).removeClass("disabled");
      }

      if (currentIndex === totalImages - 1) {
          $("#nextBtn").prop("disabled", true).addClass("disabled");
      } else {
          $("#nextBtn").prop("disabled", false).removeClass("disabled");
      }

      if (totalImages <= 1) {
          $("#prevBtn, #nextBtn").hide();
      } else {
          $("#prevBtn, #nextBtn").show();
      }
  }
});




