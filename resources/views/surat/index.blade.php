@extends('layouts.app')
@section('title', 'Web Arsip Surat')
@section('content')
{{-- card --}}
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="col-lg-2">
            <br>
            <button id="createNewData" class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" >
                Arsipkan Surat
            </button>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            <table class="data-table table table-sm table-bordered table-striped" id="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nomor Surat</th>
                        <th>Kategori</th>
                        <th>Judul</th>
                        <th>Waktu Pengarsipan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
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
                        <input type="file" id="file" class="form-control dt-post required" name="file">
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

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('surat.index') }}",
                    "type": "GET",
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'nomor_surat', name: 'nomor_surat'},
                    {data: 'kategori', name: 'kategori'},
                    {data: 'judul', name: 'judul'},
                    {data: 'waktu_pengarsipan', name: 'waktu_pengarsipan'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
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


            // download file ajax
            $('body').on('click', '.unduhData', function () {
                var data_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "/unduh/"+data_id,
                    data: {data_id:data_id},

                    xhrFields: {
                        responseType: 'blob'
                    },
                    
                    success: function (data) {
                        var a = document.createElement('a');
                        var url = window.URL.createObjectURL(data);
                        a.href = url;
                        a.download = data_id;
                        a.click();
                        window.URL.revokeObjectURL(url);

                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

            // lihat halaman
            $('body').on('click', '.lihatData', function () {
                var data_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "/lihat/"+data_id,
                    data: {data_id:data_id},
                    success: function (data) {
                        
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

            // delete
            $('body').on('click', '.deleteData', function () {
                var data_id = $(this).data("id");
                Swal.fire({
                    title: "Apa kamu yakin?",
                    text: "Menghapus data ini!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    dangerMode: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                          'Terhapus!',
                          'Data berhasil dihapus.',
                          'success'
                        )
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('surat.store') }}"+'/'+data_id,
                            success: function (data) {
                                table.draw();
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }
                })
            });
            // end delete
        });
    </script>
@endpush