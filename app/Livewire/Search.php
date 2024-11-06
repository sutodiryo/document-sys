<?php

namespace App\Livewire;

use App\Models\File;
use App\Models\Folder;
use Carbon\Carbon;
use Illuminate\Support\Env;
use Livewire\Component;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Url;

// OCR
use Alimranahmed\LaraOCR\Services\OcrAbstract;
use App\Http\Controllers\Controller;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use OCR;

class Search extends Component
{
    use WithFileUploads, LivewireAlert;

    #[Url]

    public $all_folders, $folders, $files, $count, $limit = 20;
    public $query, $search_on = 'all', $link;
    public $filter_folder, $advanced_search, $filter_by_date, $filter_date_start, $filter_date_end;
    public $sort_by, $sort_by_name = "ASC", $sort_by_date = "ASC";
    public $upload_file, $parsed_text, $file_parsed_text = [];

    public $loading = false;

    protected $listeners = ['folders', 'confirmFileDelete', 'onOcrSearchFindData'];

    public function mount()
    {
        $this->query = request()->q;
        $this->filter_folder = request()->filter_folder;
        $this->link = env("APP_URL") . Request::getRequestUri();

        $this->all_folders = Folder::orderBy('created_at')->get();

        $this->filter_folder = request()->folder;
        $this->setTables();
    }


    public function updatedSortByName()
    {
        $this->sort_by = 'name';
        $this->setTables();
    }

    public function updatedSortByDate()
    {
        $this->sort_by = 'created_at';
        $this->setTables();
    }


    public function advancedSearch()
    {
        $this->advanced_search = $this->advanced_search ? false : true;
    }


    public function updatedUploadFile()
    {
        $ocr = app()->make(OcrAbstract::class);
        $this->parsed_text = $ocr->scan($this->upload_file->getPathName());
        $this->loading = true;

        $this->setTables();
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
            })->when($this->search_on == 'ocr', function ($query) {

                $ids = [];
                foreach ($query->get() as $key => $value) {
                    if ($value->attachment) {
                        $file_ext = $value->attachment->file_type;

                        $path =  ($file_ext == 'doc' || $file_ext == 'docx' ||$file_ext == 'pdf' || $file_ext == 'PDF' ||  $file_ext == 'xls' || $file_ext == 'xlsx' || $file_ext == 'pps' || $file_ext == 'ppsx' || $file_ext == 'ppt' || $file_ext == 'pptx') ? storage_path('app/public' . $value->attachment->name) . '.jpg' : storage_path('app/public' . $value->attachment->file);

                        $ocr = app()->make(OcrAbstract::class);
                        $file = $ocr->scan($path);
                        // $this->file_parsed_text[] = $path . ' ----- ' . $file;
                        // $file = file_get_contents($path);

                        // if (strpos($file, $this->parsed_text))
                        if (stripos($file, $this->parsed_text) !== FALSE) {
                            $ids[] = $value->id;
                        }
                    }
                }
                $query->whereIn('id', $ids); // content
                $this->loading = false;

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
            })->where(function ($query) {
                $query->when($this->search_on == 'content', function ($query) {

                    $ids = [];
                    foreach ($query->get() as $key => $value) {
                        // dd($value->attachment->file);
                        if ($value->attachment) {

                            $path = storage_path('app/public/' . $value->attachment->file);

                            $file = file_get_contents($path);
                            // dd($file);

                            if (strpos($file, $this->query)) {
                                $ids[] = $value->id;
                            }
                            // $ids[] = $value->id;

                            // else {
                            //     $str = ["String not found"];
                            // }
                        }
                        // $ids = [$key];

                    }

                    // dd($ids);

                    // $ids = [];
                    $query->whereIn('id', $ids); // content
                });
            })
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

        $this->folders = ($this->search_on == 'file_name' || $this->search_on == 'content' || $this->search_on == 'ocr') ? [] : $folders->get();
        $this->files =  $this->search_on == 'folder_name' ? [] : $files->get();

        $this->count = ($this->search_on == 'file_name' || $this->search_on == 'content' || $this->search_on == 'ocr') ? $files->count() : ($this->search_on == 'folder_name' ? $folders->count() : $folders->count() + $files->count());
    }

    public function render()
    {
        return view('livewire.search');
    }
}
