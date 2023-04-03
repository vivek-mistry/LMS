<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class ActivityComponent extends Component
{
    use WithPagination;

    public $searchItem;

    public function render()
    {
        $activity = Activity::with(['causer'])->where(function($sub_query){
            $sub_query->where('description', 'like', '%'.$this->searchItem.'%');
        })->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.activity-component', ['activity' => $activity])->layout('livewire.layout.master');
    }
}
