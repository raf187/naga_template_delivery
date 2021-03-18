@foreach($iceCream as $ice)
    <form class="addCartForm" method="get" action="{{ '/add-to-cart/'. $ice->id }}">
        @csrf
        <div class="card">
            <img src="{{ $ice->url_img }}" class="card-img" alt="Nâga Antibes menu">
            <div class="card-body border-bottom">
                <h5 class="card-title text-success font-weight-bold">{{ $ice->name }}</h5>
                <p class="card-text">{{ $ice->description }}</p>
            </div>
            <div class="mx-auto">
              @if($ice->off_stock == 1)
               <p class="card-text text-center text-danger py-3 text-bold">Indisponible pour le moment</p>
              @else
               @include('menu.btnAddToCart')
              @endif
            </div>
        </div>
    </form>
@endforeach
