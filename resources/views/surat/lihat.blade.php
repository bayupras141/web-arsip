@extends('layouts.app')
@section('title', 'Lihat Arsip Surat')
@section('content')
{{-- card --}}
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="col-lg-2">
            <br>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h1>Arsip Surat >> Lihat</h1>
                        <h5><b>Nomor : {{$data->nomor_surat}}</b></h5>
                        <h5><b>Judul : {{$data->judul}}</b></h5>
                        <h5><b>Kategori : {{$data->kategori}}</b></h5>
                        <h5><b>Waktu Pengarsipan : {{$data->waktu_pengarsipan}}</b></h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <iframe src="{{ Storage::url($data->file) }}" frameBorder="0" scrolling="auto" height="600px" width="100%" ></iframe>
                    </div>
                </div>
            </div>
            {{-- btn edit --}}
            <div class="col-lg-12 col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <a href="/" class="btn btn-danger btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Kembali</span>
                        </a>
                        <a href="/unduh/{{$data->id}}" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-download"></i>
                            </span>
                            <span class="text">Unduh</span>
                        </a>
                        <a href="javascript:void(0)" data-id="{{$data->id}}" class="btn btn-primary btn-icon-split editData">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">Edit</span>
                        </a>
                    </div>
                </div>

        </div>
    </div>
</div>
{{-- end card --}}


<!-- Modal -->
<div class="modal fade text-left" id="modalBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeading">Arsipkan Surat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="dataForm" name="dataForm" class="dataForm form-horizontal" enctype="multipart/form-data">
                    <!-- validator -->
                    <ul class="list-group" id="errors-validate">
                    </ul>
                    <!-- end -->
                
                    <input type="hidden" name="data_id" id="data_id">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Nomor Surat</label>
                        <input type="text" class="form-control dt-full-name required" id="nomor_surat" name="nomor_surat" required="">
                    </div>
                    {{-- Kategori --}}
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Kategori</label>
                        <select class="form-control" name="kategori" id="kategori">
                            <option value="Undangan">Undangan</option>
                            <option value="Pengumuman">Pengumuman</option>
                            <option value="Nota Dinas">Nota Dinas</option>
                            <option value="Pemberitahuan">Pemberitahuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">Judul</label>
                        <input type="text" id="judul" class="form-control dt-post required" name="judul">
                    </div>
                    {{-- file pdf --}}
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">File Surat (PDF)</label>
                        <input type="file" id="file" class="form-control dt-post" name="file">
                    </div>
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cencel</button>
                        <button type="submit"  id="saveBtn" class="btn btn-primary" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal --> 
@endsection

@push('scripts')
    <script src="{{ asset('app-assests/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assests/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assests/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('app-assests/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
    <script src="{{ asset('app-assests/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('app-assests/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script>
        // start
        
        $(document).ready(function($){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            // show modal
            $('#createNewData').click(function () { 
                $('#saveBtn').val("create-data");
                $('#data_id').val('');
                $('#dataForm').trigger("reset");
                $('#modalHeading').html("Tambah Data");
                $('#modalBox').modal('show');
                $("#errors-validate").hide();
                $('#saveBtn').prop('disabled', false);
            });

            
            // store process
            $('#dataForm').submit(function(e) {
                e.preventDefault();  
                var formData = new FormData(this);
            
                $.ajax({
                    type:'POST',
                    url: "{{route('surat.store')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                      if(data.status == 'sukses'){
                            $('#modalBox').modal('hide');
                            Swal.fire("Selamat", data.message , "success");
                            $('#dataForm').trigger("reset");
                            table.draw();
                        }else{
                            $('#message-error').html(data.message).show()
                        }
                    },
                    error: function (data) {
                      console.log('Error:', data);
                      $('#saveBtn').html('Save');
                  }
                });
            });

            // edit data
            $('body').on('click', '.editData', function () {
                var data_id = $(this).data('id');
                $.get("{{ route('surat.index') }}" +'/' + data_id +'/edit', function (data) {
                    $('#modalHeading').html("Edit Data");
                    $('#saveBtn').val("edit-data");
                    $('#modalBox').modal('show');
                    $("#errors-validate").hide();
                    $('#saveBtn').prop('disabled', false);
                    $('#data_id').val(data.id);
                    $('#nomor_surat').val(data.nomor_surat);
                    $('#kategori').val(data.kategori);
                    $('#judul').val(data.judul);
                    $('#file').val(data.file);

                })
            });


        });
    </script>
@endpush