<nav class="navbar navbar-expand-lg navbar-dark indigo">

    <a class="navbar-brand" href="{{ base_url() }}">Kalibri KLBOX</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto navbar-left">
            
        </ul>
		<ul class="navbar-nav navbar-right">
			<li class="nav-item active">
                <a class="nav-link" href="{{ base_url() }}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about">About</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="article">Article</a>
            </li>
            @if (is_member())
            <li class="nav-item">
                <a class="nav-link" href="wallet">Wallet</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ base_url() }}member/logout">Logout</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{ base_url() }}login">Login</a>
            </li>
            @endif
		</ul>
		<!--
        <span class="navbar-text white-text">
            Navbar text with an inline element
        </span>
		-->
    </div>
</nav>