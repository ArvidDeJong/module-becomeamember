<?php

namespace Darvis\ModuleBecomeamember\Livewire;

use Livewire\Component;
use \Darvis\ModuleBecomeamember\Models\Becomeamember;
use Darvis\Manta\Traits\SortableTrait;
use Darvis\Manta\Traits\WithSortingTrait;
use Livewire\WithPagination;
use Darvis\Manta\Traits\MantaTrait;

class BecomeamemberList extends Component
{

    use BecomeamemberTrait;
    use WithPagination;
    use SortableTrait;
    use MantaTrait;
    use WithSortingTrait;

    public function mount()
    {
        $this->sortBy = 'created_at';
        $this->sortDirection = 'DESC';
        $this->getBreadcrumb();
    }

    public function render()
    {
        $this->trashed = count(Becomeamember::whereNull('pid')->onlyTrashed()->get());

        $obj = Becomeamember::whereNull('pid');
        if ($this->tablistShow == 'trashed') {
            $obj->onlyTrashed();
        }
        $obj = $this->applySorting($obj);
        $obj = $this->applySearch($obj);
        $items = $obj->paginate(50);
        return view('module-becomeamember::livewire.becomeamember-list', ['items' => $items])->title($this->config['module_name']['multiple']);
    }
}
