<?php

use App\Livewire\Dashboard;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MenuController;
use App\Livewire\Folder\Index as FolderIndex;
use App\Livewire\File\Index as FileIndex;
use App\Livewire\File\Edit as FileEdit;
use App\Http\Controllers\ProfileController;
use App\Livewire\Account\AccessOverview;
use App\Livewire\Account\AccessOverviewIndex;
use App\Livewire\Account\PasswordPolicyIndex;
use App\Livewire\Account\User;
use App\Livewire\Account\UserGroup;
use App\Livewire\AuditLog;
use App\Livewire\File\Approval;
use App\Livewire\Metadata\Index as MetadataIndex;
use App\Livewire\RecycleBin;
use App\Livewire\Folder\Approval as FolderApproval;
use App\Livewire\Search;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome')->name('home');
});

// Public link

Route::group(['prefix' => '/public', 'as' => 'public.'], function () {
    // File
    Route::get('public/{id}', [FileController::class, 'share_by_link'])->name('share.files');
    Route::get('file/dowload/{id}', [FileController::class, 'download'])->name('download.files');
    Route::get('file/preview/{id}', [FileController::class, 'preview'])->name('preview.files');
    Route::get('file/approval/{id}', Approval::class)->name('approval.files');
    // Folder
    Route::get('approval/folder/{id}', FolderApproval::class)->name('approval.folder');
    //     Route::get('folder/view/', [ResolutionController::class, 'folder'])->name('folder.view');
    //     Route::post('folder/store', [ResolutionController::class, 'folder_store'])->name('folder.store');
    //     Route::post('document/view', [ResolutionController::class, 'document_view'])->name('document.view');
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified']], function () {
    // Route::get('/', Dashboard::class)->name('home');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::group(['prefix' => '/menu', 'as' => 'menu.'], function () {
        Route::post('/section-store', [MenuController::class, 'section_store'])->name('section.store');
        Route::get('/section-name-check', [MenuController::class, 'check_folder_name'])->name('section.check_name');
    });

    Route::get('/search', Search::class)->name('search');


    Route::group(['prefix' => '/folder', 'as' => 'folder.'], function () {
        Route::get('/', FolderIndex::class)->name('index');
    });

    Route::group(['prefix' => '/file', 'as' => 'file.'], function () {
        Route::get('/', FileIndex::class)->name('index');
        Route::get('edit/', FileEdit::class)->name('edit');

        Route::group(['prefix' => '/mail', 'as' => 'mail.'], function () {
            Route::post('share/{id}', [EmailController::class, 'SendShareFileEmail'])->name('share');
            Route::post('approval/{id}', [EmailController::class, 'SendApprovalFileEmail'])->name('approval');
        });
    });

    Route::group(['prefix' => '/account', 'as' => 'account.'], function () {
        Route::get('/users', User::class)->name('users');
        Route::get('/user-groups', UserGroup::class)->name('user.group');
        Route::get('/access-overview', AccessOverviewIndex::class)->name('access.overview');
        Route::get('/password-policy', PasswordPolicyIndex::class)->name('password.policy');
    });

    Route::group(['prefix' => '/meta', 'as' => 'meta.'], function () {
        Route::get('/', MetadataIndex::class)->name('index');
    });

    Route::get('/audit', AuditLog::class)->name('audit-log');

    Route::get('/recycle-bin', RecycleBin::class)->name('recycle-bin');
});

require __DIR__ . '/auth.php';
