<?php
/*
Template Name: Страница товара
*/

require_once get_template_directory() . '/inc/lib/get_cookies_favorites.php';
require_once get_template_directory() . '/inc/lib/get_image_url.php';
?>
<div class="main-second-product">
  <?php
  if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div class="main-second-product__breadcrumbs">
                        <section class="breadcrumbs">
                          <div class="breadcrumbs__container">
                           ', '
                           </div>
                        </section>
                      </div>');
  }
  ?>
  <div class="main-second-product__page">
    <section class="single-page">
      <div class="single-page__container">
        <div class="single-page-wrapper">
          <div class="single-page__info">
            <div class="single-page__title">
              <?php

              $product_agent_phone  = !empty(carbon_get_post_meta(get_the_ID(), 'product-agent-phone')) ?  carbon_get_post_meta(get_the_ID(), 'product-agent-phone') :  carbon_get_theme_option('crb_phone_link');
              $product_agent_photo  = carbon_get_post_meta(get_the_ID(), 'product-agent-photo');
              $product_apartamens_wc = carbon_get_post_meta(get_the_ID(), 'product-apartamens-wc');
              $product_area = carbon_get_post_meta(get_the_ID(), 'product-area');
              $product_building_type = carbon_get_post_meta(get_the_ID(), 'product-building-type');
              $product_city = carbon_get_post_meta(get_the_ID(), 'product-city');
              $product_contract = carbon_get_post_meta(get_the_ID(), 'product-contract');
              $product_developer = carbon_get_post_meta(get_the_ID(), 'product-developer');
              $product_description = carbon_get_post_meta(get_the_ID(), 'product-description');
              $product_facade = carbon_get_post_meta(get_the_ID(), 'product-facade');
              $product_finishing = carbon_get_post_meta(get_the_ID(), 'product-finishing');
              $product_floor = carbon_get_post_meta(get_the_ID(), 'product-stage');
              $product_floor_total = carbon_get_post_meta(get_the_ID(), 'product-stages');
              $product_gallery = carbon_get_post_meta(get_the_ID(), 'product-gallery');
              $product_height = carbon_get_post_meta(get_the_ID(), 'product_height');
              $product_kitchen_space = carbon_get_post_meta(get_the_ID(), 'product-area-kitchen');
              $product_label = carbon_get_post_meta(get_the_ID(), 'product-label');
              $product_latitude = carbon_get_post_meta(get_the_ID(), 'product-latitude');
              $product_lift = carbon_get_post_meta(get_the_ID(), 'product-lift');
              $product_mortgage = carbon_get_post_meta(get_the_ID(), 'product-mortgage');
              $product_price = carbon_get_post_meta(get_the_ID(), 'product-price');
              $product_price_meter = carbon_get_post_meta(get_the_ID(), 'product-price-meter');
              $product_price_mortgage = carbon_get_post_meta(get_the_ID(), 'product-price-mortgage');
              $product_payment = carbon_get_post_meta(get_the_ID(), 'product-payment');
              $product_renovation = carbon_get_post_meta(get_the_ID(), 'product-renovation');
              $product_street = carbon_get_post_meta(get_the_ID(), 'product-street');
              $product_title = carbon_get_post_meta(get_the_ID(), 'product-title');
              $product_update_date = get_the_modified_date('d-m-Y', get_the_ID());
              $product_year_build = carbon_get_post_meta(get_the_ID(), 'product-year-build');
              $product_longitude = carbon_get_post_meta(get_the_ID(), 'product-longitude');
              $product_link = esc_js(get_permalink(get_the_ID()));


              $agent_phone = preg_replace('/[^0-9]/', '', $product_agent_phone);
              $format_phone_agent = '+' . substr($agent_phone, 0, 1) . ' ' . substr($agent_phone, 1, 3) . ' ' . substr($agent_phone, 4, 3) . ' - ' . substr($agent_phone, 7, 2) . ' - ...';

              $product_price_format = number_format(round(floatval($product_price)), 0, '.', ' ');
              if ($product_price_meter) {
                $product_price_meter_format = number_format(round(floatval($product_price_meter)), 0, '.', ' ');
              }
              if ($product_price_mortgage) {
                $product_price_mortgage_format = number_format(round(floatval($product_price_mortgage)), 0, '.', ' ');
              }

              $post_ids_favorites = get_cookies_favorites();

              $is_favorite = in_array(get_the_ID(), $post_ids_favorites);

              $params_map = [
                'city' => $product_city,
                'coordinates' => [$product_latitude, $product_longitude],
                'coordinates_center' => [$product_latitude, $product_longitude],
              ];

              ?>
              <?php $referer = wp_get_referer() ?>
              <a class="button-back" href="<?php echo esc_url($referer) ?>" aria-label="Назад"></a>
              <h1 class=" title--xl title--catalog title--singe-page"><?php echo $product_title ?></h1>
            </div>
            <p class="single-page__subtitle"><?php echo $product_city . (!empty($product_sub_locality) ? ", " . $product_sub_locality : '') .  (!empty($product_street) ? ", " . $product_street : ''); ?>
              <a href="#single-map">Показать на карте</a>
            </p>
            <div class="product-wrapper">
              <div class="single-page__product product">
                <div class="product__image-wrapper">
                  <div class="product__image" data-type="popup-gallery">
                    <div class="product-image-wrapper">
                      <?php
                      if (!empty($product_gallery[0])) {
                        $image_url = wp_get_attachment_image_src($product_gallery[0], 'full');
                        echo ' <img class="product-image-wrapper__preview"  data-type="popup-gallery"  src="' . get_image_url($image_url) . '" alt="" data-post-id="' . get_the_ID() . '"  >';
                      } else {
                        echo ' <img class="product-image-wrapper__preview"  src="' . get_image_url('') . '" alt="" data-post-id="' . get_the_ID() . '"  >';
                      }
                      ?>
                    </div>
                  </div>
                  <div class="product-single-slider swiper">
                    <div class="product-single-slider__wrapper swiper-wrapper">
                      <?php
                      if (!empty($product_gallery)) {
                        foreach ($product_gallery as $image_id) {
                          $image_url = wp_get_attachment_image_src($image_id, 'full');
                          echo '<div class="product-single-slider__slide swiper-slide">
                          <img src="' . get_image_url($image_url) . '" alt="" data-type="popup-gallery">
                        </div>';
                        }
                      } else {
                        echo '<div class="product-single-slider__slide ">
                        <img src="' . get_image_url('') . '" alt="" >
                      </div>';
                      }
                      ?>
                    </div>
                  </div>
                  <div class="custom-scrollbar"></div>
                  <?php if (!empty($product_gallery[1])) { ?>
                    <div class="product__gallery">
                      <div data-type="popup-gallery">
                        <?php
                        if (!empty($product_gallery[1])) {
                          $image_url = wp_get_attachment_image_src($product_gallery[1], 'full');
                          echo ' <img src="' . get_image_url($image_url) . '" alt="" width="226" height="166" data-type="popup-gallery">';
                        }
                        ?>
                      </div>
                      <div data-type="popup-gallery">
                        <?php
                        if (!empty($product_gallery[2])) {
                          $image_url = wp_get_attachment_image_src($product_gallery[2], 'full');
                          echo ' <img src="' . get_image_url($image_url) . '" alt="" width="226" height="166" data-type="popup-gallery">';
                        }
                        ?>
                        <span data-type="popup-gallery"><?php echo count($product_gallery) ?></span>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <div class="product-single-slide-gallery swiper">
                  <div class="product-single-slide-gallery__wrapper swiper-wrapper">
                    <?php if (!empty($product_gallery)) {
                      foreach ($product_gallery as $image) {
                        $image_url = wp_get_attachment_image_src($image, 'full');

                    ?>
                        <div class="product-single-slide-gallery__slide swiper-slide">
                          <img src="<?php echo get_image_url($image_url) ?>" alt="" />
                        </div>
                      <? }
                    } else { ?>
                      <div class="product-single-slide-gallery__slide ">
                        <img src="<?php echo get_image_url('') ?>" alt="" />
                      </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="product__info">
                  <div class="second-product-info">
                    <div class="second-product-info__price">
                      <div>
                        <h2 class="title--xl">от <?php echo $product_price_format ?> ₽</h2>
                        <?php
                        if (!empty($product_price_meter_format)) {
                          echo ' <span>от ' . $product_price_meter_format . ' ₽/м²</span>';
                        }
                        ?>
                      </div>
                      <div class="second-product-info__label">Хорошая цена!</div>
                    </div>
                    <div class="second-product-info__list">
                      <?php
                      if (!empty($product_area)) {
                        echo '<div class="second-product-info__item">
                                <img src="' .  get_template_directory_uri() . '/assets/images/size.svg" alt="" width="48" height="48">
                                <div class="info">
                                  <span class="title">
                                    <span>Общая площадь</span>
                                    <span>общая пл.</span>
                                  </span>
                                  <span class="value">' . $product_area . ' м²</span>
                                </div>
                              </div>';
                      }
                      ?>
                      <?php
                      if (!empty($product_kitchen_space)) {
                        echo '<div class="second-product-info__item">
                                <img src="' .  get_template_directory_uri() . '/assets/images/kitchen.svg" alt="" width="48" height="48">
                                <div class="info">
                                  <span class="title">
                                    <span>Площадь кухни</span>
                                    <span>пл. кухни</span>
                                  </span>
                                  <span class="value">' . $product_kitchen_space . ' м²</span>
                                </div>
                              </div>';
                      }
                      ?>
                      <?php
                      if (!empty($product_floor)) {
                        echo '<div class="second-product-info__item">
                                <img src="' .  get_template_directory_uri() . '/assets/images/floor.svg" alt="" width="48" height="48">
                                <div class="info">
                                  <span class="title">
                                    <span>Этаж</span>
                                    <span>этаж</span>
                                  </span>
                                  <span class="value">' . $product_floor . ' из ' . $product_floor_total . '</span>
                                </div>
                              </div>';
                      }
                      ?>
                      <?php
                      if (!empty($product_year_build)) {
                        echo '<div class="second-product-info__item">
                                <img src="' .  get_template_directory_uri() . '/assets/images/key.svg" alt="" width="48" height="48">
                                <div class="info">
                                  <span class="title">
                                    <span>Год постройки</span>
                                    <span>год постройки</span>
                                  </span>
                                  <span class="value">' . $product_year_build . '</span>
                                </div>
                              </div>';
                      }
                      ?>
                      <?php
                      if (!empty($product_info_building)) {
                        echo '<div class="second-product-info__item">
                                <img src="' .  get_template_directory_uri() . '/assets/images/building.svg" alt="" width="48" height="48">
                                <div class="info">
                                  <span class="title">
                                    <span>Дом</span>
                                    <span>дом</span>
                                  </span>
                                  <span class="value">' . $product_info_building . '</span>
                                </div>
                              </div>';
                      }
                      ?>
                      <?php
                      if (!empty($product_renovation)) {
                        echo '<div class="second-product-info__item">
                                <img src="' .  get_template_directory_uri() . '/assets/images/renovation.svg" alt="" width="48" height="48">
                                <div class="info">
                                  <span class="title">
                                    <span>Отделка</span>
                                    <span>отделка</span>
                                  </span>
                                  <span class="value">' .  $product_renovation . '</span>
                                </div>
                              </div>';
                      }
                      ?>
                    </div>
                  </div>
                </div>
                <?php if (!empty($product_description)) { ?>
                  <div class="product__description">
                    <div class="second-product-description no-active" data-more-text><?php echo nl2br(esc_html($product_description)) ?>
                    </div>
                  </div>
                  <div class="product__button-more">
                    <button class="show-more" type="button" data-more><span>Узнать больше</span></button>
                  </div>
                <?php } ?>
                <div class="product__more">
                  <section class="more-list">
                    <div class="more-list__column more-column">
                      <label class="more-tabs__label">
                        <input class="more-tabs__input" type="radio" name="more-list" checked>
                        <span class="more-column__title title--lg">О квартире</span>
                      </label>
                      <div class="more-column__list">
                        <div class="more-column__row">
                          <span>Тип жилья</span><span>Новостройка</span>
                        </div>
                        <?php if (!empty($product_area)) { ?>
                          <div class="more-column__row">
                            <span>Общая площадь</span><span><?php echo $product_area ?></span>
                          </div>
                        <?php } ?>
                        <?php if (!empty($product_kitchen_space)) { ?>
                          <div class="more-column__row">
                            <span>Площадь кухни</span><span><?php echo $product_kitchen_space ?></span>
                          </div>
                        <?php } ?>
                        <?php if (!empty($product_height)) { ?>
                          <div class="more-column__row">
                            <span>Высота потолков</span><span><?php echo $product_height ?></span>
                          </div>
                        <?php } ?>
                        <?php if (!empty($product_finishing)) { ?>
                          <div class="more-column__row">
                            <span>Отделка</span><span><?php echo $product_finishing ?></span>
                          </div>
                        <?php } ?>
                        <?php if (!empty($product_apartamens_wc)) { ?>
                          <div class="more-column__row">
                            <span>Санузел</span><span><?php echo $product_apartamens_wc ?></span>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="more-list__column more-column">
                      <label class="more-tabs__label">
                        <input class="more-tabs__input" type="radio" name="more-list">
                        <span class="more-column__title title--lg">О доме</span>
                      </label>
                      <div class="more-column__list">
                        <?php
                        if (!empty($product_developer)) {
                          echo ' <div class="more-column__row">
                                  <span>Застройщик</span><span>' . $product_developer . '</span>
                                </div>';
                        }
                        if (!empty($product_building_type)) {
                          echo ' <div class="more-column__row">
                                  <span>Тип дома</span><span>' . $product_building_type . '</span>
                                </div>';
                        }
                        if (!empty($product_facade)) {
                          echo ' <div class="more-column__row">
                                  <span>Фасад</span><span>' . $product_facade . '</span>
                                </div>';
                        }
                        if (!empty($product_finishing)) {
                          echo ' <div class="more-column__row">
                                  <span>Отделка</span><span>' . $product_finishing . '</span>
                                </div>';
                        }
                        if (!empty($product_parking_type)) {
                          echo ' <div class="more-column__row">
                                  <span>Паркинг</span><span>' . $product_parking_type . '</span>
                                </div>';
                        }
                        if (!empty($product_payment)) {
                          echo ' <div class="more-column__row">
                                  <span>Оплата</span><span>' . $product_payment . '</span>
                                </div>';
                        }
                        if (!empty($product_contract)) {
                          echo ' <div class="more-column__row">
                                  <span>Договор</span><span>' . $product_contract . '</span>
                                </div>';
                        }
                        ?>
                      </div>
                    </div>
                  </section>
                </div>
                <?php get_template_part('template-page/blocks/yandex_map', null, $params_map) ?>
              </div>
              <div class="single-page__order">
                <article class="agent-order" data-agent-order>
                  <p class="agent-order__date">Информация обновлена <?php echo $product_update_date ?></p>
                  <h2 class="agent-order__price title--xl title--product-agent"><?php echo $product_price_format ?> ₽</h2>
                  <div class="agent-order__label"><?php echo $product_label ?></div>
                  <?php
                  if (!empty($product_mortgage)) {
                    echo '<div class="agent-order__ipoteca">В ипотеку от <span>' . $product_price_mortgage_format . '</span> ₽/мес</div>';
                  }
                  if (!empty($product_price_meter_format)) {
                    echo '<div class="agent-order__price-one-metr agent-price-one-mert">
                          <span class="agent-price-one-mert__title">Цена за метр</span>
                          <span class="agent-price-one-mert__space"></span>
                          <span class="agent-price-one-mert__price">' . $product_price_meter_format . ' ₽/м²</span>
                        </div>';
                  }
                  if (!empty($product_deal_type)) {
                    echo '<div class="agent-order__conditions agent-conditions">
                            <span class="agent-conditions__title">Условия сделки</span>
                            <span class="agent-conditions__space"></span>
                            <span class="agent-conditions__price">' . $product_deal_type . '</span>
                          </div>';
                  }
                  ?>
                  <div class="button-wrapper">
                    <div class="agent-order__button">
                      <a onclick="showFullNumber(event)" class="button button--phone-order" href="tel:<?php echo $product_agent_phone ?>"><span><?php echo $format_phone_agent ?></span></a>
                      <button class="button--favorites-mobile <?php echo ($is_favorite ? 'delete' : '') ?>" type="button" data-favorite-cookies="<?php echo get_the_ID() ?>" data-button-favorite-mobile data-delete-favorite="<?php echo $is_favorite ?>"><span></span></button>
                    </div>
                    <div class="agent-order__callback" onclick="setLink(event, '<?php echo $product_link ?>')">
                      <button class="button button--callback" type="button" data-type="popup-form-callback"><span data-type="popup-form-callback">Перезвоните мне</span></button>
                    </div>
                    <div class="agent-order__favorites">
                      <button class="button button--favorites" type="button" data-favorite-cookies="<?php echo get_the_ID() ?>" data-button-favorite data-delete-favorite="<?php echo $is_favorite ?>">
                        <span><?php if ($is_favorite) {
                                echo "удалить";
                              } else {
                                echo "В избранное";
                              } ?> </span>
                      </button>
                    </div>
                  </div>
                  <script>
                    function setLink(event, link) {

                      if (event.target.innerText === "Перезвоните мне") {
                        const formSeven = document.querySelector('[data-form-callback]');

                        if (formSeven) {
                          const input = formSeven.querySelector(`input[name=your-link]`);
                          input.value = `${link}`;
                        }
                      }
                    }
                  </script>
                </article>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  </section>
</div>
</div>
<div class="single-page__questions">
  <?php get_template_part('template-page/components/questions'); ?>
</div>
<div class="popup-gallery">
  <?php get_template_part('template-page/popup/popup-gallery'); ?>
</div>