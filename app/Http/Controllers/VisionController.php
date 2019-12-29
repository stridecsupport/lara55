<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Google\Cloud\Vision\V1\ImageAnnotatorClient;

use Google\Cloud\Samples\Auth;

// Imports the Google Cloud Storage client library.
use Google\Cloud\Storage\StorageClient;

use Illuminate\Support\Facades\Input;
use File;
use Intervention\Image\Facades\Image as Image;


class VisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
				
		//putenv('GOOGLE_APPLICATION_CREDENTIALS=aiml/service-account.json');
		
		$imgdata = '';
		
		$fileName = url('/').'/uploads/default.jpg';
		
		return view('vision/index', compact('imgdata', 'fileName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $requestData = $request->all();

         if(!empty($_POST['namafoto'])){
                $encoded_data = $_POST['namafoto'];
                    $binary_data = base64_decode( $encoded_data );
                     $destinationPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
                    // save to server (beware of permissions // set ke 775 atau 777)
                    $fileName = uniqid().".jpeg";
                    $result = file_put_contents($destinationPath.$fileName, $binary_data );

         }else{

           // $file = $request->file('img');

       // $fileName = '';
       // if($file){
        //   $input = Input::all();
        //   $img = array_get($input,'img'); 
           
        //   if($img)
         //   {
                //    $destinationPath = $_SERVER['DOCUMENT_ROOT'].'/uploads';
                    // GET THE FILE EXTENSION
               //     $extension = $img->getClientOriginalExtension(); 
                    // RENAME THE UPLOAD WITH RANDOM NUMBER 
               //     $fileName = rand(11111, 99999).'-'.date('YmdHis').'.' . $extension; 
                    // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY 
                //    $img->move($destinationPath, $fileName);                
                
            //}
      //  }

         }
		
		
		
		# instantiates a client
		$imageAnnotator = new ImageAnnotatorClient(['credentials' => 'aiml/service-account.json']);

		# the name of the image file to annotate
		$fileName = url('/').'/uploads/'.$fileName;

		# prepare the image to be annotated
		$image = file_get_contents($fileName);

		# performs label detection on the image file
		$response = $imageAnnotator->labelDetection($image);
		$labels = $response->getLabelAnnotations();

		$imgdata = '';
		
		if ($labels) {			
			foreach ($labels as $label) {
				$imgdata .= $label->getDescription() . '<br>';				
			}
		} else {
			$imgdata = 'No label found';
		}
		
		return view('vision/index', compact('imgdata', 'fileName'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

                
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
	
}
