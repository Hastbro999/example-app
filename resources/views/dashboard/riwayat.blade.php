@include('partials.navbar')

{{-- datatables yajra --}}

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Riwayat Absensi</h1>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tgl Masuk</th>
                        <th>Tgl Keluar</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

{{-- end datatables yajra --}}
<script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/riwayat/{{ auth()->user()->id }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'tgl_masuk',
                    name: 'tgl_masuk'
                },
                {
                    data: 'tgl_keluar',
                    name: 'tgl_keluar'
                }
            ]
        });
    });
</script>
