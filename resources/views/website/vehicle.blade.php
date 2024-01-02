@extends('website.layout.app', ['activePage' => 'editprofile'])
@section('content')
<div class="pt-10 pb-96 w-full h-full bg-gradient-to-r from-gradient-bg1 to-gradient-bg2">
    <div class="xxxxl:pl-[300px] xxxxl:pr-[300px] s:pl-[10px] s:pr-[10px] xxl:pl-[100px] xxl:pr-[100px] xxxl:pr-[150px] xxxl:pl-[150px]">
        <div id="success_msg" class="w-full bg-[#4fd69c] text-white font-semibold font-normal text-center text-lg tracking-wide mb-2"></div>
        <div class="flex justify-between sm:items-center mb-10 sm:flex-row s:flex-col">
            <div class="flex gap-5 xxxxl:mb-0 s:mb-5 items-center">
                <a href="{{url()->previous()}}"><img src="{{asset('website/icon/left-arrow.svg')}}" alt="" class="w-5"></a>
                <div>
                    <h5 class="font-poppins font-semibold text-[#404F65] text-2xl">{{__('Mes Vélos')}}</h5>
                </div>
            </div>
            <a href="javascript:void()" class="flex bg-primary rounded-[6px] px-6 py-2 gap-3 w-[172px]" data-modal-target="AddVehicle" data-modal-toggle="AddVehicle">
                <img src="{{asset('website/icon/plus.svg')}}" alt="" class="w-4">
                <button class="font-poppins font-normal text-base text-white">{{__('Ajouter Velo')}}</button>
            </a>
        </div>

        <div class="grid l:grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
            @foreach($vehicle as $items)
            <div class="bg-white rounded-2xl p-5 m:w-[200px] s:w-full mb-5">
                <div class="flex justify-between items-center">
                    <div class="w-10 h-10 bg-light-blue rounded-lg">
                        <img src="{{ asset('vehicleType/'.$items->VehicleType->image)}}" alt="" class="w-5 h-7 mx-auto pt-1">
                    </div>
                    <div>
                        <button id="dropdownMenuIconButton_{{$items->id}}" data-dropdown-toggle="dropdownDots_{{$items->id}}" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-[#F7F8F9] rounded-lg " type="button">
                            <svg class="w-5 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownDots_{{$items->id}}" class="z-10 hidden bg-white rounded-2xl shadow w-36">
                            <ul class="p-5 font-poppins font-normal text-sm text-[#404F65]" aria-labelledby="dropdownMenuIconButton_{{$items->id}}">
                                <li class="flex" data-modal-target="editModal-{{$items->id}}" data-modal-toggle="editModal-{{$items->id}}" onclick="openModal('editModal-{{$items->id}}')">
                                    <img src="{{asset('website/icon/edit-gray.svg')}}" alt="">
                                    <a href="#" class="block px-4 py-2">{{__('Editer')}}</a>
                                </li>
                                <li class="flex" data-modal-target="DeleteVehicle-{{$items->id}}" data-modal-toggle="DeleteVehicle-{{$items->id}}">
                                    <img src="{{asset('website/icon/trash.svg')}}" alt="">
                                    <a href="#" class="block px-4 py-2">{{__('Supprimer')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <h5 class="font-poppins font-medium text-black text-lg tracking-wide mb-3 mt-5">{{$items->model}}</h5>
                <h4 class="font-poppins font-normal text-[#556987] text-base tracking-wide">{{$items->vehicle_no}}</h4>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

{{-- Delete Modal --}}
@foreach($vehicle as $items)

<div id="DeleteVehicle-{{$items->id}}" tabindex="-1" aria-hidden="true" class="fixed top-10 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-modal md:h-full">
    <div class="relative sm:w-[500px] s:w-full h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 p-5">
            <!-- Modal body -->
            <p class="font-poppins font-medium text-[#404F65] text-2xl text-center mb-10">{{__('Etes-vous sur de vouloir surpprimer ce vélo?')}}</p>
            <div class="flex gap-3 mt-4 justify-end mr-2 l:flex-row s:flex-col">
                <button class="border border-gray rounded font-poppins font-normal text-base text-[#8896AB] px-6 py-2 tracking-wide" type="button" data-modal-hide="DeleteVehicle">{{__('Non')}}</button>
                <button class="bg-dark-orange rounded font-poppins font-normal text-base text-white px-6 py-2 tracking-wide" type="button" onclick="deleteVehicle('{{$items->id}}')">{{__('Oui')}}</button>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- Add Vehicle --}}
<div id="AddVehicle" tabindex="-1" aria-hidden="true" class="fixed top-5 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative xxxxl:w-[450px] s:w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-2xl shadow p-6">
            <!-- Modal header -->
            <div class="flex items-start justify-between mb-7">
                <h3 class="font-poppins font-medium text-black text-2xl">
                    {{__('Ajouter Velo')}}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="AddVehicle">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="">
                <input type="hidden" name="user_id" value="{{Auth::guard('appuser')->user()->id}}">
                <div class="form-group mb-7">
                    <label for="brand" class="font-poppins font-medium text-black text-base tracking-wide">{{__('Marque du vélo')}}</label>
                    <input type="text" name="brand" class="w-full border border-[#D5DAE1] rounded-lg mt-3 p-3 font-poppins font-normal text-[#667085] text-base">
                    <div class="brand" style="color:red"></div>
                </div>
                <div class="form-group mb-7">
                    <label for="model" class="font-poppins font-medium text-black text-base tracking-wide">{{__('Modèl du vélo')}}</label>
                    <input type="text" name="model" class="w-full border border-[#D5DAE1] rounded-lg mt-3 p-3 font-poppins font-normal text-[#667085] text-base">
                    <div class="model" style="color:red"></div>
                </div>
                <div class="form-group mb-7">
                    <label for="number" class="font-poppins font-medium text-black text-base tracking-wide">{{__('Numero du vélo')}}</label>
                    <input type="text" name="vehicle_no" class="w-full border border-[#D5DAE1] rounded-lg mt-3 p-3 font-poppins font-normal text-[#667085] text-base">
                    <div class="vehicle_no" style="color:red"></div>
                </div>
                <div class="grid s:grid-cols-1 l:grid-cols-2  gap-5 mb-10">
                    @foreach($vehicletype as $item)
                    <div class="flex justify-between items-center rounded-lg w-[180px] h-[56px] px-3 bg-light-blue">
                        <div class="flex items-center gap-2">
                            <div class="w-[36px] h-[36px] bg-white rounded-lg">
                                <img src="{{ asset('vehicleType')}}/{{$item->image }}" alt="" class="fa fa-motorcycle pl-1.5 pt-2.5 w-[28px] h-[28px]">
                            </div>
                            <label for="bike" class="font-poppins font-normal text-base text-black tracking-wide">{{$item->title}}</label>
                        </div>
                        <input id="bordered-checkbox-1" type="checkbox" value="{{$item->id}}" name="vehicle_type_id" class="w-[20px] h-[20px] text-blue-600 border-[#BAC7D5] rounded">
                    </div>
                    @endforeach

                    <div class="vehicle_type_id" style="color:red"></div>
                </div>
                <button type="button" class="w-full bg-primary rounded-md font-poppins font-medium text-white text-base py-3 tracking-wide" onclick="addVehicle()">{{__('Add Velo')}}</button>
            </form>
        </div>
    </div>
</div>

{{-- Edit Vehicle --}}
@foreach($vehicle as $items)

<div id="editModal-{{$items->id}}" tabindex="-1" aria-hidden="true" class="fixed top-5 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative xxxxl:w-[450px] s:w-full h-full max-w-2xl md:h-auto mx-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-2xl shadow  p-6">
            <!-- Modal header -->
            <div class="flex items-start justify-between mb-7">
                <h3 class="font-poppins font-medium text-black text-2xl">
                    {{__('Editer le Velo')}}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editModal-{{$items->id}}" onclick="closeModal('editModal-{{$items->id}}')">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="">
                <div class="form-group mb-7">
                    <label for="brand" class="font-poppins font-medium text-black text-base tracking-wide">{{__('Marque du vélo')}}</label>
                    <input type="text" id="brand_{{$items->id}}" name="brand" value="{{ $items->brand }}" class="w-full border border-[#D5DAE1] rounded-lg mt-3 p-3 font-poppins font-normal text-[#667085] text-base">
                </div>
                <div class="form-group mb-7">
                    <label for="model" class="font-poppins font-medium text-black text-base tracking-wide">{{__('Modèl du vélo')}}</label>
                    <input type="text" id="model_{{$items->id}}" name="model" value="{{ $items->model }}" class="w-full border border-[#D5DAE1] rounded-lg mt-3 p-3 font-poppins font-normal text-[#667085] text-base">
                </div>
                <div class="form-group mb-7">
                    <label for="number" class="font-poppins font-medium text-black text-base tracking-wide">{{__('Numéro du vélo')}}</label>
                    <input type="text" id="vehicle_no_{{$items->id}}" name="vehicle_no" value="{{ $items->vehicle_no }}" class="w-full border border-[#D5DAE1] rounded-lg mt-3 p-3 font-poppins font-normal text-[#667085] text-base">
                </div>
                <div class="flex gap-5 mb-10 l:flex-row s:flex-col">
                    <div class="grid s:grid-cols-1 l:grid-cols-2  gap-5 mb-10">
                    
                        @foreach($vehicletype as $item)
                        <div class="flex justify-between items-center rounded-lg w-[180px] h-[56px] px-3 bg-light-blue">
                            <div class="flex items-center gap-2">
                                <div class="w-[36px] h-[36px] bg-white rounded-lg">
                                    <img src="{{ asset('vehicleType')}}/{{$item->image }}" alt="" class="fa fa-motorcycle pl-1.5 pt-2.5 w-[28px] h-[28px]">
                                </div>
                                <label class="font-poppins font-normal text-base text-black tracking-wide">{{$item->title}}</label>
                            </div>
                            <input Desactived id="checkbox-{{$item->id}}" type="checkbox" value="{{$item->id}}" name="vehicle_type_id[]" class="w-[20px] h-[20px] text-blue-600 border-[#BAC7D5] rounded checkbox-input">
                        </div>
                        @endforeach
 
                    </div>
                </div>
                <button type="button" class="w-full bg-primary rounded-md font-poppins font-medium text-white text-base py-3 tracking-wide" onclick="vehicleUpdate('{{$items->id}}')">{{__('Mettre à jour')}}</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Function to handle closing the modal
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('hidden');
        modal.setAttribute('aria-hidden', 'false');
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add('hidden');
        modal.setAttribute('aria-hidden', 'true');
    }
</script>

@endforeach