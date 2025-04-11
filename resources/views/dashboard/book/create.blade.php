@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
<h1 class="card-header">{{ __('book.create_book') }}</h1>
@endsection

@section('content')
<div class="card card-primary">
    <form action="{{ route('dashboard.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <x-adminlte-input name="name[en]" label="{{ __('book.name_book_en') }}" type="text"
                    placeholder="{{ __('book.enter_book_name') }}" fgroup-class="col-md-6" />

                <x-adminlte-input name="name[ar]" label="{{ __('book.name_book_ar') }}" type="text"
                    placeholder="{{ __('book.enter_book_name') }}" fgroup-class="col-md-6" />
            </div>

            <div class="row">
                <x-adminlte-textarea name="description[en]" label="{{ __('book.description_book_en') }}"
                    placeholder="{{ __('book.enter_book_description') }}" fgroup-class="col-md-6" />

                <x-adminlte-textarea name="description[ar]" label="{{ __('book.description_book_ar') }}"
                    placeholder="{{ __('book.enter_book_description') }}" fgroup-class="col-md-6" />
            </div>

            <div class="row">
                <x-adminlte-input name="quantity" label="{{ __('book.quantity') }}" type="number" placeholder="1 - 100"
                    fgroup-class="col-md-6" />

                <x-adminlte-input name="publish_year" label="{{ __('book.publish_year') }}" type="text"
                    fgroup-class="col-md-6" placeholder="YYYY" />
            </div>

            <div class="row">
                <x-adminlte-input name="rate" label="{{ __('book.rate') }}" type="number" placeholder="1 - 5"
                    fgroup-class="col-md-4" />

                <x-adminlte-input name="price" label="{{ __('book.price') }}" type="number"
                    placeholder="{{ __('book.EGP') }}" fgroup-class="col-md-4" />

                <x-adminlte-select name="is_available" label="{{ __('book.is_available') }}" fgroup-class="col-md-4">
                    <option value="1" {{ old('time')===1 ? 'selected' : '' }}>
                        {{ __('book.available') }}</option>
                    <option value="0" {{ old('time')===0 ? 'selected' : '' }}>
                        {{ __('book.not_available') }}</option>
                </x-adminlte-select>
            </div>

            <div class="row mt-3">

                <div class="col-md-4">
                    <div>
                        <label class="form-label ml-2">{{ __('book.category') }}</label>
                    </div>
                    <select id="category-select2" class="col-md-6 js-states form-control" name="category_id">
                        <option></option>
                    </select>
                    <x-error-input name="category_id"></x-error-input>
                </div>

                <div class="col-md-4 ">
                    <div>

                        <label class="form-label ml-2">{{ __('book.author') }}</label>
                    </div>
                    <select id="author-select2" class="col-md-6 js-states form-control" name="author_id">
                        <option></option>
                    </select>
                    <x-error-input name="author_id"></x-error-input>
                </div>

                <div class="col-md-4">
                    <div>
                        <label class="form-label ml-2">{{ __('book.publisher') }}</label>
                    </div>
                    <select id="publisher-select2" class="col-md-6 js-states form-control" name="publisher_id">
                        <option></option>
                    </select>
                    <x-error-input name="publisher_id"></x-error-input>
                </div>

            </div>

            <div class="row mt-3">
                <label class="form-label ml-2">{{ (__('book.select_discount_type')) }} :</label>
                <div>
                    <input type="radio" class="ml-3" name="discountable_type" value="App\Models\Discount"
                        id="discount_discountable">{{ __('book.discount') }}

                    <input type="radio" class="ml-3" name="discountable_type" value="App\Models\Flashsale"
                        id="flashsale_discountable">{{ __('book.flashsale') }}
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-4">
                    <select id="discount-select2" class="col-md-6 js-states form-control" style="display: none;"
                        name="discountable_id">
                        <option></option>
                    </select>
                    <x-error-input name="discountable"></x-error-input>
                </div>
            </div>

            <div class="row mt-3">

                <x-image-preview name='image' fgroup-class="col-md-6" />
                <div class="mt-5">
                    <x-error-input name="image"></x-error-input>
                </div>

            </div>
        </div>


        <div class="card-footer">
            <x-adminlte-button type="submit" theme="primary" label="{{ __('book.create') }}" />
        </div>

    </form>
</div>
@endsection

@push('js')
<script>
    $('#category-select2').select2({
            //minimumInputLength: 1,
            placeholder: "{{ __('book.select_category') }}",
            allowClear: true,
            ajax: {
                url: "{{ route('dashboard.categories.search') }}",
                dataType: 'json',
                processResults: function(data) {
                    return {
                        results: data.data.categories.map(category => ({
                            id: category.id,
                            @if (session()->get('locale') == 'ar')
                                text: category.name.ar,
                            @else
                                text: category.name.en,
                            @endif
                        }))
                    }
                }
            }
        });
        $('#author-select2').select2({
            //minimumInputLength: 1,
            placeholder: "{{ __('book.select_author') }}",
            allowClear: true,
            ajax: {
                url: "{{ route('dashboard.authors.search') }}",
                dataType: 'json',
                processResults: function(data) {
                    return {
                        results: data.data.authors.map(author => ({
                            id: author.id,
                            @if (session()->get('locale') == 'ar')
                                text: author.name.ar,
                            @else
                                text: author.name.en,
                            @endif
                        }))
                    }
                }
            }
        });
        $('#publisher-select2').select2({
            //minimumInputLength: 1,
            placeholder: "{{ __('book.select_publisher') }}",
            allowClear: true,
            ajax: {
                url: "{{ route('dashboard.publishers.search') }}",
                dataType: 'json',
                processResults: function(data) {
                    return {
                        results: data.data.publishers.map(publisher => ({
                            id: publisher.id,
                            @if (session()->get('locale') == 'ar')
                                text: publisher.name.ar,
                            @else
                                text: publisher.name.en,
                            @endif
                        }))
                    }
                }
            }
        });

        const discountRadio = document.querySelector('#discount_discountable')
        const flashSaleRadio = document.querySelector('#flashsale_discountable')
        const discountSelect2 = document.querySelector('#discount-select2')
        let placeholder = ''
        let local="{{ session()->get('locale') }}"

        discountRadio.addEventListener('change',showDiscountDropDown)
        flashSaleRadio.addEventListener('change',showDiscountDropDown)

        function showDiscountDropDown(){
            discountSelect2.style.display='block'
            
            if(this.id == 'discount_discountable') {
                placeholder="{{ __('book.select_discount') }}"
                enableSelect2()
            }else{
                placeholder="{{ __('book.select_flashsale') }}"
                enableFlashSaleSelect2()
            } 
        }

        function enableSelect2(){
            $('#discount-select2').select2({
                //minimumInputLength: 1,
                placeholder: placeholder,
                allowClear: true,
                ajax: {
                    url: "{{ route('dashboard.discounts.search') }}",
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: data.data.discounts.map(discount => ({
                                id: discount.id,
                                text: discount.code + ' - ' + discount.precentage + '%',
                            }))
                        }
                    }
                }
            });
        }
        function enableFlashSaleSelect2(){
            $('#discount-select2').select2({
                //minimumInputLength: 1,
                placeholder: placeholder,
                allowClear: true,
                ajax: {
                    url: "{{ route('dashboard.flashsales.search') }}",
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: data.data.flashsales.map(flashsale => ({
                                id: flashsale.id,
                                text: flashsale.name[local],
                            }))
                        }
                    }
                }
            });
        }

</script>
@endpush