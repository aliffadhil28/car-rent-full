@extends('layouts.master')
@section('title', 'Data Peminjaman')
@section('content')
    <div class="container">
        <div class="flex-row-reverse mb-3 justify-between">
            {{-- <button id="exportExcel" type="button" onclick="exportExcel()"
                class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Export
                Excel</button> --}}
            <button data-modal-target="add-data" data-modal-toggle="add-data" type="button"
                class="me-2 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">Add</button>
        </div>
        <div class="shadow-md sm:rounded-sm">
            <div class="card">
                <div class="card-header">Rent Data</div>
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>

    <div id="add-data" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Add Rent
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="add-data">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form id="rentForm" action="{{ route('rents.store') }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <div class="mb-3">
                            <label for="car" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                                Mobil</label>
                            <select name="car_id" id="car"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Select a car</option>
                                @foreach ($cars as $car)
                                    <option value="{{ $car->id }}">{{ $car->name }}
                                        <small>({{ $car->type }})</small>
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="driver" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                                Driver</label>
                            <select name="user_id" id="driver"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Select Driver</option>
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pj_1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                                Penanggung Jawab 1</label>
                            <select name="pj_satu" id="pj_1"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Select PIC</option>
                                @foreach ($penanggung_jawab as $pj)
                                    <option value="{{ $pj->id }}">{{ $pj->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pj_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                                Penanggung Jawab 2</label>
                            <select name="pj_dua" id="pj_2"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Select PIC</option>
                                @foreach ($penanggung_jawab as $pj)
                                    <option value="{{ $pj->id }}">{{ $pj->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex">
                            <div class="mb-3 w-1/2">
                                <label for="start_date"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Date</label>
                                <input name="start_date" id="start_date" type="date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date">
                            </div>
                            <div class="ms-2 mb-3 w-1/2">
                                <label for="end_date"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Date</label>
                                <input name="end_date" id="end_date" type="date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date">
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex flex-row-reverse items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="add-data" type="submit" id="submitBtn"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                        <button data-modal-hide="add-data" type="button"
                            class="py-2.5 px-5 me-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Data Modal -->
    <div id="edit-data" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit Rent
                    </h3>
                    <button type="button" onclick="hiddenElement('#edit-data')"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="edit-data">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form id="rentForm" action="{{ route('rents.update') }}" method="POST">
                    @csrf
                    {{-- @method('PUT') --}}
                    <!-- Modal body -->
                    <input type="hidden" id='rent_id' name="rent_id">
                    <div class="p-4 md:p-5 space-y-4">
                        <div class="mb-3">
                            <label for="car-edit"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                                Mobil</label>
                            <select name="car_id" id="car-edit"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Select a car</option>
                                @foreach ($cars as $car)
                                    <option value="{{ $car->id }}">{{ $car->name }}
                                        <small>({{ $car->type }})</small>
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="driver-edit"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                                Driver</label>
                            <select name="user_id" id="driver-edit"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Select Driver</option>
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pj_1-edit"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                                Penanggung Jawab 1</label>
                            <select name="pj_satu" id="pj_1-edit"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Select PIC</option>
                                @foreach ($penanggung_jawab as $pj)
                                    <option value="{{ $pj->id }}">{{ $pj->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pj_2-edit"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                                Penanggung Jawab 2</label>
                            <select name="pj_dua" id="pj_2-edit"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Select PIC</option>
                                @foreach ($penanggung_jawab as $pj)
                                    <option value="{{ $pj->id }}">{{ $pj->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex">
                            <div class="mb-3 w-1/2">
                                <label for="start_date-edit"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Date</label>
                                <input name="start_date" id="start_date-edit" type="date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date">
                            </div>
                            <div class="ms-2 mb-3 w-1/2">
                                <label for="end_date-edit"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Date</label>
                                <input name="end_date" id="end_date-edit" type="date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date">
                            </div>
                        </div>
                        <div class="flex items-center me-4">
                            <input type="hidden" name="status" value="0">
                            <input id="inline-checkbox" type="checkbox" value="1" name="status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="inline-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Dikembalikan</label>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex flex-row-reverse items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="edit-data" onclick="hiddenElement('#edit-data')" type="submit"
                            id="submitBtn"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                        <button data-modal-hide="edit-data" onclick="hiddenElement('#edit-data')" type="button"
                            class="py-2.5 px-5 me-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#submitBtn').click(function(e) {
                e.preventDefault();

                var formData = $('#rentForm').serialize();

                $.ajax({
                    url: "{{ route('rents.store') }}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        alert(response.message);
                        // Hide the modal
                        $('[data-modal-hide="add-data"]').trigger('click');
                        // Optionally, you can refresh the table or page here
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            var errorMessage = "There were some validation errors:\n";
                            $.each(errors, function(key, value) {
                                errorMessage += value + "\n";
                            });
                            alert(errorMessage);
                        } else {
                            alert(xhr.responseJSON.message || 'An unexpected error occurred.');
                        }
                    }
                });
            });
        });

        function hiddenElement(element) {
            $(element).addClass('hidden');
        }

        function getData(id) {
            var rentId = id

            $.ajax({
                url: `{{ url('rent/${rentId}') }}`,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    // Populate the modal with data
                    $('#rent_id').val(data.id);
                    $('#car-edit').val(data.car_id).trigger('change');
                    $('#driver-edit').val(data.user_id).trigger('change');
                    $('#pj_1-edit').val(data.pj_satu.id).trigger('change');
                    $('#pj_2-edit').val(data.pj_dua.id).trigger('change');
                    $('#start_date-edit').val(data.start_date);
                    $('#end_date-edit').val(data.end_date);

                    // Show the modal
                    $('#edit-data').removeClass('hidden');
                }
            });
        }
    </script>
@endsection
