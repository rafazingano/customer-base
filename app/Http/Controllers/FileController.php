<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\File;

class FileController extends Controller
{
    

    /**
     * Resolve o envio do arquivo.
     *
     * @param Request $request A instância do request.
     * @return Response A instância da response.
     */
    public function upload(Request $request, $dir = 'public/uploads')
    {

        /*
         * O campo do form com o arquivo tinha o atributo name="file".
         */
        $files = $request->file('files');

        if (empty($files)) {
            return false;
        }

        /*
         * Apenas grava o arquivo depois da verificação.
         */
        foreach($request->file('files') as $file){
	        $md5Name = md5(uniqid(rand(), true)) . '.' . $file->guessExtension();
	        $path = $file->storeAs($dir, $md5Name);
	        $fs[] = $md5Name;
		}
        // Faça qualquer coisa com o arquivo enviado...

        return $fs;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        File::destroy($id);
        return back()->withInput()->with('message', 'Arquivo deletado com sucesso!!');
    }

}
