<!DOCTYPE html>
<html>
<head>
    <title>Url Minimizer - Reactor Test Task</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <h1>Url Minimizer - Reactor Test Task</h1>

    <div class="card">
        <div class="card-header">
            <form method="POST" action="{{ route('generate.shorten.link.post') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="link" class="form-control" placeholder="Enter URL" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <input type="text" name="timeline" class="form-control" placeholder="Enter Timeline" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">Make Mini Url</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">

            @if (Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif

            <table class="table table-bordered table-sm">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Link</th>
                    <th>Short Link</th>
                    <th>Clicks</th>
                    <th>Time Line(hour(s))</th>
                </tr>
                </thead>
                <tbody>
                @foreach($shortLinks ?? '' as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->link }}</td>
                        <td><a href="{{ route('shorten.link', $row->code) }}" target="_blank">{{ route('shorten.link', $row->code) }}</a></td>
                        <td>{{ $row->clicks }}</td>
                        <td>{{ $row->timeline }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
