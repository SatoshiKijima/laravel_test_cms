@vite(['resources/css/app.css', 'resources/js/app.js'])
    <header>
    @include('components.userheader')
    </header>
    

<div class="bg-gray-200 py-8">
  <div class="text-center text-3xl font-bold mb-4">みらいチケット掲示板<br>皆さんから暖かい支援のチケットです</div>
        <form method="POST" action="{{ route('tickets.get') }}">
            @csrf
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-full">取得する</button>
            <div class="container mx-auto px-4 py-8">
                <div class="flex flex-wrap -mx-2">
                    @foreach ($tickets as $ticket)
                        @if ($ticket->area_id == 1 || optional($ticket->prefecture)->pref_name === Auth::user()->pref)
                            @if ($ticket->use == 0)
                            <div class="w-full md:w-1/2 lg:w-1/3 p-2">
                                <div class="bg-white shadow-md rounded-md overflow-hidden relative">
                                    <img src="{{ $ticket->giftcard->image_url }}" alt="{{ $ticket->giftcard->card_name }}" class="h-64 w-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black opacity-75"></div>
                                    <div class="absolute bottom-0 left-0 p-4">
                                        <h2 class="font-bold text-xl text-white mb-2">{{ $ticket->product->product_name }}</h2>
                                        <p class="text-gray-300 text-base">{{ $ticket->gift_sender }}</p>
                                        <p class="text-gray-300 text-base">{{ $ticket->area->pref_name }}</p>
                                        <p class="text-white text-xl">{{ $ticket->product->price }}円</p>
                                    </div>
                                    <div class="p-4 absolute bottom-0 right-0">
                                        <label class="inline-flex items-center">
                                            <span class="ml-2">{{ $ticket->product->product_name }}</span>
                                            <input type="radio" name="ticket_id" value="{{ $ticket->id }}" class="form-radio">
                                        </label>
                                        <a href="{{ route('ticket_show', $ticket) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-full">詳細を見る</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endif
                     @endforeach
                </div>
             </div>
        </form>
</div>

@if(session('ticket'))
    <div class="bg-gray-200 py-8">
        <div class="text-center text-3xl font-bold mb-4">取得済チケット</div>
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-wrap -mx-2">
                <div class="w-full md:w-1/2 lg:w-1/3 p-2">
                    <div class="bg-white shadow-md rounded-md overflow-hidden relative">
                        <img src="{{ session('ticket')->giftcard->image_url }}" alt="{{ session('ticket')->giftcard->card_name }}" class="h-64 w-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black opacity-75"></div>
                        <div class="absolute bottom-0 left-0 p-4">
                            <h2 class="font-bold text-xl text-white mb-2">{{ session('ticket')->product->product_name }}</h2>
                            <p class="text-gray-300 text-base">{{ session('ticket')->gift_sender }}</p>
                            <p class="text-gray-300 text-base">{{ session('ticket')->area->pref_name }}</p>
                            <p class="text-white text-xl">{{ session('ticket')->product->price }}円</p>
                        </div>
                        <div class="p-4 absolute bottom-0 right-0">
                            <a href="{{ route('myticket.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-full">マイチケットへ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
        