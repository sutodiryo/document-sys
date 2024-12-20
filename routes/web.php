<?php

use App\Http\Controllers\Controllers\HomeController;
use App\Livewire\Dashboard;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MenuController;
use App\Livewire\Folder\Index as FolderIndex;
use App\Livewire\File\Index as FileIndex;
use App\Livewire\File\Edit as FileEdit;
use App\Livewire\File\View as FileView;
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
use App\Livewire\HomePage;
use App\Livewire\Search;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');


// Public link
Route::group(['prefix' => '/public', 'as' => 'public.'], function () {
    // File
    Route::get('public/{id}', [FileController::class, 'share_by_link'])->name('share.files');
    Route::get('public/{id}', [FileController::class, 'share_by_link'])->name('share.files');
    Route::get('file/dowload/{id}', [FileController::class, 'download'])->name('download.files');
    Route::get('file/preview/{id}', [FileController::class, 'preview'])->name('preview.files');
    Route::get('file/approval/{id}', Approval::class)->name('approval.files');

    Route::get('ext/{id}', [FileController::class, 'file_preview'])->name('ext.preview.files'); // existing preview file for api call
    Route::get('tmp/{file}', [FileController::class, 'tmp_preview'])->name('tmp.preview.files'); // temporary preview file for api call
    Route::get('airslate-pdf/{id}', [FileController::class, 'file_edit_airslate'])->name('ext.edit.files'); // existing edit file

    // Folder
    Route::get('approval/folder/{id}', FolderApproval::class)->name('approval.folder');
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified']], function () {

    Route::get('file/preview/{id}', [FileController::class, 'preview_admin'])->name('admin.preview.file');

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
        Route::get('view-online/', FileView::class)->name('view');
        Route::get('convert-jpg/{id}', [FileController::class, 'convertJPG'])->name('convert.jpg');

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
