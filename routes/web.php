<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceSPController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\OwnershipController;
use App\Http\Controllers\PerangkatController;
use App\Http\Controllers\RereController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\TemplatePesanController;
use App\Http\Controllers\TenanController;
use App\Http\Controllers\WebHookController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login'])->name('login');
});

Route::get('/home', function () {
    return Redirect('/admin');
});

Route::get('/send-message', function () {
    echo "Sukses";
});

Route::middleware(['auth'])->group(function () {

    Route::controller(AdminController::class)->group(function () {
        // Route::get('/', 'index');
        Route::get('/admin', 'index');
        Route::get('/administrator', 'administrator')->middleware('userAkses:1');
        Route::get('/billing', 'billing')->middleware('userAkses:2');
        Route::get('/collection', 'collection')->middleware('userAkses:3');
        Route::get('/rere1', 'rere1')->middleware('userAkses:4');
        Route::get('/rere2', 'rere2')->middleware('userAkses:5');
        Route::get('/outbox', 'antrian_outbox')->name('outbox');
        Route::get('/outbox/json', 'json_outbox')->name('filter.outbox');;
        // Route::get('/import-ownership', 'ownershipimport')->middleware('userAkses:1');
        // Route::post('/import-ownership', 'import_proses_ownership')->name('admin.import-proses');
    });

    Route::controller(OwnershipController::class)->group(function () {
        Route::get('/ownership', 'index');
        Route::post('importownership', 'ownershipImport')->name('admin.import-proses');
        Route::get('/ownership/getdata', 'getData');
        Route::get('/ownership/getdata/json', 'json');
    });

    Route::controller(PerangkatController::class)->group(function () {
        Route::get('/perangkat', 'index');
        Route::get('/perangkat/json', 'json');
        Route::get('/perangkat/{id}', 'getdetail');
        Route::post('/perangkat/update', 'update');
    });

    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoice', 'index');
        Route::get('/invoice/list', 'tampil');
        Route::post('/invoice/getdata', 'getdata')->name('invoice.getdata');
        Route::get('/invoice/blast', 'prosesBlast');
        Route::post('/invoice/blast/getdata', 'getproses')->name('invoice.blast.getdata');
        Route::get('/invoice/json', 'json');
        Route::post('importinvoice', 'invoiceimport')->name('invoice.import-proses');
    });

    Route::controller(InvoiceSPController::class)->group(function () {
        Route::get('/invoicesp', 'index');
        // Route::get('/invoicesp/{reminde_no}', 'reminder');
        Route::get('/invoicesp/json', 'json');
        Route::post('/importinvoicesp', 'invoicespimport')->name('invoicesp.import-proses');
    });

    Route::controller(BillingController::class)->group(function () {
        Route::get('/billing', 'index');
        Route::get('/billing/json', 'json')->name('filter.invoices');
        Route::post('/billing/import-invoices', 'import')->name('billing.invoice-import');
        // penambahan route di sini untuk outstanding
        Route::post('/billing/import-invoices-outstanding', 'import_outstanding')->name('billing.invoice-import-outstanding');
        Route::get('/billing/json-preview', 'preview')->name('billing.preview');
        Route::get('/billing/kirim-blast-inv', 'proseskirimblast')->name('billing.kirim-blast-inv');
    });

    Route::controller(CollectionController::class)->group(function () {
        Route::get('/collection', 'index');
        Route::get('/collection/json', 'json')->name('filter.collection');
        Route::get('/collection/preview', 'preview')->name('collection.preview');
        Route::get('/collection/kirim-blast-sp', 'proseskirimblastsp')->name('collection.proses-kirim-sp');
        Route::post('/collection/upload', 'upload')->name('collection.upload');
    });

    Route::controller(LaporanController::class)->group(function () {
        Route::get('/laporan', 'index');
        Route::get('/laporan/json', 'json')->name('filter.laporan');
    });

    Route::controller(WebHookController::class)->group(function () {
        Route::get('/setwebhook', 'set_incoming');
    });

    Route::controller(TemplatePesanController::class)->group(function () {
        Route::get('/template', 'index');
        Route::get('/template/json', 'json');
        Route::get('/template/{id}', 'getdetail');
        Route::post('/template/update', 'update');
    });

    // Route::controller(ArtisanController::class)->group(function () {
    //     Route::get('/run-antrian-outbox', 'runArtisanCommand');
    // });

    Route::get('/logout', [SesiController::class, 'logout']);
});
