<?php

namespace App\Http\Controllers;

use App\Document;
use App\DocumentType;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    //

    public function ShowApplicantDocument(){
        $docs = DB::table('document')
            ->join('users', 'document.user_id', '=', 'users.user_id')
            ->select('users.first_name', 'users.last_name', 'users.role_id', 'users.role_id',
                'document.document_name', 'document.document_url', 'document.document_type_id', 'document.created_at')
            ->where('users.role_id', '=', 'ROLE002')
            ->get();

        return view('hr.applicant_document')->with([
            "docs" => $docs
        ]);

    }

    public function ShowRecruiterDocument(){
        $docs = DB::table('document')
            ->join('users', 'document.user_id', '=', 'users.user_id')
            ->select('users.first_name', 'users.last_name', 'users.role_id', 'users.role_id',
                'document.document_name', 'document.document_url', 'document.document_type_id', 'document.created_at')
            ->where('users.role_id', '=', 'ROLE001')
            ->get();

        return view('hr.recruiter_document')->with([
            "docs" => $docs
        ]);

    }

    public function UploadDocument(Request $request){
        $doc = new Document();
        $doc->document_id = GenerateId('document', 'DOC');
        $doc->user_id = Auth::user()->user_id;
        $doc->document_name = $request->docName;
        $doc->document_type_id = $request->docType;

        $date = strtotime("now");
        $pic = $request->file('docs');
        $namafile = str_replace(' ','_',Auth::user()->user_id.$request->docName.'_'.$date.'.'.$pic->getClientOriginalExtension()); /*Membuat nama foto berdasarkan nama pengguna*/
        $pic->move(public_path('/documents/user/'), $namafile); /*Memindahkan foto ke direktori assets/images/users*/

        $doc->document_url = '/documents/user/'.$namafile;

        $doc->save();

        return redirect('/profile')->with([
            "success" => "Upload Document Success!"
        ]);
    }

    public function DeleteDocument($id){
        $doc = Document::find($id);
        unlink(substr($doc->document_url, 1));
        $doc->delete();
        return redirect('/profile')->with('success','Document Deleted.');
    }

    public function ShowDocumentType(){

        $docType = DocumentType::all();

        return view('hr.manage_document_type')->with([
            "docTypes" => $docType
        ]);
    }

    public function AddDocumentType(Request $request){

        $docType = new DocumentType();
        $docType->document_type_id = GenerateId('document_type', 'DTY');
        $docType->document_type_name = $request->document_type_name;
        $docType->save();

        return redirect('/document/type')->with([
            "success" => "Success Add New Document Type"
        ]);
    }

    public function DeleteDocumentType($id){
        $doctype = DocumentType::find($id);
        $doctype->delete();

        return redirect('/document/type')->with([
            "success" => "Success Delete Document Type"
        ]);
    }

}
