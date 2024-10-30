@extends('layouts.frontend')
@section('title', $title)
@section('content')


    <!-- ---- Start Category  ----- -->
    <div class="mx-4 my-2 py-2 md:container lg:container">
        <div
            class="p-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h1 class="text-base my-2 md:text-3xl  font-medium text-gray-800 uppercase">
                {{ $title }}
                <hr class="w-4/5 h-0.5 my-2 bg-gray-200 border-0 dark:bg-gray-700">
            </h1>
            <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Be a Partner with Chef K Product</h2>

            <p class="max-w-5xl mb-3 text-gray-500 dark:text-gray-400">Join us in spreading the love for unique, healthy
                beverage products. Partner with Chef K Product to offer exceptional, natural drinks to your customers. Our
                products are known for their quality and health-conscious choices.</p>



            <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Partner with Us:</h2>
            <ul class="space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                <li>
                    Retailers and Distributors: Expand your product portfolio with our unique beverages.
                </li>
                <li>
                    Food Service Providers: Elevate your menu with our distinctive flavors.
                </li>
                <li>
                    Collaborations: Let’s create something extraordinary together.
                </li>
            </ul>
            <p class="max-w-5xl mb-3 text-gray-500 dark:text-gray-400">
                Interested in partnering with Chef K Product?
                Contact us to learn more. Join our mission to make flavorful, healthy beverages accessible to all.

            </p>

            <form class="container lg:px-52" action="{{ route('partnership.store') }}" method="POST">
                @csrf
                <div class=" lg:grid lg:grid-cols-2 lg:gap-3">

                    <div class=" lg:col-span-2">
                        @include('components.input-text', ['name' => 'name', 'label' => 'Full name'])

                    </div>
                    <div>
                        @include('components.input-text', [
                            'type' => 'email',
                            'name' => 'email',
                            'label' => 'Email Address',
                        ])
                    </div>
                    <div>
                        @include('components.input-text', [
                            'type' => 'tel',
                            'name' => 'phone',
                            'label' => 'Phone',
                        ])
                    </div>
                    <div>
                        <label for="country"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                        <select id="country" name="country"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-light focus:border-primary-light block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-light dark:focus:border-primary-light">
                            <option selected disabled>Choose a country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->name }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="state" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            State / Province / Region</label>
                        <select id="state" name="state"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-light focus:border-primary-light block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-light dark:focus:border-primary-light">
                            <option selected disabled>Select a State</option>
                        </select>
                    </div>

                    <div>
                        @include('components.input-text', [ 'name' => 'zip','label' => 'Zip Code',])
                    </div>
                    <div>
                        @include('components.input-text', ['name' => 'city', 'label' => 'City'])
                    </div>
                    <div class=" col-span-2">
                        @include('components.input-textarea', ['name' => 'address', 'label' => 'Address'])
                    </div>

                    <div>
                        <label for="hear_about_us" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">How
                            did you hear about us?</label>
                        <select id="hear_about_us" name="hear_about_us"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose a option</option>
                            <option value="Online Search">Online Search</option>
                            <option value="Facebook">Facebook</option>
                            <option value="YouTube">YouTube</option>
                            <option value="Pinterest">Pinterest</option>
                            <option value="Instagram">Instagram</option>
                            <option value="A Friend">A Friend</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>

                    <div>
                        <label for="business_type"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Business
                            Type*</label>
                        <select id="business_type" name="business_type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose a option</option>
                            <option value="Restaurant">Restaurant</option>
                            <option value="Super Shop">Super Shop</option>
                            <option value="Food Manufacturin">Food Manufacturing</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class=" col-span-2">
                        @include('components.input-textarea', [
                            'name' => 'proposal',
                            'label' => 'Provide Your Business Proposal',
                        ])

                    </div>
                </div>
                <div class=" flex justify-center">

                    @include('components.btn-loading', [
                        'type' => 'submit',
                        'label' => 'submit',
                        'class' => 'w-full lg:w-1/2',
                    ])
                </div>
            </form>

        </div>

    </div>
    <!-- ---- End Category  ----- -->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#country').on('change', function() {
                var countryId = $(this).val(); // Get the selected country ID

                // Clear the state dropdown
                $('#state').empty();
                $('#state').append('<option selected disabled>Select a State</option>');

                // Check if a country is selected
                if (countryId) {
                    // Find the selected country in the list of countries from Laravel
                    var countries = @json($countries); // Access countries from the backend

                    var selectedCountry = countries.find(function(country) {
                        return country.name == countryId;
                    });

                    // Populate the state dropdown with the states of the selected country
                    if (selectedCountry && selectedCountry.states.length > 0) {
                        $.each(selectedCountry.states, function(index, state) {
                            $('#state').append('<option value="' + state.name + '">' + state.name +
                                '</option>');
                        });
                    }
                }
            });
        });
    </script>
@endpush
