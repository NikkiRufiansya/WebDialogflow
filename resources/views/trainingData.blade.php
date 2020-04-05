<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <!-- Required meta tags -->
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <title>Training Data</title>
</head>
<body>
    <div class="container">
        <h3>Training Data</h3>
    </div>
    <div class="container">
    <form action="{{url('/putjson')}}" method="POST">
    {{csrf_field()}}
    <div class="form-group">
        <label>Intent Name</label>
        <input type="hidden" name="name" value="{{$id_pertanyaan}}">
        <input type="text" class="form-control" value="{{$id_pertanyaan}}" disabled placeholder="Intent Name" required>
    </div>
    <div class="form-group">
        <label>Training Phrase </label>
        <input type="text" class="form-control" name="phrases" placeholder="Training Phrase" required>
    </div>   
    <div class="form-group">
        <label>Responses</label>
        <input type="text" class="form-control" name="responses" placeholder="Responses" required>
    </div> 
    <div class="form-group">
    <input type="submit" value="Looss lur">
    </div>     

    </form>
    </div>
    
</body>
</html>