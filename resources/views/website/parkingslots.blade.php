@extends('website.layout.app', ['activePage' => 'parkingslot'])
@section('content')
<div class="pt-10 pb-20 w-full bg-gradient-to-r from-gradient-bg1 to-gradient-bg2 ">
    <div class="xxxxl:pl-[300px] xxxxl:pr-[300px] s:pl-[10px] s:pr-[10px] xxl:pl-[100px] xxl:pr-[100px] xxxl:pr-[150px] xxxl:pl-[150px]">
        <a href="{{url()->previous()}}"><img src="{{asset('website/icon/left-arrow.svg')}}" alt="" class="mb-10"></a>
        <div class="xxxxl:mt-5 max-w-[100%]">
            <div x-data="{activeTab:1,
            activeClass: '!bg-[#3496FF] text-white rounded font-poppins font-normal text-base tracking-wide py-2 px-4',
            inactiveClass : '!bg-white shadow-sm text-[#556987] rounded font-poppins font-normal text-base tracking-wide py-2 px-4'
            }">
                <ul class="flex flex-row flex-wrap gap-4 mb-10" id="tabs-tab" role="tablist">
                    <li>
                        <a href="#" class="activeClass active" x-on:click="activeTab = 0" :class="activeTab === 0 ? activeClass : inactiveClass" aria-current="page">
                            {{__('Tout')}}
                        </a>
                    </li>
                    @foreach($spacezones as $spacezone)
                    <li data-filter=".data{{ $spacezone->id }}" class="w-auto pb-2">
                        <a href="#" x-on:click="activeTab = {{$spacezone->id}}" :class="activeTab === {{$spacezone->id}} ? activeClass : inactiveClass">{{$spacezone->name}}</a>
                    </li>
                    @endforeach
                </ul>

                <div class="xxxxl:mt-6 tab-contents" id="tabs-tabContent">
                    <!-- <h4 class="font-poppins font-semibold text-2xl text-[#404F65] mb-4">{{__('Ground Floor')}}</h4> -->
                    <div class="bg-white shadow-sm w-full pt-8 pr-6 pl-6 rounded-xl mb-10">
                        <div class="grid xxxxl:grid-cols-12 gap-2 s:grid-cols-2 m:grid-cols-3 l:grid-cols-4 sm:grid-cols-5 md:grid-cols-7 lg:grid-cols-9 xl:grid-cols-12">
                            @foreach($spaceslots as $key => $spaceslot)
                            <div x-show="activeTab === {{$spaceslot->zone_id}} || activeTab === 0" class="tab-panes" id="tabs-all" role="tabpanel" aria-labelledby="tabs-all-tab">
                                
                                @if ($booking->contains('slot_id', $spaceslot->id))
                                <div class="border-dashed border-2 border-[#D5DAE1] !h-[145px] rounded p-1 mb-10 relative">
                                    <h5 class="font-poppins font-normal text-base text-[#404F65] text-center mb-2">{{$spaceslot->name}}</h5>
                                    <img src="{{asset('website/image/car1.png')}}" alt="" class="mx-auto w-[44px] h-[77px] object-cover absolute left-0 right-0 bottom-2">
                                </div>
                                @else
                                <form action="{{url('/parkingslot_booking')}}" method="post">
                                    @csrf
                                    <?php
                                    $parkingslot = session()->get('parkingslot');
                                    $parkingspace = session()->get('parkingspace');
                                    ?>
                                    <input type="hidden" name="arriving_time" value="{{session()->has('parkingspace') == true ? $parkingspace['arriving_time'] : '' }}">
                                    <input type="hidden" name="leaving_time" value="{{session()->has('parkingspace') == true ? $parkingspace['leaving_time'] : '' }}">
                                    <input type="hidden" name="slot_id" id="slot_id" value="{{$spaceslot->id}}">
                                    <input type="hidden" name="name" value="{{$spaceslot->name}}">
                                    <input type="hidden" name="price_par_hour" value="{{$spaceslot->price_par_hour}}">
                                    <div class="border-dashed border-2 border-[#D5DAE1] h-[145px] rounded p-1 mb-10 box" id="{{$spaceslot->id}}" name="xyz">
                                        <h5 class="font-poppins font-normal text-base text-[#404F65]  text-center mb-2">{{$spaceslot->name}}</h5>
                                        <div id="{{$spaceslot->id}}" style="display: none;">


                                            <h4 class="font-poppins font-medium text-[#4D5F7A] text-xl text-center mb-1">{{$spaceslot->price_par_hour}}</h4>
                                            @if($spaceslot['available'] == false)
                                            <button type="submit" class="border border-primary rounded text-primary font-poppins font-medium text-lg px-3 py-1 mt-1 ml-3 hover:bg-primary hover:text-white">{{__('Book')}}</button>
                                            @else
                                            <p class="font-poppins font-medium text-base text-dark-orange text-center">{{ __('Indisponible') }}</p>
                                           @endif
                                           <button type="submit" class="border  hidden border-primary rounded text-primary font-poppins font-medium text-lg px-3 py-1 mt-1 ml-3 hover:bg-primary hover:text-white">{{__('Book')}}</button>

                                        </div>
                                    </div>
                                </form>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const items = document.getElementsByName('xyz');
    let previousItem = null;
    items.forEach(item => {
        item.addEventListener('click', () => {
            if (previousItem) {
                previousItem.style.backgroundColor = '';
                previousItem.style.borderColor = '';
                previousItem.children[1].style.display = 'none';
            }
            item.style.backgroundColor = '#EBF5FF';
            item.style.borderColor = '#77B9FF';
            item.children[1].style.display = 'block';
            previousItem = item;
        });
        item.children[1].querySelector('button').addEventListener('click', e => {
            e.stopPropagation();
        });
    });
</script>
@endsection