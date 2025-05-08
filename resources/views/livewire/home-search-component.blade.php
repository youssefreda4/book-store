<div class="search">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="p-2">
                    <div class="search_input flex items-center">
                        <input type="text" placeholder="Search" wire:model.live.debounce.500ms='searchParam'
                            class="flex-grow" />
                        <!-- Limit Selection -->
                        <label for="limit" class="ml-2">Limit: </label>
                        <input type="number" wire:model.blur='limit' class="w-16 ml-1">
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
                <a href="#" class="list-group-item list-group-item-action">
                    {{ $book['text'] }}
                </a>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>