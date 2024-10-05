<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Livewire\Attributes\Lazy;

#[Lazy]
/**
 * Class LivewireTableComponent
 */
class LivewireTableComponent extends DataTableComponent
{
    protected bool $columnSelectStatus = false;

    public bool $showFilterOnHeader = false;

    public bool $paginationIsEnabled = false;

    public bool $paginationStatus = true;

    public bool $sortingPillsStatus = false;

    protected $listeners = ['refresh' => '$refresh'];

    public string $emptyMessage = 'No data available in table';

    // for table header button
    public bool $showButtonOnHeader = false;

    public string $buttonComponent = '';

    public function configure(): void
    {
        // TODO: Implement configure() method.
    }

    public function columns(): array
    {
        // TODO: Implement columns() method.
    }

    public function refreshDataTable()
    {
        $this->dispatch('refresh');
    }

    public function updatedPerPage($value): void
    {
        if (! in_array($value, $this->getPerPageAccepted(), false)) {
            $value = $this->setPerPage($this->getPerPageAccepted()[0] ?? 10);
        }

        $this->resetComputedPage();
    }
    /**
     * @throws DataTableConfigurationException
     */
    // public function mountWithPagination(): void
    // {
    //     if ($this->getPerPage()) {
    //         $this->getPerPageAccepted()[] = -1;
    //     }

    //     $this->setPerPage($this->getPerPageAccepted()[0] ?? 10);
    // }

    // public function resetPage($pageName = 'page'): void
    // {
    //     $rowsPropertyData = $this->getRows()->toArray();
    //     if ($this->searchStatus) {
    //         $prevPageNum = 0;
    //     } else {
    //         $prevPageNum = $rowsPropertyData['current_page'] - 1;
    //     }
    //     $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
    //     $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

    //     $this->setPage($pageNum, $pageName);
    // }
}
