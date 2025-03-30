<?php

namespace App\Http\Controllers;
use App\Models\ContentAlurPendaftaran;
use App\Models\ContentAlurPenyerahan;
use App\Models\ContentImageInformasi;
use App\Models\ContentImageSyarat;
use App\Models\ContentInformasiPelayanan;
use App\Models\ContentSyaratPendaftaran;
use App\Models\ContentWeb;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use SEOMeta;
use OpenGraph;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // SEO Configuration
        SEOMeta::setTitle('PSB Pondok Pesantren Al-Qodiri Jember');
        SEOMeta::setDescription('Website Resmi Penerimaan Santri Baru Pondok Pesantren Al-Qodiri Jember');
        SEOMeta::addKeyword(['Pondok Pesantren Al-Qodiri', 'Pendaftaran Santri Baru', 'Pesantren Jember', 'Pendidikan Islam']);

        OpenGraph::setTitle('PSB Pondok Pesantren Al-Qodiri Jember');
        OpenGraph::setDescription('Website Resmi Penerimaan Santri Baru');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addImage(asset('assets/images/img/logo_aqj.png'));



        $dataGeneral = ContentWeb::first();
        $dataAlurPendaftaran = ContentAlurPendaftaran::getAllDataAlurPendaftaran();
        $dataSyaratPendaftaran = ContentSyaratPendaftaran::getAllDataSyaratPendaftaran();
        $dataAlurPenyerahan = ContentAlurPenyerahan::getAllDataAlurPenyerahan();
        $dataInformasiPelayanan = ContentInformasiPelayanan::first();
        $dataImageSyaratPendaftaran = ContentImageSyarat::first();
        $dataImageInformasiPelayanan = ContentImageInformasi::first();
        return view('Client.index', compact('dataImageInformasiPelayanan', 'dataImageSyaratPendaftaran', 'dataGeneral', 'dataAlurPendaftaran', 'dataSyaratPendaftaran', 'dataAlurPenyerahan', 'dataInformasiPelayanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
