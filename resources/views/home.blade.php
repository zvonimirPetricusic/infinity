@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
<!-- Bootstrap Font Icon CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<link href="{{ asset('css/dashboard/index.css') }}" rel="stylesheet">


<body>
    <div id="asideContainer">
        <div id="logoContainer">
            <h1>Logo</h1>
        </div>
        <div id="navContainer">
            <div class="navItem  active">
                <a href="" class="navLink"><img src="../../img/dashboard.png" class="icon" alt="Dashboard icon">&nbsp; Dashboard</a>
            </div>
            <div class="navItem">
                <a href="" class="navLink"><img src="../../img/dashboard.png" class="icon" alt="Dashboard icon">&nbsp; Dashboard</a>
            </div>
            <div class="navItem">
                <a href="" class="navLink"><img src="../../img/dashboard.png" class="icon" alt="Dashboard icon">&nbsp; Dashboard</a>
            </div>
            <div class="navItem">
                <a href="" class="navLink"><img src="../../img/dashboard.png" class="icon" alt="Dashboard icon"> &nbsp; Dashboard</a>
            </div>
            
        </div>
        <div id="btnContainer">

        </div>
    </div>

    <div id="headerContainer">
        <div id="blankContainer">

        </div>
        <div id="actionsContainer">
            <div class="actionItem" id="messageAction">
                <img src="../../img/email.png" title="Messages" class="actionIcon" alt="Dashboard icon">
            </div>
            <div class="actionItem" id="userAction">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <img src="../../img/logout.png" title="Logout" class="actionIcon" alt="Dashboard icon">
                </a>
            </div>
        </div>  
    </div>
    
    <div id="subHeaderContainer">
        <h3><img src="../../img/dashboardBlack.png" class="icon" alt="Dashboard icon"> &nbsp; Dashboard</h3>
    </div>


</body>
@endsection
