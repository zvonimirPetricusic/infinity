@section('adminStructure')


<div id="asideContainer">
        <div id="logoContainer">
            <h1>Logo</h1>
        </div>
        <div id="navContainer">
            <div class="navItem  active" id="navDashboard">
                <a href="{{ url('/home') }}" class="navLink"><img src="../../img/dashboard.png" class="icon" alt="Dashboard icon">&nbsp; Dashboard</a>
            </div>
            <div class="navItem" id="navItem">
                <a href="{{ url('/items') }}" class="navLink"><img src="../../img/dashboard.png" class="icon" alt="Dashboard icon"> &nbsp; Items</a>
            </div>
            <div class="navItem" id="navCategories">
                <a href="{{ url('/categories') }}" class="navLink"><img src="../../img/dashboard.png" class="icon" alt="Dashboard icon">&nbsp; Categories</a>
            </div>
            <div class="navItem" id="navSubcategories">
                <a href="{{ url('/subcategories') }}" class="navLink"><img src="../../img/dashboard.png" class="icon" alt="Dashboard icon">&nbsp;Subcategories</a>
            </div>
            <div class="navItem" id="navSettings">
                <a href="{{ url('/settings') }}" class="navLink"><img src="../../img/setting.png" class="icon" alt="Dashboard icon">&nbsp; Settings</a>
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
</div>


@show
