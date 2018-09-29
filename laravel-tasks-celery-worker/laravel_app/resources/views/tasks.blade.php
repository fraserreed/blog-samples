<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blog Sample - Laravel App</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://v4-alpha.getbootstrap.com/examples/starter-template/starter-template.css"
          crossorigin="anonymous">

</head>
<body style="padding-top: 0.5rem;">

<div class="container">
    <div class="starter-template">
        <h4>Message Queue Tasks</h4>
    </div>

    <div class="container" style="padding-bottom: 50px;">
        <div class="row">
            <div class="col-sm-10 offset-sm-1 text-center">
                <div class="info-form">
                    <form method="post" action="{{url('/')}}" class="form-inline justify-content-center">
                        @csrf
                        <div class="form-group">
                            <label class="sr-only">Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Name" required>
                        </div>
                        <button type="submit" class="btn btn-success" style="margin-left: 8px;">Create Task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="flex-center position-ref full-height">
        <div class="content">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Message</th>
                </tr>
                </thead>
                <tbody>
                @if ( count($tasks ) > 0 )
                    @foreach($tasks as $task)
                        <tr>
                            <th scope="row">{{$task->id}}</th>
                            <td>{{$task->name}}</td>
                            <td>{{ucfirst($task->status)}}</td>
                            <td>{{$task->message}}</td>
                        </tr>
                </tbody>
                @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center">No tasks dispatched!</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</div>

</body>
</html>
