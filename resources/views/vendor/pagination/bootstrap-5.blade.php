@php
    $locale = session()->get('locale');
@endphp
@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between">
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.previous')</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                            rel="prev">@lang('pagination.previous')</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.next')</span>
                    </li>
                @endif
            </ul>
        </div>

        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <p class="small text-muted">
                    {!! __('pagination.Showing') !!}
                    <span class="fw-semibold">
                        @if ($locale == 'ar')
                            {{ Numbers::ShowInArabicDigits($paginator->firstItem()) }}
                        @else
                            {{ $paginator->firstItem() }}
                        @endif
                    </span>

                    {!! __('pagination.to') !!}
                    <span class="fw-semibold">
                        @if ($locale == 'ar')
                            {{ Numbers::ShowInArabicDigits($paginator->lastItem()) }}
                        @else
                            {{ $paginator->lastItem() }}
                        @endif
                    </span>

                    {!! __('pagination.of') !!}
                    <span class="fw-semibold">
                        @if ($locale == 'ar')
                            {{ Numbers::ShowInArabicDigits($paginator->total()) }}
                        @else
                            {{ $paginator->total() }}
                        @endif
                    </span>
                    {!! __('pagination.results') !!}
                </p>
            </div>

            <div>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                                aria-label="@lang('pagination.previous')">&lsaquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true"><span
                                    class="page-link">{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page"><span class="page-link">
                                            @if ($locale == 'ar')
                                                {{ Numbers::ShowInArabicDigits($page) }}
                                            @else
                                                {{ $page }}
                                            @endif
                                        </span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">
                                            @if ($locale == 'ar')
                                                {{ Numbers::ShowInArabicDigits($page) }}
                                            @else
                                                {{ $page }}
                                            @endif
                                        </a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                                aria-label="@lang('pagination.next')">&rsaquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="page-link" aria-hidden="true">&rsaquo;</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
