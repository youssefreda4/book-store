<div class="card-header d-flex justify-content-between align-items-center">
    <h1 class="col">
        {{ $title ?? '' }}
    </h1>
    @isset($actions)
        <div>
            {{ $actions }}
        </div>
    @endisset
</div>
