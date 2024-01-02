 <div class="w-full xxxxl:h-[185px] bg-light-blue xxxxl:pl-[300px] xxxxl:pr-[300px] pt-[24px] pb-[24px] s:pr-[10px] s:pl-[10px] xl:pr-[30px] xl:pl-[30px] xxl:pr-[100px] xxl:pl-[100px] xxxl:pr-[150px] xxxl:pl-[150px]">
     <div class="flex justify-between sm:items-center mb-10 sm:flex-row s:flex-col ">
         <a href="{{url('/')}}"><img src="{{asset('website/image/logo.png')}}" alt="" class="w-[60px] h-[60px]"></a>
         <div class="flex gap-5 l:flex-row s:flex-col s:mt-5 xxxxl:mt-0">
             <a href="https://play.google.com" target="_blank"><img src="{{asset('website/image/Googleplay.png')}}" alt=""></a>
             <a href="https://www.apple.com/in/app-store" target="_blank"><img src="{{asset('website/image/Appstore.png')}}" alt=""></a>
         </div>
     </div>
     <div class="flex justify-between lg:items-center lg:flex-row s:flex-col">
         <div>
             <ul class="flex xxxxl:gap-8 sm:flex-row s:flex-col s:gap-5">
                 <a href="{{url('/')}}">
                     <li class="font-mulish font-medium text-lg text-dark-blue">{{__('Accueil')}}</li>
                 </a>
                 <a href="{{url('/about_us')}}">
                     <li class="font-mulish font-medium text-lg text-dark-blue">{{__('À Propos')}}</li>
                 </a>
                 <a href="{{url('/contact_us')}}">
                     <li class="font-mulish font-medium text-lg text-dark-blue">{{__('Nous conctacter')}}</li>
                 </a>
                 <a href="{{url('/privacy_policy')}}">
                     <li class="font-mulish font-medium text-lg text-dark-blue">{{__('Politique de confidentialité')}}</li>
                 </a>
                 <a href="{{url('/terms_condition')}}">
                     <li class="font-mulish font-medium text-lg text-dark-blue">{{__('Termes et conditions')}}</li>
                 </a>
                 <a href="{{url('/faqs')}}">
                     <li class="font-mulish font-medium text-lg text-dark-blue">{{__('FAQ')}}</li>
                 </a>
             </ul>
         </div>
         @php
         $setting = \App\AdminSetting::first();
         @endphp
         <div class="flex gap-3 lg:mt-0 s:mt-5">
             <a href="{{$setting->facebook_url}}" target="_blank"><img src="{{asset('website/icon/facebook.svg')}}" alt=""></a>
             <a href="{{$setting->twitter_url}}" target="_blank"><img src="{{asset('website/icon/Twitter.svg')}}" alt=""></a>
             <a href="{{$setting->instagram_url}}" target="_blank"><img src="{{asset('website/icon/Instagram.svg')}}" alt=""></a>
             <a href="{{$setting->linkdin_url}}" target="_blank"><img src="{{asset('website/icon/LinkedIn.svg')}}" alt=""></a>
         </div>


         @php
         if (Auth::check()) {
         if (auth()->user()->language) {
         $lang_name = Auth::user()->language;
         $lang_image = App\Language::where('name', $lang_name)->first()->image;
         } else {
         $lang_name = 'Français';
         $lang_image = "Français.png";
         }
         } else {
         $icon = App\Language::where('name',session('locale'))->first();
         if($icon) {
         $lang_name = session('locale');
         $lang_image = $icon->image;
         } else {
         $lang_name = 'Français';
         $lang_image = "Français.png";
         }
         }
         $language = App\Language::where('status',1)->get();
         @endphp
        
         <button type="button" data-dropdown-toggle="language-dropdown-menu" class="inline-flex items-center justify-center text-sm text-gray-500 rounded-lg cursor-pointer bg-white w-[128px] h-[50px] border border-[#A2CFFF] gap-2 s:mt-5 lg:mt-0">
             @if(session()->get('lngimage'))
             <img src="{{ asset('upload')}}/{{session()->get('lngimage')}}" class="w-[24px] h-[24px] mr-2" alt="">
             <h6 class="font-mulish font-normal text-base text-[#404F65] capitalize">{{app()->getLocale()}}</h6>
             @else
             <img src="{{ asset('argon') }}/img/theme/french.png" class="w-5 h-5 mr-2 rounded-full" alt="">
             <h6 class="font-mulish font-normal text-base text-[#404F65] capitalize">{{ __('Français')}}</h6>
             @endif
         </button>

         <div class="z-50 hidden my-4 text-base list-none divide-y divide-gray-100 rounded-lg shadow bg-white" id="language-dropdown-menu">
             <ul class="py-2" role="none">
                 @foreach ($language as $lng )
                 <li>
                     <a href="{{ url('selectlanguage',$lng->id) }}" class="block px-4 py-2 text-sm text-black-700" role="menuitem">
                         <div class="inline-flex items-center">
                             <img alt="Image placeholder" src="{{ asset('upload')}}/{{$lng['image'] }}" class="h-3.5 w-3.5 rounded-full mr-2">
                             {{ $lng->name }}
                         </div>
                     </a>
                 </li>
                 @endforeach
             </ul>
         </div>
     </div>
 </div>