<!DOCTYPE html>
<html>
<head>
    <title>User Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Search Users</h2>

        <form id="searchForm" method="GET">
            <div class="form-group">
                <input type="text" name="search" id="searchInput" class="form-control" placeholder="Search by Name, Department, or Designation">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <h3 class="mt-5">Search Results:</h3>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th><a href="#" class="sort" data-sort="name">Name</a></th>
                    <th><a href="#" class="sort" data-sort="designation">Designation</a></th>
                    <th><a href="#" class="sort" data-sort="department">Department</a></th>
                </tr>
            </thead>
            <tbody id="results"></tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            function fetchResults() {
                let search = $('#searchInput').val();
                let sortBy = $('.sort.active').data('sort');
                let sortOrder = $('.sort.active').data('order') || 'asc';

                $.ajax({
                    url: "{{ route('ajax.search') }}",
                    method: "POST",
                    data: {
                        search: search,
                        sortBy: sortBy,
                        sortOrder: sortOrder,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        let rows = '';
                        $.each(response.users, function(index, user) {
                            rows += `<tr>
                                        <td>${user.name}</td>
                                        <td>${user.designation.name}</td>
                                        <td>${user.department.name}</td>
                                     </tr>`;
                        });
                        $('#results').html(rows);
                    }
                });
            }

            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                fetchResults();
            });

            $('.sort').on('click', function(e) {
                e.preventDefault();
                let currentOrder = $(this).data('order') || 'asc';
                let newOrder = currentOrder === 'asc' ? 'desc' : 'asc';
                $('.sort').removeClass('active').removeData('order');
                $(this).addClass('active').data('order', newOrder);
                fetchResults();
            });

            fetchResults();
        });
    </script>
</body>
</html>
