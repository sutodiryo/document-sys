<?php

namespace App\Livewire;

use App\Models\File;
use App\Models\Folder;
use Carbon\Carbon;
use Illuminate\Support\Env;
use Livewire\Component;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Url;

class Search extends Component
{
    #[Url]

    public $all_folders, $folders, $files, $count, $limit = 20;
    public $query, $search_on = 'all', $link;
    public $filter_folder, $advanced_search, $filter_by_date, $filter_date_start, $filter_date_end;
    public $sort_by, $sort_by_name = "ASC", $sort_by_date = "ASC";

    protected $listeners = ['folders', 'confirmFileDelete'];

    public function mount()
    {
        // dd(env("APP_URL") . Request::getRequestUri());
        $this->query = request()->q;
        $this->filter_folder = request()->filter_folder;
        $this->link = env("APP_URL") . Request::getRequestUri();

        $this->all_folders = Folder::orderBy('created_at')->get();

        $this->filter_folder = request()->folder;
        $this->setTables();
    }

    public function updated($property, $value)
    {
        if ($property == 'sort_by_name') {
            $this->sort_by = 'name';
        } elseif ($property == 'sort_by_date') {
            $this->sort_by = 'created_at';
        }
        $this->setTables();
    }

    public function advancedSearch()
    {
        $this->advanced_search = $this->advanced_search ? false : true;
    }

    public function setTables()
    {
        $folders = Folder::where(function ($query) {
            $query->when($this->search_on == 'all', function ($query) {
                $query->where('name', 'like', '%' . $this->query . '%')
                    ->orWhere('description', 'like', '%' . $this->query . '%');
            });
        })
            ->where(function ($query) {
                $query->when($this->search_on == 'folder_name', function ($query) {
                    $query->where('name', 'like', '%' . $this->query . '%');
                });
            })
            ->where(function ($query) {
                $query->when($this->search_on == 'metadata', function ($query) {
                    $query->whereHas('metadatas', function ($query) {
                        $query->where('name', 'like', '%' . $this->query . '%')
                            ->orWhere('value', 'like', '%' . $this->query . '%');
                    });
                });
            })->where(function ($query) {
                $query->when($this->search_on == 'notes', function ($query) {
                    $query->where('description', 'like', '%' . $this->query . '%'); // description
                });
            })
            // where('name', 'like', '%' . $this->query . '%')
            ->when(!empty($this->filter_folder), function ($query) {
                $query->where('parent_id', $this->filter_folder);
            })
            ->when(!empty($this->sort_by), function ($query) {
                if ($this->sort_by == 'name') {
                    $query->orderBy($this->sort_by, $this->sort_by_name);
                } elseif ($this->sort_by == 'created_at') {
                    $query->orderBy($this->sort_by, $this->sort_by_name);
                }
            })
            ->when(!empty($this->filter_date_start) || !empty($this->filter_date_end), function ($query) {
                $from = Carbon::parse($this->filter_date_start)->format('Y-m-d');
                $to = Carbon::parse($this->filter_date_end)->format('Y-m-d');

                $query->whereBetween('created_at', [$from, $to]);
            });


        $files = File::where(function ($query) {
            $query->when($this->search_on == 'all', function ($query) {
                $query->where('name', 'like', '%' . $this->query . '%')
                    ->orWhere('description', 'like', '%' . $this->query . '%');
            });
        })
            ->where(function ($query) {
                $query->when($this->search_on == 'file_name', function ($query) {
                    $query->where('name', 'like', '%' . $this->query . '%');
                });
            })
            ->where(function ($query) {
                $query->when($this->search_on == 'metadata', function ($query) {
                    $query->whereHas('metadatas', function ($query) {
                        $query->where('name', 'like', '%' . $this->query . '%')
                            ->orWhere('value', 'like', '%' . $this->query . '%');
                    });
                });
            })->where(function ($query) {
                $query->when($this->search_on == 'notes', function ($query) {
                    $query->where('description', 'like', '%' . $this->query . '%'); // description
                });
            })
            // where('name', 'like', '%' . $this->query . '%')
            ->when(!empty($this->filter_folder), function ($query) {
                $query->where('folder_id', $this->filter_folder);
            })
            ->when(!empty($this->sort_by), function ($query) {
                if ($this->sort_by == 'name') {
                    $query->orderBy($this->sort_by, $this->sort_by_name);
                } elseif ($this->sort_by == 'created_at') {
                    $query->orderBy($this->sort_by, $this->sort_by_name);
                }
            })
            ->when(!empty($this->filter_by_date) || !empty($this->filter_date_end), function ($query) {
                $from = Carbon::parse($this->filter_date_start)->format('Y-m-d');
                $to = Carbon::parse($this->filter_date_end)->format('Y-m-d');

                $query->whereBetween('created_at', [$from, $to]);
            });

        $this->folders = $this->search_on == 'file_name' ? [] : $folders->get();
        $this->files =  $this->search_on == 'folder_name' ? [] : $files->get();

        $this->count = $folders->count() + $files->count();
    }

    // public function getLabelListingsProperty()
    // {
    // return Bidding::when(!empty($this->sortSelected), function ($query) {
    //     $query->where(function ($query) {
    //         $query->when($this->sortFieldSelected == 'ccow_id', function ($query) {
    //             array_key_exists('ccow_id', $this->sortSelected) ? $query->whereIn('ccow_id', $this->sortSelected['ccow_id']) : '';
    //         });
    //         $query->when($this->sortFieldSelected == 'business_entity_id', function ($query) {
    //             array_key_exists('business_entity_id', $this->sortSelected) ? $query->whereIn('business_entity_id', $this->sortSelected['business_entity_id']) : '';
    //         });

    //     });
    // })
    //     ->when(!empty($this->searchCcow), function ($query) {
    //         $query->whereHas('ccow', function ($query) {
    //             $query->where('company_name', 'like', '%' . $this->searchCcow . '%');
    //         });
    //     })
    //     ->when(!empty($this->searchCompanyName), function ($query) {
    //         $query->where('company_name', 'like', '%' . $this->searchCompanyName . '%');
    //     })
    //     ->when(!empty($this->searchCompanyAddress), function ($query) {
    //         $query->where('address', 'like', '%' . $this->searchCompanyAddress . '%');
    //     })
    //     ->when(!empty($this->searchCompanySites), function ($query) {
    //         $query->where('company_site', 'like', '%' . $this->searchCompanySites . '%');
    //     })
    //     ->when(!empty($this->searchCompanyBusinessLicenseNumber), function ($query) {
    //         $query->where('license_number', 'like', '%' . $this->searchCompanyBusinessLicenseNumber . '%');
    //     })
    //     ->when(!empty($this->searchCompanyParent), function ($query) {
    //         $query->whereHas('parent_company', function ($query) {
    //             $query->where('company_name', 'like', '%' . $this->searchCompanyParent . '%');
    //         });
    //     })
    //     ->when(!empty($this->searchPIC), function ($query) {
    //         $query->where('person_in_charge', 'like', '%' . $this->searchPIC . '%');
    //     })
    //     ->where('maker_id', Auth::user()->id)
    //     ->where('criteria', CsmsStatus::Bidding)
    //     ->where('status', CsmsStatus::Approved)
    //     ->where('requested', CsmsStatus::Approved)
    //     ->where('published', CsmsStatus::Publish)
    //     ->orderBy($this->sortField, $this->sortType)
    //     ->paginate($this->limit);
    // }

    public function render()
    {
        return view('livewire.search');
    }
}