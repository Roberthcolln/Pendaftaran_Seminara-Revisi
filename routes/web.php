<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;

use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\KategoriKegiatanController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\DaftarKegiatanController;
use App\Http\Controllers\DaftarKegiatanUserController;
use App\Http\Controllers\dashboardContoller;
use App\Http\Controllers\SubKategoriKegiatanController;
use App\Http\Controllers\KategoriAnggotaController;
use App\Http\Controllers\HomeWebController;
use App\Http\Controllers\KirmEmailController;
use App\Http\Controllers\KuponController;
use App\Http\Controllers\ListPembayaranController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PresensiPesertaController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\ReservasiUserController;
use App\Http\Controllers\BuktiController;
use App\Http\Controllers\BuktiUserController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\SendEmailController;
use App\Models\Kupon;
use App\Models\Reservasi;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', [KirmEmailController::class, 'index']);
Route::get('/', [HomeWebController::class, 'index'])->name('home');

Route::resource('reservasi', ReservasiController::class);
Route::resource('reservasi_user', ReservasiUserController::class);
Route::resource('home', HomeWebController::class);

Route::get('invoice/{id}', [DaftarKegiatanController::class, 'invoice'])->name('invoice');
Route::get('payment/{id}', [ReservasiController::class, 'store'])->name('payment');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard.index');
    Route::resource('setting', SettingController::class);
    Route::resource('welcome', HomeWebController::class);

   
    Route::resource('order', OrderController::class);
    Route::resource('kategori_kegiatan', KategoriKegiatanController::class);
    Route::resource('sub_kategori_kegiatan', SubKategoriKegiatanController::class);
    Route::resource('kegiatan', KegiatanController::class);
    Route::resource('daftar_kegiatan', DaftarKegiatanController::class);
    Route::resource('daftar_kegiatan_user', DaftarKegiatanUserController::class);
    Route::resource('kategori_anggota', KategoriAnggotaController::class);
    Route::resource('list_pembayaran', ListPembayaranController::class);
    Route::resource('dashboard', dashboardContoller::class);
    Route::resource('kupon', KuponController::class);
    Route::resource('paket', PaketController::class);
    Route::resource('bukti', BuktiController::class);
    Route::resource('bukti_user', BuktiUserController::class);
    Route::resource('metode', MetodePembayaranController::class);


    Route::get('/finish', 'Order@finish')->name('midtrans.finish');
    Route::get('/unfinish', 'Order@unfinish')->name('midtrans.unfinish');
    Route::get('/get-potongan-harga/{kodeKupon}/{idPaket}', 'HomeWebController@getPotonganHarga');



    Route::resource('presensi_peserta', PresensiPesertaController::class);
    Route::get('order/succes', [OrderController::class, 'succes'])->name('order.succes');
    Route::post('/mistrans-callback', [OrderController::class, 'callback'])->name('midtrans.callback');
    
    Route::post('api/fetch-kegiatan', [SubKategoriKegiatanController::class, 'fetchKegiatan']);
    Route::post('api/fetch-paket', [KuponController::class, 'fetchPaket']);
    Route::post('api/fetch-package', [HomeWebController::class, 'fetchPackage']);
});
