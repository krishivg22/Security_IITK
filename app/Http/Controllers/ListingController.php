<?php

namespace App\Http\Controllers;

use App\Models\listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use ZipArchive;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class ListingController extends Controller
{
    #to get all Listings
    public function index(){  #You can pass in Request $request as formal param., but we can directly access the request query by request().
        return view('listings.index',['listings'=> listing::latest()->filter(request(['tag','search']))->paginate(5)]);    //['listings'=> listing::all()]This was when there was no tag filter. 
    }                                                                     #we can use paginate instead of get...to get pagination. simplePaginate gives next and previous.

    public function sort()
{
   if(request(('sortD'))==1){
    return view('listings.index',['listings'=> listing::orderBy('date', 'asc')->filter(request(['tag','search']))->paginate(request(('pag')))] );
   }
    else if(request(('sortD'))==2) {
        return view('listings.index',['listings'=> listing::orderBy('date', 'desc')->filter(request(['tag','search']))->paginate(request(('pag')))] );
    }
    else {
        return view('listings.index',['listings'=> listing::latest()->filter(request(['tag','search']))->paginate(request(('pag')))]);
    }
}
    #to show single listing
    public function show(listing $listing){
            return view('listings.show', [
            'listing' => $listing               
            ]);
    }
    public function create(listing $listing){
        return view('listings.create');
    }
    public function download(listing $listing){
       
        $html = View::make('listings.pdf', compact('listing'))->render();
        // $response = Response::make($html);

        // // Set the content type to force download
        // $response->header('Content-Type', 'text/html');
        // $response->header('Content-Disposition', 'attachment; filename="listings.html"');
    
        // return $response; 

        // Create Dompdf instance
        $dompdf = new Dompdf();

        // Load HTML content
        $dompdf->loadHtml($html);

        // Set paper size (optional)
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Stream the file to the browser with a specific filename
        // return $dompdf->stream('document.pdf');
        $pdfContent = $dompdf->output();
        $zip = new ZipArchive;
        $zipFileName = 'downloaded_files.zip';
    
        if ($zip->open($zipFileName, ZipArchive::CREATE) === true) {
            // Add the PDF to the zip file
            $zip->addFromString('document.pdf', $pdfContent);
    
            // Add other files from the public folder to the zip file
            if($listing->attachment !=NULL){
            if(strpos($listing->attachment, ',') !== false){
            $attachments= explode(',',$listing->attachment); 
            }
            else{
                $attachments=[$listing->attachment]  ;
            }
        
            $filesFromPublic = [];
            foreach($attachments as $attachment){
                $filesFromPublic[]='storage/'.$attachment;
            }
    
            foreach ($filesFromPublic as $file) {
                $fileContent = file_get_contents($file);
                $zip->addFromString(basename($file), $fileContent);
            }
        }
            $zip->close();
        }
    
        // Stream the zip file to the browser with a specific filename
        return response()->download($zipFileName)->deleteFileAfterSend();
    
    }
    public function store(Request $request){
$formFields = $request->validate([
'title' => 'required',
'venue' => 'required',
'date' =>'required',
'time' =>'required',
'status' => 'required',
'tags' => 'required',
'description' => 'required'
]);                       #filesystems .php me public krdo usse uploaded files storage->app->public me store hongi
if($request->hasFile('attachment')) {
    $attachments="";
    foreach ($request->file('attachment') as $file) {
        // Store each file in the 'attachments' directory within the 'public' in storage,app.
        $filePath = $file->store('attachments', 'public');
        // Add the file path to the array
        $attachments = $attachments.$filePath.",";
    }    # isse file storage->app->public me logos me store ho gyi and path formFields me logo me chla gya jo database me chla gya.
    $attachments=substr($attachments, 0, -1);
    $formFields['attachment']= $attachments;
    }
    $formFields['user_id']=auth()->id();
    $user=auth()->user();
    $formFields['reporter']=$user->name;
listing::create($formFields);
return redirect('/')->with('message', 'Report Created Successfully');
    }
    public function edit(listing $listing){
        if($listing['user_id']!=auth()->id()){
            abort(403,'Unauthorized Action');
        }
        return view('listings.edit', ['listing'=>$listing]);
    }
    public function update(Request $request, listing $listing){
        if($listing['user_id']!=auth()->id()){
            abort(403,'Unauthorized Action');
        }
        $formFields = $request->validate([
            'title' => 'required',
            'venue' => 'required',
            'date' =>'required',
            'time' =>'required',
            'status' => 'required',
            'tags' => 'required',
            'description' => 'required'
            ]);                       #filesystems .php me public krdo usse uploaded files storage->app->public me store hongi
            if($request->hasFile('attachment')) {
                $attachments="";
                foreach ($request->file('attachment') as $file) {
                    // Store each file in the 'attachments' directory within the 'public' disk
                    $filePath = $file->store('attachments', 'public');
                    // Add the file path to the array
                    $attachments = $attachments.$filePath.",";
                }    # isse file storage->app->public me logos me store ho gyi and path formFields me logo me chla gya jo database me chla gya.
                $attachments=substr($attachments, 0, -1);
                $formFields['attachment']= $attachments;
                }
            $listing->update($formFields);
            return redirect('/')->with('message', 'Report Updated Successfully');
            }
            public function attach(Request $request, listing $listing){
                if($listing['user_id']!=auth()->id()){
                    abort(403,'Unauthorized Action');
                }
                $formFields=$request->validate([]);                      #filesystems .php me public krdo usse uploaded files storage->app->public me store hongi
                    if($request->hasFile('attachment')) {
                        $attachments=$listing['attachment'].',';
                        foreach ($request->file('attachment') as $file) {
                            // Store each file in the 'attachments' directory within the 'public' disk
                            $filePath = $file->store('attachments', 'public');
                            // Add the file path to the array
                            $attachments = $attachments.$filePath.",";
                        }    # isse file storage->app->public me logos me store ho gyi and path formFields me logo me chla gya jo database me chla gya.
                        $attachments=substr($attachments, 0, -1);
                        $formFields['attachment']= $attachments;
                        }
                    $listing->update($formFields);
                    return back()->with('message', 'Files Attached Successfully');
                    }
            public function destroy(listing $listing) {
                if($listing['user_id']!=auth()->id()){
                    abort(403,'Unauthorized Action');
                }
                $listing->delete();
                return redirect('/')->with('message','Report Deleted Successfully');
            }
            public function manage(){
                return view('listings.manage',['listings'=> auth()->user()->listings()->get()]);
            }
}
