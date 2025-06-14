<div class="search">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="p-2">
                    <div class="search_input flex items-center {{ App::getLocale() === 'ar' ? 'pe-3' : 'ps-3' }}">
                        <input type="text" placeholder="{{ __('website/home.search') }}" wire:model.live.debounce.500ms='searchParam'
                            class="flex-grow" />
                        <!-- Limit Selection -->
                        <label for="limit" class="ml-2">{{ __('website/home.limit') }}: </label>
                        <input type="number" wire:model.blur='limit' class="w-16 ml-1" min="{{ $limit }}">
                        <button class="search_btn ml-2">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-3">
            @if($books->isNotEmpty())
            <div class="list-group" style="max-height: 300px; overflow-y: auto;">
                @foreach($books as $book)
                <a href="{{ route('front.books.show',$book['slug']) }}" class="list-group-item list-group-item-action">
                    {{ $book['text'] }}
                </a>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>