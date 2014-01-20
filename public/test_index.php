<html>
    <head>
        <title>Photo Gallery Test version</title>
        <link href="stylesheets/main.css" media="all" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="header">
            <h1>Photo Gallery</h1>
        </div>
        <div id="main">

            <div id="main">
                <div style="float: left; margin-left: 20px;">
                    <a href="photo.php?id=6"> <img src="images\buddhas.jpg" width="200" /> </a>
                    <p>
                        Buddhas
                    </p>
                </div>
                <div style="float: left; margin-left: 20px;">
                    <a href="photo.php?id=7"> <img src="images\wall.jpg" width="200" /> </a>
                    <p>
                        Wall
                    </p>
                </div>
                <div style="float: left; margin-left: 20px;">
                    <a href="photo.php?id=8"> <img src="images\wood.jpg" width="200" /> </a>
                    <p>
                        Wood
                    </p>
                </div>
            </div>
            <div id="pagination" style="clear: both;">
                <a href="public_index.php?page=1">Previous</a> &nbsp; &nbsp; <a href="public_index.php?page=1">1</a> &nbsp; 2 &nbsp; <a href="public_index.php?page=3">3</a> &nbsp;  &nbsp; &nbsp; <a href="public_index.php?page=3">Next</a>
            </div>

        </div>
        <div id="footer">
            Copyright 2013, Kevin Skoglund
        </div>
    </body>
</html>

