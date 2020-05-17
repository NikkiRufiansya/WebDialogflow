
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <title>Data Pertanyaan</title>

</head>
<body>


<div class="container" style="margin-top: 50px;">
    <h3 class="text-center">Hai<b>   {{ Auth::user()->name }} </b> Selamat datang di Admin STIKBOTS</h3><br>
    
    <a href="/mahasiswa" class="btn btn-primary">Data Mahasiswa</a>
    <a href="{{ route('logout') }}"
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();" class="btn btn-dark">
    Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
    </form>
    
    <br><br>

    <h5># Data Training</h5> 
    <table class="table table-bordered">
        <tr>
          
            <th>Query</th>
            <th width="280" class="text-center">Action</th>
        </tr>
        <tbody id="tbody">

        </tbody>
    </table>
</div>

<!-- Update Model -->
<form action="" method="POST" class="users-update-record-model form-horizontal">
    <div id="update-modal" data-backdrop="static" data-keyboard="false" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width:55%;">
            <div class="modal-content" style="overflow: hidden;">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Update</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body" id="updateBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                            data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-success updateQuery">Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Delete Model -->
<form action="" method="POST" class="users-remove-record-model">
    <div id="remove-modal" data-backdrop="static" data-keyboard="false" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Delete</h4>
                    <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to delete this record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form"
                            data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-danger waves-effect waves-light deleteRecord">Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


{{--Firebase Tasks--}}
<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>
<!-- <script src="https://www.gstatic.com/firebasejs/7.14.4/firebase-app.js"></script> -->

<script>
      // Set the configuration for your app
  // TODO: Replace with your project's config object
  var config = {
   apiKey: "AIzaSyD4WG-Nl-gTezbHxNPs1LwG0FwLQYdD4nw",
    authDomain: "testingbotdb-xwxvvy.firebaseapp.com",
    databaseURL: "https://testingbotdb-xwxvvy.firebaseio.com",
    projectId: "testingbotdb-xwxvvy",
    storageBucket: "testingbotdb-xwxvvy.appspot.com",
    messagingSenderId: "143316318232",
    appId: "1:143316318232:web:9c42b2e5754f0d0d32ab6d"
  };
  firebase.initializeApp(config);

  // Get a reference to the database service
  var database = firebase.database();

  

    var lastIndex = 0;

    // Get Data
    firebase.database().ref('query_user/').on('value', function (snapshot) {
        var value = snapshot.val();
        var id = snapshot.key;
        var htmls = [];
        $.each(value, function (index, value) {
            if (value) {
                htmls.push('<tr>\
        		<td>' + value.query + '</td>\
        		<td><button data-toggle="modal" data-target="#update-modal" class="btn btn-info updateData" data-id="' + index + '">Update</button>\
        		<button data-toggle="modal" data-target="#remove-modal" class="btn btn-danger removeData" data-id="' + index + '">Delete</button>\
                <a href="/trainingData/'+value.query+'" class ="btn btn-warning">Training</a>\
                </td>\
        	</tr>');
            }
            lastIndex = index;
        });
        $('#tbody').html(htmls);
        $("#submitUser").removeClass('desabled');
    });

   

    // Update Data
    var updateID = 0;
    $('body').on('click', '.updateData', function () {
        updateID = $(this).attr('data-id');
        firebase.database().ref('query_user/' + updateID).on('value', function (snapshot) {
            var values = snapshot.val();
            var updateData = '<div class="form-group">\
		        <div class="col-md-12">\
		            <input id="id" type="hidden" class="form-control" name="id" value="' + values.ID + '" required autofocus>\
		        </div>\
		    </div>\
		    <div class="form-group">\
		        <label for="last_name" class="col-md-12 col-form-label">Query</label>\
		        <div class="col-md-12">\
		            <input id="last_name" type="text" class="form-control" name="email" value="' + values.query + '" required autofocus>\
		        </div>\
		    </div>';

            $('#updateBody').html(updateData);
        });
    });

    $('.updateQuery').on('click', function () {
        var values = $(".users-update-record-model").serializeArray();
        var postData = {
            id: values[0].value,
            query: values[1].value,
        };

        var updates = {};
        updates['/query_user/' + updateID] = postData;

        firebase.database().ref().update(updates);

        $("#update-modal").modal('hide');
    });

    // Remove Data
    $("body").on('click', '.removeData', function () {
        var id = $(this).attr('data-id');
        $('body').find('.users-remove-record-model').append('<input name="id" type="hidden" value="' + id + '">');
    });

    $('.deleteRecord').on('click', function () {
        var values = $(".users-remove-record-model").serializeArray();
        var id = values[0].value;
        firebase.database().ref('query_user/' + id).remove();
        $('body').find('.users-remove-record-model').find("input").remove();
        $("#remove-modal").modal('hide');
    });
    $('.remove-data-from-delete-form').click(function () {
        $('body').find('.users-remove-record-model').find("input").remove();
    });
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>