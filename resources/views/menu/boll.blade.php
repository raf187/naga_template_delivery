 @foreach($bolls as $boll)
     <form class="addCartForm" method="get" action="{{ '/add-to-cart/'. $boll->id }}">
         @csrf

         <div class="card">
             <img src="{{ $boll->url_img }}" class="card-img" alt="Nâga Antibes menu">
             <div class="card-body">
                 <h5 class="card-title text-success font-weight-bold pb-1 mx-auto">{{ $boll->name }}</h5>
                 <p class="card-text">{{ $boll->description }}</p>
             </div>
             <div class="text-center font-weight-bold border-bottom">
                 <!--<div class="form-check form-check-inline">
                     <input class="form-check-input" type="checkbox" name="extras[]" value="">
                     <label class="form-check-label" for="checkChoux">Sans choux</label>
                 </div>
                 <div class="form-check form-check-inline">
                     <input class="form-check-input" type="checkbox" name="extras[]" value="">
                     <label class="form-check-label" for="checkSpicie1">Piquant 🌶</label>
                 </div>-->
                 <div class="form-check form-check-inline">
                     <input class="form-check-input" type="checkbox" name="extras[]" value="3">
                     <label class="form-check-label" for="checkSpicie2">Piquant 🌶🌶</label>
                 </div>
                 @if($boll->id <= 3)
                     <div class="form-check form-check-inline">
                         <input class="form-check-input" type="checkbox" name="extras[]" value="4">
                         <label class="form-check-label" for="checkRice">Supp. riz 2€</label>
                     </div>
                 @endif

                 @if($boll->id === 1 || $boll->id === 4)
                     <div class="form-check form-check-inline">
                         <input class="form-check-input" type="checkbox" name="extras[]" value="6">
                         <label class="form-check-label" for="checkBeef">Supp. beef 3€</label>
                     </div>
                 @endif

                 @if($boll->id === 2 || $boll->id === 5)
                     <div class="form-check form-check-inline">
                         <input class="form-check-input" type="checkbox" name="extras[]" value="5">
                         <label class="form-check-label" for="checkChicken">Supp. chicken 3€</label>
                     </div>
                 @endif
             </div>
             <div class="mx-auto">
               @if($boll->off_stock == 1)
                <p class="card-text text-center text-danger py-3 text-bold">Indisponible pour le moment</p>
               @else
                @include('menu.btnAddToCart')
               @endif
             </div>
         </div>
     </form>
 @endforeach
