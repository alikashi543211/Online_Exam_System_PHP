<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="stylesheet.css" type="text/css" />
<link rel="shortcut icon" href="d.jpg" />
<link href="ddmenu.css" rel="stylesheet" type="text/css" />
<script src="ddmenu.js" type="text/javascript"></script>
</head>

</html>
<?php/*
session_start();
include ("connection.php");
if(!$_SESSION['email_id'])
{
	header ('Location:../index.php');
}
else if($_SESSION['user_type_id']!='2')
{
	header ('Location:error.php');
}
*/?>

<title>
Admin
</title>
<html>
<body id="bgcolor" >
<form action="../index.php" method="post">
<div>
<table id="table1">
<tr>
<td id="td1">
<?php /* echo "<h1 id='heading_a'>WELLCOME ".strtoupper($_SESSION['user_name']."</h1>"); */?>
</td>
<td id="td2"><input class="testbutton" id="button1" type="submit" name="sign_out" value="Sign Out" />
</td>
</tr>
</table>
</div>
</form>
<nav id="ddmenu">
    <div class="menu-icon"></div>
    <ul>
        <li class="full-width">
            <span class="top-heading">User</span>
            <i class="caret"></i>
            <div class="dropdown">
                <div class="dd-inner">
                    <ul class="column">
                        <li>Lorem Ipsum</li>
                        <li><a href="#">Dolor sit amet</a></li>
                        <li><a href="#">Consectetur elit</a></li>
                        <li><a href="#">Etiam massa</a></li>
                        <li><a href="#">Suscipit sapien</a></li>
                        <li><a href="#">Quis turpis</a></li>
                    </ul>
                    <ul class="column">
                        <li><h3>User Type</h3></li>
                        <li><a href="#">Sed interdum</a></li>
                        <li><a href="#">Fringilla congue</a></li>
                        <li><a href="#">Dolor nisl auctor</a></li>
                        <li><a href="#">Quisque dictum</a></li>
                        <li><a href="#">Porttitor</a></li>
                    </ul>
                    <ul class="column mayHide">
                        <li><br /><img src="ddmenu/img1.jpg" /></li>
                    </ul>
                </div>
            </div>
        </li>
		<li>
            <a class="top-heading" href="http://www.microsoft.com">User Type</a>
            <i class="caret"></i>
            <div class="dropdown">
                <div class="dd-inner">
                    <ul class="column">
                        <li><h3>Vestibulum Ut</h3></li>
                        <li><a href="#">Nunc pharetra</a></li>
                        <li><a href="#">Vestibulum ante</a></li>
                        <li><a href="#">Nulla id laoreet</a></li>
                        <li><a href="#">Elementum blandit</a></li>
                    </ul>
                </div>
            </div>
        </li>
        <li class="no-sub"><a class="top-heading" href="http://www.google.com">Program</a></li>
        <li>
            <a class="top-heading" href="http://www.microsoft.com">Course</a>
            <i class="caret"></i>
            <div class="dropdown">
                <div class="dd-inner">
                    <ul class="column">
                        <li><h3>Vestibulum Ut</h3></li>
                        <li><a href="#">Nunc pharetra</a></li>
                        <li><a href="#">Vestibulum ante</a></li>
                        <li><a href="#">Nulla id laoreet</a></li>
                        <li><a href="#">Elementum blandit</a></li>
                    </ul>
                </div>
            </div>
        </li>
        <li>
            <span class="top-heading">Program Course</span>
            <i class="caret"></i>
            <div class="dropdown offset300">
                <div class="dd-inner">
                    <ul class="column">
                        <li><h3>Pellentesque</h3></li>
                        <li><a href="#">Fermentum ut nulla</a></li>
                        <li><a href="#">Duis ut mauris</a></li>
                        <li><h3>Volutpat</h3></li>
                        <li><a href="#">Quisque dictum</a></li>
                        <li><a href="#">Nulla scelerisque</a></li>
                    </ul>
                    <ul class="column">
                        <li><h3>Suspendisse</h3></li>
                        <li><a href="#">Suspendisse potenti</a></li>
                        <li><a href="#">Curabitur in mauris</a></li>
                        <li><a href="#">Phasellus ultrices</a></li>
                        <li><a href="#">Quisque ornare</a></li>
                        <li><a href="#">Vestibulum</a></li>
                        <li><a href="#">Vitae tempus risus</a></li>
                    </ul>
                    <ul class="column mayHide">
                        <li><br /><img src="ddmenu/img2.jpg" /></li>
                    </ul>
                </div>
            </div>
        </li>
        <li class="no-sub">
            <a class="top-heading" href="#">Session</a>
        </li>
        <li>
            <span class="top-heading">Date Sheet</span>
            <i class="caret"></i>
            <div class="dropdown right-aligned">
                <div class="dd-inner">
                    <ul class="column">
                        <li><h3>Nam a leo</h3></li>
                        <li><a href="#">Vel faucibus leo</a></li>
                        <li><a href="#">Duis ut mauris</a></li>
                        <li><a href="#">In tempus semper</a></li>
                        <li><a href="#">laoreet erat</a></li>
                    </ul>
                    <ul class="column">
                        <li><h3>Proin iaculis</h3></li>
                        <li><a href="#">In tempus semper</a></li>
                        <li><a href="#">Hendrerit tincidunt</a></li>
                        <li><a href="#">Duis ut mauris</a></li>
                        <li><a href="#">pretium amet</a></li>
                    </ul>
                </div>
            </div>
        </li>
		<li>
            <a class="top-heading" href="http://www.microsoft.com">Question Paper Type</a>
            <i class="caret"></i>
            <div class="dropdown">
                <div class="dd-inner">
                    <ul class="column">
                        <li><h3>Vestibulum Ut</h3></li>
                        <li><a href="#">Nunc pharetra</a></li>
                        <li><a href="#">Vestibulum ante</a></li>
                        <li><a href="#">Nulla id laoreet</a></li>
                        <li><a href="#">Elementum blandit</a></li>
                    </ul>
                </div>
            </div>
        </li>
		<li>
            <a class="top-heading" href="http://www.microsoft.com">Question Paper</a>
            <i class="caret"></i>
            <div class="dropdown">
                <div class="dd-inner">
                    <ul class="column">
                        <li><h3>Vestibulum Ut</h3></li>
                        <li><a href="#">Nunc pharetra</a></li>
                        <li><a href="#">Vestibulum ante</a></li>
                        <li><a href="#">Nulla id laoreet</a></li>
                        <li><a href="#">Elementum blandit</a></li>
                    </ul>
                </div>
            </div>
        </li>
    </ul>
</nav>
    <div style="margin:200px auto 40px; width:400px; font:normal 15px/20px Arial; color:white; background-color:rgba(0,0,0,0.5);padding:30px;">
        <h2>Note</h2>
        <p>If you decrease the window size and the menu switches to the mobile mode, some of the columns in the menu dropdown will disappear. 
This is because we have added the <code><b>mayHide</b></code> class to the columns. Class <b>mayHide</b> has been set to <code>display:none</code> 
in the <em>ninja-slider.css</em> when the screen size is small.</p>
    </div>
</body>
</html>