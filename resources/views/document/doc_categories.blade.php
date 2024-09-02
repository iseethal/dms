@include('document.navbar')


<table class="table">
    <thead>
        <tr>
            <th scope="col">Doc_cat_id</th>
            <th scope="col">Category Name</th>
            <th scope="col">Accepted Type</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($categories as $item)
            <tr>
                <th scope="row">{{ $item->id }}</th>
                <td>{{ $item->category_name }}</td>
                <td>{{ $item->accepted_type }}</td>
            </tr>
        @endforeach


    </tbody>
</table>
