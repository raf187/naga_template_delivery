<section id="menu" class="p-2 p-md-4 noir container-fluid">
    <div class="row pb-5" id="menuContent">
        <div id="menuForm" class="tab-content col-lg-9">
            <div id="menuBoll" class="scrollspy">
                <h2 class="text-center py-md-5 display-4 text-success font-weight-bold menuTitle">Notre Menu</h2>
                <div class="row row-cols-md-2 m-2">
                    @include('menu.boll')
                </div>
            </div>
            <div id="menuDrinks" class="scrollspy">
                <h3 class="text-center py-md-4 text-success font-weight-bold">Boissons</h3>
                <div class="row row-cols-md-3 m-2">
                    @include('menu.drink')
                </div>
            </div>

            <div  id="menuIcecream" class="scrollspy">
                <h3 class="text-center py-md-4 text-success font-weight-bold">Glaces</h3>
                <div class="row row-cols-md-3 m-2">
                    @include('menu.desert')
                </div>
            </div>
        </div>

        <div class="col-lg-3 scrollspy" id="menuCart">
            @include('menu.cart')
        </div>
    </div>
    @include('menu.barMobile')
</section>
