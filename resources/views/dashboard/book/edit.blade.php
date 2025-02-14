@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">{{ __('book.book_edit') }}</h1>
@stop

@section('content')
    <div class="card card-primary">
        <form action="{{ route('dashboard.books.update', $book->slug) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body col-12">
                <div class="row">
                    <x-adminlte-input name="name[en]" label="{{ __('book.name_book_en') }}" type="text"
                        placeholder="{{ __('book.enter_book_name') }}" value="{{ $book->getTranslation('name', 'en') }}"
                        fgroup-class="col-md-6" />

                    <x-adminlte-input name="name[ar]" label="{{ __('book.name_book_ar') }}" type="text"
                        placeholder="{{ __('book.enter_book_name') }}" value="{{ $book->getTranslation('name', 'ar') }}"
                        fgroup-class="col-md-6" />
                </div>

                <div class="row">

                    <x-adminlte-textarea name="description[en]" label="{{ __('book.description_book_en') }}"
                        placeholder="{{ __('book.enter_book_description') }}" fgroup-class="col-md-6">
                        {{ $book->getTranslation('description', 'en') }}
                    </x-adminlte-textarea>

                    <x-adminlte-textarea name="description[ar]" label="{{ __('book.description_book_ar') }}"
                        placeholder="{{ __('book.enter_book_description') }}" fgroup-class="col-md-6">
                        {{ $book->getTranslation('description', 'ar') }}

                    </x-adminlte-textarea>

                </div>

                <div class="row">
                    <x-adminlte-input name="quantity" label="{{ __('book.quantity') }}" type="number"
                        placeholder="1 - 100" fgroup-class="col-md-6" value="{{ $book->quantity }}" />

                        <x-adminlte-input name="publish_year" label="{{ __('book.publish_year') }}" type="text"
                        fgroup-class="col-md-6" value="{{ $book->publish_year }}" placeholder="YYYY" />
                    
                </div>

                <div class="row">
                    <x-adminlte-input name="rate" label="{{ __('book.rate') }}" type="number" placeholder="1 - 5"
                        fgroup-class="col-md-4" value="{{ $book->rate }}" />

                    <x-adminlte-input name="price" label="{{ __('book.price') }}" type="number"
                        placeholder="{{ __('book.EGP') }}" fgroup-class="col-md-4" value="{{ $book->price }}" />

                    <x-adminlte-select name="is_available" label="{{ __('book.is_available') }}" fgroup-class="col-md-4">
                        <option value="1" {{ $book->is_available === 1 ? 'selected' : '' }}>
                            {{ __('book.available') }}</option>
                        <option value="0" {{ $book->is_available === 0 ? 'selected' : '' }}>
                            {{ __('book.not_available') }}</option>
                    </x-adminlte-select>
                </div>

                <div class="row mt-3">

                    <div class="col-md-4">
                        <label class="form-label ml-2">{{ __('book.category') }}:</label>
                        <select id="category-select2" class="col-md-6 js-states form-control" name="category_id">
                            <option></option>
                        </select>
                        <input type="hidden" id="selected-category-id" value="{{ $book->category->id }}">
                        <input type="hidden" id="selected-category-name" value="{{ $book->category->name }}">

                        <x-error-input name="category_id"></x-error-input>
                    </div>

                    <div class="col-md-4 ">
                        <label class="form-label ml-2">{{ __('book.author') }}:</label>
                        <select id="author-select2" class="col-md-6 js-states form-control" name="author_id">
                            <option></option>
                        </select>
                        <input type="hidden" id="selected-author-id" value="{{ $book->author->id }}">
                        <input type="hidden" id="selected-author-name" value="{{ $book->author->name }}">
                        <x-error-input name="author_id"></x-error-input>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label ml-2">{{ __('book.publisher') }}:</label>
                        <select id="publisher-select2" class="col-md-6 js-states form-control" name="publisher_id">
                            <option></option>
                        </select>
                        <input type="hidden" id="selected-publisher-id" value="{{ $book->publisher->id }}">
                        <input type="hidden" id="selected-publisher-name" value="{{ $book->publisher->name }}">
                        <x-error-input name="publisher_id"></x-error-input>
                    </div>

                </div>

                <div class="row mt-3">

                    <x-image-preview name='image' fgroup-class="col-md-6"
                        value="{{ $book->getFirstMediaUrl('book') }}" />
                    <di class="mt-5">
                        <x-error-input name="image"></x-error-input>
                    </di>

                </div>
            </div>


            <div class="card-footer">
                <x-adminlte-button type="submit" theme="primary" label="{{ __('book.update') }}" />
            </div>

        </form>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            let selectedCategoryId = $('#selected-category-id').val();
            let selectedCategoryName = $('#selected-category-name').val();

            $('#category-select2').select2({
                placeholder: "{{ __('book.select_category') }}",
                allowClear: true,
                ajax: {
                    url: "{{ route('dashboard.categories.search') }}",
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: data.data.categories.map(category => ({
                                id: category.id,
                                text: "{{ session()->get('locale') == 'ar' }}" ? category
                                    .name.ar : category.name.en
                            }))
                        };
                    }
                }
            });

            // If there is a selected category, manually set it
            if (selectedCategoryId) {
                let selectedOption = new Option(selectedCategoryName, selectedCategoryId, true, true);
                $('#category-select2').append(selectedOption).trigger('change');
            }
        });

        $(document).ready(function() {
            let selectedAuthorId = $('#selected-author-id').val();
            let selectedAuthorName = $('#selected-author-name').val();

            $('#author-select2').select2({
                placeholder: "{{ __('book.select_author') }}",
                allowClear: true,
                ajax: {
                    url: "{{ route('dashboard.authors.search') }}",
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: data.data.authors.map(author => ({
                                id: author.id,
                                text: "{{ session()->get('locale') == 'ar' }}" ? author
                                    .name.ar : author.name.en
                            }))
                        };
                    }
                }
            });

            // If there is a selected Author, manually set it
            if (selectedAuthorId) {
                let selectedOption = new Option(selectedAuthorName, selectedAuthorId, true, true);
                $('#author-select2').append(selectedOption).trigger('change');
            }
        });

        $(document).ready(function() {
            let selectedPublisherId = $('#selected-publisher-id').val();
            let selectedPublisherName = $('#selected-publisher-name').val();

            $('#publisher-select2').select2({
                placeholder: "{{ __('book.select_publisher') }}",
                allowClear: true,
                ajax: {
                    url: "{{ route('dashboard.publishers.search') }}",
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: data.data.publishers.map(publisher => ({
                                id: publisher.id,
                                text: "{{ session()->get('locale') == 'ar' }}" ? publisher
                                    .name.ar : publisher.name.en
                            }))
                        };
                    }
                }
            });

            // If there is a selected publisher, manually set it
            if (selectedPublisherId) {
                let selectedOption = new Option(selectedPublisherName, selectedPublisherId, true, true);
                $('#publisher-select2').append(selectedOption).trigger('change');
            }
        });
    </script>
@stop
