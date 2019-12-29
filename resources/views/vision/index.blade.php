<!DOCTYPE html>

<html>

  <head>

    <title>Instascan</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script type="text/javascript" src="{{ url('/') }}/js/instascan.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/js/webcam.min.js"></script>
	<style>
	.formdiv { width:100%; margin:0 auto; text-align:center; }
	.imgsize { margin-top:25px; max-width:400px; max-height: 300px; }
	</style>
  </head>

  <body>

	
    <form role="form" name="frm" id="frm" method="post" action="{{ url('/vision') }}"  enctype='multipart/form-data'>
	{{ csrf_field() }}
	
	<div class="formdiv">
	<div id="my_camera" style="margin-left: 500px; margin-top: 20px; margin-bottom: 20px"></div>
	<button class="btn btn-space btn-primary" type="button" id="capture" onclick="take_snapshot()">Capture</button>
	<!--<input class="form-control" type="file" name="img" id="img" required>-->
	 <input type="hidden" id="namafoto"  name="namafoto" value="">
	<!--<button class="btn btn-space btn-primary" type="submit">Submit</button>-->
	
	<div>
	
	
	<img id="uploadPreview" src="{{ $fileName }}" class="imgsize" />
	
	</div>
	
	<div id="imgdata">

	{!! $imgdata !!}
	
	</div>
	
	<!--<video id="preview"></video>-->
	
	</div>
	
	</form>

	<script type="text/javascript" src="{{ url('/') }}/js/jquery.min.js"></script>
	
	<script type="text/javascript">
	Webcam.set({
			width: 320,
			height: 240,
			image_format: 'jpeg',
			jpeg_quality: 90
		});
		Webcam.attach( '#my_camera' );
		function take_snapshot() {
			// take snapshot and get image data
			Webcam.snap( function(data_uri) {
		
	document.getElementById('uploadPreview').src = data_uri;
	var base64image = document.getElementById("uploadPreview").src;
   var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
document.getElementById('namafoto').value = raw_image_data;
                            document.getElementById('frm').submit();
				
			} );
		}

    </script>

  </body>

</html>