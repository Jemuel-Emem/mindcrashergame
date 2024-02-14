<div>
    <div class="flex justify-between">
      <div>
        <i class="ri-copper-diamond-fill text-green-700 md:text-4xl text-xl"></i>
        <label for="" class="font-black md:text-4xl text-xl text-green-500">{{ auth()->user()->coins1 + auth()->user()->coins2  + auth()->user()->coins3}} </label>
      </div>
      @if (auth()->user()->totalcoins >=0 && auth()->user()->totalcoins < 50)
      <div>
        <img src="{{ asset('images/warrior.png') }}" alt="Violation Photo" class="md:w-20 w-12  md:h-20 ">
      </div>
      @endif

      @if (auth()->user()->totalcoins >=50)
      <div>
        <img src="{{ asset('images/elite.png') }}" alt="Violation Photo" class="md:w-20 w-12  md:h-20 ">
      </div>
      @endif

    </div>
   <div class="p-20 relative">
    <div class="md:absolute none right-30 md:left-80 ">
        <div class="flex flex-col">
            <label for="" class="text-bermuda font-black md:text-4xl text-lg text-center" >ARE YOU READY TO BREAK YOUR MIND?</label>
           <div class="flex justify-center">
            <img src="{{ asset('images/logonamon.gif') }}" alt="Violation Photo" class="md:w-80 md:h-80 md:mt-2">
        </div>
           </div>

    </div>
     <div class="flex  md:justify-end justify-center md:mt-0 mt-10">
        <span class="flex flex-col gap-4">
        <a href="{{ route('easy') }}"><button class="text-white p-2  rounded bg-green-400 hover:bg-green-500 w-72 h-16" >Easy</button></a>
       <a href="{{ route('medium') }}"> <button class="text-white p-2  rounded bg-blue-400 hover:bg-blue-500 w-72 h-16">Medium</button></a>
       <a href="{{ route('hard') }}"> <button  class="text-white p-2  rounded bg-amber-400  hover:bg-amber-500 w-72 h-16">Hard</button></a>
        </span>
     </div>
   </div>
</div>
