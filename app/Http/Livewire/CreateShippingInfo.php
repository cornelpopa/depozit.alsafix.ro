<?php

namespace App\Http\Livewire;

use App\Dispatch;
use App\Forwarder;
use App\ShippingInfo;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CreateShippingInfo extends Component
{

    public Dispatch $dispatch;
    public ShippingInfo $shipping_info;
    public Collection $forwarders;
    public string $scanner_read, $selected_tracking_number, $message;
    public int $selected_forwarder;
    public bool $ready;

    public function mount()
    {
        $this->forwarders = Forwarder::where('is_active', true)
                                     ->orderBy('name')
                                     ->get();
        $this->scanner_read = "";

        if ($this->shipping_info->id) {
            $this->selected_tracking_number = $this->shipping_info->tracking_number;
            $this->selected_forwarder = $this->shipping_info->forwarder_id;
        }
        $this->selected_forwarder = 0;
        $this->ready = false;
        $this->message = "";
    }

    public function setForwarder($forwarder_id)
    {
        $this->selected_forwarder = $forwarder_id;
    }

    public function processScannerRead()
    {

        $searchFw = Forwarder::where('barcode', 'LIKE', $this->scanner_read)
                             ->first();
        if ($searchFw) {
            $this->selected_forwarder = $searchFw->id;
        } else {
            $this->selected_tracking_number = $this->scanner_read;
        }

        $searchFw = Forwarder::where('scan_length', '=', strlen($this->scanner_read))
                             ->firstOr(function () {
                                 return null;
                             });
        if ($searchFw) {
            $this->selected_forwarder = $searchFw->id;
        }

        $this->scanner_read = "";

        if ($this->selected_forwarder > 0 and strlen($this->selected_tracking_number)) {
            $this->processLongScan($this->selected_forwarder, $this->selected_tracking_number);
            $this->ready = true;
        }


    }

    public function save(bool $back_to_dispatch)
    {
        if ( ! $this->ready) {
            return false;
        }

        $this->shipping_info->forwarder_id = $this->selected_forwarder;
        $this->shipping_info->tracking_number = $this->selected_tracking_number;
        $this->shipping_info->phone = $this->dispatch->phone;
        $this->shipping_info->sms_text = $this->message;
        $this->shipping_info->sending_time = now()->addHour();
        $this->dispatch->shipping_info()
                       ->save($this->shipping_info);

        //dd($this->shipping_info);

        if($back_to_dispatch) {
            return redirect()->route('dispatches.show', $this->dispatch);
        }

        return redirect()->route('dispatches.create');

    }

    public function render()
    {

        if ($this->selected_forwarder > 0) {
            $fw = $this->forwarders->firstWhere('id', '=', $this->selected_forwarder)->name;
        } else {
            $fw = " NullFW ";
        }

        $awb = $this->selected_tracking_number ?? " NullAWB ";

        $this->message = "Stimate Partener, Alsafix a livrat azi comanda ta numarul ".($this->dispatch->name)." cu $fw AWB nr ".$awb.".";

        return view('livewire.create-shipping-info');
    }

    private function processLongScan($selected_forwarder, string $selected_tracking_number)
    {
        $forwarder = Forwarder::find($selected_forwarder);
        if($forwarder->limits)
        {
            $limits = explode("-", $forwarder->limits, 2);
            if(count($limits) != 2) dd($limits);
            if(intval($limits[0]>=intval($limits[1]))) dd($limits);
            $this->selected_tracking_number = substr($selected_tracking_number, $limits[0], $limits[1]);
        }

    }
}
