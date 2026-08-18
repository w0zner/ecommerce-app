<div class="bg-white py-12">
    <x-container class="flex">
        <aside class="w-52 flex-shrink-0">
            <ul>
                @dump($options)  
                @foreach($options as $option)
                
                    <li class="mb-2">
                        {{ $option->name }}
                        <ul>
                            @foreach($option->features as $feature)
                                <li class="mb-2">
                                    {{ $feature->name }}
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </aside>
        <div class="flex-1">

        </div>
    </x-container>
</div>
