<div class="relative mt-3 md:ml-0">
    <div class="relative">
        <input wire:model.debounce.500ms="search" type="text" class="bg-gray-800 rounded-full w-64 px-4 py-1" name="search" placeholder="search">
    </div>
    @if(strlen($search)>=1)
        <div class="position-absolute">
            @if($searchResults->count()>0)
                <ul>
                    @foreach($searchResults as $result)
                        <li class="border-b border-gray-700">
                            <a href="{{route('post.show', $result->id)}}"
                               class="black hover:bg-gray-700 px-3 py-3 flex items-center">
                                @foreach(@json_decode($result->image, true) as $img)
                                    <img class="h-25 w-25" src="{{asset('uploads/post/'.$img)}}" alt="">
                                @endforeach
                                <span class="ml-4">{{$result['name']}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">პროდუცტი ვერ მოიძებნა</div>
            @endif
        </div>
    @endif
</div>
