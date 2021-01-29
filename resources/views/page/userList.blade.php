@include('include.header')
<body>

<div class="container">
    <h1>Bit Panda Test</h1>
    <table class="table table-bordered data-table">
        <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Active</th>
            <th width="100px">Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

</body>

<script type="text/javascript">
    $(function () {

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url()->current() }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'id'},
                {data: 'email', name: 'email'},
                {data: 'active', name: 'active'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });
</script>
</html>
