@extends('website.layout.app', ['activePage' => 'faq'])
@section('content')
<div class="pt-10 pb-10 h-screen xxxxl:pl-[300px] xxxxl:pr-[300px] s:pl-[10px] s:pr-[10px] xxl:pl-[100px] xxl:pr-[100px] xxxl:pr-[150px] xxxl:pl-[150px] bg-gradient-to-r from-gradient-bg1 to-gradient-bg2">
<h5 class="font-poppins font-semibold text-[#404F65] text-2xl mb-10">{{__('FAQ')}}</h5>
    <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
        @foreach($faq as $item)
        <div class="bg-white rounded-[8px] shadow p-4 mb-5">
            <h2 id="accordion-color-heading-{{$item->id}}">
                <button type="button" class="flex items-center justify-between w-full font-medium text-left" data-accordion-target="#accordion-color-body-{{$item->id}}" aria-expanded="false" aria-controls="accordion-color-body-{{$item->id}}">
                    <span class="font-poppins font-medium text-[#404F65] text-xl">{{$item->question}}</span>
                    <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </h2>
            <div id="accordion-color-body-{{$item->id}}" class="hidden mt-5" aria-labelledby="accordion-color-heading-{{$item->id}}">
                <div>
                    <p class="font-poppins font-normal text-gray text-lg">{{$item->answer}}</p>                   
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection