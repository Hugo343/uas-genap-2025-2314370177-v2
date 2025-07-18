<h5>Ulasan Produk</h5>
@foreach($product->reviews as $review)
    <div class="border-bottom mb-2 pb-2">
        <strong>{{ $review->user->name }}</strong>
        <p class="mb-0">Rating: {{ $review->rating }}/5</p>
        <p>{{ $review->comment }}</p>
    </div>
@endforeach
