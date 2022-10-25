<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- DATATABLE -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/nav/aside.css') }}" rel="stylesheet">
    <link href="{{ asset('css/categories.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    

    <script type="application/javascript" src="{{ asset('js/similarity.min.js') }}"></script> 



    <link rel="stylesheet" href="{{ asset('css/chatbot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <script type="application/javascript" src="{{ asset('js/chatbot.js') }}"></script> 
    <title>Home</title>
</head>
<body>
    <div class="nav">

    </div>

    <div id="welcomeContainer">
        <div class="card-body" id="itemsContainer">  
          

          <?php foreach ($items as $item){?>
            <div class="card">
              <?php echo '<img src="/img/' . $item->filename . '" alt="Avatar" style="width:100%">'; ?> 
              <div class="container">
                <h4><b><?php echo $item->name; ?></b></h4> 
                <h6 style="color: #bcbaba;">ID: <?php echo $item->id; ?></h6> 
                <p><?php echo $item->description; ?></p> 
              </div>
            </div>
          <?php } ?>
        </div>
    </div> 

    @include('chatbot')
</body>
<style>
    .nav{
        width: 100%;
        height: 50px;
        position: absolute;
        top: 0;
        left: 0;
        background: #FE2D67;
    }
</style>
</html>