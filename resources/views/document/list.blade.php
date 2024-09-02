@include('document.navbar')


<style>
    .add-button {
        display: flex;
        justify-content: flex-end;
    }
</style>



<div class="add-button">
    <a href="{{ route('document.add') }}" class="btn btn-primary">Add Document</a>
</div>
<br>
<img src="{{ asset('storage/qr-codes/qr-code.svg') }}" style="width: 100px; height: 100px">

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Doc Id</th>
            <th scope="col">Doc category Id</th>
            <th scope="col">Doc Name</th>
            <th scope="col">Doc Type</th>
            <th scope="col">Doc Size</th>
            <th scope="col">Expiry Date</th>
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
            <th>Qr</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($documents as $item)
            <tr>
                <th scope="row"> {{ $i++ }} </th>
                <td>{{ $item->category->category_name }}</td>
                <td>{{ $item->doc_file }}</td>
                <td> {{ $item->doc_type }} </td>
                <td> {{ $item->doc_size }}</td>
                <td> {{ $item->expiry_date }} </td>
                <td> {{ $item->created_at }} </td>

                <td>
                    <img src="{{ asset('storage/qr-codes/qr-code-123.svg') }}" style="width: 100px; height: 100px">
                </td>
                <td>
                    <a href="{{ route('document.edit', ['id' => $item['id']]) }}" class="btn btn-info">Edit</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('document.delete', $item->id) }}" onclick="myDelete(event)"
                        class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $documents->links() }}

<script>
    function myDelete(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log('urlToredirect');
        swal({
                title: `Do you want to Delete ?`,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = urlToRedirect;
                }
            });
    }

    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
