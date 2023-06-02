<html>
<head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>How to convert html to pdf  | tutorialswebsite.com</title>
</head>

<body>

<div class="container">
      <form class="contact-us form-horizontal" action="dopdf.php" method="post">
        <legend>Fill Form and submit to generate PDF</legend>        
        <div class="control-group">
            <label class="control-label">Name</label>
            <div class="controls">
                <div class="input-prepend">
                <span class="add-on"><i class="icon-user"></i></span>
                    <input type="text" class="input-xlarge" name="name" placeholder="Name">
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Email</label>
            <div class="controls">
                <div class="input-prepend">
                <span class="add-on"><i class="icon-envelope"></i></span>
                    <input type="text" class="input-xlarge" name="email" placeholder="Email">
                </div>
            </div>    
        </div>
        <div class="control-group">
            <label class="control-label">Url</label>
            <div class="controls">
                <div class="input-prepend">
                <span class="add-on"><i class="icon-globe"></i></span>
                    <input type="text" id="url" class="input-xlarge" name="url" placeholder="http://www.example.com">
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Comment</label>
            <div class="controls">
                <div class="input-prepend">
                <span class="add-on"><i class="icon-pencil"></i></span>
                    <textarea name="comment" class="span4" rows="4" cols="80" placeholder="Comment (Max 200 characters)"></textarea>
                </div>
            </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn">Cancel</button>
          </div>    
        </div>
      </form>
</div>
</body>
</html>