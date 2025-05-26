@extends('website.layouts.main')

@section('title', __('website/profile.title'))

@push('css')
<link rel="stylesheet" href="{{ asset('front-assets')}}/css/profile.css" />
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
@endpush

@section('content')
<section class="my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="profile-card">
                    <div class="text-center mb-4">
                        <div class="profile_image mx-auto">
                             @php
                                $image = null;
                                if(auth()->user()->getFirstMediaUrl('profile')){
                                    $image = auth()->user()->getFirstMediaUrl('profile');
                                }elseif (!auth()->user()->image) {
                                  $image = 'https://fakeimg.pl/100x100';
                                }else {
                                    $image = auth()->user()->image;
                                }
                            @endphp
                            <img src="{{ $image }}" alt="profile image">
                        </div>
                        <h4 class="mt-3 mb-0">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h4>
                        <p class="text-muted">{{ auth()->user()->email }}</p>
                    </div>

                    <form class="profile_form" action="{{ route('front.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">{{ __('website/profile.username') }}</label>
                                <input type="text" class="form-control" name="username"
                                    placeholder="{{ __('website/profile.placeholder.username') }}"
                                    value="{{ auth()->user()->username }}">
                                <x-error-form-input name="username"></x-error-form-input>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">{{ __('website/profile.first_name') }}</label>
                                <input type="text" class="form-control"
                                    placeholder="{{ __('website/profile.placeholder.first_name') }}" name="first_name"
                                    value="{{ auth()->user()->first_name }}">
                                <x-error-form-input name="first_name"></x-error-form-input>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">{{ __('website/profile.last_name') }}</label>
                                <input type="text" class="form-control"
                                    placeholder="{{ __('website/profile.placeholder.last_name') }}" name="last_name"
                                    value="{{ auth()->user()->last_name }}">
                                <x-error-form-input name="last_name"></x-error-form-input>
                            </div>

                            <div class="col-12">
                                <label class="form-label">{{ __('website/profile.email') }}</label>
                                <input type="email" class="form-control"
                                    placeholder="{{ __('website/profile.placeholder.email') }}" name="email"
                                    value="{{ auth()->user()->email }}">
                                <x-error-form-input name="email"></x-error-form-input>
                            </div>

                            <div class="col-12">
                                <label class="form-label">{{ __('website/profile.phone') }}</label>
                                <input type="text" class="form-control"
                                    placeholder="{{ __('website/profile.placeholder.phone') }}" name="phone"
                                    value="{{ auth()->user()->phone }}">
                                <x-error-form-input name="phone"></x-error-form-input>
                            </div>

                            <div class="col-12">
                                <label class="form-label">{{ __('website/profile.address') }}</label>

                                @foreach ($userAddress as $address)
                                <div class="mb-3 d-flex align-items-center" id="address-{{ $address->id }}">
                                    <input type="text" name="addresses[{{ $address->id }}][address]"
                                        class="form-control"
                                        placeholder="{{ __('website/profile.placeholder.address') }}"
                                        value="{{ $address->address }}">

                                    <div class="form-check {{ app()->getLocale() === 'ar' ? 'me-2' : 'ms-2' }}">
                                        <input class="form-check-input" type="checkbox" value="1"
                                            name="addresses[{{ $address->id }}][delete]" id="delete-{{ $address->id }}">
                                        <label class="form-check-label text-danger" for="delete-{{ $address->id }}">
                                            {{ __('website/profile.delete') }}
                                        </label>
                                    </div>
                                </div>

                                <x-error-form-input name="addresses.{{ $address->id }}.address"></x-error-form-input>
                                @endforeach
                                <div class="mb-3">
                                    <input type="text" name="new_address" class="form-control"
                                        placeholder="{{ __('website/profile.placeholder.new_address') }}">
                                    <x-error-form-input name="new_address"></x-error-form-input>
                                </div>
                            </div>

                            <div class="row ">
                                <x-image-preview name='image' fgroup-class="col-md-6" />
                                <div class="mt-5">
                                    <x-error-input name="image"></x-error-input>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="main_btn mt-4">{{ __('website/profile.update') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
@endpush