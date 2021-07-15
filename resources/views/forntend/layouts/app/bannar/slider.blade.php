<div class="home-banner-area mb-4 pt-3">
    <div class="container">
        <div class="row gutters-10 position-relative">

            @include('forntend.layouts.app.bannar.category_menu')

            <div class=" col-lg-7 ">
                <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height" data-arrows="true"
                    data-dots="true" data-autoplay="true" data-infinite="true">
                    <div class="carousel-box">
                        <a href="https://codecanyon.net/item/active-ecommerce-cms/23471405?s_rank=14">
                            <img class="d-block mw-100 img-fit rounded shadow-sm"
                                src="forntend/uploads/all/qQR6fBE9MAjTWuIzGkZeI2wTDYAlIeBKQaezchPM.jpg"
                                alt="Active eCommerce CMS promo" height="315"
                                onerror="this.onerror=null;this.src='forntend/assets/img/placeholder-rect.jpg';">
                        </a>
                    </div>
                    <div class="carousel-box">
                        <a href="https://codecanyon.net/item/active-ecommerce-cms/23471405?s_rank=14">
                            <img class="d-block mw-100 img-fit rounded shadow-sm"
                                src="forntend/uploads/all/jJjPcgUsldYlpgdxpKBKmR6gIwtXIcuYtxeloijR.jpg"
                                alt="Active eCommerce CMS promo" height="315"
                                onerror="this.onerror=null;this.src='forntend/assets/img/placeholder-rect.jpg';">
                        </a>
                    </div>
                    <div class="carousel-box">
                        <a href="https://codecanyon.net/item/active-ecommerce-cms/23471405?s_rank=14">
                            <img class="d-block mw-100 img-fit rounded shadow-sm"
                                src="forntend/uploads/all/yclPDRGHySYidlrU06gics221CHFuYmZA2QvjIC2.jpg"
                                alt="Active eCommerce CMS promo" height="315"
                                onerror="this.onerror=null;this.src='forntend/assets/img/placeholder-rect.jpg';">
                        </a>
                    </div>
                    <div class="carousel-box">
                        <a href="https://codecanyon.net/item/active-ecommerce-cms/23471405?s_rank=14">
                            <img class="d-block mw-100 img-fit rounded shadow-sm"
                                src="forntend/uploads/all/TGCHVRY64CxOCh1C33Pn7mdYfYM7OW6X8JdOaN7d.jpg"
                                alt="Active eCommerce CMS promo" height="315"
                                onerror="this.onerror=null;this.src='forntend/assets/img/placeholder-rect.jpg';">
                        </a>
                    </div>
                </div>
               @includeIf('forntend.layouts.app.bannar.category_bottom')
            </div>

            @include('forntend.layouts.app.bannar.todays_deal')


        </div>
    </div>
</div>
