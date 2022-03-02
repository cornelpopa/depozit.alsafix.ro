<div>
    <div class="d-flex mb-4">
        @forelse($forwarders as $forwarder)
            <button wire:click="setForwarder({{$forwarder->id}})"
                    class="btn btn-lg mr-5
                    @if($selected_forwarder  == $forwarder->id) btn-danger @else btn-primary @endif">
                {{$forwarder->name}}
            </button>
        @empty
            Nu aveți curieri definiți / activi!!!
        @endforelse
    </div>
    <div class="mb-4 font-weight-bold">AWB: {{$selected_tracking_number}}</div>

    <div class="mb-4">
        <input wire:keydown.enter="processScannerRead" wire:model="scanner_read" type="text" class="form-control mb-4" >
    </div>

    <div class="mb-4">
        {{$message}}
    </div>

    <div class="">
        <button wire:click="save(0)" class="btn mr-4 @if($ready) btn-primary @else btn-light-dark @endif">SAVE SI IESIRE NOUA</button>
        <button wire:click="save(1)" class="btn @if($ready) btn-primary @else btn-light-dark @endif">SAVE</button>
    </div>
</div>
