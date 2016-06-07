<div id="list-products" class="carousel slide" data-ride="carousel">
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        @foreach($products as $chunk => $chunk_product)
        <div class="item @if($chunk == 0) active @endif">
            @foreach($chunk_product as $product)
            <div class="col-md-3">
                <div class="thumb">
                    <item-product inline-template product="{{{ json_encode($product) }}}">
                        <div class="image">
                            <img height="200" :src="product.thumb" :alt="product.name">
                        </div>

                        <div class="caption">
                            <a href="javascript:;" v-text="product.name"></a>
                            <p>Won <span v-text="product.price | currency"></span> <small>playing</small></p>
                            <a href="#" class="add2cart" @click.prevent="addToCart">add to cart</a>
                        </div>
                    </item-product>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>

    <!-- Left and right controls -->
    <a class="right carousel-control" href="#list-products" data-slide="next">
        <span class="fa fa-arrow-circle-right"></span>
        <span class="sr-only">Next</span>
    </a>
    <a class="left carousel-control" href="#list-products" data-slide="prev">
        <span class="fa fa-arrow-circle-left "></span>
        <span class="sr-only">Previous</span>
    </a>
</div>
