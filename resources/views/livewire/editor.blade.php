<div >
    <div id="page">
        <h2>{{ $page->name }}</h2>
    </div>
    <div class="border-2 border-blue" id="blocks">
        @if($blocks !== null)
            @foreach($blocks as $block)
                <livewire:block :$block :key="$block->id" />
            @endforeach
        @endif
    </div>
    <button wire:click="addBlock" class="button">+</button>

</div>
