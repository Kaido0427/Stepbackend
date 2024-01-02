@extends('website.layout.app', ['activePage' => 'profile'])
@section('content')
<div class="pt-10 pb-60 w-full h-full bg-gradient-to-r from-gradient-bg1 to-gradient-bg2">
    <div class="xxxxl:pl-[300px] xxxxl:pr-[300px] s:pl-[10px] s:pr-[10px] xxl:pl-[100px] xxl:pr-[100px] xxxl:pr-[150px] xxxl:pl-[150px]">
        <div id="success_msg" class="w-full bg-[#4fd69c] text-white font-semibold font-normal text-center text-lg tracking-wide mb-2"></div>
        <div class="flex gap-5 xxxxl:mb-0 items-center mb-10">
            <a href="{{url()->previous()}}"><img src="{{asset('website/icon/left-arrow.svg')}}" alt="" class="w-5"></a>
            <div>
                <h5 class="font-poppins font-semibold text-[#404F65] text-2xl">{{__('Profile')}}</h5>
            </div>
        </div>
        <div class="bg-white shadow-sm md:w-[650px] p-10 rounded-2xl s:w-full">
            <div class="flex gap-5 mb-14 md:items-center sm:flex-row s:flex-col">
                <img src="{{asset('upload/'.Auth::guard('appuser')->user()->image)}}" alt="" class="w-[200px] h-[200px] rounded-full object-cover">
                <div>
                    <h3 class="font-poppins font-semibold text-5xl text-black mb-5">{{Auth::guard('appuser')->user()->name}}</h3>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="bg-light-pink w-11 h-11 rounded-lg">
                            <img src="{{asset('website/icon/envelope.svg')}}" alt="" class="mx-auto pt-3">
                        </div>
                        <h4 class="font-poppins font-normal text-[#556987] text-lg">{{Auth::guard('appuser')->user()->email}}</h4>
                    </div>
                    <div class="flex items-center gap-2 mb-3">
                        <div class="bg-light-blue w-11 h-11 rounded-lg">
                            <img src="{{asset('website/icon/phone.svg')}}" alt="" class="mx-auto pt-3">
                        </div>
                        <h4 class="font-poppins font-normal text-[#556987] text-lg">
                            @if(Auth::guard('appuser')->user()->phone_no == null)
                            <h1 class="font-poppins font-normal text-[#556987] text-lg">{{__('Numéro indisponible')}}</h1>
                            @else
                            {{Auth::guard('appuser')->user()->phone_no}}
                            @endif
                        </h4>
                    </div>
                </div>
            </div>
            <div class="flex gap-5 l:flex-row s:flex-col">
                <a href="javascript:void()" class="flex border border-perot rounded py-3 w-48 px-3 gap-5">
                    <img src="{{asset('website/icon/block.svg')}}" alt="">
                    <button class="text-dark-orange font-poppins font-normal text-sm tracking-wide" data-modal-target="DeleteAccount" data-modal-toggle="DeleteAccount">{{__('Supprimer mon compte')}}</button>
                </a>

                <a href="javascript:void()" class="flex bg-light-perot rounded-lg py-3 w-48 px-3 gap-5" data-modal-target="EditProfile" data-modal-toggle="EditProfile" type="button">
                    <img src="{{asset('website/icon/edit.svg')}}" alt="">
                    <button class="text-perot font-poppins font-normal text-sm tracking-wide">{{__('Editer Profile')}}</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Edit Modal --}}
<div id="EditProfile" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative xxxxl:w-[450px] s:w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 rounded-t">

                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="EditProfile">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-7">
                <div id="errors-list" style="color:red"></div>
                <form action="" id="imageUploadForm" enctype="multipart/form-data">
                    @csrf
                    <div class="relative mb-10">
                        <img src="{{asset('upload/'.Auth::guard('appuser')->user()->image)}}" class="w-[200px] h-[200px] rounded-full object-cover mx-auto" id="upload" name="image">
                        <div class="w-10 h-10 rounded-full bg-light-blue border border-[#C0DEFF] absolute top-44 left-44">
                            <label for="imgUpload" class="block w-full h-full cursor-pointer">
                                <img src="{{asset('website/icon/camera.svg')}}" alt="" class="mx-auto pt-2.5">
                                <input type="file" id="imgUpload" name="image" class="hidden absolute top-[-10px] left-[-30px]" onchange="readURL(this);">
                            </label>
                        </div>
                    </div>
                </form>
                <div id="errors-list" style="color:red"></div>
                <form action="" enctype="multipart/form-data" id="profile">
                    @csrf
                    <div class="form-group mb-5">
                        <label for="name" class="font-poppins font-medium text-black text-base tracking-wide">{{__('Nom')}}</label>
                        <input type="text" name="name" value="{{Auth::guard('appuser')->user()->name}}" class="w-full border border-[#D5DAE1] rounded-lg mt-3 p-3 font-poppins font-normal text-[#667085] text-base">
                    </div>
                    <div class="form-group mb-5">
                        <label for="email" class="font-poppins font-medium text-black text-base tracking-wide">{{__('Adresse mail')}}</label>
                        <input type="text" name="email" value="{{Auth::guard('appuser')->user()->email}}" class="w-full border border-[#D5DAE1] rounded-lg mt-3 p-3 font-poppins font-normal text-[#667085] text-base" readonly>
                    </div>
                    <div class="form-group mb-5">
                        <label for="number" class="font-poppins font-medium text-black text-base tracking-wide">{{__('Numéro de téléphone')}}</label>
                        <input type="tel" name="number" pattern="[0-9]{10}" value="{{Auth::guard('appuser')->user()->phone_no}}" class="w-full border border-[#D5DAE1] rounded-lg mt-3 p-3 font-poppins font-normal text-[#667085] text-base">
                        <div class="phone" style="color:red"></div>
                    </div>
                    <button type="button" class="w-full bg-primary rounded-md font-poppins font-medium text-white text-base py-3 tracking-wide" onclick="profileUpdate()">{{__('Mettre à jour')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- Delete Account --}}
<div id="DeleteAccount" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative xxxxl:w-[570px] s:w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="p-5 rounded-t">
                <h4 class="font-poppins font-medium text-2xl text-[#404F65] mb-5">{{__('Supprimer le compte?')}}</h4>
                <p class="font-poppins font-normal text-lg text-[#404F65] mb-5">{{__('Vous perdrez toutes vos données et ne pourrez pas vous reconnecter.')}}</p>
                <form action="">
                    @csrf
                    <div class="mb-5">
                        <label for="cpassword" class="font-poppins font-medium text-base text-black tracking-wide">{{__('Mot de passe actuel*')}}</label>
                        <input type="password" name="accountPassword" id="accountPassword" class="border border-[#D5DAE1] rounded-[8px] p-3 w-full mt-2">
                        <div id="delete-list" style="color:red"></div>
                    </div>
                    <div class="flex gap-5 justify-end">
                        <button type="button" class="border border-[#D5DAE1] rounded-[8px] p-3 text-[#8896AB] font-poppins font-normal text-base xxxxl:px-5 tracking-wide" data-modal-hide="DeleteAccount">{{__('Annuler')}}</button>
                        <button type="button" class="btn bg-dark-orange rounded-[8px] p-3 text-white font-poppins font-normal text-base xxxxl:px-5 tracking-wide" onclick="deleteAccount()">{{__('Supprimer')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- can't Delete Account --}}
<div id="NotDeleteAccount" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative xxxxl:w-[570px] s:w-full h-full max-w-2xl md:h-auto mx-auto ">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 mt-60">
            <!-- Modal header -->
            <div class="p-5 rounded-t">
                <h4 class="font-poppins font-medium text-2xl text-[#404F65] mb-5">{{__("Impossible de supprimer le compte.")}}</h4>
                <p class="font-poppins font-normal text-lg text-[#404F65] mb-5">{{__('Veuillez annuler ou finaliser d\'abord les commandes en attente et impayées.')}}</p>

                <div class="flex gap-5 justify-end">
                    <button type="button" class="bg-primary rounded-[8px] p-3 text-white font-poppins font-medium text-base xxxxl:px-7 tracking-wide" data-modal-hide="NotDeleteAccount">{{__('Ok')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>