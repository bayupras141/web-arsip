<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use DataTables;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Surat::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteData">Delete </a>';
                    $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Unduh" class="edit btn btn-warning btn-sm unduhData">Unduh</a>';
                    $btn = $btn. ' <a href="/lihat/'.$row->id.'" data-toggle="tooltip"  data-original-title="Lihat" class="btn btn-info btn-sm ">Lihat </a>';

                        
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
       return view('surat.index');
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nomor_surat' => 'required',
            'kategori' => 'required',
            'judul' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ]);
        
        $surat = Surat::updateOrCreate(
            ['id' => $request->data_id],
            [
                'nomor_surat' => $request->nomor_surat,
                'kategori' => $request->kategori,
                'judul' => $request->judul,
                'file' => $request->file('file')->store('public/files'),
                
            ]
        );

        if(!$request->data_id == ''){
            return response()->json([
                'status' => 'sukses',
                'message'=>'Data berhasil Diubah'
            ],200);
        } else {
            return response()->json([
                'status' => 'sukses',
                'message'=>'Data berhasil Diarsipkan'
            ],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function show(Surat $surat)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function edit(Surat $surat)
    {
        return response()->json($surat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Surat $surat)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Surat  $surat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surat $surat)
    {
        $surat->delete();
        return response()->json([
            'status' => 'sukses',
            'message'=>'Arsip berhasil Dihapus'
        ],200);
    }

    public function about()
    {
        return view('about');
    }

    // unduh file pdf

    public function unduh($id)
    {
        $surat = Surat::find($id);
        return response()->download(storage_path('app/'.$surat->file));
    }

    // lihat data
    public function lihat($id)
    {
        $data = Surat::find($id);
        return view('surat.lihat', compact('data'));;
    }
}
