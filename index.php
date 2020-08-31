<?php require_once __DIR__ . '/config.php'; ?>
<!doctype html>
<html lang=en>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    body {
        margin:0px;
        -webkit-touch-callout: none;
        -webkit-text-size-adjust: none;
        -webkit-user-select: none;
        overflow: hidden;
    }
    #container {
        width: 100vw;
        height: 100vh;
        overflow: hidden;
    }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.drawr.combined.js?v=2"></script>
</head>
<body>
    <div id="container">
        <canvas class="canvas"></canvas>
    </div>
    <input type="file" id="file-picker" style="display:none;">
    <script type="text/javascript">
    (function () {
        // define settings
        $("#container .canvas").drawr({
            enable_tranparency: true,
            canvas_width: <?php echo $image['width'] ?>,
            canvas_height: <?php echo $image['height'] ?>,
            brushes_title: "Vahendid",
            zoom_title: "Suum",
            background_image: "<?php echo $image['path'] ?>",
            scroll_to_center: true,
            fit_to_window: true,
            buttons: {
                move: {order: 1},
                pen: {order: 2, size: 15, icon: "mdi mdi-grease-pencil mdi-24px"},
                brush: {order: 3, size: 30},
                airbrush: {order: 4, alpha: 0.5, size: 150},
                filledsquare: {order: 5},
                unfilledsquare: {order: 6},
                eraser: {order: 7, size: 50}
            }
        });

        // start plugin
        $("#container .canvas").drawr("start");

        // add custom load file button
        var buttoncollection = $(".canvas").drawr("button", {
            "icon":"mdi mdi-folder-open mdi-24px"
        }).on("touchstart mousedown", function() {
            $("#file-picker").click();
        });
        $("#file-picker")[0].onchange = function(){
            var file = $("#file-picker")[0].files[0];
            if (!file.type.startsWith('image/')){ return }
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#container .canvas").drawr("load",e.target.result);
            };
            reader.readAsDataURL(file);
        };

        // add custom download button
        var buttoncollection = $("#container .canvas").drawr("button", {
            "icon":"mdi mdi-download mdi-24px"
        }).on("touchstart mousedown", function() {
            var imagedata = $("#container .canvas").drawr("export","image/png");
            var element = document.createElement('a');
            element.setAttribute('href', imagedata);
            element.setAttribute('download', "layer.png");
            element.style.display = 'none';
            document.body.appendChild(element);
            element.click();
            document.body.removeChild(element);
        });

        // add custom save button
        var buttoncollection = $("#container .canvas").drawr("button", {
            "icon":"mdi mdi-content-save mdi-24px"
        }).on("touchstart mousedown", function() {
            var imagedata = $("#container .canvas").drawr("export","image/png");
            $.post("saveImg.php", {imagedata: imagedata}, function(data) {
                alert(data);
            });
        });

        // read default layer from base64 text
        // $.get('img/layer.txt', function(data) {
        //  $("#container .canvas").drawr("load", data);
        // });

        // read default layer from image file
        $.ajax({
            url: 'img/layer.png',
            cache: false,
            xhr: function(){
                var xhr = new XMLHttpRequest();
                xhr.responseType= 'blob'
                return xhr;
            },
            success: function(data){
                var reader = new FileReader();
                reader.onloadend = function () {
                    $("#container .canvas").drawr("load", reader.result);
                }
                reader.readAsDataURL(data);
            },
            error:function(){
                alert('Could not load layer!');
            }
        });
    })();
    </script>
</body>
</html>