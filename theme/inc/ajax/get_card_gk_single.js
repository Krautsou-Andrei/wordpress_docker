jQuery(document).ready(function ($) {
  const SELECTORS = {
    CONTAINER_CARD_AGENT: "[data-container-card-agent-info]",
    CONTAINER_TABLE: "[data-container-table]",
    FILTER_SLIDER: "[data-filter-slider-area]",
    INPUT_TABLE_PARAMS: "[data-input-table-params]",
    LOADER: "[data-loader]",
  };

  const loader = $(SELECTORS.LOADER);
  const content = $(SELECTORS.CONTAINER_TABLE);
  const contentAgentInfo = $(SELECTORS.CONTAINER_CARD_AGENT);
  const inputTableParams = $(SELECTORS.INPUT_TABLE_PARAMS);

  function unblockScroll() {
    $("body").css({
      overflow: "",
      height: "",
    });
  }

  $.ajax({
    url: ajax_object.ajaxurl,
    type: "POST",
    data: {
      action: "get_card_gk_single",
      id_page_gk: params.id_page_gk,
      slug_page: params.slug_page,
    },
    success: function (response) {
      if (response.paramsTable) {
        inputTableParams.val(response.paramsTable);
      }

      if (response.agentInfo) {
        contentAgentInfo.html(response.agentInfo);
      }
      if (response.pageGk) {
        content.html(response.pageGk);
        if (document.querySelector(SELECTORS.FILTER_SLIDER)) {
          const filterSlider = new GlobalFilterSlider(
            document.querySelector(SELECTORS.FILTER_SLIDER)
          );
          GlobalSetSliderByFilter();
        }
      } else {
        content.html("Ничего не найдено");
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
    complete: function () {
      loader.hide();
      unblockScroll();
      updateMainScript();
      initializeFormFilter();
      new NewTooltip();
    },
  });

  function updateMainScript() {
    const SELECTORS = {
      RETURN_FIRST_SLIDE: "[data-return-first-slide]",
    };

    const sliderSinglePagePreviewMobile = new Swiper(".product-single-slider", {
      preloadImages: false,
      slidesPerView: "auto",
      observer: true,
      observerParents: true,
      observerSlideChildren: true,
      spaceBetween: 7,
      scrollbar: {
        el: ".custom-scrollbar",
      },
      thumbs: {
        swiper: {
          el: ".product-single-slide-gallery",
          slidesPerView: "auto",
          observer: true,
          observerParents: true,
          observerSlideChildren: true,
          spaceBetween: 10,
        },
      },
      lazy: {
        loadOnTransitionStart: true,
        loadPrevNext: true,
      },
      watchSlidesProgress: true,
      watchSlidesVisibility: true,
    });

    function returnFirstSlide() {
      const returnButton = document.querySelector(SELECTORS.RETURN_FIRST_SLIDE);
      if (returnButton) {
        returnButton.addEventListener("click", () => {
          sliderSinglePagePreviewMobile.slideTo(0);
        });
      }
    }
  }
});
